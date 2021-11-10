<?php

if (isset($_POST['delete'])){
    $Obj_Dino = new Dino(intval($_POST["idobj"]));
    echo "<p class='note note-success'>".$Obj_Dino->Get('nom')." a bien été supprimé<br> <a href='index.php?page=liste_".$_GET['tbl']."'>Retour à la liste</a></p>";
    $conn = new BDD();
    $conn->Update($_POST['table'], 'deleted_at', date('Y-m-d H:i:s'), $_POST['idobj']);


} elseif (isset($_POST['nodelete'])){

} else {
?>

Voulez-vous confirmer la suppression?

<form action="" method="post">
    <input type="hidden" name="table" value="<?php echo $_GET['tbl']?>">
    <input type="hidden" name="idobj" value="<?php echo $_GET['id']?>">
    <input type="submit" name="nodelete" value="non">
    <input type="submit" name="delete" value="oui">
</form>

<?php } ?>