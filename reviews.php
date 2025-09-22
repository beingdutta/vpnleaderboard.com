<?php
require_once __DIR__ . '/db.php';

// In a real application, you would fetch reviews from a database.
// For now, we'll use a placeholder array.
$reviews = [
    [
        'title' => 'ExpressVPN Review 2025: Still the King of Speed?',
        'slug' => 'expressvpn-review-2025',
        'author' => 'Mike Richards',
        'date' => 'September 12, 2025',
        'excerpt' => 'We put ExpressVPN through its paces to see if its performance, security, and features still justify its premium price tag.',
        'image' => 'https://images.unsplash.com/photo-1614027164847-1b28accfbdf1?q=80&w=870',
        'url' => 'reviews/expressvpn-review-2025'
    ],
    [
        'title' => 'NordVPN In-Depth Review: A Deep Dive into Features',
        'slug' => 'nordvpn-review-2025',
        'author' => 'Laura Chen',
        'date' => 'September 8, 2025',
        'excerpt' => 'Beyond the marketing, how does NordVPN hold up? We test its Threat Protection, Meshnet, and Double VPN features.',
        'image' => 'https://images.unsplash.com/photo-1611162616805-6a405b6a4a7a?q=80&w=774',
        'url' => 'reviews/nordvpn-review-2025'
    ],
    [
        'title' => 'Surfshark One Review: Is the Bundle Worth It?',
        'slug' => 'surfshark-one-review-2025',
        'author' => 'David Kim',
        'date' => 'September 2, 2025',
        'excerpt' => 'Surfshark offers more than just a VPN. We review its antivirus, search, and alert features to see if the "One" bundle is a good deal.',
        'image' => 'https://images.unsplash.com/photo-1611162618071-b39a2ec055fb?q=80&w=774',
        'url' => 'reviews/surfshark-one-review-2025'
    ],
    [
        'title' => 'Proton VPN Review: The Choice for Privacy Purists',
        'slug' => 'proton-vpn-review-2025',
        'author' => 'Emily White',
        'date' => 'August 25, 2025',
        'excerpt' => 'From the creators of ProtonMail, this VPN promises unmatched privacy. We verify its claims and test its Secure Core servers.',
        'image' => 'https://images.unsplash.com/photo-1614027164847-1b28accfbdf1?q=80&w=870',
        'url' => 'reviews/proton-vpn-review-2025'
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