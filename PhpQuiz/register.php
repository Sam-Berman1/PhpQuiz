<!DOCTYPE html>
<html>
 <head>
 <title>Register</title>
 <body>
 <?php
 require_once "config.php";
 echo "<p>";
 echo "<strong>Connected successfully</strong><br>";
 echo "</p>";
 // Processing form data when form is submitted
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
 // Get submitted values
 $user = trim($_POST['username']);
 $passwd = trim($_POST['passwd']);
 echo "$user $passwd";
 //Create a prepared statement
 $sql ="insert into users(username, password) values (?,?)" ;
 $stmt = mysqli_prepare($link, $sql);
 // Bind variables to the prepared statement as parameters
 mysqli_stmt_bind_param($stmt, "ss", $param_username,
$param_passwd);
 //Set variables
 $param_username=$user;
 $param_passwd=$passwd;
 mysqli_stmt_execute($stmt);
 $rows_inserted= mysqli_stmt_affected_rows($stmt);
 echo "Inserted ".$rows_inserted." rows";
 }
 ?>
 </body>
</html>
