<?php
require_once __DIR__ . '/db.php';
$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Terms and Conditions | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Read the terms and conditions for using the VPN Leaderboard website and its services.">
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
<body>
  <?php include __DIR__ . '/navigation/nav.php'; ?>

  <header class="py-5 hero">
    <div class="container text-center">
      <h1 class="display-5 fw-bold">Terms and Conditions</h1>
      <p class="text-secondary" style="font-size: 1.1rem;">Last Updated: <?= date('F j, Y') ?></p>
    </div>
  </header>

  <main class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <article class="article-content">
          <p class="lead">Welcome to VPN Leaderboard. These terms and conditions outline the rules and regulations for the use of our website, located at vpnleaderboard.com.</p>
          <p>By accessing this website, we assume you accept these terms and conditions. Do not continue to use VPN Leaderboard if you do not agree to all of the terms and conditions stated on this page.</p>

          <h2>1. Intellectual Property Rights</h2>
          <p>Other than the content you own, under these Terms, VPN Leaderboard and/or its licensors own all the intellectual property rights and materials contained in this Website. You are granted a limited license only for purposes of viewing the material contained on this Website.</p>

          <h2>2. User Conduct and Voting</h2>
          <ul>
              <li>You agree not to use any automated system, including without limitation "robots," "spiders," or "offline readers," to access the site in a manner that sends more request messages to the servers than a human can reasonably produce in the same period by using a conventional on-line web browser.</li>
              <li>Votes submitted to the platform should reflect your own genuine experience and opinion.</li>
              <li>Any attempt to manipulate the voting system, including creating multiple accounts or using bots, is strictly prohibited and will result in a ban.</li>
          </ul>

          <h2>3. Affiliate Links and Promotions</h2>
          <p>VPN Leaderboard is a reader-supported website. Some links on our site are affiliate links. If you click on an affiliate link and make a purchase, we may receive a commission at no extra cost to you. This helps us maintain the website and continue providing our service. We clearly mark "Promoted" listings, but these do not influence the community-driven score.</p>

          <h2>4. Limitation of Liability</h2>
          <p>The information on this website is provided "as is" without any representations or warranties, express or implied. VPN Leaderboard makes no representations or warranties in relation to the information and materials provided on this website.</p>
          <p>In no event shall VPN Leaderboard, nor any of its officers, directors, and employees, be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract. VPN Leaderboard shall not be held liable for any indirect, consequential, or special liability arising out of or in any way related to your use of this Website.</p>

          <h2>5. Disclaimer</h2>
          <p>The rankings and information on VPN Leaderboard are for informational purposes only. We strive for accuracy, but we cannot guarantee that all information is correct or up-to-date. You should always do your own research before purchasing any VPN service.</p>

          <h2>6. Governing Law & Jurisdiction</h2>
          <p>These Terms will be governed by and interpreted in accordance with the laws of the State/Country of [Your Jurisdiction], and you submit to the non-exclusive jurisdiction of the state and federal courts located in [Your Jurisdiction] for the resolution of any disputes.</p>

          <h2>7. Changes to These Terms</h2>
          <p>We reserve the right to revise these terms and conditions at any time. By using this Website, you are expected to review these terms on a regular basis.</p>

          <h2>Contact Us</h2>
          <p>If you have any questions about these Terms, please <a href="/contact.php">contact us</a>.</p>

        </article>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>