<?php 

$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$answer = isset($_POST['answer']) ? $_POST['answer'] : null;

$myfile = fopen("answers.txt", "a") or die("Unable to open file!");

$txt= '
Name : '.$name.'
Email :  '.$email.'
Answer: '.$answer.'  
==============================================================================
';

fwrite($myfile, "\n". $txt);
fclose($myfile);

$response = array();
$response['html'] = "Thank you for your submission!";

echo json_encode($response);

?>
