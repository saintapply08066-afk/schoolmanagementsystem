<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Admission Application</title>
</head>
<body>

<h2>Student Admission Form</h2>

<form action="process_application.php" method="POST" enctype="multipart/form-data">

    <label>Full Name</label><br>
    <input type="text" name="fullname" required><br><br>

    <label>Gender</label><br>
    <select name="gender" required>
        <option value="">Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br><br>

    <label>Date of Birth</label><br>
    <input type="date" name="date_of_birth" required><br><br>

    <label>Parent Name</label><br>
    <input type="text" name="parent_name" required><br><br>

    <label>Parent Phone</label><br>
    <input type="text" name="parent_phone" required><br><br>

    <label>Address</label><br>
    <textarea name="address" required></textarea><br><br>

    <label>Previous School</label><br>
    <input type="text" name="previous_school"><br><br>

    <label>Passport Photo</label><br>
    <input type="file" name="photo" accept="image/*" required><br><br>

    <button type="submit">Submit Application</button>

</form>

</body>
</html>
