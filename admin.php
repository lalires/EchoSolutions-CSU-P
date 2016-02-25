<? session_start(); 
?><!doctype html>
<html lang=en>
<head>
<link href="css/simple-sidebar.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel='stylesheet' type='text/css' href='wallstyle.css'>
<title text-align: center>Admin</title>
<meta charset=utf-8>
</head>
<body>

<?php include('nav.php'); ?>

<br />
<br />
<div align='center'>
<form action="goalset.php" method="POST" enctype="multipart/form-data">
    Input Goal for the Week
	<input type="number" name="goal" min="1" max="100" placeholder="1-100"></br>
    <input type="submit" value="Submit" name="submit">
</form>
</div>

</body>
</html> 