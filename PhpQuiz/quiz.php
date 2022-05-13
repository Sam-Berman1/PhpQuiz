<html>
<head>
  <style media="screen">
    body {
      background-color: lightblue;
    }
    input[type=submit]{
      background-color: #4CAF50; /* Green */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 5px 3px;
      cursor: pointer;
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
      margin-top: 20px;
    }

  </style>
</head>
<body>
    <?php
      require_once "config.php";

      if ($result = mysqli_query($link, "SELECT * from quiz")) {
      if (mysqli_num_rows($result) > 0) {
      // output data in each row
      echo "<form action='score.php' method='POST'>";
      while($row = mysqli_fetch_assoc($result)) {
        $name = 1;
        $a = $row["a"];
        $b = $row["b"];
        $c = $row["c"];

        echo "<h3>Question " . $row["id"] . ": " . $row["question"] . "</h3>";
        echo "A " . $a  . "<input type='radio' value='a' name='".$row["id"]."'/><br>";
        echo "B "     . $b  . "<input type='radio' value='b' name='".$row["id"]."'/><br>";
        echo "C "     . $c  . "<input type='radio' value='c' name='".$row["id"]."'/><br>";
      }
        echo "<input type='submit' value='Submit Quiz' Quiz id='submit'> </form>";

      } else {
      echo "0 results";
      }
      }
      mysqli_close($link);
      ?>

</body>
</html>
