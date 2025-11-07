<?php
session_start();

// --- CONFIGURATION ---
const ADMIN_SESSION_KEY = 'is_vpn_admin';

// --- AUTHENTICATION CHECK ---
if (!isset($_SESSION[ADMIN_SESSION_KEY]) || !$_SESSION[ADMIN_SESSION_KEY]) {
    header('Location: /admin.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Guide | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/assets/site-icon.png" type="image/png">
    <link href="styles/style.css?v=<?= @filemtime('styles/style.css') ?>" rel="stylesheet">
</head>
<body>
    <!-- NAV -->
    <nav class="navbar navbar-expand-lg border-bottom" style="--bs-border-color: var(--border-color);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="admin.php">Admin Panel</a>
            <div class="ms-auto d-flex align-items-center">
                <a href="#" id="theme-toggle" class="nav-link me-3" title="Toggle light/dark theme"></a>
                <a href="index.php" class="nav-link me-3" target="_blank">View Site</a>
                <a href="admin.php?action=logout" class="btn btn-sm btn-outline-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2">Admin Panel Guide</h1>
            <a href="admin.php" class="btn btn-primary">&larr; Back to Admin Panel</a>
        </div>

        <div class="accordion" id="adminGuideAccordion">

            <!-- Core Concepts -->
            <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background-color: var(--background-secondary); color: var(--text-primary);">
                        Core Concept: Master List vs. Regional Data
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#adminGuideAccordion">
                    <div class="accordion-body">
                        <p>The admin panel is split into two main concepts:</p>
                        <ul>
                            <li><strong>Master List:</strong> This is the central database of all VPNs. It stores the core, non-changing information about a VPN, such as its name, logo, website URL, headquarters location, and supported platforms. A VPN must exist in the Master List before it can be added to any regional leaderboard.</li>
                            <li><strong>Regional Data:</strong> This contains information specific to a region (Global, India, US, China). This includes the VPN's speed in that region, its local price, affiliate link, and whether it's "Promoted". A VPN will only appear on a public leaderboard if it has been added to that specific regional list.</li>
                        </ul>
                        <p class="fw-bold">In short: First, add a VPN to the Master List. Then, add it from the Master List into one or more Regional lists.</p>
                    </div>
                </div>
            </div>

            <!-- How to Add a New VPN -->
            <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: var(--background-secondary); color: var(--text-primary);">
                        How to Add a Brand New VPN to the Site
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#adminGuideAccordion">
                    <div class="accordion-body">
                        <p>This is a two-step process.</p>
                        <ol>
                            <li><strong>Step 1: Add to Master List</strong>
                                <ol>
                                    <li>Navigate to the <a href="admin.php?view=master">Master List</a> view using the top navigation pill.</li>
                                    <li>Click the blue "Add New Master VPN" button.</li>
                                    <li>In the modal window, fill in all the "Master Details" fields. The "Regional Details" section will be hidden.</li>
                                    <li>Click "Save changes". The VPN is now in the system but not yet visible on any public page.</li>
                                </ol>
                            </li>
                            <li class="mt-3"><strong>Step 2: Add to a Regional Leaderboard</strong>
                                <ol>
                                    <li>Navigate to the desired region (e.g., <a href="admin.php?region=global&view=vpns">Global</a>, <a href="admin.php?region=india&view=vpns">India</a>) using the navigation pills.</li>
                                    <li>Click the green "Add VPN to Region" button.</li>
                                    <li>Select the VPN you just created from the dropdown menu.</li>
                                    <li>Fill in the region-specific details (Speed, Price, Affiliate Link, etc.).</li>
                                    <li>Click "Add to Region". The VPN will now appear on that region's public leaderboard.</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

            <!-- How to Edit -->
            <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color: var(--background-secondary); color: var(--text-primary);">
                        How to Edit VPN Information
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#adminGuideAccordion">
                    <div class="accordion-body">
                        <p>Editing depends on what you want to change:</p>
                        <ul>
                            <li><strong>To Edit Regional Data (Price, Speed, etc.):</strong>
                                <ol>
                                    <li>Go to the specific regional view (e.g., "US").</li>
                                    <li>Find the VPN in the list and click the "Edit" button.</li>
                                    <li>The modal will open. The "Master Details" will be disabled (greyed out). You can only change the "Regional Details".</li>
                                    <li>Make your changes and click "Save changes".</li>
                                </ol>
                            </li>
                            <li class="mt-3"><strong>To Edit Master Data (Name, Logo, etc.):</strong>
                                <ol>
                                    <li>Go to the <a href="admin.php?view=master">Master List</a> view.</li>
                                    <li>Find the VPN in the list and click the "Edit" button.</li>
                                    <li>The modal will open. You can now change the "Master Details".</li>
                                    <li>Make your changes and click "Save changes". These changes will be reflected everywhere the VPN appears.</li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Other Actions -->
            <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="background-color: var(--background-secondary); color: var(--text-primary);">
                        Other Actions (Deleting, Resetting Votes)
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#adminGuideAccordion">
                    <div class="accordion-body">
                        <ul>
                            <li><strong>Add Dummy Votes:</strong> In any regional view, you can use the form at the end of a VPN's row to add a specific number of upvotes or downvotes. This is useful for initial seeding.</li>
                            <li><strong>Reset Votes:</strong> In a regional view, clicking "Reset Votes" will delete all votes for that VPN *in that region only*.</li>
                            <li><strong>Remove from Region:</strong> In a regional view, this removes the VPN from the current leaderboard but does NOT delete it from the Master List. You can add it back later.</li>
                            <li><strong>Delete (Master List):</strong> This is the most destructive action. Clicking "Delete" in the Master List view will permanently remove the VPN from the master table and, due to database constraints, will also remove all its associated regional data and votes across all regions. <strong>This cannot be undone.</strong></li>
                            <li><strong>Manage Votes:</strong> In any regional view, click the "Votes" tab to see the 100 most recent votes. You can delete individual votes here to combat spam.</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/script.js"></script>
</body>
</html>