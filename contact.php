<?php
require_once __DIR__ . '/db.php';
$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact Us | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">    <meta name="description" content="Contact the VPN Leaderboard team with questions, suggestions, or partnership inquiries. Connect with us about our community-driven VPN rankings and reviews.">
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
      <h1 class="display-5 fw-bold">Get In Touch</h1>
      <p class="text-secondary" style="font-size: 1.1rem;">We value your input. Let's connect.</p>
    </div>
  </header>

  <div class="container mt-4">
    <div class="alert alert-info text-center" role="alert">
      <strong>Are you a VPN company?</strong> To register your VPN or discuss partnerships, please email us at 
      <a href="mailto:admin@vpnleaderboard.com" class="alert-link">admin@vpnleaderboard.com</a>.
    </div>
  </div>

  <main class="container my-5">
    <div class="row justify-content-center">
      <div class="col-lg-7">
        <div id="feedback-card" class="card" style="background: var(--background-secondary); border-color: var(--border-color);">
          <div class="card-body p-4 p-md-5">
            <h5 class="card-title text-center mb-4">Send us a Message</h5>
            <form id="feedback-form">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="mb-3">
                <label for="country" class="form-label">Country (Optional)</label>
                <input type="text" class="form-control" id="country" name="country">
              </div>
              <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
              </div>
              <div id="form-feedback" class="mt-3"></div>
              <button type="submit" class="btn btn-primary w-100">Submit Message</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts/script.js"></script>
  <script>
    document.getElementById('feedback-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const form = this;
      const feedbackDiv = document.getElementById('form-feedback');
      const cardDiv = document.getElementById('feedback-card');
      const data = Object.fromEntries(new FormData(form).entries());

      feedbackDiv.innerHTML = '<div class="alert alert-info small py-2">Submitting...</div>';

      fetch('submit_feedback.php', { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(data) })
      .then(res => res.json())
      .then(result => {
        if (result.ok) {
          cardDiv.innerHTML = `<div class="card-body text-center p-5"><h3 class="text-success">Thank You!</h3><p>Your message has been sent successfully.</p><p class="text-secondary">We'll get back to you shortly. Redirecting to homepage...</p></div>`;
          setTimeout(() => { window.location.href = '/'; }, 3500);
        } else {
          feedbackDiv.innerHTML = `<div class="alert alert-danger small py-2">${result.error || 'An unknown error occurred.'}</div>`;
        }
      })
      .catch(error => {
        feedbackDiv.innerHTML = `<div class="alert alert-danger small py-2">A network error occurred. Please try again.</div>`;
      });
    });
  </script>
</body>
</html>