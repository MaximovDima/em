<?php 
//Config
define('DB_DRIVER','pgsql');
define('DB_HOST','localhost');
define('DB_NAME','test_db');
define('DB_USER','postgres');
define('DB_PASS','12345');

try
{
	$connect_str = DB_DRIVER . ':host='. DB_HOST . ';dbname=' . DB_NAME;
	$dbconn = new PDO($connect_str,DB_USER,DB_PASS);
}
	catch (PDOEXception $e)
{
	die("Error: ".$e->getMessage());
}

$Userlogin = pg_escape_string($_POST['login']);
$UserPassword = pg_escape_string($_POST['password']);

$stmt1 = $dbconn->prepare("SELECT id FROM users WHERE login = :login");
$stmt1->bindValue(':login', $Userlogin);
$stmt1->execute();

$row = $stmt1->fetch();
if (!$row) {
	$stmt2 = $dbconn->prepare("INSERT INTO users (login, password) VALUES (:login, :password)");
	$stmt2->bindValue(':login', $Userlogin);
	$stmt2->bindValue(':password', $UserPassword);
	$stmt2->execute();
	echo "Вы успешно зарегистрировались!";
}
else {
	$MessNo = "Такой логин уже занят!"; 
	echo "<script>alert('$MessNo')</script>";
	echo'<meta http-equiv="refresh" content="seconds; http://test">';
	//header('Location:http://test');
}    
 ?>