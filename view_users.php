<!DOCTYPE html>
<?php
  $con = mysqli_connect("localhost","root","","Test_log") or die("Connection was not established");
?>
<html lang='en'>

  <head>
    <meta charset='UTF-8'/>
    <title>View users</title>
    <link rel='stylesheet' href='log_in-style.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>
<body>

<table>
<tr align="center">
  <td colspan="3"> <h2>View all users</h2> </td>
</tr>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
</tr>
<?php
$sel = "Select * from users_log";
$run = mysqli_query($con, $sel);
while($row=mysqli_fetch_array($run)) {
  $id = $row['id'];
  $username = $row['username'];
  $email = $row['email'];

?>
<tr>
    <td><?php echo $id; ?></td>
    <td><?php echo $username; ?></td>
    <td><?php echo $email; ?></td>

</tr>
<?php } ?>



</table>


</body>


</html>
