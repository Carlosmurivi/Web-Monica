<?php
include_once '../src/controllers/ControllerUsers.php';

ControllerUsers::logOut();
header("Location: login.php");
exit();