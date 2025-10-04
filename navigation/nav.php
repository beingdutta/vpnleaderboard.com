<?php
$current_ip = $_SERVER['REMOTE_ADDR'];

// --- Fetch Geolocation from IP ---
$location_info = '';
// Don't query for localhost IPs
if ($current_ip !== '127.0.0.1' && $current_ip !== '::1') {
    try {
        // Use a timeout to prevent long page loads if the API is slow
        $context = stream_context_create(['http' => ['timeout' => 2]]);
        $geo_data_json = @file_get_contents("http://ip-api.com/json/{$current_ip}?fields=status,city,countryCode", false, $context);
        
        if ($geo_data_json) {
            $geo_data = json_decode($geo_data_json);
            if ($geo_data && $geo_data->status === 'success' && !empty($geo_data->countryCode)) {
                $location_info = htmlspecialchars(trim(($geo_data->city ?? '') . ', ' . $geo_data->countryCode), ENT_QUOTES, 'UTF-8');
            }
        }
    } catch (Exception $e) {
        // Silently fail if there's an error fetching location
    }
}

$current_page = basename($_SERVER['SCRIPT_NAME']);

$nav_links = [
    'index.php' => 'Global',
    'VPNs-in-India.php' => 'India',
    'VPNs-in-US.php' => 'USA',
    'VPNs-in-China.php' => 'China',
    'blog.php' => 'Blog',
    'reviews.php' => 'Reviews',
    'feedback.php' => 'Feedback'
];
?>
<nav class="navbar navbar-expand-lg border-bottom" style="--bs-border-color: var(--border-color);">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <span class="brand-text">VPN Leaderboard</span>
      <span class="ip-info-block" title="Your public IP address and estimated location. A VPN will change this.">
        Your IP: <span class="ip-addr"><?= htmlspecialchars($current_ip) ?></span>
        <?php if ($location_info): ?>
          <span class="location-info"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-geo-alt-fill me-1" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/></svg><?= $location_info ?></span>
        <?php endif; ?>
        <span class="ip-status">(Unprotected)</span>
      </span>
    </a>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
        <?php foreach ($nav_links as $href => $text): ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page === $href) ? 'active' : '' ?>" href="/<?= $href ?>"><?= $text ?></a>
        </li>
        <?php endforeach; ?>
        <li class="nav-item d-none d-lg-block">
            <a href="#" id="theme-toggle-desktop" class="nav-link" title="Toggle light/dark theme"></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script>
  // This script ensures both theme toggles work in sync.
  document.addEventListener('DOMContentLoaded', () => {
    const mobileToggle = document.getElementById('theme-toggle');
    const desktopToggle = document.getElementById('theme-toggle-desktop');
 
    if (mobileToggle && desktopToggle) {
      // 1. A function to copy the icon from the mobile toggle to the desktop one.
      const syncIcons = () => {
        desktopToggle.innerHTML = mobileToggle.innerHTML;
      };
 
      // 2. Run the sync function once on page load to set the initial icon.
      syncIcons();
 
      // 3. Add a click listener to the desktop toggle.
      desktopToggle.addEventListener('click', (e) => {
        e.preventDefault(); // Prevent the link from navigating.
        mobileToggle.click(); // Programmatically click the main mobile toggle.
      });
 
      // 4. Observe the mobile toggle for changes (when the icon swaps).
      // When it changes, re-run the sync function to update the desktop icon.
      const observer = new MutationObserver(syncIcons);
      observer.observe(mobileToggle, { childList: true, subtree: true });
    }
  });
</script>