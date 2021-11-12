<?php

if(isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = 'created_at';
}

if(isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = 'DESC';
}

if(isset($_GET['depart'])) {
    $depart = $_GET['depart'];
} else {
    $depart = 0;
}

if(isset($_GET['nbaffichage'])) {
    $snbaffichageort = $_GET['nbaffichage'];
} else {
    $nbaffichage = 5;
}


$Obj_cochon = new cochon("empty");
$result_cochon = ($Obj_cochon->SelectAll($order, $sort));

$Obj_cochon = new cochon("empty");
$nb_cochon = ($Obj_cochon->CompteCochonH());

$Obj_cochon = new cochon("empty");
$nb_cochonne = ($Obj_cochon->CompteCochonF());

$Obj_cochon = new cochon("empty");
$nb_cochon_total = ($Obj_cochon->CompteCochon());


$tblNomMasculin = array("Francis", "Roger", "Paul", "Serkan", "Martial", "Lucas", "Mansour", "François", "Pierre", "Pascal");
$tblNomFeminin = array("Claudette", "Mauricette", "Georgette", "Annette", "Lucie", "Catherine", "Françoise", "Marie", "Lucette", "Aurélie");

if(isset($_POST['gen_cochon'])){

    for ($i=0; $i < $_POST['nombre_cochon'] ; $i++) {
    
  $Obj_cochon = new cochon("new");
  $sexe = rand(0,1);
  if($sexe == 0){$valSexe = "Male";$nomCochon = $tblNomMasculin[rand(0,9)];} else {$valSexe = "Femelle";$nomCochon = $tblNomFeminin[rand(0,9)];};
  $Obj_cochon->Set('sexe', $valSexe);
  $Obj_cochon->Set('nom', $nomCochon);
  $Obj_cochon->Set('poids', rand(30 , 250));
  $Obj_cochon->Set('taille', rand(50 , 180));
  $Obj_cochon->Set('duree_de_vie', rand(60 , 86400));
}

  echo "<p class='note note-success message-creation'>Vous avez créé ".$_POST['nombre_cochon']." cochon"; if($_POST['nombre_cochon'] > 1 ) echo "s </p>";
    

}

if(isset($_POST['reprod_cochon'])){
    $nb_bebe = rand(4 , 8);

    for ($i=0; $i < $nb_bebe ; $i++) {
    
  $Obj_cochon = new cochon("new");
  $sexe = rand(0,1);
  if($sexe == 0){$valSexe = "Male";$nomCochon = $tblNomMasculin[rand(0,9)];} else {$valSexe = "Femelle";$nomCochon = $tblNomFeminin[rand(0,9)];};
  $Obj_cochon->Set('sexe', $valSexe);
  $Obj_cochon->Set('nom', $nomCochon);
  $Obj_cochon->Set('poids', rand(20 , 160));
  $Obj_cochon->Set('taille', rand(30 , 40));
  $Obj_cochon->Set('duree_de_vie', rand(3600 , 86400));
  $Obj_cochon->Set('id_pere', $_POST['pere']);
  $Obj_cochon->Set('id_mere', $_POST['mere']);
}

  echo "<p class='note note-success message-creation'>Vous avez donné naissance à ".$nb_bebe." cochonnet"; if($nb_bebe > 1) echo "s </p>";
    

}


?>
<h1>Liste des cochons</h1>

<?php

$Obj_cochon = new cochon("empty");
$nb_cochon = ($Obj_cochon->CompteCochonH());

$Obj_cochon = new cochon("empty");
$nb_cochonne = ($Obj_cochon->CompteCochonF());

$Obj_cochon = new cochon("empty");
$nb_cochon_total = ($Obj_cochon->CompteCochon());

$Obj_cochon = new cochon("empty");
$cochon = ($Obj_cochon->SelectAllM());

$Obj_cochon = new cochon("empty");
$cochonne = ($Obj_cochon->SelectAllF());

?>



<div class="gen-cochon">

        <form>
          Filtre :
            <select  name="order">
                <option value="nom" <?php if (isset($_GET['order'])) if ($_GET['order'] == "nom") echo "selected";?> >Nom</option>
                <option value="poids" <?php if (isset($_GET['order'])) if ($_GET['order'] == "poids") echo "selected";?> >Poids</option>
                <option value="taille" <?php if (isset($_GET['order'])) if ($_GET['order'] == "taille") echo "selected";?> >Taille</option>
                <option value="sexe" <?php if (isset($_GET['order'])) if ($_GET['order'] == "sexe") echo "selected";?> >Sexe</option>
                <option value="created_at" <?php if (isset($_GET['order'])) if ($_GET['order'] == "created_at") echo "selected";?> >Date de création</option>
                <option value="duree_de_vie" <?php if (isset($_GET['order'])) if ($_GET['order'] == "duree_de_vie") echo "selected";?> >Durée de vie</option>
                <option value="id_pere" <?php if (isset($_GET['order'])) if ($_GET['order'] == "id_pere") echo "selected";?> >Père</option>
                <option value="id_mere" <?php if (isset($_GET['order'])) if ($_GET['order'] == "id_mere") echo "selected";?> >Mère</option>
                <option value="updated_at" <?php if (isset($_GET['order'])) if ($_GET['order'] == "updated_at") echo "selected";?> >Date de modification</option>

            </select>
            Ordre :
            <select name="sort">
                <option value="ASC" <?php if (isset($_GET['sort'])) if ($_GET['sort'] == "ASC") echo "selected";?>>Croissant</option>
                <option value="DESC" <?php if (isset($_GET['sort'])) if ($_GET['sort'] == "DESC") echo "selected";?>>Décroissant</option>
            </select>
            <input class="btn btn-success bouton" type="submit" value="Appliquer le filtre">
        </form>

        <form action="" method="POST"> <!--  Génération de cochons aléatoires -->
            Génération de cochon :
            <input type="number" name="nombre_cochon" value="">
            <input class="btn btn-success bouton" name="gen_cochon" type="submit" value="Générer">

        </form>

        <form action="" method="POST"> <!--  Reproduction de cochons aléatoires -->
            Reproduction de cochon : <br>
            Père :
            <select name="pere">
                <option value="0">Non renseigné</option>
               <?php foreach ($cochon as $male){
                echo  "<option value='".$male['id_cochon']."'"; echo ">".$male['nom']."</option>"; } ?>
            </select>
            Mère :
            <select name="mere">
                <option value="0">Non renseigné</option>
               <?php foreach ($cochonne as $femelle){
                echo  "<option value='".$femelle['id_cochon']."'"; echo ">".$femelle['nom']."</option>"; } ?>
            </select>

            <input class="btn btn-success bouton" name="reprod_cochon" type="submit" value="Reproduire">

        </form>
</div>
    


<table id="table_id" class="display table table-cochon">
    <thead>
    <tr>
        <th>    
            <?php echo $nb_cochon[0][0]." mâle";if($nb_cochon[0][0] > 1) echo "s";echo "<br>";?>
            <?php echo $nb_cochonne[0][0]." femelle";if($nb_cochonne[0][0] > 1) echo "s";echo "<br>";?>
            <?php echo " Total : ".$nb_cochon_total[0][0]."<br>";?>
        </th>
        <th>Nom</th>
        <th>Poids</th>
        <th>Taille</th>
        <th>Sexe</th>
        <th>Date création</th>
        <th>Durée de vie</th>
        <th>Père</th>
        <th>Mère</th>
        <th>Date modification</th>
    </tr>
</thead>
<tbody>
    <?php


foreach ($result_cochon as $ligne) {

    

?>
    <tr class="ligne_<?php echo $ligne['id_cochon']; ?>">
        <td>
        <a href='index.php?page=form_cochon&id=<?php echo $ligne['id_cochon'];?>'> <i class="fas fa-pen"></i> </a>
        <a href="javascript:deletebox(<?php echo $ligne['id_cochon'];?>, 'cochon');"><i class="fas fa-trash-alt"></i></a>

        </td>
        <td><?php echo $ligne['nom'];?></td>
        <td><?php echo $ligne['poids'];?></td>
        <td><?php echo $ligne['taille'];?></td>
        <td><?php echo $ligne['sexe'];?></td>
        <td><?php echo $ligne['created_at'];?></td>
        <td><?php echo strtotime($ligne['created_at'])+$ligne['duree_de_vie']-time();?></td>
        <td><?php echo $ligne['id_pere'];?></td>
        <td><?php echo $ligne['id_mere'];?></td>
        <td><?php echo $ligne['updated_at'];?></td>
    </tr>

    <?php
    
    if(strtotime($ligne['created_at'])+$ligne['duree_de_vie']-time() <= 0 ) {


        $conn = new BDD();
        $conn->UPDATE('cochon', 'deleted_at', date('Y-m-d H:i:s'), $ligne['id_cochon']);
    
    
    }
    
     } ?>
</tbody>
    

</table>


<script type="text/javascript">

    function deletebox(id, tbl) {
        $('#form_center').show();
        $('#cache_noir').show();

        $.ajax({
            type :'POST',
            dataType : 'html',
            cache : false,
            url : 'ajax/form_delete.php',
            data : {'iddelete' : id, 'tbldelete' : tbl},
            success : function(data) {
                $('#form_center').html(data);
            }
        });
    }

    function confirm_delete(id, tbl){
        $.ajax({
            type :'POST',
            dataType : 'html',
            cache : false,
            url : 'ajax/confirm_delete.php',
            data : {'iddelete' : id, 'tbldelete' : tbl},
            success : function(data) {
                closebox();
                $('.ligne_'+id).hide();
                
            }
        });
    }

    $(function(){
        list_cochon();
    });

    function list_cochon(){
        
    } 

     
  
</script>

</div>