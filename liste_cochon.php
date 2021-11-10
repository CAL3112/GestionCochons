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
  $Obj_cochon->Set('duree_de_vie', rand(600 , 604800));
}

  echo "<p class='note note-success'>Vous avez créé ".$_POST['nombre_cochon']." cochon(s)";
    

}


?>
<h1>Liste des cochons</h1>
<div class="container">

    <div class="filtre">

        <form>
          Filtre :
            <select  name="order">
                <option value="nom" <?php if (isset($_GET['order'])) if ($_GET['order'] == "nom") echo "selected";?> >Nom</option>
                <option value="poids" <?php if (isset($_GET['order'])) if ($_GET['order'] == "poids") echo "selected";?> >Poids</option>
                <option value="taille" <?php if (isset($_GET['order'])) if ($_GET['order'] == "taille") echo "selected";?> >Taille</option>
                <option value="sexe" <?php if (isset($_GET['order'])) if ($_GET['order'] == "sexe") echo "selected";?> >Sexe</option>
                <option value="created_at" <?php if (isset($_GET['order'])) if ($_GET['order'] == "created_at") echo "selected";?> >Date de création</option>
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

    </div>

    <div class="nbcochon">

    <?php

    $Obj_cochon = new cochon("empty");
    $nb_cochon = ($Obj_cochon->CompteCochonH());

    $Obj_cochon = new cochon("empty");
    $nb_cochonne = ($Obj_cochon->CompteCochonF());

    $Obj_cochon = new cochon("empty");
    $nb_cochon_total = ($Obj_cochon->CompteCochon());

    ?>
    <?php echo "<br>Il y a ".$nb_cochon[0][0]." cochon(s) en vie. <br>"; ?>
    <?php echo "Il y a ".$nb_cochonne[0][0]." cochonne(s) en vie.<br>"; ?>
    <?php echo "Ce qui nous fait un total de ".$nb_cochon_total[0][0]." cochon(s) en vie.<br>"; ?>

    <!-- <form action="" methode="post">
    <?php  
    //$Obj_cochon = new cochon("empty");
    //$nb_cochon_total = ($Obj_cochon->CochonRandom());
    ?>
    <input type="submit" value="Créer un cochon aléatoire"></form> -->
    
    </div>

<table class="table table-cochon">
    <tr>
        <td></td>
        <td>Nom</td>
        <td>Poids</td>
        <td>Taille</td>
        <td>Sexe</td>
        <td>Date création</td>
        <td>Durée de vie</td>
        <td>Père</td>
        <td>Mère</td>
        <td>Date modification</td>
    </tr>
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
        <td><?php echo $ligne['duree_de_vie'];?></td>
        <td><?php echo $ligne['id_pere'];?></td>
        <td><?php echo $ligne['id_mere'];?></td>
        <td><?php echo $ligne['updated_at'];?></td>
    </tr>

    <?php } ?>

    

</table>
<!-- <div class="pagination">
        <?php

        //for ($i = 1; $i <= ceil($nb_cochon_total[0][0]/5); $i++) {
          //  $debut = 5*($i-1);
        //echo "<a class='lien-pagination' href='index.php?page=liste_cochon&order=".$_GET['order']."&sort=".$_GET['sort']."&depart=".$debut."&nbaffichage=5'>".$i."</a>";  
        //}
                
        ?>
    </div> -->
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

    // $(document).ready(function(){
    //     list_cochon();
    // });


    function list_cochon(){
        
    }   

      
  
</script>

</div>