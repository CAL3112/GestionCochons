<?php 

include('../classes/class_bdd.php');

$conn = new BDD();
$req="SELECT * FROM ".$_POST['tbldelete']." WHERE id_".$_POST['tbldelete']." = '".$_POST['iddelete']."'";
$res = $conn->Query($req);
// var_dump($res);
?>

Confirmez-vous la suppression de : <br>
<?php echo "<b>".$res[0]['nom']."</b>"; ?>
<br><br>
<input class="btn-suppr" type="button" value ="Annuler" onClick="closebox();">
<input class="btn-suppr" type="button" value="Oui" onClick="confirm_delete(<?php echo $_POST['iddelete']; ?>, '<?php echo $_POST['tbldelete']; ?>')">
