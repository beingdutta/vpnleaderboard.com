<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
  exit;
}

$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$country = trim($data['country'] ?? '');
$message = trim($data['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Name, email, and message are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Please provide a valid email address.']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO feedback (name, email, country, message) VALUES (:name, :email, :country, :message)");
    $stmt->execute(['name' => $name, 'email' => $email, 'country' => $country ?: null, 'message' => $message]);
    echo json_encode(['ok' => true, 'message' => 'Feedback submitted successfully.']);
} catch (Exception $e) {
    // In a real app, you would log this error instead of echoing it.
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'A server error occurred. Please try again later.']);
}