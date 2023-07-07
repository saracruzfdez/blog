<?php require_once "./head.php";
require_once "config/function.php";

if (isset($_SESSION) && !empty($_SESSION)) {


  session_destroy();


  header("Location: index.php");
}
