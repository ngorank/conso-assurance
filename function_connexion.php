<?php	
// $servername = "185.98.131.176";
// $username = "badog2121822";
// $password = "wtahkoomqr";
// $dbname = "badog2121822";


$servername ="localhost";
$username = "root";
$password ="";
$dbname ="consoscar";
$conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password); 


// $connex = mysqli_connect($servername, $username, $password, $dbname);
// if (!$connex) {
//     die("Connection failed" . mysqli_connect_error());
//  }
// $sql=$conn->query("SELECT * FROM tb_consommation limit 1");											




?>