<?php
function sum($a,$b)
{
	$c = $a + $b;
	return $c;
}


function detectPage()
{
	$uri = $_SERVER ['REQUEST_URI'];
$parts = explode('/', $uri);
$fileName = $parts[2];
$parts = explode('.', $fileName);
$page = $parts[0];
return $page;
}

function findUserByEmail($email)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
	$stmt->execute(array($email));
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function findUserById($id)
{
	global $db;
	$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
	$stmt->execute(array($id));
	return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateUserPassword($id,$password)
{
	global $db;
	$hashPassword = password_hash($password,PASSWORD_DEFAULT);
	$stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
    return $stmt->execute(array($hashPassword, $id));
   
}

function createUser($displayname, $email, $password)
{
	global $db;
	$hashPassword = password_hash($password,PASSWORD_DEFAULT);
	$stmt = $db->prepare("INSERT INTO users (displayname, email, password)  VALUES (?,?,?)");
    $stmt->execute(array($displayname, $email, $hashPassword));
   return $db->lastInsertId();
}