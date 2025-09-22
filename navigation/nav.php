<?php
$current_page = basename($_SERVER['PHP_SELF']);
$request_uri = $_SERVER['REQUEST_URI'];
$region = isset($_GET['region']) ? strtoupper($_GET['region']) : '';
?>
<nav class="navbar navbar-expand-lg border-bottom" style="--bs-border-color: var(--border-color);">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/index.php">VPN Leaderboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link<?= $current_page === 'VPNs-in-India.php' ? ' active' : '' ?>" href="/VPNs-in-India.php" title="Best VPNs in India">Ranking in India</a></li>
        <li class="nav-item"><a class="nav-link<?= $current_page === 'VPNs-in-US.php' ? ' active' : '' ?>" href="/VPNs-in-US.php" title="Best VPNs in the USA">Ranking in USA</a></li>
        <li class="nav-item"><a class="nav-link<?= $current_page === 'VPNs-in-China.php' ? ' active' : '' ?>" href="/VPNs-in-China.php" title="Best VPNs in China">Ranking in China</a></li>
        <li class="nav-item"><a class="nav-link<?= ($current_page === 'index.php' && $region === 'GLOBAL') || ($current_page === 'index.php' && $region === '') ? ' active' : '' ?>" href="/index.php?region=GLOBAL" title="Global VPN Ranking">Global</a></li>
        <li class="nav-item"><a class="nav-link<?= ($current_page === 'blogs.php' || str_starts_with($request_uri, '/blogs/')) ? ' active' : '' ?>" href="/blogs.php" title="VPN & Security Blog">Blog</a></li>
        <li class="nav-item"><a class="nav-link<?= ($current_page === 'reviews.php' || str_starts_with($request_uri, '/reviews/')) ? ' active' : '' ?>" href="/reviews.php" title="Expert VPN Reviews">Reviews</a></li>
        <li class="nav-item ms-lg-3"><a href="#" id="theme-toggle" class="nav-link" title="Toggle light/dark theme"></a></li>
      </ul>
    </div>
  </div>
</nav>