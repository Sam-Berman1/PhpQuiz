<!DOCTYPE html>
<html>
<head>
  <style media="screen">
    body{
      background-color: lightblue;
      text-align: center;
      text-decoration-color: blue;
    }
  </style>
</head>
<body>
 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
 /** Get submitted username and password */
 $user = trim($_POST["username"]);
 $password = trim($_POST["password"]);
 /** Pass connection information through a config file */
 require_once "config.php";
 /** if connection fails, an error message will be sent, and as specified in the config file
*/
 /** if connection succeeds, display a message */
 echo "<p>";
 echo "<strong>Connected successfully</strong><br>";
 echo "</p>";
 /******* Retrieve user's passwrod from the database ********/
 /** Construct the SQL to retrieve password */
 //$sql = "SELECT password from users where username = \"".$user."\"" ;
 $sql = sprintf("SELECT password from users where username ='%s'",
mysqli_real_escape_string($link, $user));
 if($result = mysqli_query($link, $sql)){
 if (mysqli_num_rows($result) > 0) {

$row = mysqli_fetch_assoc($result);
 $pw = $row["password"];
 /** Check if user supplied the correct password */
 if ($pw == $password){
 echo "<strong><h1>Welcome user: '$user'</h1></strong><br>";
 echo "<a href=\"https://cs.newpaltz.edu/~bermans2/CS3/Final/quiz.html\"> Continue to quiz </a>";
 }
 else{
 /* Incorrect password */
 echo "<strong>Login Failed - Wrong password</strong><br>";
 }
 }
 else{
 // mysqli_num_rows($result) is zero, meaning no such username
 echo "<strong>Could not log in - No such user</strong><br>";
 }
 }
 else{
 //$result is false -> error getting password
 echo "<strong>Login Failed</strong><br>";
 }
 mysqli_close($link);
}
?>
</body>
</html>
