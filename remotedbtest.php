<?php
$DB_HOST = 'srv559.hstgr.io'; // or use '156.67.76.5'
$DB_NAME = 'u628985654_vpnboard';
$DB_USER = 'u628985654_vpnuser'; // replace with your actual username
$DB_PASS = 'Vpn18##@@@'; // replace with your actual password

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}
echo "✅ Connected successfully to remote database!";
?>
