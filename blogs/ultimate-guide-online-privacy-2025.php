<?php

// This file is a self-contained article.
$article = [
    'title' => 'The Ultimate Guide to Online Privacy in 2025',
    'author' => 'Jane Doe',
    'author_bio' => 'Jane is a cybersecurity analyst with over a decade of experience in digital privacy and network security.',
    'author_avatar' => 'https://i.pravatar.cc/150?u=jane',
    'date' => 'September 15, 2025',
    'image' => 'https://images.unsplash.com/photo-1555949963-ff9fe0c870eb?q=80&w=1920', // Use a high-res image
];

$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($article['title']) ?> | VPN Leaderboard</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="In an increasingly digital world, protecting your privacy has never been more important. This guide covers the essential tools and practices...">
    <meta property="og:title" content="<?= htmlspecialchars($article['title']) ?>">
    <meta property="og:description" content="In an increasingly digital world, protecting your privacy has never been more important. This guide covers the essential tools and practices...">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>"> 
    <meta property="og:image" content="<?= htmlspecialchars($article['image']) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/styles/style.css?v=<?= @filemtime(__DIR__ . '/styles/style.css') ?>" rel="stylesheet">
</head>
<body>
  <?php include __DIR__ . '/../navigation/nav.php'; ?>

  <header class="article-hero" style="background-image: url('<?= htmlspecialchars($article['image']) ?>');">
    <div class="article-hero-overlay">
      <div class="container">
        <h1 class="display-4 fw-bold"><?= htmlspecialchars($article['title']) ?></h1>
        <p class="lead">Posted on <?= htmlspecialchars($article['date']) ?></p>
      </div>
    </div>
  </header>

  <main class="container my-5">
    <div class="row g-5">
      <div class="col-lg-8">
        <article class="article-content">
          <p class="lead">In an increasingly digital world, protecting your online privacy has never been more important. This guide covers the essential tools and practices to safeguard your personal information from prying eyes.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
          <h2>Why Privacy Matters</h2>
          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida.</p>
          <figure class="figure">
            <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=870" class="figure-img img-fluid rounded" alt="A screen with green code, representing data encryption.">
            <figcaption class="figure-caption text-center">Encryption is the cornerstone of digital privacy.</figcaption>
          </figure>
          <h3>Choosing the Right Tools</h3>
          <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus.</p>
          <ul>
            <li><strong>Virtual Private Networks (VPNs):</strong> Encrypt your internet connection.</li>
            <li><strong>Secure Browsers:</strong> Block trackers and ads automatically.</li>
            <li><strong>Password Managers:</strong> Create and store strong, unique passwords.</li>
          </ul>
          <p>Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
        </article>
      </div>
      <div class="col-lg-4">
        <div class="sticky-sidebar">
          <div class="p-4 rounded author-box">
            <h4 class="fst-italic">About the author</h4>
            <div class="d-flex align-items-center mt-3">
              <img src="<?= htmlspecialchars($article['author_avatar']) ?>" alt="<?= htmlspecialchars($article['author']) ?>" width="64" height="64" class="rounded-circle me-3">
              <div class="fw-bold"><?= htmlspecialchars($article['author']) ?></div>
            </div>
            <p class="small text-secondary mt-3"><?= htmlspecialchars($article['author_bio']) ?></p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/script.js"></script>
</body>
</html>