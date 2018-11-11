<!DOCTYPE html>
<html>
<head>
 <title> Page 6 </title>
 <style type="text/css">
	table, th, td {border:1px solid blue;}
	th {padding: 20px;}
 </style>
</head>
<body>
	<?php
	$Cnum=1;
	$num=1;
	$lang1=$_GET['lang1'];
	$lang2=$_GET['lang2'];
	if($lang1==$lang2){
		print("Please choose two different languages");
	}
	$conn = mysqli_connect("localhost", "root", "","world");
	if ($conn->connect_error)  {
			echo "Unable to connect to database";
			exit;
	}
	$query1="select CountryCode,Language,Population,Percentage,Population*Percentage/100000000 from country inner join countrylanguage on country.Code=countrylanguage.CountryCode where (Language='".$lang1."' or Language='".$lang2."') and IsOfficial='T' ";
	$query2="select Language,count(*) from country inner join countrylanguage on country.Code=countrylanguage.CountryCode where (Language='".$lang1."' or Language='".$lang2."') and IsOfficial='T' group by Language";
	$query3="select Language,sum(Population*Percentage/100000000) as Popu from country inner join countrylanguage on country.Code=countrylanguage.CountryCode where (Language='".$lang1."' or Language='".$lang2."') group by Language";
	$query4="select Language,sum(Population*Percentage/100000000) as Popu from country inner join countrylanguage on country.Code=countrylanguage.CountryCode group by Language order by Popu DESC";

	$result1=$conn->query($query1);
	if (!$result1) die("No information");
	$result1->data_seek(0);
	while ($row=$result1->fetch_assoc())  {
		//print("<li>" .$row['Language']." ".$row['CountryCode']." ". $row["Population"] ." ".$row['Percentage']." ".$row['Population*Percentage/100000000']."</li>");
    }

	$result2=$conn->query($query2);
	if (!$result2) die("No information");
	$result2->data_seek(0);
	while ($row2=$result2->fetch_assoc())  {
		if($row2['Language']==$lang1){
			$langC[1]=$row2['count(*)'];
		}else if($row2['Language']==$lang2){
			$langC[2]=$row2['count(*)'];
		}
	}

	$result3=$conn->query($query3);
	if (!$result3) die("No information");
	$result3->data_seek(0);
	while ($row3=$result3->fetch_assoc())  {
		if($row3['Language']==$lang1){
			$langP[1]=$row3['Popu'];
		}else if($row3['Language']==$lang2){
			$langP[2]=$row3['Popu'];
		}
	}


	$result4=$conn->query($query4);
	if (!$result4) die("No information");
	$result4->data_seek(0);
	while ($row4=$result4->fetch_assoc())  {
		//print("<li>" .$row4['Language']." ".$row4['Popu']."</li>");
		if($row4['Language']==$lang1){
			$langR[1]=$Cnum;
			$Cnum=$Cnum+1;
		}else if($row4['Language']==$lang2){
			$langR[2]=$Cnum;
			$Cnum=$Cnum+1;
		}else{
		$Cnum=$Cnum+1;
		}
	}
	
	print("<table>");
	print("<tr><th></th><th>".$lang1."</th><th>".$lang2."</th></tr>");
	print("<tr><td>The total number of countries that have chosen the language as an official language</td><td>".$langC[1]."</td><td>".$langC[2]."</td></tr>");
	print("<tr><td>The total number of people speaking that language (in millions)</td><td>".$langP[1]."</td><td>".$langP[2]."</td></tr>");
	print("<tr><td>The ranking in terms of the total number of people speaking that language</td><td>".$langR[1]."</td><td>".$langR[2]."</td></tr>");

	echo "</table>";
	?>

</body>
</html>