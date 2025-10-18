<?php
require_once __DIR__ . '/db.php';

// In a real application, you would fetch reviews from a database.
// For now, we'll use a placeholder array.
$reviews = [
    [
        'title' => 'ExpressVPN Quick Review 2025',
        'slug' => 'expressvpn-review-2025',
        'author' => 'Mike Richards',
        'date' => 'September 12, 2025',
        'excerpt' => 'We put ExpressVPN through its paces to see if its performance, security, and features still justify its premium price tag.',
        'image' => 'https://xv.imgix.net/photos/xv/Red-Logo-Horizontal-ExpressVPN-Preview-fa080bcc7c7b864b93c1613d444c36d2.png?s=fcbeb8941e9e72a5889930b7df6c7c85',
        'url' => '/reviews/express-vpn-review'
    ],
    [
        'title' => 'NordVPN In-Depth Review: A Deep Dive into Features',
        'slug' => 'nordvpn-review',
        'author' => 'Laura Chen',
        'date' => 'September 8, 2025',
        'excerpt' => 'Beyond the marketing, how does NordVPN hold up? We test its Threat Protection, Meshnet, and Double VPN features.',
        'image' => 'https://ic.nordcdn.com/v1/https://sb.nordcdn.com/transform/de3af5d2-7549-4841-a4c4-48f00c9ba1c3/logo-featured-blog-jpg?X-Nord-Credential=T4PcHqfACi8Naxvulzf4IE8XT4oypRTi0blOOGwbK2A8L4fcPw52k3qkvbkYH&X-Nord-Signature=8iqRmG595OV8ojGMfaf7BGjxl1E200Yl9nIlO2Z5P7s%3D',
        'url' => '/reviews/nord-vpn-review'
    ],
    [
        'title' => 'Surfshark Quick Review',
        'slug' => 'surfshark-one-review',
        'author' => 'David Kim',
        'date' => 'September 2, 2025',
        'excerpt' => 'Surfshark offers more than just a VPN. We review its antivirus, search, and alert features to see if the "One" bundle is a good deal.',
        'image' => 'https://i.pcmag.com/imagery/reviews/04S1wwi1deiGuN21Ixcjcxv-52..v1620413332.png',
        'url' => '/reviews/surfshark-vpn-review'
    ],
    [
        'title' => 'Proton VPN Quick Review',
        'slug' => 'proton-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://res.cloudinary.com/dbulfrlrz/images/f_auto,q_auto/v1714482718/wp-vpn/hero-vpn/hero-vpn.jpg',
        'url' => '/reviews/proton-vpn-review'
    ],
    [
        'title' => 'TunnelBear VPN Review: The Choice for Privacy Purists',
        'slug' => 'tunnelBear-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => '/assets/review-article-thumbnails/tunnebear-thumbnail.png',
        'url' => '/reviews/tunnelbear-vpn-review'
    ],
    [
        'title' => 'CyberGhost VPN Review: The Choice for Privacy Purists',
        'slug' => 'cyberGhost-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://cyberinsider.com/wp-content/uploads/2024/09/CyberGhost-VPN-Review.jpg',
        'url' => '/reviews/cyberghost-vpn-review'
    ],
    [
        'title' => 'Hide.me VPN Review: The Choice for Privacy Purists',
        'slug' => 'Hideme-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://static0.howtogeekimages.com/wordpress/wp-content/uploads/2023/01/hide-me-logo.png',
        'url' => '/reviews/hideme-vpn-review'
    ],
    [
        'title' => 'Avast Secureline VPN Review: The Choice for Privacy Purists',
        'slug' => 'avast-secureline-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuPPYqXIjsGpXp5SjQzE6XjMOccSRW1oLNvw&s',
        'url' => '/reviews/avast-secureline-vpn-review'
    ],
    [
        'title' => 'PureVPN Review: The Choice for Privacy Purists',
        'slug' => 'purevpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://media.cybernews.com/images/featured-big/2024/09/purevpn-review.jpg',
        'url' => '/reviews/pure-vpn-review'
    ],
    [
        'title' => 'PrivateVPN Review: A Budget-Friendly Streaming Powerhouse?',
        'slug' => 'private-vpn-review',
        'author' => 'Ellen Carter',
        'date' => 'August 24, 2025',
        'excerpt' => 'PrivateVPN is known for strong streaming support and modest pricing. We test if this budget-friendly choice can keep up with the top-tier competition.',
        'image' => 'https://www.01net.com/en/app/uploads/2023/07/PrivateVPN-review.jpg',
        'url' => '/reviews/private-vpn-review'
    ],
    [
        'title' => 'Windscribe VPN Review: Generous Free Plan & Unlimited Devices',
        'slug' => 'windscribe-vpn-review',
        'author' => 'Jordan Lee',
        'date' => 'September 23, 2025',
        'excerpt' => 'Windscribe blends power and flexibility with a famously generous free tier, unlimited device connections, and a strong privacy stance, making it a compelling choice.',
        'image' => 'https://m.media-amazon.com/images/I/61MBBK+vS1L.png',
        'url' => '/reviews/windscribe-vpn-review'
    ],
    [
        'title' => 'Astrill VPN Review: A Look at the Power-User Favorite',
        'slug' => 'astrill-vpn-review',
        'author' => 'Casey Bennett',
        'date' => 'August 22, 2025',
        'excerpt' => 'Known for its speed and advanced options, we test Astrill VPN to see if its premium price tag is justified for users in restrictive regions.',
        'image' => 'https://www.security.org/app/uploads/2020/10/Astrill-VPN-Logo.png',
        'url' => '/reviews/astrill-vpn-review'
    ],
    [
        'title' => 'Mullvad VPN Review: The Gold Standard for Privacy?',
        'slug' => 'mullvad-vpn-review',
        'author' => 'Alex Chen',
        'date' => 'August 20, 2025',
        'excerpt' => 'With anonymous accounts and a no-nonsense approach, Mullvad is a favorite among privacy purists. We see how it holds up in real-world use.',
        'image' => '/assets/review-article-thumbnails/mullvad-vpn-thumbnail.png',
        'url' => '/reviews/mullvad-vpn-review'
    ],
    [
        'title' => 'V1VPN Review: Simplicity and Speed for Everyday Users',
        'slug' => 'v1-vpn-review',
        'author' => 'Riley Morgan',
        'date' => 'August 18, 2025',
        'excerpt' => 'V1VPN aims to make private browsing effortless with a one-tap connect experience. Is it the right choice for beginners?',
        'image' => 'https://static.wixstatic.com/media/5c8709_5c0d8b1ff6324885b06764561eca865a~mv2.jpg',
        'url' => '/reviews/v1-vpn-review'
    ],
    [
        'title' => 'LetsVPN Review: One-Tap Privacy for Mobile and Desktop',
        'slug' => 'letsvpn-vpn-review',
        'author' => 'Mike Richards',
        'date' => 'August 15, 2025',
        'excerpt' => 'LetsVPN focuses on a simple, auto-routing experience. We test its proprietary protocol for speed and stability in daily use.',
        'image' => 'https://cdn6.aptoide.com/imgs/6/0/f/60f15a30d56e3058d0c06909d6ccd194_fgraphic.png',
        'url' => '/reviews/letsvpn-review'
    ],
    [
        'title' => 'VeePN Review 2025',
        'slug' => 'veepn-vpn-review',
        'author' => 'Mike Richards',
        'date' => 'September 15, 2025',
        'excerpt' => 'VeePN offers a solid feature set and decent performance, especially on nearby servers, but its kill switch is flaky.',
        'image' => 'https://media.cybernews.com/images/750w/2021/08/VeePN-review.jpg',
        'url' => '/reviews/veepn-review'
    ],
    [
        'title' => 'Private Internet Access (PIA) VPN Review',
        'slug' => 'private-internet-access-vpn-review',
        'author' => 'Mike Richards',
        'date' => 'September 25, 2025',
        'excerpt' => 'PIA blends robust privacy with wallet-friendly pricing, featuring open-source apps, an audited no-logs policy, and unlimited device connections.',
        'image' => '/assets/review-article-thumbnails/pia-thumbnail.png',
        'url' => '/reviews/private-internet-access-vpn-review'
    ],
    [
        'title' => '12VPX VPN Review 2025 | The China Specialist?',
        'slug' => '12vpx-vpn-review',
        'author' => 'Mike Richards',
        'date' => 'October 5, 2025',
        'excerpt' => 'A human-written 2025 review of 12VPX VPN. We look at its legendary status for bypassing restrictions in China, but see how it stacks up for everyday use like streaming and privacy.',
        'image' => '/assets/review-article-thumbnails/12vpx-thumbnail.png',
        'url' => '/reviews/12vpx-vpn-review'
    ],
    [
        'title' => 'Hotspot Shield VPN Review 2025 | The Speed Demon',
        'slug' => 'hotspot-shield-vpn-review',
        'author' => 'Mike Richards',
        'date' => 'October 5, 2025',
        'excerpt' => 'Known for its blazing-fast Hydra protocol, we review Hotspot Shield to see if its top-tier streaming performance is worth the privacy trade-offs of its US jurisdiction and logging policy.',
        'image' => 'https://i.pcmag.com/imagery/reviews/03Zv0ZUOeqGtbYk612UMWbg-18.fit_lim.size_1050x591.v1593116274.png',
        'url' => '/reviews/hotspot-shield-vpn-review'
    ],
];

// Sort the reviews array by date in descending order (newest first)
usort($reviews, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VPN Reviews - Unbiased & In-Depth Analysis | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Expert, hands-on reviews of the top VPN services. We test speed, security, and features to help you choose the best VPN.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link rel="icon" href="/assets/site-icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/styles/style.css?v=<?= @filemtime(__DIR__ . '/styles/style.css') ?>" rel="stylesheet">
    <!-- Google tag (gtag.js) -->
   
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1RMZD8BYYZ"></script>
    <script>
    window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'G-1RMZD8BYYZ');
     </script>
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
    <?php if (!empty($reviews)): ?>
      <?php
        // Take the first 3 reviews for the carousel
        $carousel_reviews = array_splice($reviews, 0, 3);
      ?>
      <!-- Featured Article Carousel -->
      <div id="featuredReviewCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <?php foreach ($carousel_reviews as $index => $review): ?>
            <button type="button" data-bs-target="#featuredReviewCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
          <?php endforeach; ?>
        </div>
        <div class="carousel-inner rounded">
          <?php foreach ($carousel_reviews as $index => $review): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="card featured-article-card">
              <div class="row g-0">
                <div class="col-lg-6">
                  <img src="<?= htmlspecialchars($review['image']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($review['title']) ?>" loading="lazy">
                </div>
                <div class="col-lg-6 d-flex align-items-center">
                  <div class="card-body p-lg-5">
                    <h2 class="card-title display-6 mb-3"><?= htmlspecialchars($review['title']) ?></h2>
                    <p class="card-text text-secondary mb-4"><?= htmlspecialchars($review['excerpt']) ?></p>
                    <p class="card-text"><small class="text-secondary">By <?= htmlspecialchars($review['author']) ?> on <?= htmlspecialchars($review['date']) ?></small></p>
                    <a href="<?= htmlspecialchars($review['url']) ?>" class="stretched-link"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#featuredReviewCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredReviewCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <div class="alert unbiased-review-alert text-center my-5" role="alert">
        <h4 class="alert-heading mb-0">Only Unbiased VPN Review In The "Whole Internet"</h4>
      </div>

      <hr class="my-5">

      <!-- Grid of Other Reviews -->
      <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($reviews as $review): ?>
        <div class="col">
          <div class="card h-100 article-card-vertical">
            <a href="<?= htmlspecialchars($review['url']) ?>">
              <img src="<?= htmlspecialchars($review['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($review['title']) ?>" loading="lazy">
            </a>
            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-2">
                <a href="<?= htmlspecialchars($review['url']) ?>" class="text-decoration-none stretched-link"><?= htmlspecialchars($review['title']) ?></a>
              </h5>
              <p class="card-text text-secondary small flex-grow-1"><?= htmlspecialchars($review['excerpt']) ?></p>
              <p class="card-text mt-auto"><small class="text-secondary">By <?= htmlspecialchars($review['author']) ?> on <?= htmlspecialchars($review['date']) ?></small></p>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <div class="text-center">
        <p>No reviews found.</p>
      </div>
    <?php endif; ?>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>