<?php

// get $_POST contents
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
header('Content-Type: application/json');

// Make email, and send it
$subjectStr = "New Contact Form Message, From: {$name} ({$email})";
$content="New message from contact form, reply to it wontcha?\n=============================\n From: $name \nEmail: $email \nSubject: $subject \nMessage: $message";
$headers = array('Content-Type: text/plain; charset="UTF-8";',
'From: ' . $email,
'Reply-To: ' . $email,
'Return-Path: ' . $email,
);

if(mail('info@iuvoderm.com', $subjectStr, $content, implode("\n", $headers))) {
    // print json_encode(array('message' => 'Message has been sent. We will get back to you as soon as possible.', 'code' => 1));
    print "<p class='success'>Message has been sent. We will get back to you as soon as possible.</p>";
} else {
    // print json_encode(array('message' => 'Problem in sending mail.', 'code' => 2));
    print "<p class='error'>Problem in sending message.</p>"; 
}
?>