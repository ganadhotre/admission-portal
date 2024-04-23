<?php

include 'db_connection.php';

// Retrieve and sanitize input
$collegeName = $conn->real_escape_string($_POST['collegeName']);
$address = $conn->real_escape_string($_POST['address']);
$about = $conn->real_escape_string($_POST['about']);
$email = $conn->real_escape_string($_POST['email']);
$contactNo = $conn->real_escape_string($_POST['contactNo']);
$county = $conn->real_escape_string($_POST['county']); // Retrieve and sanitize county
$state = $conn->real_escape_string($_POST['state']);   // Retrieve and sanitize state
$city = $conn->real_escape_string($_POST['city']);     // Retrieve and sanitize city
$typeOfCollege = $conn->real_escape_string($_POST['typeOfCollege']); // Retrieve and sanitize type of college

// File upload handling remains unchanged
$target_dir = "clgImage/";
$imageUrl = "";

if (isset($_FILES['collegeImage'])) {
    $target_file = $target_dir . basename($_FILES['collegeImage']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES['collegeImage']['tmp_name']);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES['collegeImage']['tmp_name'], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES['collegeImage']['name'])). " has been uploaded.";
            $imageUrl = htmlspecialchars(basename($_FILES['collegeImage']['name']));
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Courses handling remains the same
$coursesArray = isset($_POST['courses']) ? $_POST['courses'] : [];
$coursesJSON = json_encode($coursesArray);

// Prepare and bind including new fields
$stmt = $conn->prepare("INSERT INTO colleges (collegeName, address, about, email, contactNo, imageUrl, courses, county, state, city, typeOfCollege) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $collegeName, $address, $about, $email, $contactNo, $imageUrl, $coursesJSON, $county, $state, $city, $typeOfCollege);

// Execute and output result
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
