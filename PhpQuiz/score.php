<!DOCTYPE html>
<html>
<head>
  <style media="screen">
    body{
      background-color: lightblue;
      text-align: middle;
      text-decoration-color: blue;
    }
    a.button {
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
  }
  </style>
</head>
<body>
 <?php

   require_once "config.php";


   $score = 25;

   if ($_SERVER["REQUEST_METHOD"] == "POST"){

     $input = array();
     $definedInput = array_key_exists('input', get_defined_vars());
     echo "<script>console.log(`" . json_encode($definedInput) . "`);</script>";

     for($i=1; $i < 5; $i++){
       if(!isset($_POST[$i])){
         $input[$i-1] = "You did not answer this question, please go back and try again";
       }
       else{
         array_push($input, $_POST[$i]);
       }

     }




     echo "<h2>Answer 1: $input[0] <br>";
     echo "Answer 2: $input[1] <br>";
     echo "Answer 3: $input[2] <br>";
     echo "Answer 4: Free Point! Min Chen is the best (: </h2><br>";

     $correct = array();

   if ($result = mysqli_query($link, "SELECT * from quiz")) {
     if (mysqli_num_rows($result) > 0) {
          /* output data in each row */

       while($row = mysqli_fetch_assoc($result)) {
            array_push($correct,$row["answers"]);
        }

        for ($i=0; $i < 3; $i++) {
          if($correct[$i] == $input[$i]){
            $score = $score + 25;
          }
        }
      }


        echo "<script>console.log(`" . json_encode($correct) . "`);</script>";

    if($score <= 50) {
      echo "<h3> You failed with a $score, would you like to try again? </h3>";
      echo "<a href='quiz.php' class='button'>Yes</a>";
    }
      else {
        echo "<h3> You got a $score nice job! </h3>";
      }
    }
      else {
     echo "0 results";
     }
   }

   mysqli_close($link);
   ?>
</body>
</html>
