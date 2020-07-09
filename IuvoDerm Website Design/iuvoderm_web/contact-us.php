<?php

// Address where the email will be sent from
$from = 'info@iuvoderm.com';

// Destination address
$sendTo = 'info@iuvoderm.com';

// Subject of the email
$subject = 'New Contact Form Message, from: ';

// Array variable name => Text to appear in the email
$fields = array('name' => 'Name', 'email' => 'Email', 'subject' => 'Subject', 'message' => 'Message'); 

// Throwback OK message
$okMessage = 'Message has been sent. We will get back to you as soon as possible.';

// Throwback FAIL message
$errorMessage = 'There was an error while submitting the form. Please try again later.';

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(0);

try
{

    if(count($_POST) == 0) throw new \Exception('Form is empty');
            
    $emailText = "New message from contact form, reply to it wontcha?\n=============================\n";

    foreach ($_POST as $key => $value) {
        // If the field exists in the $fields array, include it in the email 
        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
            if ($key == 'name') {
                $subject .= "{$value} ";
            }
            if ($key == 'email') {
                $subject .= "({$value}) ";
            }
        }
    }

    // All the neccessary headers for the email.
    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    // Send email
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}


// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
// else just display the message
else {
    echo $responseArray['message'];
}