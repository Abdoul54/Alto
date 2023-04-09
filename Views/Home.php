<?php 
include_once('C:\Apache24\htdocs\BackEnd\App\Controller\UserC.php');
session_start();
$uid = $_SESSION['uid'];
echo 'WELCOME USER '.$uid;
chk();

?>
<form method="post" action="../App/Controller/UserC.php">
<button id="logout" name="logout">Log out</button>
</form>