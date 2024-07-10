<?php
// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $notes = $_POST['notes'] ?? '';

    // Prepare Discord webhook URL
    $webhookUrl = 'https://discord.com/api/webhooks/1260378849225605214/mHW_ENJx7TbTLJH6pQ70kaC7u2UPx43M4Yufa5TzLWeiooPiij3owzrw-_tqOvldjvXJ';

    // Create payload for Discord webhook
    $data = json_encode([
        'content' => "New Order Details:\n**Address:** $address\n**Phone:** $phone\n**Notes:** $notes"
    ]);

    // Initialize cURL session
    $ch = curl_init($webhookUrl);

    // Set cURL options
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    // Execute cURL session
    $response = curl_exec($ch);

    // Check for errors
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        echo 'Order details sent successfully to Discord!';
    }

    // Close cURL session
    curl_close($ch);

    // Redirect to a thank you or confirmation page
    header('Location: thank_you.html');
    exit();
} else {
    // If the form is not submitted via POST, redirect to the order page
    header('Location: order.html');
    exit();
}
?>
