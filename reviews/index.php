<?php
require_once __DIR__ . '/../db.php';

// In a real application, you would fetch reviews from a database.
// For now, we'll use a placeholder array.
$reviews = [
    [
        'title' => 'ExpressVPN Quick Review 2025',
        'slug' => 'expressvpn-review-2025',
        'author' => 'Mike Richards',
        'date' => 'September 12, 2025',
        'excerpt' => 'We put ExpressVPN through its paces to see if its performance, security, and features still justify its premium price tag.',
        'image' => 'https://www.expressvpn.com/wp-ws/uploads-expressvpn/2023/04/expressvpn-vertical-logo-white-on-red.jpeg',
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
        'image' => 'https://www.tunnelbear.com/static/images/social-meta/share_graphic.jpg',
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
        'image' => 'https://play-lh.googleusercontent.com/W7lHDGmA0LTMB2tul80ezqEnnILgFM4jTxh6eSrPBqTOKWLRahEHc4uXSiE7PUHZOACM=w3840-h2160-rw',
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
        'image' => 'https://letsvpn.world/images/ietel.png',
        'url' => '/reviews/letsvpn-vpn-review'
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
        'image' => 'https://www.privateinternetaccess.com/blog/wp-content/uploads/2021/06/New-PIA-Logo.png',
        'url' => '/reviews/private-internet-access-vpn-review'
    ],
];
sort($reviews);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/styles/style.css?v=<?= @filemtime(__DIR__ . '/../styles/style.css') ?>" rel="stylesheet" />
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
  <?php include __DIR__ . '/../navigation/nav.php'; ?>

  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">Expert VPN Reviews</h1>
      <p class="text-secondary" style="font-size: 1.1rem;">Unbiased, hands-on testing to help you choose wisely.</p>
    </div>
  </header>

  <main class="container my-5">
    <div class="d-grid gap-4">
      <?php foreach ($reviews as $review): ?>
      <div class="card article-card-horizontal">
        <div class="row g-0">
          <div class="col-md-3">
            <img src="<?= htmlspecialchars($review['image']) ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars($review['title']) ?>">
          </div>
          <div class="col-md-9">
            <div class="card-body d-flex flex-column h-100">
              <h5 class="card-title mb-2"><?= htmlspecialchars($review['title']) ?></h5>
              <p class="card-text text-secondary small flex-grow-1"><?= htmlspecialchars($review['excerpt']) ?></p>
              <p class="card-text"><small class="text-secondary">By <?= htmlspecialchars($review['author']) ?> on <?= htmlspecialchars($review['date']) ?></small></p>
              <a href="<?= htmlspecialchars($review['url']) ?>" class="stretched-link"></a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </main>

  <?php include __DIR__ . '/../navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/script.js"></script>
</body>
</html>