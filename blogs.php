<?php
require_once __DIR__ . '/db.php';

// In a real application, you would fetch blog articles from a database.
// For now, we'll use a placeholder array.
$blogs = [
    [
        'title' => 'How VPNs Can Secure Your Public Wi-Fi Connections',
        'slug' => 'how-vpns-secure-public-wifi',
        'author' => 'John Smith',
        'date' => 'September 10, 2025',
        'excerpt' => 'Public Wi-Fi is convenient but risky. Learn how a Virtual Private Network (VPN) can encrypt your data and keep you safe from hackers.',
        'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1920',
        'url' => '/blogs/how-vpns-secure-public-wifi'
    ],
    [
        'title' => 'Debunking Common Myths About VPNs',
        'slug' => 'biggest-vpn-myths',
        'author' => 'Alex Ray',
        'date' => 'September 5, 2025',
        'excerpt' => 'Are VPNs only for tech experts? Do they make you completely anonymous? We tackle the most common misconceptions about VPNs.',
        'image' => 'https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?q=80&w=1920',
        'url' => '/blogs/biggest-vpn-myths'
    ],
    [
        'title' => 'Choosing the Right VPN for Streaming',
        'slug' => 'right-vpn-for-streaming',
        'author' => 'Sarah Jones',
        'date' => 'August 28, 2025',
        'excerpt' => 'Tired of geo-restrictions? A good streaming VPN can unlock a world of content. Here’s what to look for when choosing one.',
        'image' => 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?q=80&w=1920',
        'url' => '/blogs/right-vpn-for-streaming'
    ],
    [
        'title' => 'Working VPNs for China 2025 - Read Me First!!',
        'slug' => 'working-vpns-for-china',
        'author' => 'Jane Doe',
        'date' => 'October 5, 2025',
        'excerpt' => 'An in-depth, human-narrated guide to the VPNs that actually work in China in 2025. We explore Astrill VPN, Mullvad, and LetsVPN to see how they beat the Great Firewall.',
        'image' => 'https://images.unsplash.com/photo-1640869429947-ace411d59d43?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        'url' => '/blogs/working-vpns-for-china'
    ],
    [
        'title' => 'Free No-Logs VPNs: A 2025 Deep Dive',
        'slug' => 'free-no-logs-vpns',
        'author' => 'Jane Doe',
        'date' => 'October 4, 2025',
        'excerpt' => 'A brutally honest guide to the world of free VPNs that claim \'no-logs.\' We investigate the business models and review the few trustworthy options like Proton VPN and Windscribe.',
        'image' => 'https://plus.unsplash.com/premium_photo-1663050681752-4c95effcca58?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        'url' => '/blogs/free-no-logs-vpns'
    ],
];

$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VPN Blog - Insights on Privacy and Security | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Read the latest articles and guides on VPNs, online privacy, and internet security from the experts at VPN Leaderboard.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link rel="icon" href="/assets/site-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/styles/style.css?v=<?= @filemtime(__DIR__ . '/styles/style.css') ?>" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1RMZD8BYYZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-1RMZD8BYYZ');
    </script>
</head>
<body>
  <?php include __DIR__ . '/navigation/nav.php'; ?>

  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">VPN & Security Blog</h1>
      <p class="text-secondary">Your source for privacy news, tips, and in-depth guides.</p>
    </div>
  </header>

  <main class="container my-5">
    <div class="d-grid gap-4">
      <?php foreach ($blogs as $blog): ?>
      <div class="card article-card-horizontal">
        <div class="row g-0">
          <div class="col-md-3">
            <img src="<?= htmlspecialchars($blog['image']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($blog['title']) ?>">
          </div>
          <div class="col-md-9">
            <div class="card-body d-flex flex-column h-100">
              <h5 class="card-title mb-2"><?= htmlspecialchars($blog['title']) ?></h5>
              <p class="card-text text-secondary small flex-grow-1"><?= htmlspecialchars($blog['excerpt']) ?></p>
              <p class="card-text"><small class="text-secondary">By <?= htmlspecialchars($blog['author']) ?> on <?= htmlspecialchars($blog['date']) ?></small></p>
              <a href="<?= htmlspecialchars($blog['url']) ?>" class="stretched-link"></a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>