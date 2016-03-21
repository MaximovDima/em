<?php 

$Userlogin = $_POST['login'];
$UserPassword = $_POST['password'];
//echo $Userlogin."/".$UserPassword;

$dbconn = pg_connect("host=localhost dbname=test_db user=postgres password=12345")
	or die('Could not connect: ' . pg_last_error());

$query = "SELECT id FROM users WHERE login = '$Userlogin' ";
$resultSelect = pg_query($dbconn, $query);
$row = pg_fetch_row($resultSelect);
if (!$row) {
	$queryInsert = "INSERT INTO users (login, password) VALUES ('$Userlogin', '$UserPassword')";
	$resultInsert = pg_query($dbconn, $queryInsert) or die('Ошибка запроса: ' . pg_last_error());
	echo "Вы успешно зарегистрировались!";
}
else {
	$MessNo = "Такой логин уже занят!";  
    echo "<script type=\"text/javascript\">alert(\"$MessNo\"), history.go(-1)</script> \n"; 
}

 ?>