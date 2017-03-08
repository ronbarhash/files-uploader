<?php
require_once '../lib/php/vendor/autoload.php';

$pdo = new PDO("mysql:dbname=pdfreader", "root");
$fpdo = new FluentPDO($pdo);

