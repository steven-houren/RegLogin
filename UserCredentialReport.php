<!DOCTYPE html>
<html>
<head>
    <title>Credential Report</title>

<style type=text/css>

body{
    background-color: #151515;
    color: white;
    font-family: Helvetica;
}

#UserCredentialsTable{

    width: 1440px;
    margin-left: auto;
    margin-right: auto;
    
}

.PageTitle{
    width: 1440px;
    margin-left: auto;
    margin-right: auto;
}

table{
    padding: 0;
    margin: 0;
    border-collapse: collapse;
    border: 3px solid white;
    color: white;
    font-family: sans; 
    width: 1400px;
}

th, td{
    text-align: center;
    padding: 5px;
    border-radius: 5px;
    border: 3px solid white;
    /*width: 175px;*/
}

tr: nth-child(even){background-color: #F2F2F2}


th{
    background-color: #050505;
    color: white;
}


</style>

</head>
<body>


<div class="PageTitle">
<h1>User Credentials Report Page</h1>
</div>

<?php

$servername = "localhost";
$username = "id5361824_shouren_usercredentials";
$password = "8675309";
$dbname = "id5361824_usercredentials";

try{
    $db = new PDO ("mysql:host=$servername;dbname=$dbname", $username, $password);
}
catch(PDOException $e) {
    echo $e->getMessage()."<br>";
    die();
}

$query = "SELECT * FROM UserCredentials ORDER BY RegDate DESC";


echo "<div id='UserCredentialsTable'>";

echo "<table id='MainTable' border=1>
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Address Line 1</th>
    <th>Address Line 2</th>
    <th>City</th>
    <th>State</th>
    <th>Zip</th>
    <th>Country</th>
    <th>Date</th>
    </tr>";




foreach($db->query($query) as $item){
    echo "<tr>";
    echo "<td>".$item['FirstName']."</td>";
    echo "<td>".$item['LastName']."</td>";
    echo "<td>".$item['Address1']."</td>";
    echo "<td>".$item['Address2']."</td>";
    echo "<td>".$item['City']."</td>";
    echo "<td>".$item['RegState']."</td>";
    echo "<td>".$item['Zip']."</td>";
    echo "<td>".$item['Country']."</td>";
    echo "<td>".$item['RegDate']."</td>";
    echo "</tr>";
}

echo "</table>";

?> 

</body>