<?php
require_once __DIR__ . '/../db.php'; // For header/footer includes
$page_title = "Blog Articles";
$canonical = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/blogs/';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($page_title) ?> | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A collection of articles and deep dives into VPN technology, online security, and streaming.">
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
        <h1 class="mb-4 text-center newspaper-main-title">Digital Privacy, Demystified</h1>
        <p class="lead mb-5 text-center text-secondary">We cut through the jargon with brutally honest reviews, technical deep dives, and practical guides to help you master your online security.</p>
        
        <?php
          // Scan the directory for article files
          $files = glob(__DIR__ . '/*.php');
          $articles = [];

          foreach ($files as $file) {
              if (basename($file) === 'index.php') continue;

              // To get the article metadata, we can't execute the file.
              // Instead, we'll read its content and parse out the $article array.
              $content = file_get_contents($file);
              
              // This is a simple way to extract the array definition.
              if (preg_match('/\$article\s*=\s*(\[.*?\]);/s', $content, $matches)) {
                  // We need to make this string a valid PHP expression to evaluate.
                  $dummy_vpns = [];
                  $article_data = eval('$compared_vpns = []; return ' . $matches[1] . ';');
                  
                  if ($article_data && is_array($article_data)) {
                      $article_data['slug'] = pathinfo($file, PATHINFO_FILENAME);
                      $articles[] = $article_data;
                  }
              }
          }

          // Sort articles by date, newest first
          usort($articles, function($a, $b) {
              return strtotime($b['date']) - strtotime($a['date']);
          });

          // Separate articles for the layout
          $featured_article = array_shift($articles);
          $top_stories = array_splice($articles, 0, 2);
        ?>

        <?php if ($featured_article): ?>
        <!-- Featured Article -->
        <div class="newspaper-featured-article mb-5">
          <div class="card article-card-horizontal h-100">
            <div class="row g-0">
              <div class="col-md-7">
                <a href="/blogs/<?= htmlspecialchars($featured_article['slug']) ?>"><img src="<?= htmlspecialchars($featured_article['image']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($featured_article['title']) ?>" loading="lazy"></a>
              </div>
              <div class="col-md-5 d-flex align-items-center">
                <div class="card-body">
                  <h3 class="card-title mb-2"><a href="/blogs/<?= htmlspecialchars($featured_article['slug']) ?>" class="text-decoration-none stretched-link"><?= htmlspecialchars($featured_article['title']) ?></a></h3>
                  <p class="card-text text-secondary d-none d-md-block"><?= htmlspecialchars($featured_article['excerpt'] ?? '') ?></p>
                  <p class="card-text mt-3"><small class="text-secondary">By <?= htmlspecialchars($featured_article['author']) ?> on <?= htmlspecialchars($featured_article['date']) ?></small></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <h2 class="section-title"><span>Top Stories</span></h2>

        <!-- Top Stories Grid -->
        <div class="row row-cols-1 row-cols-md-2 g-4 mb-5">
          <?php foreach ($top_stories as $article): ?>
            <div class="col">
              <div class="card article-card-vertical h-100">
                <a href="/blogs/<?= htmlspecialchars($article['slug']) ?>"><img src="<?= htmlspecialchars($article['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($article['title']) ?>" loading="lazy"></a>
                <div class="card-body d-flex flex-column p-3">
                  <h5 class="card-title mb-2"><a href="/blogs/<?= htmlspecialchars($article['slug']) ?>" class="text-decoration-none stretched-link"><?= htmlspecialchars($article['title']) ?></a></h5>
                  <p class="card-text text-secondary small flex-grow-1"><?= htmlspecialchars($article['excerpt'] ?? '') ?></p>
                  <p class="card-text mt-auto pt-2"><small class="text-secondary">By <?= htmlspecialchars($article['author']) ?> on <?= htmlspecialchars($article['date']) ?></small></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php if (!empty($articles)): ?>
        <h2 class="section-title"><span>From The Archives</span></h2>
        <!-- Archived Articles List -->
        <div class="list-group">
          <?php foreach ($articles as $article): ?>
          <a href="/blogs/<?= htmlspecialchars($article['slug']) ?>" class="list-group-item list-group-item-action d-flex gap-3 py-3" style="background: var(--background-secondary); border-color: var(--border-color);">
            <img src="<?= htmlspecialchars($article['image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>" width="48" height="48" class="rounded-circle flex-shrink-0" style="object-fit: cover;">
            <div class="d-flex gap-2 w-100 justify-content-between">
              <div>
                <h6 class="mb-0" style="color: var(--text-primary);"><?= htmlspecialchars($article['title']) ?></h6>
                <p class="mb-0 opacity-75 small">By <?= htmlspecialchars($article['author']) ?></p>
              </div>
              <small class="opacity-50 text-nowrap"><?= date('M d', strtotime($article['date'])) ?></small>
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