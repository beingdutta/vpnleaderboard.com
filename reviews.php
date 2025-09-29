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
        'image' => 'https://www.expressvpn.com/wp-ws/uploads-expressvpn/2023/04/expressvpn-vertical-logo-white-on-red.jpeg',
        'url' => 'reviews/express-vpn-review' // This will now correctly map to the .php file
    ],
    [
        'title' => 'NordVPN In-Depth Review: A Deep Dive into Features',
        'slug' => 'nordvpn-review',
        'author' => 'Laura Chen',
        'date' => 'September 8, 2025',
        'excerpt' => 'Beyond the marketing, how does NordVPN hold up? We test its Threat Protection, Meshnet, and Double VPN features.',
        'image' => 'https://ic.nordcdn.com/v1/https://sb.nordcdn.com/transform/de3af5d2-7549-4841-a4c4-48f00c9ba1c3/logo-featured-blog-jpg?X-Nord-Credential=T4PcHqfACi8Naxvulzf4IE8XT4oypRTi0blOOGwbK2A8L4fcPw52k3qkvbkYH&X-Nord-Signature=8iqRmG595OV8ojGMfaf7BGjxl1E200Yl9nIlO2Z5P7s%3D',
        'url' => 'reviews/nord-vpn-review' // You will need to create this .php file
    ],
    [
        'title' => 'Surfshark Quick Review',
        'slug' => 'surfshark-one-review',
        'author' => 'David Kim',
        'date' => 'September 2, 2025',
        'excerpt' => 'Surfshark offers more than just a VPN. We review its antivirus, search, and alert features to see if the "One" bundle is a good deal.',
        'image' => 'https://i.pcmag.com/imagery/reviews/04S1wwi1deiGuN21Ixcjcxv-52..v1620413332.png',
        'url' => 'reviews/surfshark-vpn-review' // You will need to create this .php file
    ],
    [
        'title' => 'Proton VPN Quick Review',
        'slug' => 'proton-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://res.cloudinary.com/dbulfrlrz/images/f_auto,q_auto/v1714482718/wp-vpn/hero-vpn/hero-vpn.jpg',
        'url' => 'reviews/proton-vpn-review' // You will need to create this .php file
    ],
    [
        'title' => 'TunnelBear VPN Review: The Choice for Privacy Purists',
        'slug' => 'tunnelBear-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://www.tunnelbear.com/static/images/social-meta/share_graphic.jpg',
        'url' => 'reviews/tunnelbear-vpn-review' // You will need to create this .php file
    ],
    [
        'title' => 'CyberGhost VPN Review: The Choice for Privacy Purists',
        'slug' => 'cyberGhost-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://cyberinsider.com/wp-content/uploads/2024/09/CyberGhost-VPN-Review.jpg',
        'url' => 'reviews/cyberGhost-vpn-review' // You will need to create this .php file
    ],
    [
        'title' => 'Hide.me VPN Review: The Choice for Privacy Purists',
        'slug' => 'Hideme-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://static0.howtogeekimages.com/wordpress/wp-content/uploads/2023/01/hide-me-logo.png',
        'url' => 'reviews/hideme-vpn-review' // You will need to create this .php file
    ],
    [
        'title' => 'Avast Secureline VPN Review: The Choice for Privacy Purists',
        'slug' => 'avast-secureline-vpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuPPYqXIjsGpXp5SjQzE6XjMOccSRW1oLNvw&s',
        'url' => 'reviews/avast-secureline-vpn-review' // You will need to create this .php file
    ],
    [
        'title' => 'PureVPN Review: The Choice for Privacy Purists',
        'slug' => 'purevpn-review',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://media.cybernews.com/images/featured-big/2024/09/purevpn-review.jpg',
        'url' => 'reviews/pure-vpn-review' // You will need to create this .php file
    ],

];

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
    <link href="styles/style.css?v=<?= @filemtime('styles/style.css') ?>" rel="stylesheet">
</head>
<body>
  <?php include __DIR__ . '/navigation/nav.php'; ?>

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

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>