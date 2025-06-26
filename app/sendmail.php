<?php
require_once __DIR__ . '/../vendor/autoload.php';
try {
    // Create the SMTP Transport 
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
        ->setUsername('rnarvaez.5304@unimar.edu.ve')
        ->setPassword('27125304');
    // Create the Mailer using your created Transport 
    $mailer = new Swift_Mailer($transport);
    // Create a message 
    $message = new Swift_Message();
    // Set a "subject" 
    $message->setSubject('Demo message using the SwiftMailer library.');
    // Set the "From address" 
    $message->setFrom(['rnarvaez.5304@unimar.edu.ve' => 'yo']);
    // Set the "To address" [Use setTo method for multiple recipients, argument should be array] 
    $message->addTo('raymondnarvaez19@gmail.com','recipient name');
    // Add "CC" address [Use setCc method for multiple recipients, argument should be array] 
    // $message->addCc('recipient@gmail.com', 'recipient name');
    // // Add "BCC" address [Use setBcc method for multiple recipients, argument should be array] 
    // $message->addBcc('recipient@gmail.com', 'recipient name');
    // // Add an "Attachment" (Also, the dynamic data can be attached) 
    // $attachment = Swift_Attachment::fromPath('example.xls');
    // $attachment->setFilename('report.xls');
    // $message->attach($attachment);
    // Add inline "Image" 
    // $inline_attachment = Swift_Image::fromPath('nature.jpg');
    // $cid = $message->embed($inline_attachment);
    // Set the plain-text "Body" 
    $message->setBody("This is the plain text body of the message.\nThanks,\nAdmin");
    // Set a "Body" 
    $message->addPart('This is the HTML version of the message.<br>Example of inline image:<br><img src="'.$cid.'" width="200" height="200"><br>Thanks,<br>Admin', 'text/html');
    // Send the message 
    $result = $mailer->send($message);
} catch (Exception $e) {
  echo $e->getMessage();
}