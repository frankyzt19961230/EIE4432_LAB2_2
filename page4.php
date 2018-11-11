<?php
    $language = $_GET['lang'];
    $conn = mysqli_connect("localhost", "root", "","world");
    if ($conn->connect_error)  {
		echo "Unable to connect to database";
		exit;
    }

    print ("<h1>Language: ".$language."</h1>");
    //echo "<br/>";
    print ("<p>This is an official language in the following countries</p>");
    $query1="select Name,Continent from country inner join countrylanguage on country.Code=countrylanguage.CountryCode where Language='".$language."' and IsOfficial='T'";
    $result1=$conn->query($query1);
    if (!$result1) die("No information");
    $result1->data_seek(0);
	while ($row=$result1->fetch_assoc())  {
		print("<li>" . $row["Name"] .", ".$row['Continent']. "</li>");
    }
    
    $query2="select Name,Continent,count(*) from country inner join countrylanguage on country.Code=countrylanguage.CountryCode where Language='".$language."' and IsOfficial='T' group by Continent";
    print ("<h2>Distribution among different countries </h2>");
    $result2=$conn->query($query2);
    if (!$result2) die("No information");
    $result2->data_seek(0);
    while ($row2=$result2->fetch_assoc())  {
		print("<li>" . $row2["Continent"] .": ".$row2['count(*)']."</li>");
    }

?>