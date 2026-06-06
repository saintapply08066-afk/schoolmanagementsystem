<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();



if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

require_once '../includes/db.php';

if (!isset($_GET['id'])) {
    die("Application ID not provided");
}

$app_id = intval($_GET['id']);

/* Get Application Details */

$sql = "SELECT * FROM applications WHERE id=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $app_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    die("Application not found");
}

$app = mysqli_fetch_assoc($result);

/* Generate Admission Number */

$school_code = "GSSBRK";

/* Last two digits of current year */
$year = date("y");   // 26 instead of 2026

/* Get next serial number */
$count_query = "SELECT COUNT(*) AS total FROM students";
$count_result = mysqli_query($conn, $count_query);
$count_row = mysqli_fetch_assoc($count_result);

$next_number = $count_row['total'] + 1;

/* Format: 0001, 0002, 0003 ... */
$serial = str_pad($next_number, 4, "0", STR_PAD_LEFT);

/* Final Admission Number */
$admission_no = $school_code . "/" . $year . "/" . $serial;

/* Default Login Details */

$username = $admission_no;

$plain_password = "student123";

$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

echo "Reached user creation stage";
exit();

/* Create User Account */

$user_sql = "INSERT INTO users
(fullname, username, password, role, status)

VALUES (?, ?, ?, 'student', 'active')";

$user_stmt = mysqli_prepare($conn, $user_sql);

mysqli_stmt_bind_param(
    $user_stmt,
    "sss",
    $app['fullname'],
    $username,
    $hashed_password
);

if (!mysqli_stmt_execute($user_stmt)) {
    die("Failed to create user account");
}

$user_id = mysqli_insert_id($conn);

/* Create Student Record */

$student_sql = "INSERT INTO students
(user_id, admission_no, gender, date_of_birth,
address, parent_name, parent_phone, photo)

VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$student_stmt = mysqli_prepare($conn, $student_sql);

mysqli_stmt_bind_param(
    $student_stmt,
    "isssssss",
    $user_id,
    $admission_no,
    $app['gender'],
    $app['date_of_birth'],
    $app['address'],
    $app['parent_name'],
    $app['parent_phone'],
    $app['photo']
);

mysqli_stmt_execute($student_stmt);

/* Update Application Status */

$update_sql = "UPDATE applications
SET status='approved'
WHERE id=?>";

$update_stmt = mysqli_prepare($conn, $update_sql);

mysqli_stmt_bind_param(
    $update_stmt,
    "i",
    $app_id
);

mysqli_stmt_execute($update_stmt);

echo "<h2>Application Approved Successfully</h2>";

echo "<p><strong>Admission Number:</strong> $admission_no</p>";

echo "<p><strong>Username:</strong> $username</p>";

echo "<p><strong>Password:</strong> $plain_password</p>";

echo "<a href='applications.php'>Back to Applications</a>";
?>
