<?php
require 'class.phpmailer.php';
require 'class.smtp.php';
$q1 = $_POST['Q1'];
$q2 = $_POST['Q2'];
$q3 = $_POST['Q3'];
$q4 = $_POST['Q4'];
$q5 = $_POST['Q5'];
$q6 = $_POST['Q6'];
$q7 = $_POST['Q7'];
$q8 = $_POST['Q8'];
$q9 = $_POST['Q9'];

$t=time();
$day= date("Y-m-d",$t);
$name = $_POST['Name'];

$threshold = 2;
$total = $_POST['total'];
$to = "rnadkathimar@gmail.com";
$headers = "";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
// or try these settings (worked on XAMPP and WAMP):
// $mail->Port = 587;
// $mail->SMTPSecure = 'tls';
 
 
$mail->Username = "fullfake11@gmail.com";
$mail->Password = "fakepassword11";
 
$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
 
$mail->From = "rnadkathimar@gmail.com";
$mail->FromName = "Your Name";
 
$mail->addAddress("a.ravinarayana@gmail.com","User 1");


if($total<$threshold)
$mail->Subject =$name."-".$day."-"."Total-$total";
else
$mail->Subject =$name."-".$day."-"."Criteria met:Total-$total";

$mail->Body = "1-$q1 \n

2-$q2 \n

3-$q3 \n

4-$q4 \n 

5-$q5 \n

6-$q6 \n

7-$q7 \n

8-$q8 \n

9-$q9 \n";
if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else
    echo "Message has been sent";
?>
