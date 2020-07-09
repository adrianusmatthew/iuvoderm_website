<?php

// get $_POST contents
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
header('Content-Type: application/json');

// Validation of field contents
if ($name === ''){
print json_encode(array('message' => 'Name cannot be empty', 'code' => 0));
exit();
}
if ($email === ''){
print json_encode(array('message' => 'Email cannot be empty', 'code' => 0));
exit();
} else {
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
print json_encode(array('message' => 'Email format invalid.', 'code' => 0));
exit();
}
}
if ($subject === ''){
print json_encode(array('message' => 'Subject cannot be empty', 'code' => 0));
exit();
}
if ($message === ''){
print json_encode(array('message' => 'Message cannot be empty', 'code' => 0));
exit();
}

// Make email, and send it
$subjectStr = "New Contact Form Message, From: {$name} ({$email})";
$content="New message from contact form, reply to it wontcha?\n=============================\n From: $name \nEmail: $email \nSubject: $subject \nMessage: $message";
$headers = array('Content-Type: text/plain; charset="UTF-8";',
'From: ' . $address,
'Reply-To: ' . $address,
'Return-Path: ' . $address,
);
mail('info@iuvoderm.com', $subjectStr, $content, implode("\n", $headers)) or die("Error!");
print json_encode(array('message' => 'Message has been sent. We will get back to you as soon as possible.', 'code' => 1));
exit();
?>
