<?php
include_once 'config.php';
include_once 'autoload.php';

global $db;


$idremove=$_GET['id'];


$db->exec("DELETE FROM task WHERE id=$idremove");  


if($db)
{
    echo "<font-color:'green'>Entrée n°".$idremove." supprimée de la base de données";
}

else
{
    echo "<font-color:'red'>Failed to deleted from Database";
}


?>