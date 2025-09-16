// --- Theme Switcher ---
(function() {
  const themeToggle = document.getElementById('theme-toggle');
  const htmlEl = document.documentElement;

  function applyTheme(theme) {
    htmlEl.setAttribute('data-theme', theme);
    if (themeToggle) {
      themeToggle.textContent = theme === 'dark' ? '☀️' : '🌙';
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
    const sa = parseInt(a.dataset.score,10)||0;
    const sb = parseInt(b.dataset.score,10)||0;
    if (sb !== sa) return sb - sa;
    const speedA = parseInt(a.children[2]?.textContent || '0',10);
    const speedB = parseInt(b.children[2]?.textContent || '0',10);
    if (speedB !== speedA) return speedB - speedA;
    const nameA = a.querySelector('td:nth-child(2) a').textContent.trim().toLowerCase();
    const nameB = b.querySelector('td:nth-child(2) a').textContent.trim().toLowerCase();
    return nameA.localeCompare(nameB);
  });
  rows.forEach((r,i) => { r.querySelector('td:first-child').textContent = (i+1); tbody.appendChild(r); });
}