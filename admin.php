<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session with debug info
$session_dir = session_save_path();
$writable = is_writable($session_dir);

// Ensure secure session settings
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

// Start the session
session_start();

// Debug information
$debug = [
    'session_dir' => $session_dir,
    'session_dir_writable' => $writable ? 'Yes' : 'No',
    'session_id' => session_id(),
    'post_data' => $_POST,
    'session_data' => $_SESSION
];
require_once __DIR__ . '/db.php';

// --- CONFIGURATION ---
// IMPORTANT: Change this password to something secure!
const ADMIN_PASSWORD = 'admin@@@18###';
const ADMIN_SESSION_KEY = 'is_vpn_admin';

// --- LOGOUT ---
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION[ADMIN_SESSION_KEY]);
    session_destroy();
    header('Location: /admin.php');
    exit;
}

// --- LOGIN ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $entered_password = $_POST['password'];
    $expected_password = ADMIN_PASSWORD;
    
    $debug['submitted_password_length'] = strlen($entered_password);
    $debug['expected_password_length'] = strlen($expected_password);
    $debug['passwords_match'] = $entered_password === $expected_password ? 'Yes' : 'No';
    
    if ($entered_password === $expected_password) {
        // Set session variable
        $_SESSION[ADMIN_SESSION_KEY] = true;
        
        // Verify session was set
        $debug['session_set'] = isset($_SESSION[ADMIN_SESSION_KEY]) ? 'Yes' : 'No';
        
        // Force session write
        session_write_close();
        
        // Check if session persisted
        session_start();
        $debug['session_persisted'] = isset($_SESSION[ADMIN_SESSION_KEY]) ? 'Yes' : 'No';
        
        if (isset($_SESSION[ADMIN_SESSION_KEY]) && $_SESSION[ADMIN_SESSION_KEY] === true) {
            // Success - redirect
            header('Location: /admin.php');
            exit;
        } else {
            $login_error = 'Session not persisting. Debug info: ' . print_r($debug, true);
        }
    } else {
        $login_error = 'Invalid password. Debug info: ' . print_r($debug, true);
    }
}

// --- AUTHENTICATION CHECK ---
if (!isset($_SESSION[ADMIN_SESSION_KEY]) || !$_SESSION[ADMIN_SESSION_KEY]):
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/assets/site-icon.png" type="image/png">
    <link href="styles/style.css?v=<?= @filemtime('styles/style.css') ?>" rel="stylesheet">
</head> 
<body class="admin-login-page">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-4">
                <div class="card" style="background: var(--background-secondary); border-color: var(--border-color);">
                    <div class="card-body p-4">
                        <h3 class="card-title text-center mb-4">Admin Login</h3>
                        <form method="POST" action="/admin.php">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <?php if (isset($login_error)): ?>
                                <div class="alert alert-danger small py-2"><?= htmlspecialchars($login_error) ?></div>
                            <?php endif; ?>
                            
                            <?php if (isset($debug)): ?>
                                <div class="alert alert-info small py-2">
                                    <pre><?= htmlspecialchars(print_r($debug, true)) ?></pre>
                                </div>
                            <?php endif; ?>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts/script.js"></script>
</body>
</html>
<?php
exit; // End script if not logged in
endif;

// --- ADMIN LOGIC (if logged in) ---
$allowed_regions = ['global', 'india', 'us', 'china'];
$current_view_param = isset($_GET['view']) ? $_GET['view'] : 'vpns';

if ($current_view_param === 'master') {
    $region = null;
    $view = 'master';
} else {
    $region = isset($_GET['region']) && in_array($_GET['region'], $allowed_regions) ? $_GET['region'] : 'global';
    $view = in_array($current_view_param, ['votes', 'vpns']) ? $current_view_param : 'vpns';
}

$vpns_table = $region ? "vpns_" . $region : null;
$votes_table = $region ? "votes_" . $region : null;

// Define currency symbol based on region
$currency_symbol = '$';
if ($region === 'india') {
    $currency_symbol = '₹';
} elseif ($region === 'china') {
    $currency_symbol = '¥';
}

// Handle POST actions (Save, Delete, Reset)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action_region = isset($_POST['region']) && in_array($_POST['region'], $allowed_regions) ? $_POST['region'] : 'global';
    $action_vpns_table = "vpns_" . $action_region;
    $action_votes_table = "votes_" . $action_region;
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    try {
        if ($_POST['action'] === 'save_vpn') {
            $mode = $_POST['mode'] ?? 'regional';

            // Only save master data if not in regional-only edit mode.
            if ($mode !== 'regional') {
                $master_params = [
                    'name' => $_POST['name'] ?? '', 
                    'website_url' => $_POST['website_url'] ?? '', 
                    'logo_path' => $_POST['logo_path'] ?: null,
                    'suitable_for' => $_POST['suitable_for'] ?? '', 
                    'supported_countries' => (int)($_POST['supported_countries'] ?? 0), 
                    'features' => $_POST['features'] ?? '', 
                    'server_count' => $_POST['server_count'] ?? null,
                    'device_limit' => $_POST['device_limit'] ?? null,
                    'protocols_supported' => $_POST['protocols_supported'] ?? '',
                    'logging_policy' => $_POST['logging_policy'] ?? '',
                    'based_in' => $_POST['based_in'] ?? '',
                    'Free_available' => isset($_POST['Free_available']) ? 1 : 0,
                    'Platform' => $_POST['Platform'] ?? ''
                ];
                
                if ($id > 0) { // Update existing master VPN
                    $master_params['id'] = $id;
                    $sql = "UPDATE `vpn_master_table` SET 
                                name=:name, website_url=:website_url, logo_path=:logo_path, suitable_for=:suitable_for, supported_countries=:supported_countries, features=:features,
                                server_count=:server_count, device_limit=:device_limit, protocols_supported=:protocols_supported, logging_policy=:logging_policy, based_in=:based_in,
                                Free_available=:Free_available, Platform=:Platform
                            WHERE id=:id";
                } else { // Insert new master VPN
                    $sql = "INSERT INTO `vpn_master_table` 
                                (name, website_url, logo_path, suitable_for, supported_countries, features, server_count, device_limit, protocols_supported, logging_policy, based_in, Free_available, Platform) 
                            VALUES (:name, :website_url, :logo_path, :suitable_for, :supported_countries, :features, :server_count, :device_limit, :protocols_supported, :logging_policy, :based_in, :Free_available, :Platform)";
                }
                $stmt = $pdo->prepare($sql);
                $stmt->execute($master_params);
            }

            // Get the ID of the VPN we just saved
            $vpn_id = ($id > 0) ? $id : $pdo->lastInsertId();

            // Always save regional data unless we are in master-only edit mode.
            // We only want to save regional data when we are specifically in regional edit mode.
            if ($mode === 'regional') {
            // Regional VPN data (UPSERT logic)
            $regional_params = [
                'vpn_id' => $vpn_id,
                'is_promoted' => isset($_POST['is_promoted']) ? 1 : 0,
                'speed_mbps' => (int)($_POST['speed_mbps'] ?? 0),
                'starting_price' => (float)($_POST['starting_price'] ?? 0),
                'affiliate_link' => $_POST['affiliate_link'] ?? ''
            ];
            $sql = "INSERT INTO `$action_vpns_table` (vpn_id, is_promoted, speed_mbps, starting_price, affiliate_link) 
                    VALUES (:vpn_id, :is_promoted, :speed_mbps, :starting_price, :affiliate_link)
                    ON DUPLICATE KEY UPDATE 
                        is_promoted = VALUES(is_promoted), speed_mbps = VALUES(speed_mbps), starting_price = VALUES(starting_price), affiliate_link = VALUES(affiliate_link)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($regional_params);
            }

        } elseif ($_POST['action'] === 'delete_vpn' && $id > 0) {
            // Deleting from vpns_all will cascade and delete from all regional and votes tables.
            $stmt = $pdo->prepare("DELETE FROM `vpn_master_table` WHERE id = ?");
            $stmt->execute([$id]);
        } elseif ($_POST['action'] === 'reset_votes' && $id > 0) {
            $stmt = $pdo->prepare("DELETE FROM `$action_votes_table` WHERE vpn_id = ?");
            $stmt->execute([$id]);
        } elseif ($_POST['action'] === 'delete_vote' && $id > 0) {
            // Note: $id here is the vote ID, not vpn_id
            $stmt = $pdo->prepare("DELETE FROM `$action_votes_table` WHERE id = ?");
            $stmt->execute([$id]);
        } elseif ($_POST['action'] === 'remove_from_region' && $id > 0) {
            // This only removes the regional data, not the master VPN
            $stmt = $pdo->prepare("DELETE FROM `$action_vpns_table` WHERE vpn_id = ?");
            $stmt->execute([$id]);
        } elseif ($_POST['action'] === 'add_vpn_to_region') {
            $vpn_id = (int)($_POST['vpn_id'] ?? 0);
            if ($vpn_id > 0) {
                $regional_params = [
                    'vpn_id' => $vpn_id,
                    'is_promoted' => isset($_POST['is_promoted']) ? 1 : 0,
                    'speed_mbps' => (int)($_POST['speed_mbps'] ?? 0), 
                    'starting_price' => (float)($_POST['starting_price'] ?? 0),
                    'affiliate_link' => $_POST['affiliate_link'] ?? ''
                ];
                $sql = "INSERT INTO `$action_vpns_table` (vpn_id, is_promoted, speed_mbps, starting_price, affiliate_link) VALUES (:vpn_id, :is_promoted, :speed_mbps, :starting_price, :affiliate_link)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($regional_params);
            }
        } elseif ($_POST['action'] === 'add_dummy_votes') {
            $vpn_id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $vote_count = isset($_POST['vote_count']) ? (int)$_POST['vote_count'] : 0;
            $vote_type = in_array($_POST['vote_type'], ['up', 'down']) ? $_POST['vote_type'] : 'up';

            if ($vpn_id > 0 && $vote_count > 0) {
                $sql = "INSERT INTO `$action_votes_table` (vpn_id, user_id, ip_address, vote) VALUES (:vpn_id, :user_id, :ip_address, :vote)";
                $stmt = $pdo->prepare($sql);
                for ($i = 0; $i < $vote_count; $i++) {
                    // Generate unique dummy data for each vote
                    $dummy_user_id = 'dummy-' . bin2hex(random_bytes(8));
                    // Generate a random private IP to ensure uniqueness for the constraint
                    $dummy_ip = '10.' . rand(0, 255) . '.' . rand(0, 255) . '.' . rand(1, 254);
                    $stmt->execute(['vpn_id' => $vpn_id, 'user_id' => $dummy_user_id, 'ip_address' => inet_pton($dummy_ip), 'vote' => $vote_type]);
                }
            }
        }
    } catch (Exception $e) {
        // In a real app, log this error
        if ($pdo->inTransaction()) $pdo->rollBack();
        die("An error occurred: " . $e->getMessage());
    }
    // Redirect back to the correct view after the action
    $is_master_view_action = ($_POST['action'] === 'save_vpn' && in_array(($_POST['mode'] ?? ''), ['master', 'full'])) || $view === 'master';
    $redirect_url = $is_master_view_action ? '/admin.php?view=master' : '/admin.php?region=' . $action_region . '&view=' . $view;
    header('Location: ' . $redirect_url);
    exit;
}

// Fetch data for the current region/view
if ($view === 'vpns') {
    // Show only VPNs that exist in the current region's table
    $sql = "
        SELECT 
            va.*, 
            vr.is_promoted, vr.speed_mbps, vr.starting_price, vr.affiliate_link,
            (SELECT COUNT(*) FROM `$votes_table` vt WHERE vt.vpn_id = va.id) as total_votes
        FROM `vpn_master_table` va
        JOIN `$vpns_table` vr ON va.id = vr.vpn_id
        ORDER BY va.name ASC
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $vpns = $stmt->fetchAll();

    $vpns_to_add_stmt = $pdo->prepare("SELECT id, name FROM vpn_master_table WHERE id NOT IN (SELECT vpn_id FROM `$vpns_table`) ORDER BY name ASC");
    $vpns_to_add_stmt->execute();
    $vpns_to_add = $vpns_to_add_stmt->fetchAll();
} elseif ($view === 'master') {
    $stmt = $pdo->prepare("SELECT * FROM `vpn_master_table` ORDER BY name ASC");
    $stmt->execute();
    $master_vpns = $stmt->fetchAll();
} else { // 'votes' view
    $stmt = $pdo->prepare("SELECT vt.*, v.name as vpn_name FROM `$votes_table` vt LEFT JOIN `vpn_master_table` v ON vt.vpn_id = v.id ORDER BY vt.id DESC LIMIT 100");
    $stmt->execute();
    $votes = $stmt->fetchAll();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Panel | VPN Leaderboard</title>
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
                <a href="admin_readme.php" class="nav-link me-3" target="_blank">Help/Guide</a>
                <a href="index.php" class="nav-link me-3" target="_blank">View Site</a>
                <a href="admin.php?action=logout" class="btn btn-sm btn-outline-secondary">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Manage <?= $view === 'master' ? 'Master VPN List' : ($view === 'vpns' ? 'Regional Data' : ucfirst($view)) ?> <?php if($region): ?>(Region: <?= strtoupper($region) ?>)<?php endif; ?></h1>
            <?php if ($view === 'vpns'): ?>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addRegionalVpnModal">Add VPN to Region</button>
            <?php elseif ($view === 'master'): ?>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#vpnModal" onclick="prepareModal()">Add New Master VPN</button>
            <?php endif; ?>
        </div>

        <!-- Main Navigation -->
        <ul class="nav nav-pills mb-3">
            <?php foreach ($allowed_regions as $r): ?>
            <li class="nav-item">
                <a class="nav-link <?= ($view !== 'master' && $region === $r) ? 'active' : '' ?>" href="?view=vpns&region=<?= $r ?>"><?= ucfirst($r) ?></a>
            </li>
            <?php endforeach; ?>
            <li class="nav-item">
                <a class="nav-link <?= $view === 'master' ? 'active' : '' ?>" href="?view=master">Master List</a>
            </li>
        </ul>

        <?php if ($view !== 'master'): ?>
        <!-- View Toggle for Regions -->
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link <?= $view === 'vpns' ? 'active' : '' ?>" href="?view=vpns&region=<?= $region ?>">Regional Data</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $view === 'votes' ? 'active' : '' ?>" href="?view=votes&region=<?= $region ?>">Votes</a>
            </li>
        </ul>

        <?php if ($view === 'vpns'): ?>
        <!-- VPN Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>VPN</th>
                        <th>Promoted</th>
                        <th>Price</th>
                        <th>Total Votes</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vpns as $v): ?>
                    <tr id="vpn-row-<?= (int)$v['id'] ?>" data-vpn='<?= htmlspecialchars(json_encode($v), ENT_QUOTES, 'UTF-8') ?>'>
                        <td>
                            <img src="<?= htmlspecialchars($v['logo_path'] ?: 'assets/defaultvpn.png') ?>" alt="<?= htmlspecialchars($v['name']) ?> logo" width="28" height="28" class="rounded me-2">
                            <?= htmlspecialchars($v['name']) ?>
                        </td>
                        <td><?= $v['is_promoted'] ? 'Yes' : 'No' ?></td>
                        <td><?= $v['starting_price'] ? $currency_symbol . htmlspecialchars(number_format($v['starting_price'], 2)) : 'N/A' ?></td>
                        <td><?= (int)$v['total_votes'] ?></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-secondary" onclick="prepareModal(<?= (int)$v['id'] ?>)">Edit</button>
                            <form method="POST" action="admin.php" class="d-inline" onsubmit="return confirm('Are you sure you want to reset votes for this VPN in this region?');">
                                <input type="hidden" name="action" value="reset_votes">
                                <input type="hidden" name="id" value="<?= (int)$v['id'] ?>">
                                <input type="hidden" name="region" value="<?= $region ?>">
                                <button type="submit" class="btn btn-sm btn-warning">Reset Votes</button>
                            </form>
                            <form method="POST" action="admin.php" class="d-inline" onsubmit="return confirm('Are you sure you want to remove this VPN from the <?= strtoupper($region) ?> region?');">
                                <input type="hidden" name="action" value="remove_from_region">
                                <input type="hidden" name="id" value="<?= (int)$v['id'] ?>">
                                <input type="hidden" name="region" value="<?= $region ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Remove from Region</button>
                            </form>
                            <div class="d-inline-block ms-2">
                                <form method="POST" action="admin.php" class="d-inline-flex align-items-center gap-1" onsubmit="return confirm('Add ' + this.vote_count.value + ' dummy ' + this.vote_type.value + ' votes?');">
                                    <input type="hidden" name="action" value="add_dummy_votes">
                                    <input type="hidden" name="id" value="<?= (int)$v['id'] ?>">
                                    <input type="hidden" name="region" value="<?= $region ?>">
                                    <input type="number" name="vote_count" class="form-control form-control-sm" style="width: 70px;" value="10" min="1" max="1000" required>
                                    <select name="vote_type" class="form-select form-select-sm" style="width: 80px;">
                                        <option value="up">Up</option>
                                        <option value="down">Down</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-info" title="Add Dummy Votes">Add dummy vote</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <!-- Votes Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Vote ID</th>
                        <th>VPN Name</th>
                        <th>Vote</th>
                        <th>User ID</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($votes as $vote): ?>
                    <tr>
                        <td><?= (int)$vote['id'] ?></td>
                        <td><?= htmlspecialchars($vote['vpn_name'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars(strtoupper($vote['vote'])) ?></td>
                        <td><small><?= htmlspecialchars($vote['user_id']) ?></small></td>
                        <td class="text-end">
                            <form method="POST" action="admin.php" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this vote?');">
                                <input type="hidden" name="action" value="delete_vote">
                                <input type="hidden" name="id" value="<?= (int)$vote['id'] ?>">
                                <input type="hidden" name="region" value="<?= $region ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    <?php else: // This handles the 'master' view ?>
        <!-- Master VPN Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>VPN Name</th>
                        <th>Website</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($master_vpns as $v): ?>
                    <tr id="vpn-row-<?= (int)$v['id'] ?>" data-vpn='<?= htmlspecialchars(json_encode($v), ENT_QUOTES, 'UTF-8') ?>'>
                        <td><?= (int)$v['id'] ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($v['logo_path'] ?: 'assets/defaultvpn.png') ?>" alt="<?= htmlspecialchars($v['name']) ?> logo" width="28" height="28" class="rounded me-2">
                            <?= htmlspecialchars($v['name']) ?>
                        </td>
                        <td><a href="<?= htmlspecialchars($v['website_url']) ?>" target="_blank"><?= htmlspecialchars($v['website_url']) ?></a></td>
                        <td class="text-end">
                            <button class="btn btn-sm btn-secondary" onclick="prepareModal(<?= (int)$v['id'] ?>, 'master')">Edit</button>
                            <form method="POST" action="admin.php" class="d-inline" onsubmit="return confirm('DANGER: This will delete the VPN from ALL regions and remove all associated votes. This cannot be undone. Are you sure?');">
                                <input type="hidden" name="action" value="delete_vpn">
                                <input type="hidden" name="id" value="<?= (int)$v['id'] ?>">
                                <input type="hidden" name="region" value="<?= $region ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    </main>

    <!-- VPN Add/Edit Modal -->
    <div class="modal fade" id="vpnModal" tabindex="-1" aria-labelledby="vpnModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: var(--background-secondary);">
                <form method="POST" action="admin.php">
                    <input type="hidden" name="action" value="save_vpn">
                    <input type="hidden" name="id" id="vpn-id">
                    <input type="hidden" name="mode" id="form-mode">
                    <input type="hidden" name="region" value="<?= $region ?>">

                    <div class="modal-header" style="border-bottom-color: var(--border-color);">
                        <h5 class="modal-title" id="vpnModalLabel">Add/Edit VPN</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <fieldset>
                            <legend class="h6">Master Details</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vpn-name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="vpn-name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vpn-website_url" class="form-label">Website URL or Local Path</label>
                                    <input type="text" class="form-control" id="vpn-website_url" name="website_url" placeholder="e.g., https://example.com or reviews/example.php">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="vpn-logo_path" class="form-label">Logo Path</label>
                                    <input type="text" class="form-control" id="vpn-logo_path" name="logo_path" placeholder="e.g., assets/nordvpn.png">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vpn-suitable_for" class="form-label">Suitable For</label>
                                    <input type="text" class="form-control" id="vpn-suitable_for" name="suitable_for">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vpn-supported_countries" class="form-label">Countries</label>
                                    <input type="number" class="form-control" id="vpn-supported_countries" name="supported_countries">
                                </div>
                                <div class="mb-3">
                                    <label for="vpn-features" class="form-label">Features (semicolon-separated)</label>
                                    <input type="text" class="form-control" id="vpn-features" name="features">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="vpn-server_count" class="form-label">Server Count (e.g., 5000 or "5000+")</label>
                                        <input type="text" class="form-control" id="vpn-server_count" name="server_count">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vpn-device_limit" class="form-label">Device Limit (e.g., 10 or "Unlimited")</label>
                                        <input type="text" class="form-control" id="vpn-device_limit" name="device_limit">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="vpn-protocols_supported" class="form-label">Protocols Supported</label>
                                        <input type="text" class="form-control" id="vpn-protocols_supported" name="protocols_supported" placeholder="e.g., WireGuard, OpenVPN, IKEv2">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vpn-logging_policy" class="form-label">Logging Policy</label>
                                        <input type="text" class="form-control" id="vpn-logging_policy" name="logging_policy" placeholder="e.g., Strict No-Logs Policy">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="vpn-based_in" class="form-label">Based In (Country)</label>
                                        <input type="text" class="form-control" id="vpn-based_in" name="based_in" placeholder="e.g., British Virgin Islands">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label for="vpn-Platform" class="form-label">Platform (comma-separated)</label>
                                        <input type="text" class="form-control" id="vpn-Platform" name="Platform" placeholder="e.g., Windows, macOS, iOS, Android">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="vpn-Free_available" name="Free_available">
                                            <label class="form-check-label" for="vpn-Free_available">Free Plan Available?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <hr>
                        <fieldset>
                            <legend class="h6">Regional Details (<?= $region ? strtoupper($region) : 'N/A' ?>)</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vpn-speed_mbps" class="form-label">Speed (Mbps)</label>
                                    <input type="number" class="form-control" id="vpn-speed_mbps" name="speed_mbps">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="vpn-starting_price" class="form-label">Starting Price (<?= $currency_symbol ?>)</label>
                                    <input type="number" step="0.01" class="form-control" id="vpn-starting_price" name="starting_price">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="vpn-affiliate_link" class="form-label">Affiliate Link</label>
                                <input type="url" class="form-control" id="vpn-affiliate_link" name="affiliate_link">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="vpn-is_promoted" name="is_promoted">
                                <label class="form-check-label" for="vpn-is_promoted">
                                    Is Promoted?
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer" style="border-top-color: var(--border-color);">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add VPN to Region Modal -->
    <div class="modal fade" id="addRegionalVpnModal" tabindex="-1" aria-labelledby="addRegionalVpnModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background: var(--background-secondary);">
                <form method="POST" action="admin.php">
                    <input type="hidden" name="action" value="add_vpn_to_region">
                    <input type="hidden" name="region" value="<?= $region ?>">

                    <div class="modal-header" style="border-bottom-color: var(--border-color);">
                        <h5 class="modal-title" id="addRegionalVpnModalLabel">Add VPN to <?= strtoupper($region) ?> Region</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="vpn-id-select" class="form-label">Select VPN</label>
                            <select class="form-select" id="vpn-id-select" name="vpn_id" required>
                                <option value="" disabled selected>Choose a VPN to add...</option>
                                <?php foreach ($vpns_to_add as $vpn_item): ?>
                                    <option value="<?= (int)$vpn_item['id'] ?>"><?= htmlspecialchars($vpn_item['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <hr>
                        <fieldset>
                            <legend class="h6">Regional Details</legend>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="add-speed_mbps" class="form-label">Speed (Mbps)</label>
                                    <input type="number" class="form-control" id="add-speed_mbps" name="speed_mbps">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="add-starting_price" class="form-label">Starting Price (<?= $currency_symbol ?>)</label>
                                    <input type="number" step="0.01" class="form-control" id="add-starting_price" name="starting_price">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="add-affiliate_link" class="form-label">Affiliate Link</label>
                                <input type="url" class="form-control" id="add-affiliate_link" name="affiliate_link">
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="add-is_promoted" name="is_promoted">
                                <label class="form-check-label" for="add-is_promoted">
                                    Is Promoted?
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer" style="border-top-color: var(--border-color);">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add to Region</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/script.js"></script>
    <script>
        const vpnModal = new bootstrap.Modal(document.getElementById('vpnModal'));
        const form = document.querySelector('#vpnModal form');

        function prepareModal(vpnId = null, mode = 'regional') {
            form.reset();
            document.getElementById('vpn-id').value = '';
            
            // When adding a new VPN, we must add both master and regional data
            if (!vpnId) {
                mode = 'full';
            }

            document.getElementById('form-mode').value = mode;
            document.getElementById('vpnModalLabel').textContent = 'Add New Master VPN';

            // Get fieldsets
            const masterFieldset = form.querySelector('fieldset:nth-of-type(1)');
            const regionalFieldset = form.querySelector('fieldset:nth-of-type(2)');

            // Default state
            masterFieldset.style.display = 'block';
            regionalFieldset.style.display = 'block';
            form.querySelectorAll('fieldset:nth-of-type(1) input').forEach(el => el.disabled = false);

            if (mode === 'master' || mode === 'full') {
                regionalFieldset.style.display = 'none'; // Hide regional fields when editing master
            }

            if (vpnId) {
                document.getElementById('vpnModalLabel').textContent = 'Edit VPN';
                const row = document.getElementById('vpn-row-' + vpnId);
                const data = JSON.parse(row.dataset.vpn);

                // Master data
                document.getElementById('vpn-id').value = data.id;
                document.getElementById('vpn-name').value = data.name || '';
                document.getElementById('vpn-website_url').value = data.website_url || '';
                document.getElementById('vpn-logo_path').value = data.logo_path || '';
                document.getElementById('vpn-suitable_for').value = data.suitable_for || '';
                document.getElementById('vpn-supported_countries').value = data.supported_countries || '';
                document.getElementById('vpn-features').value = data.features || '';

                document.getElementById('vpn-server_count').value = data.server_count || '';
                document.getElementById('vpn-device_limit').value = data.device_limit || ''; // Changed from number to text
                document.getElementById('vpn-protocols_supported').value = data.protocols_supported || '';
                document.getElementById('vpn-logging_policy').value = data.logging_policy || '';
                document.getElementById('vpn-based_in').value = data.based_in || '';
                document.getElementById('vpn-Platform').value = data.Platform || '';
                document.getElementById('vpn-Free_available').checked = data.Free_available == 1;

                // When editing regional data, disable master fields to prevent accidental changes
                if (mode === 'regional') {
                    form.querySelectorAll('fieldset:nth-of-type(1) input, fieldset:nth-of-type(1) textarea').forEach(el => el.disabled = true); // This will include the new fields
                }

                // Regional data
                document.getElementById('vpn-is_promoted').checked = data.is_promoted == 1;
                document.getElementById('vpn-speed_mbps').value = data.speed_mbps || '';
                document.getElementById('vpn-starting_price').value = data.starting_price || '';
                document.getElementById('vpn-affiliate_link').value = data.affiliate_link || '';
            }
            vpnModal.show();
        }
    </script>
</body>
</html>