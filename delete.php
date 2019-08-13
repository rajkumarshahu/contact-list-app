<?php
//Delete code goes here.
include_once("includes/global_variables.php");
include_once("includes/functions.php");

if(isset($_GET['id']) && $_GET['id']>0){
    deleteUser($_GET['id']);
    header('location:index.php');
}
?>
