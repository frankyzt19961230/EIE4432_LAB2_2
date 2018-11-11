<!DOCTYPE html>
<html>
<head>
   <title> Test your knowledge </title>
   <script type="text/javascript">
	function welcomeMessage()  {
		
		<?php 
			  $s1 = $_POST["quiz"];
		      $headInfo = $s1;

		      $s2 = "Name: " . $_POST["username"] . "<br/> Quiz: " . $_POST["quiz"]."";
		      $pInfo = $s2;
		?>
		document.getElementById("headInfo").innerHTML="<?php print("Quiz Paper: ".$headInfo."") ?>";
		document.getElementById("pInfo").innerHTML="<?php echo $s2 ?>";
	}

   </script>
</head>
<body onload="welcomeMessage()">
   
   <h1 id="headInfo"> Quiz Paper: </h1>
   <p id="pInfo"> </p>
   


</body>
</html>