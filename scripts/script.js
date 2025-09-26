// --- Theme Switcher ---
(function() {
  const themeToggle = document.getElementById('theme-toggle');
  const htmlEl = document.documentElement;

  const moonIcon = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>`;
  const sunIcon = `<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>`;

  function applyTheme(theme) {
    htmlEl.setAttribute('data-theme', theme);
    if (themeToggle) {
      // Use SVG icons for a cleaner, material look
      themeToggle.innerHTML = theme === 'dark' ? sunIcon : moonIcon;
    }
    localStorage.setItem('vpnlb_theme', theme);
  }

  if (themeToggle) {
    themeToggle.addEventListener('click', (e) => {
      e.preventDefault();
      const currentTheme = htmlEl.getAttribute('data-theme') || 'light';
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
      applyTheme(newTheme);
    });
  }

  // On page load, apply saved theme or system preference
  const savedTheme = localStorage.getItem('vpnlb_theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
  applyTheme(savedTheme);
})();


// Vote handler (AJAX, no reload)
document.querySelectorAll('.vote-btn').forEach(btn => {
  btn.addEventListener('click', async (e) => {
    const button = e.currentTarget;
    const row = button.closest('tr');
    const vpnId = parseInt(row.dataset.vpnId, 10);
    const type = button.dataset.type;
    const region = document.body.dataset.region || 'global';

    // Optimistic UI disable buttons
    const upBtn = row.querySelector('.vote-up');
    const downBtn = row.querySelector('.vote-down');
    upBtn.disabled = true; downBtn.disabled = true;

    try {
      const res = await fetch('vote.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({ vpn_id: vpnId, vote: type, region: region })
      });
      const json = await res.json();
      if (!json || json.ok === undefined) throw new Error('Invalid server response');

      // Add a class to animate the row, then remove it when done.
      row.classList.add('row-pop');
      row.addEventListener('animationend', () => {
        row.classList.remove('row-pop');
      }, { once: true });

      const upEl = row.querySelector('.upcount');
      const downEl = row.querySelector('.downcount');
      const scoreEl = row.querySelector('.score');

      if (json.upvotes !== undefined) upEl.textContent = json.upvotes;
      if (json.downvotes !== undefined) downEl.textContent = json.downvotes;

      const newScore = (parseInt(upEl.textContent,10)||0) - (parseInt(downEl.textContent,10)||0);
      scoreEl.textContent = newScore;
      row.dataset.score = newScore;

      // Mark as voted (MVP: one vote only)
      row.querySelector('.d-flex.justify-content-center').classList.add('voted');

      // Add a specific class to the button that was clicked
      if (type === 'up') {
        upBtn.classList.add('voted-up');
      }

      if (!json.ok && json.error) {
        // Already voted — keep buttons disabled
        console.info(json.error);
      }

      // Re-sort table by score desc, then speed desc, then name
      resortTable();
    } catch (err) {
      // Re-enable on error
      upBtn.disabled = false; downBtn.disabled = false;
      alert('Sorry, voting failed. Please try again.');
    }
  });
});

function resortTable() {
  const tbody = document.querySelector('#vpntable tbody');
  if (!tbody) return;
  const rows = Array.from(tbody.querySelectorAll('tr'));
  rows.sort((a,b) => {
    const pa = parseInt(a.dataset.promoted,10)||0;
    const pb = parseInt(b.dataset.promoted,10)||0;
    if (pb !== pa) return pb - pa;

    const sa = parseInt(a.dataset.score,10)||0;
    const sb = parseInt(b.dataset.score,10)||0;
    if (sb !== sa) return sb - sa;

    const nameA = a.querySelector('td:nth-child(2) .fw-semibold').textContent.trim().toLowerCase();
    const nameB = b.querySelector('td:nth-child(2) .fw-semibold').textContent.trim().toLowerCase();
    return nameA.localeCompare(nameB);
  });
  rows.forEach((r,i) => { r.querySelector('td:first-child').textContent = (i+1); tbody.appendChild(r); });
}

// --- Column Toggler ---
(function() {
    const controlsContainer = document.querySelector('.column-toggle-controls');
    if (!controlsContainer) return;

    const checkboxes = controlsContainer.querySelectorAll('input[type="checkbox"]');

    function updateColumnVisibility() {
        checkboxes.forEach(checkbox => {
            const colName = checkbox.dataset.colName;
            const cells = document.querySelectorAll(`[data-col-name="${colName}"]`);
            cells.forEach(cell => {
                cell.style.display = checkbox.checked ? '' : 'none';
            });
        });
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateColumnVisibility);
    });

    // Initial run on page load
    updateColumnVisibility();
})();

// --- Hero Chip Filtering & Sorting ---
// --- Hero Chip Filtering & Sorting (with deep logging) ---
(function () {
  // All logs live *inside functions / handlers* only.
  // Helper logger (uses console.log so you always see it)
  const TAG = 'HeroChips';
  const log  = (...a) => console.log(`[${TAG}]`, ...a);
  const warn = (...a) => console.warn(`[${TAG}]`, ...a);
  const err  = (...a) => console.error(`[${TAG}]`, ...a);

  const heroChips = document.querySelectorAll('.hero-chip');
  const table = document.querySelector('#vpntable');
  const tbody = table ? table.querySelector('tbody') : null;

  // Guard: we log this *inside the IIFE (a function)*.
  log('init()', {
    chipsFound: heroChips ? heroChips.length : 0,
    hasTable: !!table,
    hasTbody: !!tbody
  });
  if (!heroChips.length) { warn('init(): No .hero-chip elements found.'); return; }
  if (!tbody) { err('init(): #vpntable tbody not found.'); return; }

  const originalRows = Array.from(tbody.querySelectorAll('tr'));
  log('init(): captured originalRows', originalRows.length);

  // Identify a row in logs by something human-readable
  function rowId(row) {
    const nameCell =
      row.querySelector('[data-col-name="name"]') ||
      row.querySelector('[data-col-name="provider"]') ||
      row.querySelector('[data-col-name="vpn"]') ||
      row.querySelector('td:nth-child(2)') ||
      row.querySelector('td');
    const t = (nameCell ? nameCell.textContent : '').trim();
    return t ? t.slice(0, 40) : `row#${Array.from(row.parentNode?.children || []).indexOf(row)}`;
  }

  function getCellText(row, colName) {
    log('getCellText()', { row: rowId(row), colName });
    const cell = row.querySelector(`[data-col-name="${colName}"]`);
    if (!cell) {
      warn('getCellText(): cell not found', { row: rowId(row), colName });
      return '';
    }
    const text = (cell.textContent || '').trim();
    log('getCellText(): value', { row: rowId(row), colName, text });
    return text;
  }

  function getCellNumber(row, colName) {
    log('getCellNumber(): start', { row: rowId(row), colName });
    const raw = getCellText(row, colName);
    const n = parseFloat((raw || '').replace(/[^0-9.]+/g, ''));
    const val = isNaN(n) ? 0 : n;
    log('getCellNumber(): parsed', { row: rowId(row), colName, raw, number: val });
    return val;
  }

  function updateRanks() {
    log('updateRanks(): start');
    const visible = Array.from(tbody.querySelectorAll('tr'));
    visible.forEach((row, i) => {
      const rankCell = row.querySelector('td:first-child');
      if (rankCell) {
        rankCell.textContent = i + 1;
        log('updateRanks(): set', { row: rowId(row), rank: i + 1 });
      } else {
        warn('updateRanks(): first cell not found for rank', { row: rowId(row) });
      }
    });
    log('updateRanks(): end', { totalVisible: visible.length });
  }

  function rebuildBody(rows) {
    log('rebuildBody(): start', { incoming: rows.length, beforeChildren: tbody.children.length });
    tbody.innerHTML = '';
    rows.forEach((r, i) => {
      r.style.display = '';
      tbody.appendChild(r);
      if (i < 5) log('rebuildBody(): appended sample', { i, row: rowId(r) });
    });
    updateRanks();
    log('rebuildBody(): end', { afterChildren: tbody.children.length });
  }

  function resetTable() {
    log('resetTable(): start');
    rebuildBody(originalRows);
    heroChips.forEach(c => c.classList.remove('active'));
    log('resetTable(): cleared active chips');
  }

  function applyFilter(rows, value) {
    log('applyFilter(): start', { startCount: rows.length, value });
    let filtered = rows;

    if (value === 'free') {
      filtered = rows.filter(r => getCellText(r, 'free_available').toLowerCase() === 'yes');
    } else if (value === 'mobile') {
      filtered = rows.filter(r => {
        const t = getCellText(r, 'platform').toLowerCase();
        const ok = t.includes('android') || t.includes('ios');
        log('applyFilter(): mobile check', { row: rowId(r), platform: t, ok });
        return ok;
      });
    } else if (value) {
      // windows / macos / linux / other platform tokens
      filtered = rows.filter(r => getCellText(r, 'platform').toLowerCase().includes(value));
    }

    log('applyFilter(): end', { endCount: filtered.length });
    return filtered;
  }

  function applySort(rows, value) {
    log('applySort(): start', { count: rows.length, value });
    const copy = rows.slice();

    if (value === 'speed') {
      copy.sort((a, b) => {
        const na = getCellNumber(a, 'speed_mbps');
        const nb = getCellNumber(b, 'speed_mbps');
        const diff = nb - na;
        log('applySort(): compare', { a: rowId(a), na, b: rowId(b), nb, diff });
        return diff;
      });
    } else {
      log('applySort(): no matching sorter; leaving order as-is');
    }

    log('applySort(): end');
    return copy;
  }

  // Bind clicks with detailed logging
  heroChips.forEach(chip => {
    chip.addEventListener('click', (ev) => {
      log('onClick(): chip', {
        text: chip.textContent?.trim(),
        dataset: { action: chip.dataset.action, value: chip.dataset.value },
        activeBefore: chip.classList.contains('active')
      });

      const action = chip.dataset.action;   // "filter" | "sort"
      const value  = (chip.dataset.value || '').toLowerCase();
      const isActive = chip.classList.contains('active');

      if (isActive) {
        log('onClick(): chip is active -> resetting');
        resetTable();
        return;
      }

      // Set this the only active chip
      heroChips.forEach(c => c.classList.remove('active'));
      chip.classList.add('active');
      log('onClick(): activated chip', { text: chip.textContent?.trim() });

      // Start from pristine rows
      let rows = originalRows.slice();
      log('onClick(): start rows', rows.length);

      if (action === 'filter') {
        rows = applyFilter(rows, value);
      } else if (action === 'sort') {
        rows = applySort(rows, value);
      } else {
        warn('onClick(): unknown chip action', { action, value });
      }

      log('onClick(): rebuilding body with rows', rows.length);
      rebuildBody(rows);
      log('onClick(): done');
    });

    log('bind(): attached click', {
      text: chip.textContent?.trim(),
      dataset: { action: chip.dataset.action, value: chip.dataset.value }
    });
  });

  log('init(): ready — waiting for clicks');
})();
