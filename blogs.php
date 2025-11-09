<?php
require_once __DIR__ . '/db.php';

$blogs = [
    [
        'title' => 'How VPNs Can Secure Your Public Wi-Fi Connections',
        'slug' => 'how-vpns-secure-public-wifi',
        'author' => 'John Smith',
        'date' => 'September 10, 2025',
        'excerpt' => 'Public Wi-Fi is convenient but risky. Learn how a Virtual Private Network (VPN) can encrypt your data and keep you safe from hackers.',
        'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1920', // This should be a relative path if the image is local
        'url' => '/blogs/how-vpns-secure-public-wifi'
    ],
    [
        'title' => 'Debunking Common Myths About VPNs',
        'slug' => 'biggest-vpn-myths',
        'author' => 'Alex Ray',
        'date' => 'September 5, 2025',
        'excerpt' => 'Are VPNs only for tech experts? Do they make you completely anonymous? We tackle the most common misconceptions about VPNs.',
        'image' => 'https://images.unsplash.com/photo-1510915228340-29c85a43dcfe?q=80&w=1920', // This should be a relative path if the image is local
        'url' => '/blogs/biggest-vpn-myths'
    ],
    [
        'title' => 'Choosing the Right VPN for Streaming',
        'slug' => 'right-vpn-for-streaming',
        'author' => 'Sarah Jones',
        'date' => 'August 28, 2025',
        'excerpt' => 'Tired of geo-restrictions? A good streaming VPN can unlock a world of content. Here’s what to look for when choosing one.',
        'image' => 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?q=80&w=1920', // This should be a relative path if the image is local
        'url' => '/blogs/right-vpn-for-streaming'
    ],
    [
        'title' => 'Working VPNs for China 2025 - Read Me First!!',
        'slug' => 'working-vpns-for-china',
        'author' => 'Jane Doe',
        'date' => 'October 5, 2025',
        'excerpt' => 'An in-depth, human-narrated guide to the VPNs that actually work in China in 2025. We explore Astrill VPN, Mullvad, and LetsVPN to see how they beat the Great Firewall.', // This should be a relative path if the image is local
        'image' => '/assets/blog-article-thumbnails/working-vpns-in-china.webp',
        'url' => '/blogs/working-vpns-for-china'
    ],
    [
        'title' => 'Free No-Logs VPNs: A 2025 Deep Dive',
        'slug' => 'free-no-logs-vpns',
        'author' => 'Jane Doe',
        'date' => 'October 4, 2025',
        'excerpt' => 'A brutally honest guide to the world of free VPNs that claim \'no-logs.\' We investigate the business models and review the few trustworthy options like Proton VPN and Windscribe.', // This should be a relative path if the image is local
        'image' => '/assets/blog-article-thumbnails/free-no-logs-vpns.webp',
        'url' => '/blogs/free-no-logs-vpns'
    ],
    [
        'title' => 'Best VPN for CapCut 2025: Unblock All Features in India',
        'slug' => 'best-free-vpn-for-capcut-in-india',
        'author' => 'Jane Doe',
        'date' => 'October 4, 2025',
        'excerpt' => 'Struggling with \'No internet connection\' on CapCut in India? Unlock templates and pro features with our guide to the best free and paid VPNs for CapCut on Android & iOS.', // This should be a relative path if the image is local
        'image' => '/assets/blog-article-thumbnails/best-free-vpn-for-capcut.webp',
        'url' => '/blogs/best-free-vpn-for-capcut-in-india'
    ],
    [
        'title' => 'Best No-Log VPNs 2025: Your Guide to True Digital Privacy',
        'slug' => 'best-no-logs-vpns',
        'author' => 'Jane Doe',
        'date' => 'October 18, 2025',
        'excerpt' => 'Looking for a true no-log VPN? We review the best VPNs with audited no-log policies, RAM-only servers, and strong privacy to keep your data safe in 2025.',
        'image' => '/assets/blog-article-thumbnails/best-no-logs-vpns.webp',
        'url' => '/blogs/best-no-logs-vpns'
    ],
    [
        'title' => 'Best VPN for PUBG Mobile 2025: The Ultimate Guide to Low Ping',
        'slug' => 'best-vpn-for-pubg',
        'author' => 'Jane Doe',
        'date' => 'October 18, 2025',
        'excerpt' => 'Stop losing to lag. We tested the top VPNs to find the lowest ping for PUBG Mobile. Read our expert review of the best VPN for PUBG in India, iOS, and Android.',
        'image' => '/assets/blog-article-thumbnails/best-vpn-for-pubg.webp',
        'url' => '/blogs/best-vpn-for-pubg'
    ],
    [
        'title' => 'Best VPN for PC 2025: The Ultimate Free & Paid Guide (Windows 11/10)',
        'slug' => 'best-free-vpn-for-pc',
        'author' => 'Jane Doe',
        'date' => 'October 18, 2025',
        'excerpt' => 'Searching for the best free VPN for PC in 2025? We review the only safe free VPNs (like Proton and Windscribe) and the top paid VPN software for Windows.',
        'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=1920',
        'url' => '/blogs/best-free-vpn-for-pc'
    ],
];

// Sort the blogs array by date in descending order (newest first)
usort($blogs, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

$canonical = 'https://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VPN Blog - Expert Guides on Privacy, Streaming & Gaming | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="From finding the best free VPN for CapCut to debunking privacy myths, the VPN Leaderboard blog offers expert guides on streaming, gaming, and staying safe online.">
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

  <main class="container my-5">
    <?php if (!empty($blogs)): ?>
      <?php
        // Take the first 3 blog posts for the carousel and remove them from the main array
        $carousel_blogs = array_splice($blogs, 0, 3);
      ?>
      <!-- Featured Article Carousel -->
      <div id="featuredArticleCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <?php foreach ($carousel_blogs as $index => $blog): ?>
            <button type="button" data-bs-target="#featuredArticleCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
          <?php endforeach; ?>
        </div>
        <div class="carousel-inner rounded">
          <?php foreach ($carousel_blogs as $index => $blog): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="card featured-article-card">
              <div class="row g-0">
                <div class="col-lg-6">
                  <img src="<?= htmlspecialchars($blog['image']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($blog['title']) ?>" loading="lazy">
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                  <div class="card-body p-lg-5">
                    <h2 class="card-title display-6 mb-3"><?= htmlspecialchars($blog['title']) ?></h2>
                    <p class="card-text text-secondary mb-4"><?= htmlspecialchars($blog['excerpt']) ?></p>
                    <p class="card-text"><small class="text-secondary">By <?= htmlspecialchars($blog['author']) ?> on <?= htmlspecialchars($blog['date']) ?></small></p>
                    <a href="<?= htmlspecialchars($blog['url']) ?>" class="stretched-link"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredArticleCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredArticleCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <hr class="my-5">

      <!-- Grid of Other Articles -->
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($blogs as $blog): ?>
        <div class="col">
          <div class="card h-100 article-card-vertical">
            <a href="<?= htmlspecialchars($blog['url']) ?>">
              <img src="<?= htmlspecialchars($blog['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($blog['title']) ?>" loading="lazy">
            </a>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-2">
                <a href="<?= htmlspecialchars($blog['url']) ?>" class="text-decoration-none stretched-link"><?= htmlspecialchars($blog['title']) ?></a>
              </h5>
              <p class="card-text text-secondary small flex-grow-1"><?= htmlspecialchars($blog['excerpt']) ?></p>
              <p class="card-text mt-auto"><small class="text-secondary">By <?= htmlspecialchars($blog['author']) ?> on <?= htmlspecialchars($blog['date']) ?></small></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <div class="text-center">
        <p>No blog posts found.</p>
      </div>
    <?php endif; ?>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/script.js?v=<?= @filemtime(__DIR__ . '/scripts/script.js') ?>"></script>
</body>
</html>