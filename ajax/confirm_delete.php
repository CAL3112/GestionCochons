<?php 
include('../classes/class_bdd.php');
$conn = new BDD();
$conn->Update($_POST['tbldelete'], 'deleted_at', date('Y-m-d H:i:s'), $_POST['iddelete']);

?>