<?php
http_response_code(404);
require_once __DIR__ . '/db.php'; // For consistency, includes helpers
$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . '/404.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page Not Found | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta name="description" content="Oops! The page you're looking for on VPN Leaderboard could not be found. Let us help you find the best community-ranked VPNs for privacy, streaming, and security.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <meta name="robots" content="noindex, follow">
    <link rel="icon" href="/assets/site-icon.png" type="image/png">
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
<body style="display: flex; flex-direction: column; min-height: 100vh;">
  <?php include __DIR__ . '/navigation/nav.php'; ?>

  <main class="container my-5" style="flex-grow: 1;">
    <div class="d-flex justify-content-center align-items-center text-center h-100">
      <div class="col-lg-6">
        <h1 class="display-1 fw-bold mb-4">404</h1>
        <h2 class="h3 mb-3">Page Not Found</h2>
        <p class="text-secondary mb-4">
          Oops! The page you're looking for seems to have been lost in the digital ether.
          Let's find a new path.
        </p>
        
        <div class="col-md-8 mx-auto mb-4">
          <form action="/" method="get" class="d-flex">
            <input type="search" name="q" class="form-control form-control-lg me-2" placeholder="Search the site..." aria-label="Search">
            <button class="btn btn-primary btn-lg" type="submit">Search</button>
          </form>
        </div>

        <a href="/" class="btn btn-outline-secondary">Go to Homepage</a>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>