<?php
require_once __DIR__ . '/../db.php'; // For header/footer includes
$page_title = "VPN Reviews";
$canonical = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/reviews/';
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
        <h1 class="mb-4">VPN Reviews</h1>
        <p class="lead mb-5">Explore our in-depth reviews and analysis of the top VPN services on the market to find the perfect one for your needs.</p>
        <div class="list-group">
            <?php
            $files = scandir(__DIR__);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && $file !== 'index.php') {
                    $clean_name = pathinfo($file, PATHINFO_FILENAME);
                    $title = ucwords(str_replace('-', ' ', $clean_name));
                    echo '<a href="/reviews/' . htmlspecialchars($clean_name) . '" class="list-group-item list-group-item-action">';
                    echo htmlspecialchars($title);
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>
  </main>

  <?php include __DIR__ . '/../navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/script.js"></script>
</body>
</html>