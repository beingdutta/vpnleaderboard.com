<?php
require_once __DIR__ . '/db.php';

$user_id = ensure_user_cookie();

$sql = "
SELECT 
  v_reg.vpn_id, v_reg.speed_mbps, v_reg.is_promoted, v_reg.affiliate_link, v_reg.starting_price,
  v_all.name, v_all.website_url, v_all.logo_path, v_all.suitable_for, v_all.supported_countries, v_all.features, v_all.server_count, v_all.device_limit, v_all.protocols_supported, v_all.logging_policy, v_all.based_in,
  v_all.Free_available, v_all.Platform, COALESCE(SUM(vt.vote='up'),0) AS upvotes,
  COALESCE(SUM(vt.vote='down'),0) AS downvotes,
  COALESCE(SUM(vt.vote='up'),0) - COALESCE(SUM(vt.vote='down'),0) AS score
FROM vpns_us v_reg
JOIN vpn_master_table v_all ON v_reg.vpn_id = v_all.id
LEFT JOIN votes_us vt ON vt.vpn_id = v_reg.vpn_id
GROUP BY v_reg.vpn_id
ORDER BY score DESC, v_all.name ASC
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

$votedStmt = $pdo->prepare("SELECT vpn_id FROM votes_us WHERE user_id = ? OR ip_address = ?");
$votedStmt->execute([$user_id, client_ip_bin()]);
$votedIds = array_column($votedStmt->fetchAll(), 'vpn_id');

$canonical = 'https://www.vpnleaderboard.com/vpn-usa-leaderboard';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Best VPN for USA (2025): Top VPN Services Ranked</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Compare and vote for the best VPN services in the USA. Live community ranking of the top VPN providers for streaming, torrenting, and privacy in the United States.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <meta name="robots" content="index,follow">
    <meta name="keywords" content="best vpn usa, vpn for us, fastest vpn usa, best vpn for streaming, best vpn for torrenting, vpn ranking usa, best vpn providers">
    <meta property="og:title" content="Best VPNs in USA 2025: Your VPN, Your Vote">
    <meta property="og:description" content="Real-time VPN leaderboard for the USA, powered by community votes. Upvote or downvote your favorite VPNs.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
    <meta property="og:image" content="<?= htmlspecialchars((isset($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER['HTTP_HOST']) ?>/og-image.jpg">
    <script type="application/ld+json"> 
    [
      {
          "@context":"https://schema.org",
          "@type":"WebPage",
          "name":"Best VPN for USA (2025): Top VPN Services Ranked",
          "url":"<?= htmlspecialchars($canonical) ?>",
          "description":"Compare and vote for the best VPN services in the USA. Live community ranking of the top VPN providers for streaming, torrenting, and privacy in the United States."
      },
      {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
          {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "https://www.vpnleaderboard.com/"
          },
          {
            "@type": "ListItem",
            "position": 2,
            "name": "Best VPN for USA",
            "item": "<?= htmlspecialchars($canonical) ?>"
          }
        ]
      },
      {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Best VPNs for USA Leaderboard",
        "description": "A community-voted list of the best VPN services for the USA in 2025.",
        "itemListElement": [
          <?php foreach ($vpns as $index => $vpn): ?>
          {
            "@type": "ListItem",
            "position": <?= (int)$vpn['true_rank'] ?>,
            "item": {
              "@type": "Service",
              "name": "<?= htmlspecialchars($vpn['name']) ?>",
              "url": "<?= htmlspecialchars($vpn['website_url']) ?>",
              "provider": {
                "@type": "Organization",
                "name": "<?= htmlspecialchars($vpn['name']) ?>"
              },
              "aggregateRating": {
                "@type": "AggregateRating",
                "ratingValue": "<?= (int)$vpn['score'] ?>",
                "reviewCount": "<?= (int)$vpn['upvotes'] + (int)$vpn['downvotes'] ?>"
              }
            }
          }<?= $index < count($vpns) - 1 ? ',' : '' ?>
          <?php endforeach; ?>
        ]
      }
    ]
  </script>
  <link rel="icon" href="/assets/site-icon.png" type="image/png">
  <!-- Bootstrap 5 (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="styles/style.css?v=<?= @filemtime('styles/style.css') ?>" rel="stylesheet">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-1RMZD8BYYZ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-1RMZD8BYYZ');
  </script>  
</head>
<body data-region="us">
  <?php include __DIR__ . '/navigation/nav.php'; ?>

  <!-- HERO -->
  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">Best VPN for USA (2025 Community Ranking)</h1>
      <p class="text-secondary" style="font-size: 1.1rem;">Find the <strong>best VPN service</strong> for the US, ranked by real users for speed, streaming, and security.</p>
      <div class="d-flex flex-wrap gap-2 justify-content-center">
        <span class="chip hero-chip" data-action="sort" data-value="price">Best Cheap VPN</span>
        <span class="chip hero-chip" data-action="filter" data-value="free">Best Free VPN for USA</span>
        <span class="chip hero-chip" data-action="filter" data-value="Windows">Best VPN for PC</span>
        <span class="chip hero-chip" data-action="filter" data-value="macOS">Best VPN for Mac</span>
        <span class="chip hero-chip" data-action="filter" data-value="mobile">Best VPN for Android & iPhone</span>
        <a href="/reviews" class="chip hero-chip" style="text-decoration: none;">In-Depth Reviews</a>
      </div>
    </div>
  </header>

  <!-- CONTROLS -->
  <div class="container my-3">
    <div class="column-toggle-wrapper">
      <!-- Dropdown for small screens -->
      <div class="d-md-none">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="columnToggleDropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
          Show/Hide Columns
        </button>
        <div class="dropdown-menu p-3" aria-labelledby="columnToggleDropdown">
          <div class="checkbox-group-mobile">
            <!-- Checkboxes will be injected here by JS -->
          </div>
        </div>
      </div>
      <!-- Inline checkboxes for large screens -->
      <div class="column-toggle-controls d-none d-md-block">
        <strong>Show Columns:</strong>
        <div class="checkbox-group-desktop">
          <!-- Checkboxes will be injected here by JS -->
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
            <th data-col-name="starting_price" class="hide-sm">Starts</th>
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
            <td data-label="#" class="text-secondary"><?= (int)$v['true_rank'] ?></td>
            <td class="vpn-info-cell">
              <a href="<?= htmlspecialchars($v['website_url']) ?>" target="_blank" rel="nofollow noopener" class="text-decoration-none text-reset">
                <div class="d-flex align-items-center gap-2">
                  <img src="<?= htmlspecialchars($v['logo_path'] ?: 'assets/defaultvpn.png') ?>" alt="<?= htmlspecialchars($v['name']) ?> logo" width="28" height="28" class="rounded me-1">
                  <div class="d-flex flex-column">
                    <span class="fw-semibold"><?= htmlspecialchars($v['name']) ?></span>
                    <small class="text-secondary">Trusted VPN provider</small>
                  </div>
                  <?php if (!empty($v['is_promoted'])): ?>
                    <span class="chip chip-promoted ms-auto">Promoted</span>
                  <?php endif; ?>
                </div>
              </a>
            </td>
            <td data-label="Speed" data-col-name="speed_mbps"><div><?= (int)$v['speed_mbps'] ?> Mbps</div></td>
            <td data-label="Starts" data-col-name="starting_price" class="hide-sm"><div>$<?= htmlspecialchars(number_format($v['starting_price'], 2)) ?></div></td>
            <td data-label="Suitable for" data-col-name="suitable_for"><div><?= htmlspecialchars($v['suitable_for']) ?></div></td>
            <td data-label="Countries" data-col-name="countries" class="hide-sm"><div><?= (int)$v['supported_countries'] ?></div></td>
            <td data-label="Features" data-col-name="features">
              <div>
                <?php foreach ($features as $f): ?>
                  <span class="chip me-1"><?= htmlspecialchars($f) ?></span>
                <?php endforeach; ?>
              </div>
            </td> 
            <td data-label="Servers" data-col-name="server_count" class="hide-sm"><div><?= htmlspecialchars($v['server_count']) ?></div></td>
            <td data-label="Device Limit" data-col-name="device_limit" class="hide-sm"><div><?= htmlspecialchars($v['device_limit']) ?></div></td>
            <td data-label="Protocols" data-col-name="protocols_supported"><div><?= htmlspecialchars($v['protocols_supported']) ?></div></td>
            <td data-label="Logging" data-col-name="logging_policy"><div><?= htmlspecialchars($v['logging_policy']) ?></div></td>
            <td data-label="Based In" data-col-name="based_in" class="hide-sm"><div><?= htmlspecialchars($v['based_in']) ?></div></td>
            <td data-label="Free Plan" data-col-name="free_available" class="hide-sm"><div><?= $v['Free_available'] ? 'Yes' : 'No' ?></div></td>
            <td data-label="Platform" data-col-name="platform" class="hide-sm">
              <div>
                <?php 
                $platforms = array_filter(array_map('trim', explode(',', (string)$v['Platform'])));
                foreach ($platforms as $p):
                ?>
                  <span class="chip me-1 mb-1"><?= htmlspecialchars($p) ?></span>
                <?php endforeach; ?>
              </div>
            </td>
            <td data-label="Deal">
              <div>
                <?php if (!empty($v['affiliate_link'])): ?>
                  <a href="<?= htmlspecialchars($v['affiliate_link']) ?>" target="_blank" rel="nofollow noopener" class="btn-get-deal">Get Deal</a>
                <?php endif; ?>
              </div>
            </td>
            <td data-label="Votes" class="text-center votes-cell">
              <div>
                <div class="d-flex justify-content-center align-items-center gap-2 <?= $voted ? 'voted':'' ?>">
                <button class="vote-btn vote-up" data-type="up" title="Upvote" <?= $voted?'disabled':'' ?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg></button>
                <span class="upcount"><?= (int)$v['upvotes'] ?></span>
                <button class="vote-btn vote-down" data-type="down" title="Downvote" <?= $voted?'disabled':'' ?>><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg></button>
                <span class="downcount"><?= (int)$v['downvotes'] ?></span>
                </div>
                <?php if ($voted): ?><small class="text-success">You voted</small><?php endif; ?>
              </div>
            </td>
            <td data-label="Score" class="text-center score-cell">
              <div>
                <span class="badge rounded-pill score-badge px-3 py-2">
                  <span class="score"><?= (int)$v['score'] ?></span>
                </span>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <p class="mt-3 text-secondary small">
      Rankings are computed by community <strong>Upvotes − Downvotes</strong>. Data updates instantly. Help others find the <strong>best VPN for the USA</strong> for streaming, gaming, torrenting, and privacy by voting above.
    </p>

    <div class="p-3 mt-4 rounded" style="background-color: var(--chip-bg); border: 1px solid var(--border-color);" role="alert">
      <div class="d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-info-circle-fill me-3" viewBox="0 0 16 16" style="min-width: 24px;"><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM8 4a.905.905 0 0 1 .9.995l.35 3.507a.552.552-0-0-1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
        <div class="small" style="color: var(--text-secondary);"><strong>Disclaimer:</strong> The "Speed" values are based on a combination of our own tests and data aggregated from public forums. Your actual performance may vary depending on your location, network, and server load.</div>
      </div>
    </div>

    <!-- FAQ Section -->
    <section class="my-5 pt-4">
      <h2 class="text-center mb-4">Best VPN for USA: Frequently Asked Questions</h2>
      <div class="accordion" id="faqAccordion">
        <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
          <h3 class="accordion-header" id="headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="background-color: var(--background-secondary); color: var(--text-primary);">
              What is the best VPN for the USA?
            </button>
          </h3>
          <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              The <strong>best VPN for the USA</strong> should offer fast speeds for streaming, a strong no-logs policy, and a large network of US-based servers. Services that are headquartered outside of the US (and the Five Eyes alliance) are often preferred for privacy. Use our community-voted list to see which <strong>VPN providers</strong> are most trusted by users for performance and security in the United States.
            </div>
          </div>
        </div>
        <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
          <h3 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: var(--background-secondary); color: var(--text-primary);">
              Is it legal to use a VPN in the USA?
            </button>
          </h3>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Yes, it is completely legal to use a VPN in the United States for legitimate purposes like enhancing your privacy, securing your connection on public Wi-Fi, and accessing geo-restricted content. Using a VPN for illegal activities, however, remains illegal.
            </div>
          </div>
        </div>
        <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
          <h3 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color: var(--background-secondary); color: var(--text-primary);">
              What is the best VPN for streaming US content?
            </button>
          </h3>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              The <strong>best VPN for streaming</strong> US content (like Netflix, Hulu, and HBO Max) is one with fast servers located in the US and a proven track record of unblocking these platforms. Many users find that VPNs offering dedicated or residential IP addresses are the most reliable for avoiding streaming service blocks.
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>
<script>
    function applyLoadingStyles(loadingOverlay) {
        const isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';

        if (isDarkMode) {
            loadingOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
        } else {
            loadingOverlay.style.backgroundColor = 'rgba(255, 255, 255, 0.7)';
        }
    }


    // Add this function to each of the leaderboard php files for the loader to work.
</script>