<?php
// db.php — PDO connection (update credentials)
$DB_HOST = 'localhost';
$DB_NAME = 'vpnboard';
$DB_USER = 'root';
$DB_PASS = '';

$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $pdo = new PDO(
    "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4",
    $DB_USER,
    $DB_PASS,
    $options
  );
} catch (Exception $e) {
  http_response_code(500);
  echo "Database connection error.";
  exit;
}

// Helper: get client IP as packed binary (IPv4/IPv6)
function client_ip_bin(): string {
  $ip = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
  // If X-Forwarded-For has multiple, take the first
  if (strpos($ip, ',') !== false) {
    $ip = trim(explode(',', $ip)[0]);
  }
  $bin = @inet_pton($ip);
  return $bin !== false ? $bin : inet_pton('0.0.0.0');
}

// Helper: get or create user cookie ID
function ensure_user_cookie(): string {
  $cookieName = 'vpnlb_uid';
  if (!isset($_COOKIE[$cookieName]) || !preg_match('/^[a-f0-9\-]{20,}$/i', $_COOKIE[$cookieName])) {
    $uid = bin2hex(random_bytes(8)) . "-" . bin2hex(random_bytes(4));
    setcookie($cookieName, $uid, time()+60*60*24*365*5, "/", "", isset($_SERVER['HTTPS']), true);
    $_COOKIE[$cookieName] = $uid;
  }
  return $_COOKIE[$cookieName];
}
