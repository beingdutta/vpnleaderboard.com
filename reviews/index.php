<?php
require_once __DIR__ . '/../db.php'; // For header/footer includes
$page_title = "VPN Reviews";
$canonical = 'https://www.vpnleaderboard.com/reviews/';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($page_title) ?> | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="In-depth reviews and analysis of the top VPN services on the market.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link rel="icon" href="/assets/site-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/styles/style.css?v=<?= @filemtime(__DIR__ . '/../styles/style.css') ?>" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1RMZD8BYYZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-1RMZD8BYYZ');
    </script>
</head>
<body>
  <?php include __DIR__ . '/../navigation/nav.php'; ?>

  <main class="container my-5">
    <div class="col-lg-8 mx-auto">
        <h1 class="mb-4 text-center newspaper-main-title">Unbiased Reviews, Verified</h1>
        <p class="lead mb-5 text-center text-secondary">We go hands-on to test speed, security, and streaming so you can choose with confidence. No marketing fluff, just the facts.</p>
        
        <?php
          // Helper function to truncate text to a specific word count
          function truncate_words($text, $limit) {
            if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos = array_keys($words);
                $text = substr($text, 0, $pos[$limit]) . '...';
            }
            return $text;
          }

          $files = glob(__DIR__ . '/*.php');
          $reviews = [];

          foreach ($files as $file) {
              if (basename($file) === 'index.php') continue;

              $content = file_get_contents($file);
              $review_data = ['title' => '', 'excerpt' => '', 'image' => '', 'date' => ''];

              // To correctly execute PHP in the title, we must buffer and include the file.
              ob_start();
              include $file;
              $buffered_content = ob_get_clean(); // This content is not used, but it executes the PHP.

              // Now, re-read the raw content to parse the executed title.
              if (preg_match('/<title>(.*?)<\/title>/is', $buffered_content, $matches)) {
                  $review_data['title'] = str_replace(' | VPN Leaderboard', '', $matches[1]);
              }

              if (preg_match('/<meta\s+name="description"\s+content="(.*?)"/', $content, $matches)) {
                  $review_data['excerpt'] = $matches[1];
              }

              // Prioritize the header background image as it's more reliable for local assets.
              if (preg_match('/style="background-image: url\(\'(.*?)\'\);"/is', $content, $matches)) {
                  $review_data['image'] = $matches[1];
              } 
              // Fallback to the og:image meta tag if the header image isn't found.
              elseif (preg_match('/<meta\s+(?:name|property)=["\']og:image["\']\s+content=["\'](.*?)["\']/is', $content, $matches)) {
                  $review_data['image'] = $matches[1];
              }

              if (preg_match('/<p class="lead">Last updated on (.*?)<\/p>/', $content, $matches)) {
                  $review_data['date'] = $matches[1];
              } else {
                  $review_data['date'] = date("F j, Y", filemtime($file));
              }

              if (!empty($review_data['title'])) {
                  $review_data['slug'] = pathinfo($file, PATHINFO_FILENAME);
                  $reviews[] = $review_data;
              }
          }

          usort($reviews, function($a, $b) {
              return strtotime($b['date']) - strtotime($a['date']);
          });

          $featured_review = array_shift($reviews);
          $top_reviews = array_splice($reviews, 0, 2);
        ?>

        <?php if ($featured_review): ?>
        <div class="newspaper-featured-article mb-5">
          <div class="card article-card-horizontal h-100">
            <div class="row g-0">
              <div class="col-md-7">
                <a href="/reviews/<?= htmlspecialchars($featured_review['slug']) ?>"><img src="<?= htmlspecialchars($featured_review['image']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($featured_review['title']) ?>" loading="lazy"></a>
              </div>
              <div class="col-md-5 d-flex align-items-center">
                <div class="card-body">
                  <h3 class="card-title mb-2"><a href="/reviews/<?= htmlspecialchars($featured_review['slug']) ?>" class="text-decoration-none stretched-link"><?= htmlspecialchars($featured_review['title']) ?></a></h3>
                  <p class="card-text text-secondary d-none d-md-block"><?= htmlspecialchars(truncate_words($featured_review['excerpt'] ?? '', 14)) ?></p>
                  <p class="card-text mt-3"><small class="text-secondary">Updated on <?= htmlspecialchars($featured_review['date']) ?></small></p>
                </div>
              </div>
          </div>
        </div>
        <?php endif; ?>

        <h2 class="section-title mt-5"><span>Top Reviews</span></h2>

        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
          <?php foreach ($top_reviews as $review): ?>
            <div class="col">
              <div class="card article-card-vertical h-100">
                <a href="/reviews/<?= htmlspecialchars($review['slug']) ?>"><img src="<?= htmlspecialchars($review['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($review['title']) ?>" loading="lazy"></a>
                <div class="card-body d-flex flex-column p-3">
                  <h5 class="card-title mb-2"><a href="/reviews/<?= htmlspecialchars($review['slug']) ?>" class="text-decoration-none stretched-link"><?= htmlspecialchars($review['title']) ?></a></h5>
                  <p class="card-text text-secondary small flex-grow-1"><?= htmlspecialchars(truncate_words($review['excerpt'] ?? '', 14)) ?></p>
                  <p class="card-text mt-auto pt-2"><small class="text-secondary">Updated on <?= htmlspecialchars($review['date']) ?></small></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php if (!empty($reviews)): ?>
        <h2 class="section-title mt-5"><span>From The Archives</span></h2>
        <div class="list-group">
          <?php foreach ($reviews as $review): ?>
          <a href="/reviews/<?= htmlspecialchars($review['slug']) ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" style="background: var(--background-secondary); border-color: var(--border-color);">
            <img src="<?= htmlspecialchars($review['image']) ?>" alt="<?= htmlspecialchars($review['title']) ?>" width="48" height="48" class="rounded-circle flex-shrink-0" style="object-fit: cover;">
            <div class="d-flex gap-2 w-100 justify-content-between">
              <div>
                <h6 class="mb-0" style="color: var(--text-primary);"><?= htmlspecialchars($review['title']) ?></h6>
                <p class="mb-0 opacity-75 small">In-depth analysis</p>
              </div>
              <small class="opacity-50 text-nowrap"><?= date('M d', strtotime($review['date'])) ?></small>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
  </main>

  <?php include __DIR__ . '/../navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/script.js"></script>
</body>
</html>