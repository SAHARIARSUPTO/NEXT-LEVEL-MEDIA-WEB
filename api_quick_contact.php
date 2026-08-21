<?php
header('Content-Type: application/json; charset=utf-8');
require_once('config/db.php');
require_once('components/tracker.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    exit;
}

$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');
$name = trim($_POST['name'] ?? '');

if (empty($name)) {
    // If name is not provided, generate a readable name from email username
    $parts = explode('@', $email);
    $name = !empty($parts[0]) ? ucwords(str_replace(['.', '_', '-'], ' ', $parts[0])) : 'Prospective Client';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'error' => 'Please provide a valid email address.']);
    exit;
}

$subject = 'Quick Direct Touch (Footer CTA)';
$full_message = !empty($message) ? $message : 'Client requested direct touch from footer CTA.';

try {
    save_contact_inquiry($name, $email, '', $subject, $full_message);
    track_visitor('Quick Direct Touch Sent', $email);
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! We have received your query. Our creative team will get in touch with you shortly.'
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => 'Failed to save message. Please try again or reach out via email.'
    ]);
}
