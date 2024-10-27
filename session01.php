<?php

session_start();

$name = "けんた";
$age = 25;

echo $name . $age;

$_SESSION["name"] = $name;
$_SESSION["age"] = $age;

$sid = session_id();
echo $sid;
