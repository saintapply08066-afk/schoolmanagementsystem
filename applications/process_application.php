<?php

require_once '../includes/db.php';

$fullname = trim($_POST['fullname']);
$gender = trim($_POST['gender']);
$date_of_birth = trim($_POST['date_of_birth']);
$parent_name = trim($_POST['parent_name']);
$parent_phone = trim($_POST['parent_phone']);
$address = trim($_POST['address']);
$previous_school = trim($_POST['previous_school']);

$photo_name = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];

$photo_path = "../uploads/photos/" . time() . "_" . $photo_name;

move_uploaded_file($tmp_name, $photo_path);

$sql = "INSERT INTO applications
(fullname, gender, date_of_birth, parent_name,
 parent_phone, address, previous_school, photo, status)

VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssssssss",
    $fullname,
    $gender,
    $date_of_birth,
    $parent_name,
    $parent_phone,
    $address,
    $previous_school,
    $photo_path
);

if(mysqli_stmt_execute($stmt)){
    echo "Application Submitted Successfully";
}else{
    echo "Error: " . mysqli_error($conn);
}

?>
