<?php
require_once __DIR__ . '/db.php';
$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Privacy Policy | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Read the privacy policy for VPN Leaderboard to understand how we collect, use, and protect your data.">
    <link rel="canonical" href="https://www.vpnleaderboard.com/privacy">
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
      <h1 class="display-5 fw-bold">Privacy Policy</h1>
      <p class="text-secondary" style="font-size: 1.1rem;">Last Updated: <?= date('F j, Y') ?></p>
    </div>
  </header>

  <main class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <article class="article-content">
          <p class="lead">VPN Leaderboard ("us", "we", or "our") operates the vpnleaderboard.com website (the "Service"). This page informs you of our policies regarding the collection, use, and disclosure of personal data when you use our Service and the choices you have associated with that data.</p>

          <h2>1. Information Collection and Use</h2>
          <p>We collect several different types of information for various purposes to provide and improve our Service to you.</p>

          <h3>Types of Data Collected</h3>
          <h4>Personal Data</h4>
          <ul>
              <li><strong>Voting System:</strong> To prevent fraudulent voting, we assign a unique, anonymous cookie ID to your browser. We also log the IP address associated with each vote. This data is used solely for the purpose of maintaining the integrity of our ranking system.</li>
              <li><strong>Contact/Feedback Form:</strong> When you submit feedback or contact us, we collect the information you provide, such as your name, email address, and message, to respond to your inquiry.</li>
          </ul>

          <h4>Usage Data</h4>
          <p>We may also collect information on how the Service is accessed and used ("Usage Data"). This Usage Data may include information such as your computer's Internet Protocol address (e.g., IP address), browser type, browser version, the pages of our Service that you visit, the time and date of your visit, the time spent on those pages, and other diagnostic data.</p>

          <h2>2. Use of Data</h2>
          <p>VPN Leaderboard uses the collected data for various purposes:</p>
          <ul>
              <li>To provide and maintain the Service</li>
              <li>To prevent fraudulent activity on our voting platform</li>
              <li>To allow you to participate in interactive features of our Service when you choose to do so</li>
              <li>To provide customer support and respond to inquiries</li>
              <li>To gather analysis or valuable information so that we can improve the Service</li>
              <li>To monitor the usage of the Service</li>
          </ul>

          <h2>3. Cookies</h2>
          <p>We use cookies to operate our voting system. A cookie is a small file placed on your device. Our primary cookie is a unique, anonymous identifier used to track your votes and prevent duplicate voting. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to vote on our platform.</p>

          <h2>4. Security of Data</h2>
          <p>The security of your data is important to us, but remember that no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.</p>

          <h2>5. Links to Other Sites</h2>
          <p>Our Service contains links to other sites that are not operated by us, including affiliate links to VPN providers. If you click on a third-party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>

          <h2>6. Changes to This Privacy Policy</h2>
          <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. You are advised to review this Privacy Policy periodically for any changes.</p>

        </article>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
</body>
</html>