<h1>Welcome to http(s)://localhost</h1>

<?php

$mysqli = new mysqli("mariadb", "root", "s3cretP4ss", "test");
echo $mysqli->connect_error ? $mysqli->connect_error : "DB connected";

phpinfo();
