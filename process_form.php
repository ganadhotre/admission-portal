<?php

include 'db_connection.php';
// Retrieve form data
$name = $_POST['name'];
$surname = $_POST['surname'];
$age = $_POST['age'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$course = $_POST['course'];

// Define table name based on course selection
$tableName = '';

switch ($course) {
    case 'medical':
        $tableName = 'medical_table';
        break;
    case 'engineering':
        $tableName = 'engineering_table';
        break;
    case 'pharmacy':
        $tableName = 'pharmacy_table';
        break;
    default:
        // Handle invalid course selection
        break;
}

// Prepare SQL statement
$sql = "INSERT INTO $tableName (name, surname, age, email, contact, gender, address) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssissss", $name, $surname, $age, $email, $contact, $gender, $address);


// Execute query
if ($stmt->execute()) {
    echo "Data stored successfully in $tableName table.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
