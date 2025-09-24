<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar navbar-expand-lg border-bottom" style="--bs-border-color: var(--border-color);">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">VPN Leaderboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto me-3 mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link <?= ($current_page === 'index.php') ? 'active' : '' ?>" href="/">Global</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page === 'VPNs-in-India.php') ? 'active' : '' ?>" href="/VPNs-in-India.php">India</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page === 'VPNs-in-US.php') ? 'active' : '' ?>" href="/VPNs-in-US.php">US</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page === 'VPNs-in-China.php') ? 'active' : '' ?>" href="/VPNs-in-China.php">China</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page === 'reviews.php') ? 'active' : '' ?>" href="/reviews.php">Reviews</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page === 'blogs.php') ? 'active' : '' ?>" href="/blogs.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page === 'feedback.php') ? 'active' : '' ?>" href="/feedback.php">Feedback</a></li>
            </ul>
            <a href="#" id="theme-toggle" class="nav-link" title="Toggle light/dark theme"></a>
        </div>
    </div>
</nav>