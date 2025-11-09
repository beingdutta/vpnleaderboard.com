<?php
require_once __DIR__ . '/db.php';
$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>About VPN Leaderboard | Our Mission & Values</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta name="description" content="Learn about VPN Leaderboard's mission to provide transparent, community-driven VPN rankings. We help users find the best VPN for privacy, security, and streaming.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <meta name="robots" content="index, follow">
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
<body>
  <?php include __DIR__ . '/navigation/nav.php'; ?>

  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">About Us</h1>
      <p class="text-secondary" style="font-size: 1.1rem;">Transparency, Community, and Security in the VPN World.</p>
    </div>
  </header>

  <main class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <article class="article-content">
          <h2>Our Mission</h2>
          <p class="lead">In a digital landscape filled with biased reviews and sponsored content, VPN Leaderboard was founded with a simple yet powerful mission: to create a transparent, community-powered platform for ranking VPN services. We believe that the most accurate measure of a VPN's quality comes from the real-world experiences of its users.</p>
          <p>Our goal is to empower you to make informed decisions about your online privacy and security. By putting the power of ranking in your hands, we aim to cut through the marketing noise and highlight the VPNs that truly deliver on their promises.</p>

          <h2>How It Works</h2>
          <p>The core of VPN Leaderboard is our live ranking system. Unlike static "top 10" lists, our leaderboards are dynamic and updated in real-time based on community votes. Here’s the process:</p>
          <ul>
            <li><strong>Community Voting:</strong> Registered users and visitors can upvote or downvote VPNs based on their personal experience with speed, reliability, customer support, and overall performance.</li>
            <li><strong>Real-Time Scoring:</strong> Each vote directly impacts a VPN's score. The rankings are calculated simply by subtracting downvotes from upvotes.</li>
            <li><strong>Promotional Transparency:</strong> Some VPNs may be marked as "Promoted." This is our way of keeping the lights on. However, these promotions do not affect the community score or the "true rank" of a service. Promoted listings are always clearly disclosed.</li>
          </ul>

          <h2>Our Values</h2>
          <p>We are guided by a core set of principles that influence every decision we make:</p>
          <ul>
            <li><strong>Transparency:</strong> We are open about how our rankings work and how we sustain our platform.</li>
            <li><strong>Community-First:</strong> Your voice is what matters most. We are committed to building a platform that reflects the collective wisdom of its users.</li>
            <li><strong>Data-Driven:</strong> While votes are subjective, we also provide objective data points on features, pricing, and security protocols to give you a complete picture.</li>
            <li><strong>User Privacy:</strong> We respect your privacy. We collect minimal data required for the voting system to function and are transparent about it in our Privacy Policy.</li>
          </ul>

          <h2>Join Our Community</h2>
          <p>Your participation is what makes VPN Leaderboard a valuable resource. Whether you're a privacy advocate, a streaming enthusiast, or someone just looking for a reliable VPN, your vote helps others navigate the complex world of online security. Thank you for being a part of our community.</p>

        </article>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>