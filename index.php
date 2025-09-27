<?php
require_once __DIR__ . '/db.php';

$user_id = ensure_user_cookie();
$region = isset($_GET['region']) ? strtoupper($_GET['region']) : 'GLOBAL';
$validRegions = ['GLOBAL','IN','US','CN'];
if (!in_array($region, $validRegions, true)) $region = 'GLOBAL';

$regionCond = $region === 'GLOBAL' ? "1=1" : "FIND_IN_SET(:region, regions)";

$sql = "
SELECT 
  v_reg.vpn_id, v_reg.speed_mbps, v_reg.is_promoted, v_reg.affiliate_link, v_reg.starting_price,
  v_all.name, v_all.website_url, v_all.logo_path, v_all.suitable_for, v_all.supported_countries, v_all.features, v_all.server_count, v_all.device_limit, v_all.protocols_supported, v_all.logging_policy, v_all.based_in,
  v_all.Free_available, v_all.Platform, COALESCE(SUM(vt.vote='up'),0) AS upvotes,
  COALESCE(SUM(vt.vote='down'),0) AS downvotes,
  COALESCE(SUM(vt.vote='up'),0) - COALESCE(SUM(vt.vote='down'),0) AS score
FROM vpns_global v_reg
JOIN vpn_master_table v_all ON v_reg.vpn_id = v_all.id
LEFT JOIN votes_global vt ON vt.vpn_id = v_reg.vpn_id
WHERE $regionCond
GROUP BY v_reg.vpn_id
ORDER BY score DESC, v_all.name ASC
LIMIT 15;
";
$stmt = $pdo->prepare($sql);
if ($region !== 'GLOBAL') $stmt->bindValue(':region', $region, PDO::PARAM_STR);
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

$votedStmt = $pdo->prepare("SELECT vpn_id FROM votes_global WHERE user_id = ? OR ip_address = ?");
$votedStmt->execute([$user_id, client_ip_bin()]);
$votedIds = array_column($votedStmt->fetchAll(), 'vpn_id');

$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VPN Leaderboard 2025: Your VPN, Your Vote</title>
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
  <link rel="icon" href="/assets/site-icon.png" type="image/png">
  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="styles/style.css?v=<?= @filemtime('styles/style.css') ?>" rel="stylesheet">
</head>
<body data-region="<?= strtolower($region) ?>">
  <?php include __DIR__ . '/navigation/nav.php'; ?>

  <!-- HERO -->
  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-6 fw-bold">Global Ranking 2025: <span class="tagline">Your VPN, Your Vote</span></h1>
      <p class="text-secondary" style="font-size: 1.2rem;">Because Security Matters, You Matters.</p>
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <span class="chip hero-chip" data-action="sort" data-value="price">Low-Cost VPNs</span>
        <span class="chip hero-chip" data-action="filter" data-value="Windows">Best VPN for Windows PC</span>
        <span class="chip hero-chip" data-action="filter" data-value="macOS">Best VPN for MAC</span>
        <span class="chip hero-chip" data-action="filter" data-value="Linux">Best VPN for Linux</span>
        <span class="chip hero-chip" data-action="filter" data-value="free">Best Free VPN</span>
        <span class="chip hero-chip" data-action="filter" data-value="mobile">VPN for Android & iOS</span>
      </div>
    </div>
  </header>

  <!-- CONTROLS -->
  <div class="container mt-2">
    <div class="column-toggle-controls p-3 mb-3">
        <strong>Show Columns:</strong>
        <div class="checkbox-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-speed_mbps" data-col-name="speed_mbps" checked>
                <label class="form-check-label" for="toggle-speed_mbps">Speed</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-starting_price" data-col-name="starting_price" checked>
                <label class="form-check-label" for="toggle-starting_price">Starting Price</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-suitable_for" data-col-name="suitable_for" checked>
                <label class="form-check-label" for="toggle-suitable_for">Suitable For</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-countries" data-col-name="countries">
                <label class="form-check-label" for="toggle-countries">Countries</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-features" data-col-name="features" checked>
                <label class="form-check-label" for="toggle-features">Features</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-server_count" data-col-name="server_count">
                <label class="form-check-label" for="toggle-server_count">Servers</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-device_limit" data-col-name="device_limit">
                <label class="form-check-label" for="toggle-device_limit">Device Limit</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-protocols_supported" data-col-name="protocols_supported">
                <label class="form-check-label" for="toggle-protocols_supported">Protocols</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-logging_policy" data-col-name="logging_policy">
                <label class="form-check-label" for="toggle-logging_policy">Logging</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-based_in" data-col-name="based_in">
                <label class="form-check-label" for="toggle-based_in">Based In</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-free_available" data-col-name="free_available">
                <label class="form-check-label" for="toggle-free_available">Free Plan</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="toggle-platform" data-col-name="platform">
                <label class="form-check-label" for="toggle-platform">Platform</label>
            </div>
        </div>
    </div>
  </div>

  <!-- TABLE -->
  <main class="container my-4">
    <div class="table-responsive">
      <table id="vpntable" class="table table-hover align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>VPN</th>
            <th data-col-name="speed_mbps">Speed</th>
            <th data-col-name="starting_price" class="hide-sm">Starting Price</th>
            <th data-col-name="suitable_for">Suitable for</th>
            <th data-col-name="countries" class="hide-sm">Countries</th>
            <th data-col-name="features">Features</th>
            <th data-col-name="server_count" class="hide-sm">Servers</th>
            <th data-col-name="device_limit" class="hide-sm">Device Limit</th>
            <th data-col-name="protocols_supported">Protocols</th>
            <th data-col-name="logging_policy">Logging</th>
            <th data-col-name="based_in" class="hide-sm">Based In</th>
            <th data-col-name="free_available" class="hide-sm">Free Plan</th>
            <th data-col-name="platform" class="hide-sm">Platform</th>
            <th></th>
            <th class="text-center">Votes</th>
            <th class="text-center">Score</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($vpns as $v):
            $voted = in_array($v['vpn_id'], $votedIds, true);
            $features = array_slice(array_map('trim', explode(';', str_replace([',',';'], ';', (string)$v['features']))),0,3);
          ?>
          <tr data-vpn-id="<?= (int)$v['vpn_id'] ?>" data-score="<?= (int)$v['score'] ?>" data-promoted="<?= (int)$v['is_promoted'] ?>">
            <td class="text-secondary"><?= (int)$v['true_rank'] ?></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <img src="<?= htmlspecialchars($v['logo_path'] ?: 'assets/defaultvpn.png') ?>" alt="<?= htmlspecialchars($v['name']) ?> logo" width="28" height="28" class="rounded">
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
            <td data-col-name="speed_mbps"><?= (int)$v['speed_mbps'] ?> Mbps</td>
            <td data-col-name="starting_price" class="hide-sm">$<?= htmlspecialchars(number_format($v['starting_price'], 2)) ?></td>
            <td data-col-name="suitable_for"><?= htmlspecialchars($v['suitable_for']) ?></td>
            <td data-col-name="countries" class="hide-sm"><?= (int)$v['supported_countries'] ?></td>
            <td data-col-name="features">
              <?php foreach ($features as $f): ?>
                <span class="chip me-1"><?= htmlspecialchars($f) ?></span>
              <?php endforeach; ?>
            </td>
            <td data-col-name="server_count" class="hide-sm"><?= (int)$v['server_count'] ?></td>
            <td data-col-name="device_limit" class="hide-sm"><?= (int)$v['device_limit'] ?></td>
            <td data-col-name="protocols_supported"><?= htmlspecialchars($v['protocols_supported']) ?></td>
            <td data-col-name="logging_policy"><?= htmlspecialchars($v['logging_policy']) ?></td>
            <td data-col-name="based_in" class="hide-sm"><?= htmlspecialchars($v['based_in']) ?></td>
            <td data-col-name="free_available" class="hide-sm"><?= $v['Free_available'] ? 'Yes' : 'No' ?></td>
            <td data-col-name="platform" class="hide-sm">
              <?php 
              $platforms = array_filter(array_map('trim', explode(',', (string)$v['Platform'])));
              foreach ($platforms as $p):
              ?>
                <span class="chip me-1 mb-1"><?= htmlspecialchars($p) ?></span>
              <?php endforeach; ?>
            </td>
            <td>
              <?php if (!empty($v['affiliate_link'])): ?>
                <a href="<?= htmlspecialchars($v['affiliate_link']) ?>" target="_blank" rel="nofollow noopener" class="btn-get-deal">Get Deal</a>
              <?php endif; ?>
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center align-items-center gap-2 <?= $voted ? 'voted':'' ?>">
                <button class="vote-btn vote-up" data-type="up" title="Upvote" <?= $voted?'disabled':'' ?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg></button>
                <span class="upcount"><?= (int)$v['upvotes'] ?></span>
                <button class="vote-btn vote-down" data-type="down" title="Downvote" <?= $voted?'disabled':'' ?>><svg xmlns="http://www.w_3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
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

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>
