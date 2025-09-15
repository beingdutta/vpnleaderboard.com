<?php
require_once __DIR__ . '/db.php';

$user_id = ensure_user_cookie();
$region = isset($_GET['region']) ? strtoupper($_GET['region']) : 'GLOBAL';
$validRegions = ['GLOBAL','IN','US','CN'];
if (!in_array($region, $validRegions, true)) $region = 'GLOBAL';

$regionCond = $region === 'GLOBAL' ? "1=1" : "FIND_IN_SET(:region, regions)";

$sql = "
SELECT 
  v.*,
  COALESCE(SUM(vt.vote='up'),0) AS upvotes,
  COALESCE(SUM(vt.vote='down'),0) AS downvotes,
  COALESCE(SUM(vt.vote='up'),0) - COALESCE(SUM(vt.vote='down'),0) AS score
FROM vpns v
LEFT JOIN votes vt ON vt.vpn_id = v.id
WHERE $regionCond
GROUP BY v.id
ORDER BY score DESC, v.speed_mbps DESC, v.name ASC
LIMIT 15;
";
$stmt = $pdo->prepare($sql);
if ($region !== 'GLOBAL') $stmt->bindValue(':region', $region, PDO::PARAM_STR);
$stmt->execute();
$vpns = $stmt->fetchAll();

$votedStmt = $pdo->prepare("SELECT vpn_id FROM votes WHERE user_id = ? OR ip_address = ?");
$votedStmt->execute([$user_id, client_ip_bin()]);
$votedIds = array_column($votedStmt->fetchAll(), 'vpn_id');

$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Global Ranking 2025: Your VPN, Your Vote | VPN Leaderboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Compare and vote the best VPN services for streaming, gaming, privacy & work. Live community ranking of top VPNs in India, USA, China & worldwide.">
  <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
  <meta name="robots" content="index,follow">
  <meta name="keywords" content="best vpn, vpn for pc, vpn for android, fastest vpn, secure vpn, vpn india, vpn usa, vpn china, vpn comparison, vpn ranking">
  <meta property="og:title" content="Global Ranking 2025: Your VPN, Your Vote">
  <meta property="og:description" content="Real-time VPN leaderboard powered by community votes. Upvote or downvote your favorite VPNs.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
  <meta property="og:image" content="<?= htmlspecialchars((isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST']) ?>/og-image.jpg">
  <script type="application/ld+json">
  {
    "@context":"https://schema.org",
    "@type":"WebSite",
    "name":"VPN Leaderboard",
    "url":"<?= htmlspecialchars($canonical) ?>",
    "potentialAction":{"@type":"SearchAction","target":"<?= htmlspecialchars($canonical) ?>?q={search_term_string}","query-input":"required name=search_term_string"},
    "about":"Community-powered rankings of the best VPN providers"
  }
  </script>
  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --brand: #0ea5e9;
      --link-color: #2563eb;
      --background-primary: #f8fafc;
      --background-secondary: #ffffff;
      --text-primary: #0f172a;
      --text-secondary: #64748b;
      --border-color: #e2e8f0;
      --table-header-color: #64748b;
      --chip-bg: #f1f5f9;
      --chip-border: #e2e8f0;
      --chip-text: #475569;
      --score-badge-bg: #f1f5f9;
      --score-badge-border: #e2e8f0;
    }
    html[data-theme="dark"] {
      --link-color: #93c5fd;
      --background-primary: #0b1220;
      --background-secondary: #0f172a;
      --text-primary: #e5e7eb;
      --text-secondary: #9ca3af;
      --border-color: #334155;
      --table-header-color: #9ca3af;
      --chip-bg: #111827;
      --chip-border: #1f2937;
      --chip-text: #cbd5e1;
      --score-badge-bg: #1f2937;
      --score-badge-border: #334155;
    }
    body { background: var(--background-primary); color: var(--text-primary); transition: background-color 0.2s, color 0.2s; }
    a { color: var(--link-color); }
    .navbar, .footer { background: var(--background-secondary); transition: background-color 0.2s; }
    .navbar .navbar-brand, .navbar .nav-link { color: var(--text-primary); }
    .navbar .nav-link.active { color: var(--brand); font-weight: 600; }
    .navbar .nav-link:hover, .navbar .navbar-brand:hover { color: var(--brand); }
    .table { --bs-table-bg: var(--background-secondary); --bs-table-border-color: var(--border-color); --bs-table-color: var(--text-primary); --bs-table-hover-color: var(--text-primary); }
    .table-hover > tbody > tr:hover > * { --bs-table-accent-bg: rgba(0,0,0,0.04); }
    html[data-theme="dark"] .table-hover > tbody > tr:hover > * { --bs-table-accent-bg: rgba(255,255,255,0.04); }
    .tagline { font-weight:700; }
    .vote-btn { border:0; padding:.3rem .55rem; border-radius:.5rem; }
    .vote-up { background: #0ea5e933; }
    .vote-down { background: #ef444433; }
    .vote-up:hover { background: #0ea5e955; }
    .vote-down:hover { background: #ef444455; }
    .voted { opacity: 0.7; }
    .table thead th { color: var(--table-header-color); }
    .score-badge { background: var(--score-badge-bg); border:1px solid var(--score-badge-border); color: var(--text-primary); font-weight: 600; }
    .hero { background: radial-gradient(1200px 400px at 50% -10%, #f1f5f9, var(--background-primary)); }
    html[data-theme="dark"] .hero { background: radial-gradient(1200px 400px at 50% -10%, #1e293b, transparent); }
    .chip { background: var(--chip-bg); border:1px solid var(--chip-border); padding:.2rem .5rem; border-radius:1rem; font-size:.75rem; color: var(--chip-text); }
    @media (max-width: 768px) {
      .hide-sm { display:none; }
      .table-responsive { border:0; }
    }
  </style>
</head>
<body>
  <!-- NAV -->
  <nav class="navbar navbar-expand-lg border-bottom" style="--bs-border-color: var(--border-color);">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">VPN Leaderboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link<?= $region==='IN'?' active':'' ?>" href="?region=IN" title="Best VPNs in India">Ranking in India</a></li>
          <li class="nav-item"><a class="nav-link<?= $region==='US'?' active':'' ?>" href="?region=US" title="Best VPNs in the USA">Ranking in USA</a></li>
          <li class="nav-item"><a class="nav-link<?= $region==='CN'?' active':'' ?>" href="?region=CN" title="Best VPNs in China">Ranking in China</a></li>
          <li class="nav-item"><a class="nav-link<?= $region==='GLOBAL'?' active':'' ?>" href="?region=GLOBAL" title="Global VPN Ranking">Global</a></li>
          <li class="nav-item ms-lg-3">
            <a href="#" id="theme-toggle" class="nav-link" title="Toggle light/dark theme">🌙</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">Global Ranking 2025: <span class="tagline">Your VPN, Your Vote</span></h1>
      <p class="text-secondary" style="font-size: 1.1rem;">Because Security Matters, You Matters.</p>
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <span class="chip">Fastest VPN</span>
        <span class="chip">Best VPN for PC</span>
        <span class="chip">Best Free VPN</span>
        <span class="chip">VPN for Android & iOS</span>
      </div>
    </div>
  </header>

  <!-- TABLE -->
  <main class="container my-4">
    <div class="table-responsive">
      <table id="vpntable" class="table table-hover align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>VPN</th>
            <th class="hide-sm">Speed (Mbps)</th>
            <th>Suitable for</th>
            <th class="hide-sm">Countries</th>
            <th class="hide-sm">Bandwidth</th>
            <th>Features</th>
            <th class="text-center">Votes</th>
            <th class="text-center">Score</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $rank = 1;
          foreach ($vpns as $v):
            $voted = in_array($v['id'], $votedIds, true);
            $features = array_slice(array_map('trim', explode(';', str_replace([',',';'], ';', (string)$v['features']))),0,3);
          ?>
          <tr data-vpn-id="<?= (int)$v['id'] ?>" data-score="<?= (int)$v['score'] ?>">
            <td class="text-secondary"><?= $rank++ ?></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <img src="<?= htmlspecialchars($v['logo_url'] ?: 'https://via.placeholder.com/28x28?text=VPN') ?>" alt="<?= htmlspecialchars($v['name']) ?> logo" width="28" height="28" class="rounded">
                <div class="d-flex flex-column" style="min-width: 150px;">
                  <a class="fw-semibold text-decoration-none" href="<?= htmlspecialchars($v['website_url'] ?: '#') ?>" target="_blank" rel="nofollow noopener"><?= htmlspecialchars($v['name']) ?></a>
                  <small class="text-secondary">Trusted VPN provider</small>
                </div>
              </div>
            </td>
            <td class="hide-sm"><?= (int)$v['speed_mbps'] ?></td>
            <td><?= htmlspecialchars($v['suitable_for']) ?></td>
            <td class="hide-sm"><?= (int)$v['supported_countries'] ?></td>
            <td class="hide-sm"><?= htmlspecialchars($v['bandwidth']) ?></td>
            <td>
              <?php foreach ($features as $f): ?>
                <span class="chip me-1"><?= htmlspecialchars($f) ?></span>
              <?php endforeach; ?>
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center align-items-center gap-2 <?= $voted ? 'voted':'' ?>">
                <button class="vote-btn vote-up" data-type="up" title="Upvote" <?= $voted?'disabled':'' ?>>▲</button>
                <span class="upcount"><?= (int)$v['upvotes'] ?></span>
                <button class="vote-btn vote-down" data-type="down" title="Downvote" <?= $voted?'disabled':'' ?>>▼</button>
                <span class="downcount"><?= (int)$v['downvotes'] ?></span>
              </div>
              <?php if ($voted): ?><small class="text-success">You voted</small><?php endif; ?>
            </td>
            <td class="text-center">
              <span class="badge rounded-pill score-badge px-3 py-2">
                <span class="score"><?= (int)$v['score'] ?></span>
              </span>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <p class="mt-3 text-secondary small">
      Rankings are computed by community <strong>Upvotes − Downvotes</strong>. Data updates instantly via AJAX. Help others find the <em>best VPN</em> for streaming, gaming, torrenting, and privacy by voting above.
    </p>
  </main>

  <!-- FOOTER -->
  <footer class="footer py-4 border-top" style="--bs-border-color: var(--border-color);">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
      <div>&copy; <?= date('Y') ?> VPN Leaderboard · All rights reserved.</div>
      <div class="d-flex flex-wrap gap-3">
        <a href="about.php" class="text-decoration-none">About</a>
        <a href="contact.php" class="text-decoration-none">Contact</a>
        <a href="terms.php" class="text-decoration-none">Terms</a>
        <a href="privacy.php" class="text-decoration-none">Privacy</a>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // --- Theme Switcher ---
    (function() {
      const themeToggle = document.getElementById('theme-toggle');
      const htmlEl = document.documentElement;

      function applyTheme(theme) {
        htmlEl.setAttribute('data-theme', theme);
        themeToggle.textContent = theme === 'dark' ? '☀️' : '🌙';
        localStorage.setItem('vpnlb_theme', theme);
      }

      themeToggle.addEventListener('click', (e) => {
        e.preventDefault();
        const currentTheme = htmlEl.getAttribute('data-theme') || 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        applyTheme(newTheme);
      });

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

        // Optimistic UI disable buttons
        const upBtn = row.querySelector('.vote-up');
        const downBtn = row.querySelector('.vote-down');
        upBtn.disabled = true; downBtn.disabled = true;

        try {
          const res = await fetch('vote.php', {
            method: 'POST',
            headers: {'Content-Type':'application/json'},
            body: JSON.stringify({ vpn_id: vpnId, vote: type })
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
  </script>
</body>
</html>
