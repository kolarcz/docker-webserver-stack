<?php

// Prevent access from one site folder to others
$_SERVER["DOCUMENT_ROOT"] = preg_replace("~^(/var/www/html/[^/]+).*$~", "$1", $_SERVER["DOCUMENT_ROOT"]);
ini_set("open_basedir", $_SERVER["DOCUMENT_ROOT"]);
