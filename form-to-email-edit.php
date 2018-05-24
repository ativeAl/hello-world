<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['fullname'];
$visitor_email = $_POST['email'];
//$telephone = $_POST['telephone'];
//$date = $_POST['date'];
//$time = $_POST['time'];
//$personcount = $_POST['personcount'];
$comment = $_POST['comment'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'mail@paintandchat.dk';//<== update the email address
$email_subject = "New Booking";
$email_body = "New booking\n\n 
    Name: $name\n
    E-mail adress: $email\n
    Telephone number: $telephone\n
    Date: $date\n
    Time: $time\n
    Comment: $comment\n".
    
$to = "mail@paintandchat.dk";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: https://www.paintandchat.dk/booking-confirmation/'); //thank-you.html


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 