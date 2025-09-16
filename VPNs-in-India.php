<?php
require_once __DIR__ . '/db.php';

$user_id = ensure_user_cookie();

$sql = "
SELECT 
  v.*,
  COALESCE(SUM(vt.vote='up'),0) AS upvotes,
  COALESCE(SUM(vt.vote='down'),0) AS downvotes,
  COALESCE(SUM(vt.vote='up'),0) - COALESCE(SUM(vt.vote='down'),0) AS score
FROM vpns_india v
LEFT JOIN votes_india vt ON vt.vpn_id = v.id
GROUP BY v.id
ORDER BY score DESC, v.name ASC
LIMIT 15;
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$vpns = $stmt->fetchAll();

// Assign true rank before re-sorting for display
foreach ($vpns as $key => &$vpn) {
    $vpn['true_rank'] = $key + 1;
}
unset($vpn);

usort($vpns, function($a, $b) {
    if ($a['is_promoted'] != $b['is_promoted']) return $b['is_promoted'] <=> $a['is_promoted'];
    return $a['true_rank'] <=> $b['true_rank'];
});

$votedStmt = $pdo->prepare("SELECT vpn_id FROM votes_india WHERE user_id = ? OR ip_address = ?");
$votedStmt->execute([$user_id, client_ip_bin()]);
$votedIds = array_column($votedStmt->fetchAll(), 'vpn_id');

$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Best VPNs in India 2025: Your VPN, Your Vote</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Compare and vote for the best VPN services in India. Live community ranking of top VPNs for users in India.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <meta name="robots" content="index,follow">
    <meta name="keywords" content="best vpn india, vpn for india, fastest vpn india, secure vpn, vpn comparison, vpn ranking india">
    <meta property="og:title" content="Best VPNs in India 2025: Your VPN, Your Vote">
    <meta property="og:description" content="Real-time VPN leaderboard for India, powered by community votes. Upvote or downvote your favorite VPNs.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
    <meta property="og:image" content="<?= htmlspecialchars((isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST']) ?>/og-image.jpg">
    <script type="application/ld+json">
    {
        "@context":"https://schema.org",
        "@type":"WebSite",
        "name":"VPN Leaderboard - India",
        "url":"<?= htmlspecialchars($canonical) ?>",
        "about":"Community-powered rankings of the best VPN providers for India"
    }
  </script>
  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="styles/style.css" rel="stylesheet">
</head>
<body data-region="india">
  <!-- NAV -->
  <nav class="navbar navbar-expand-lg border-bottom" style="--bs-border-color: var(--border-color);">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php">VPN Leaderboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="nav" class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="VPNs-in-India.php" title="Best VPNs in India">Ranking in India</a></li>
          <li class="nav-item"><a class="nav-link" href="VPNs-in-US.php" title="Best VPNs in the USA">Ranking in USA</a></li>
          <li class="nav-item"><a class="nav-link" href="VPNs-in-China.php" title="Best VPNs in China">Ranking in China</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?region=GLOBAL" title="Global VPN Ranking">Global</a></li>
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
      <h1 class="display-5 fw-bold">India Ranking 2025: <span class="tagline">Your VPN, Your Vote</span></h1>
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
            <th class="hide-sm">Starting Price</th>
            <th>Suitable for</th>
            <th class="hide-sm">Countries</th>
            <th>Features</th>
            <th></th>
            <th class="text-center">Votes</th>
            <th class="text-center">Score</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($vpns as $v):
            $voted = in_array($v['id'], $votedIds, true);
            $features = array_slice(array_map('trim', explode(';', str_replace([',',';'], ';', (string)$v['features']))),0,3);
          ?>
          <tr data-vpn-id="<?= (int)$v['id'] ?>" data-score="<?= (int)$v['score'] ?>" data-promoted="<?= (int)$v['is_promoted'] ?>">
            <td class="text-secondary"><?= (int)$v['true_rank'] ?></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <img data-vpn-name="<?= htmlspecialchars($v['name']) ?>" alt="<?= htmlspecialchars($v['name']) ?> logo" width="28" height="28" class="rounded vpn-logo" src="https://via.placeholder.com/28x28?text=...">
                <div class="d-flex flex-column" style="min-width: 150px;">
                  <div class="d-flex align-items-center">
                    <span class="fw-semibold"><?= htmlspecialchars($v['name']) ?></span>
                    <?php if (!empty($v['is_promoted'])): ?>
                      <span class="chip chip-promoted ms-2">Promoted</span>
                    <?php endif; ?>
                  </div>
                  <small class="text-secondary">Trusted VPN provider</small>
                </div>
              </div>
            </td>
            <td class="hide-sm">$<?= htmlspecialchars(number_format($v['starting_price'], 2)) ?></td>
            <td><?= htmlspecialchars($v['suitable_for']) ?></td>
            <td class="hide-sm"><?= (int)$v['supported_countries'] ?></td>
            <td>
              <?php foreach ($features as $f): ?>
                <span class="chip me-1"><?= htmlspecialchars($f) ?></span>
              <?php endforeach; ?>
            </td>
            <td>
              <?php if (!empty($v['affiliate_link'])): ?>
                <a href="<?= htmlspecialchars($v['affiliate_link']) ?>" target="_blank" rel="nofollow noopener" class="btn btn-sm btn-success">Get Deal</a>
              <?php endif; ?>
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
  <script src="scripts/script.js"></script>
</body>
</html>