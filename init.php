<?php
//Load core functions
require_once ('functions.php');
//Always display error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Start session
session_start();

//Detect page
$page = detectPage();

//Connect databse
$db = new PDO('mysql:host=localhost;dbname=demo1;charset=utf8', 'root', '');

//Detect login
$currentUser = null;

if(isset($_SESSION['userId']))
{
	$currentUser = findUserById($_SESSION['userId']);
}