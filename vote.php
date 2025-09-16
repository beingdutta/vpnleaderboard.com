<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['ok'=>false,'error'=>'Method not allowed']);
  exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);
$vpn_id = isset($data['vpn_id']) ? (int)$data['vpn_id'] : 0;
$type = isset($data['vote']) ? strtolower($data['vote']) : '';
$region = isset($data['region']) ? strtolower($data['region']) : 'global';

// Validate region to prevent SQL injection
$allowed_regions = ['global', 'india', 'us', 'china'];
if (!$vpn_id || !in_array($type, ['up','down'], true) || !in_array($region, $allowed_regions, true)) {
  http_response_code(422);
  echo json_encode(['ok'=>false,'error'=>'Invalid payload']);
  exit;
}

$vpns_table = "vpns_" . $region;
$votes_table = "votes_" . $region;

$user_id = ensure_user_cookie();
$ip_bin = client_ip_bin();

// Check VPN exists
// Use prepared statements for table names is not possible, so we use a whitelist.
$chk = $pdo->prepare("SELECT vpn_id FROM `$vpns_table` WHERE vpn_id = ?");
$chk->execute([$vpn_id]);
if (!$chk->fetch()) {
  http_response_code(404);
  echo json_encode(['ok'=>false,'error'=>'VPN not found']);
  exit;
}

try {
  $pdo->beginTransaction();

  // Prevent multiple votes: either same user_id OR same IP for the same VPN
  $exists = $pdo->prepare("SELECT id, vote FROM `$votes_table` WHERE vpn_id = ? AND (user_id = ? OR ip_address = ?)");
  $exists->execute([$vpn_id, $user_id, $ip_bin]);
  $prev = $exists->fetch();

  if ($prev) {
    // Already voted — MVP rule: only once (no switching). Return current tallies.
    $pdo->commit();
    $agg = $pdo->prepare("SELECT
        SUM(vote='up') AS upvotes,
        SUM(vote='down') AS downvotes
      FROM `$votes_table` WHERE vpn_id = ?");
    $agg->execute([$vpn_id]);
    $row = $agg->fetch();
    echo json_encode([
      'ok'=>false,
      'error'=>'You have already voted for this VPN.',
      'upvotes'=>(int)($row['upvotes'] ?? 0),
      'downvotes'=>(int)($row['downvotes'] ?? 0)
    ]);
    exit;
  }

  $ins = $pdo->prepare("INSERT INTO `$votes_table` (vpn_id, user_id, ip_address, vote) VALUES (?,?,?,?)");
  $ins->execute([$vpn_id, $user_id, $ip_bin, $type]);
  $pdo->commit();

  // Return updated counts
  $agg = $pdo->prepare("SELECT
      SUM(vote='up') AS upvotes,
      SUM(vote='down') AS downvotes
    FROM `$votes_table` WHERE vpn_id = ?");
  $agg->execute([$vpn_id]);
  $row = $agg->fetch();

  echo json_encode([
    'ok'=>true,
    'upvotes'=>(int)($row['upvotes'] ?? 0),
    'downvotes'=>(int)($row['downvotes'] ?? 0)
  ]);
} catch (Exception $e) {
  if ($pdo->inTransaction()) $pdo->rollBack();
  http_response_code(500);
  echo json_encode(['ok'=>false,'error'=>'Server error']);
}
