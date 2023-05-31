<?php
// Validate and sanitize the form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// Server-side validation
$errors = array();
if (empty($full_name)) {
    $errors[] = "Full name is required";
}
if (empty($email)) {
    $errors[] = "Email address is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address";
}
if (empty($gender)) {
    $errors[] = "Gender is required";
}

// If there are any errors, display them
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
} else {
    // Connect to the MySQL database
    $host = "localhost";
    $username = "your_username";
    $password = "your_password";
    $database = "your_database";

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the data into the "students" table
    $sql = "INSERT INTO students (full_name, email, gender) VALUES ('$full_name', '$email', '$gender')";
    if ($conn->query($sql) === TRUE) {
        echo "Student registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>