<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){

	  header("Location: ../auth/login.php");
	  exit();
}

require_once '../includes/db.php';

$sql = "SELECT * FROM applications WHERE status = 'pending' ";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pending Applications</title>
</head>
<body>
       <h2>Pending Applications</h2>
       <table border="1" cellpadding="10">
       	<tr>
       		<th>ID</th>
       		<th>Photo</th>
       		<th>Name</th>
       		<th>Gender</th>
       		<th>Parent</th>
       		<th>Phone</th>
       		<th>Action</th>

       	</tr>

 <?php while($row = mysqli_fetch_assoc($result)){ ?>

 	<tr>
 		<td><?php echo $row['id']; ?> </td>
 		<td><img src ="  <?php  echo $row['photo']; ?>" width = "60"> </td>
        <td><?php echo $row['fullname']; ?> </td>
        <td><?php echo $row['gender']; ?> </td>
        <td><?php echo $row['parent_name']; ?> </td>
        <td><?php echo $row['parent_phone']; ?> </td>
       <td> <a href = "approve_applicaton.php?id=<?php echo $row['id']; ?>"> Approve </a> | <a href = "reject_applicaton.php?id=<?php echo $row['id']; ?>"> Reject </a></td>
     
 	</tr>
 <?php } ?>
       </table>
</body>
</html>