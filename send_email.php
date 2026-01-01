<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON data from request
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Extract form data
    $name = isset($data['name']) ? trim($data['name']) : '';
    $email = isset($data['email']) ? trim($data['email']) : '';
    $phone = isset($data['phone']) ? trim($data['phone']) : '';
    $project = isset($data['project']) ? trim($data['project']) : '';
    $message = isset($data['message']) ? trim($data['message']) : '';
    
    // Your email address
    $to = 'yao1mqz@gmail.com';
    
    // Email subject
    $subject = 'New Contact Form Submission from BuildRight Construction Website';
    
    // Email body
    $body = "You have received a new message from the BuildRight Construction website:\n\n";
    $body .= "Name: " . htmlspecialchars($name) . "\n";
    $body .= "Email: " . htmlspecialchars($email) . "\n";
    $body .= "Phone: " . htmlspecialchars($phone) . "\n";
    $body .= "Project Type: " . htmlspecialchars($project) . "\n\n";
    $body .= "Message:\n" . htmlspecialchars($message) . "\n\n";
    $body .= "---\nThis message was sent from the BuildRight Construction contact form.";
    
    // Email headers
    $headers = "From: BuildRight Construction <noreply@buildright.com>\r\n";
    $headers .= "Reply-To: " . htmlspecialchars($email) . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send email']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
