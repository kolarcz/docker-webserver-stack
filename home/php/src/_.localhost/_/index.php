<h1>Welcome to http(s)://localhost</h1>

<?php

$mysqli = new mysqli("mariadb", "root", "s3cretP4ss", "information_schema");
echo $mysqli->connect_error ? $mysqli->connect_error : "DB connected";

phpinfo();
