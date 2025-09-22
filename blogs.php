<?php
require_once __DIR__ . '/db.php';

// In a real application, you would fetch blog articles from a database.
// For now, we'll use a placeholder array.
$blogs = [
    [
        'title' => 'The Ultimate Guide to Online Privacy in 2025',
        'slug' => 'ultimate-guide-online-privacy-2025',
        'author' => 'Jane Doe',
        'date' => 'September 15, 2025',
        'excerpt' => 'In an increasingly digital world, protecting your privacy has never been more important. This guide covers the essential tools and practices...',
        'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?q=80&w=870',
        'url' => 'blogs/ultimate-guide-online-privacy-2025'
    ],
    [
        'title' => 'How VPNs Can Secure Your Public Wi-Fi Connections',
        'slug' => 'how-vpns-secure-public-wifi',
        'author' => 'John Smith',
        'date' => 'September 10, 2025',
        'excerpt' => 'Public Wi-Fi is convenient but risky. Learn how a Virtual Private Network (VPN) can encrypt your data and keep you safe from hackers.',
        'image' => 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=870',
        'url' => 'blogs/how-vpns-secure-public-wifi'
    ],
    [
        'title' => 'Debunking Common Myths About VPNs',
        'slug' => 'debunking-common-vpn-myths',
        'author' => 'Alex Ray',
        'date' => 'September 5, 2025',
        'excerpt' => 'Are VPNs only for tech experts? Do they make you completely anonymous? We tackle the most common misconceptions about VPNs.',
        'image' => 'https://images.unsplash.com/photo-1585226985133-2a64e3203a25?q=80&w=870',
        'url' => 'blogs/debunking-common-vpn-myths'
    ],
    [
        'title' => 'Choosing the Right VPN for Streaming',
        'slug' => 'choosing-right-vpn-for-streaming',
        'author' => 'Sarah Jones',
        'date' => 'August 28, 2025',
        'excerpt' => 'Tired of geo-restrictions? A good streaming VPN can unlock a world of content. Here’s what to look for when choosing one.',
        'image' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?q=80&w=774',
        'url' => 'blogs/choosing-right-vpn-for-streaming'
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/style.css?v=<?= @filemtime('styles/style.css') ?>" rel="stylesheet">
</head>
<body>
  <?php include __DIR__ . '/navigation/nav.php'; ?>

  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">VPN & Security Blog</h1>
      <p class="text-secondary" style="font-size: 1.1rem;">Your source for privacy news, tips, and in-depth guides.</p>
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