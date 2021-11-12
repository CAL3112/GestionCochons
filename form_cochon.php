<?php
if(isset($_POST['sub_cochon'])){

  if ($_POST["cochon_id"] != "new") $_POST["cochon_id"] = intval($_POST["cochon_id"]);

  $Obj_cochon = new cochon($_POST["cochon_id"]);
  $Obj_cochon->Set('nom', $_POST['cochon_nom']);
  $Obj_cochon->Set('poids', $_POST['cochon_poids']);
  $Obj_cochon->Set('taille', $_POST['cochon_taille']);
  $Obj_cochon->Set('sexe', $_POST['cochon_sexe']);
  $Obj_cochon->Set('duree_de_vie', $_POST['cochon_duree_de_vie']);



  echo "<p class='note note-success'>".$_POST['cochon_nom']." a bien été créé(e) <br> <a href='index.php?page=liste_cochon'>Retour à la liste</a></p>";
    exit();
} else if ($_GET["id"] != "new" && $_GET["id"] > 0){
    $Obj_cochon = new cochon(intval($_GET["id"]));
}


?>
<h1>Ajouter un(e) cochon(ne)</h1>
<div class="form">



    <form method="POST" action="">

        Nom :
            <input type="text" name="cochon_nom" value="<?php if(isset($Obj_cochon)) echo $Obj_cochon->Get('nom'); ?>">
        <br>
        Poids :
            <input type="number" name="cochon_poids" value="<?php if(isset($Obj_cochon)) echo $Obj_cochon->Get('poids'); ?>">
        <br>
        Taille :
            <input type="number" name="cochon_taille" value="<?php if(isset($Obj_cochon)) echo $Obj_cochon->Get('taille'); ?>">
        <br>
        Durée de vie :
            <input type="number" name="cochon_duree_de_vie" value="<?php if(isset($Obj_cochon)) echo $Obj_cochon->Get('duree_de_vie'); ?>">
        <br>
        Sexe :
            <select name="cochon_sexe">
               <option value="Male">Male</option>
               <option value="Femelle">Femelle</option>
            </select>

        
        <input type="hidden" name="cochon_id" value="<?php echo $_GET['id'] ?>">
        <input type="submit" name="sub_cochon" value="Enregistrer" class="btn btn-success bouton">

    </form>

</div>