<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $fromEmail = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // L'email de destination
    $to = "khadijagrira143@gmail.com";

    // Sujet de l'email
    $subject = "Message from Contact Form";

    // Corps de l'email
    $emailMessage = "You have received a new message from the contact form.\n\n";
    $emailMessage .= "Here are the details:\n\n";
    $emailMessage .= "Email: " . $fromEmail . "\n\n";
    $emailMessage .= "Message:\n" . $message . "\n";

    // Headers de l'email
    $headers = "From: " . $fromEmail . "\r\n";
    $headers .= "Reply-To: " . $fromEmail . "\r\n";

    // Envoyer l'email
    if (mail($to, $subject, $emailMessage, $headers)) {
        echo "Message sent successfully.";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request.";
}
?>
