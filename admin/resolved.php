<?php
require_once '../database/connection.php';

if ($conn) {
	?>
	<script>
		alert('COMPLAINT RESOLVED successfully !!!');
	</script>
	<?php
} else {
	die("No Connection" . mysqli_connect_error());
}

$id = $_GET['id'];

$resolvequery = mysqli_query($conn, "UPDATE complaints SET status = 'Resolved' WHERE `complaints`.`id` = $id");

header('location: admin.php');
?>