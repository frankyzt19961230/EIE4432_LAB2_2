<!DOCTYPE html>
<html>
<head>
 <title> Page 3 </title>
     
</head>
<body>
     
   <form name="myForm" action="page4.php" method="get" >

      <h2> Please choose the language: </h2>
      <?php
       $conn = mysqli_connect("localhost", "root", "","world");
       if ($conn->connect_error)  {
               echo "Unable to connect to database";
               exit;
       }
       $query1="select Language,count(*) from countrylanguage group by Language";
       $result1=$conn->query($query1);
       if (!$result1) die("No information");
       $result1->data_seek(0);
	 while ($row=$result1->fetch_assoc())  {
		if($row["count(*)"]>=15){
                  print("<input type='radio' name='lang' value='".$row["Language"]."' />".$row["Language"]."");
            }
    }
      ?>
      <br /> <br />

      <input type="submit" value="submit" />
   </form>

</body>
</html>