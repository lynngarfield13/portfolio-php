
<?php

    $contact_name = filter_input(INPUT_POST, 'contactName');
    $from_email = filter_input(INPUT_POST, 'contactEmail');
                
    $subject= filter_input(INPUT_POST, 'contactSubject');
    $message= filter_input(INPUT_POST, 'contactMessage');
  /*//  $message = str_replace("\n", "n\", $message);
  
        
    // validate contact name
    if ($contact_name === FALSE ) {
        $error_message = 'Please enter a Contact Name.';
    
    // validate email accress
    } else if ($from_email === FALSE) {
        $error_message = "Please enter a valid email address";
    }  else {
        $error_message = ''; }

    // if an error message exists, go to the index page
    if ($error_message != '') {
        include('index.html');
        exit();
    }
    $to = 'lynngarfield13@gmail.com';           
    $headers = 'From: '. $from_email . "\r\n" .
    'Reply-To: '. $from_email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    // Mail it
    $success =  mail($to, $subject, $message, $headers);

    if (!$success) {
        echo error_get_last()['message'];
    } else {
       echo "Thank you!  Your email has been sent.";
    }
  */     

// PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
// Base files 
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// create object of PHPMailer class with boolean parameter which sets/unsets exception.
$mail = new PHPMailer(true);                              
try {
    $mail->isSMTP(); // using SMTP protocol                                     
    $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
    $mail->SMTPAuth = true;  // enable smtp authentication                             
    $mail->Username = 'lynngarfieldportfolio@gmail.com';  // sender gmail host            
    $mail->Password = 'portfolioAccess'; // sender gmail host password                          
    $mail->SMTPSecure = 'tls';  // for encrypted connection                           
    $mail->Port = 587;   // port for SMTP     

    $mail->setFrom($from_email, $contact_name); // sender's email and name
    $mail->addAddress('lynngarfield13@gmail.com', "Lynn Garfield");  // receiver's email and name

    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) { // handle error.
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>

