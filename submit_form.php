<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));
    
    // Validate the form data
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        // Email settings
        $to = "#"; // Your email address/ info@TexasArchery.info
        $subject = "New Contact Form Submission";
        $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
        $headers = "From: $email";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            // Success message
            echo "Thank you! Your message has been sent.";
        } else {
            // Error sending email
            echo "Sorry, something went wrong. Please try again.";
        }
        
    } else {
        // Error in validation
        echo "Please complete all fields and provide a valid email.";
    }

} else {
    // Redirect to the form page if accessed directly
    header("Location: contact.html");
    exit();
}
?>
