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

if(isset($_GET['decalage'])) {
    $decalage = $_GET['decalage'];
} else {
    $decalage = 0;
}

if(isset($_GET['nbaffichage'])) {
    $nbaffichage = $_GET['nbaffichage'];
} else {
    $nbaffichage = 5;
}
if(isset($_GET['sexe'])) {
    $sexe = $_GET['sexe'];
} else {
    $sexe = "%";
}

$Obj_cochon = new cochon("empty");
$result_cochon = ($Obj_cochon->SelectAll($sexe, $order, $sort, $decalage, $nbaffichage));
$Obj_cochon = new cochon("empty");
$nb_cochon = ($Obj_cochon->CompteCochon("Male"));
$Obj_cochon = new cochon("empty");
$nb_cochonne = ($Obj_cochon->CompteCochon("Femelle"));
$Obj_cochon = new cochon("empty");
$nb_cochon_total = ($Obj_cochon->CompteCochon("%"));


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
$nb_cochon = ($Obj_cochon->CompteCochon("Male"));

$Obj_cochon = new cochon("empty");
$nb_cochonne = ($Obj_cochon->CompteCochon("Femelle"));

$Obj_cochon = new cochon("empty");
$nb_cochon_total = ($Obj_cochon->CompteCochon("%"));

$Obj_cochon = new cochon("empty");
$cochon = ($Obj_cochon->SelectAll("Male", $order, $sort, $decalage, $nbaffichage));

$Obj_cochon = new cochon("empty");
$cochonne = ($Obj_cochon->SelectAll("Femelle", $order, $sort, $decalage, $nbaffichage));

?>



<div class="gen-cochon">

        <form>
            <div class="ligne">
            <div class="mr">Tri : </div>
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
            </div>
            <div class="ligne">
            <div>Ordre :</div>
                <select name="sort">
                    <option value="ASC" <?php if (isset($_GET['sort'])) if ($_GET['sort'] == "ASC") echo "selected";?>>Croissant</option>
                    <option value="DESC" <?php if (isset($_GET['sort'])) if ($_GET['sort'] == "DESC") echo "selected";?>>Décroissant</option>
                </select>
            </div>
            <div class="ligne">
            <div>Filtre :</div>
        <select name="sexe">
            <option value="%">Tout</option>
            <option value="Male" <?php if (isset($_GET['sexe'])) if ($_GET['sexe'] == "Male") echo "selected";?>>Mâle</option>
            <option value="Femelle" <?php if (isset($_GET['sexe'])) if ($_GET['sexe'] == "Femelle") echo "selected";?>>Femelle</option>
        </select>
    </div>
    <div class="ligne">
           <div>Nombre affiché :</div>
           <div>
               <select name="nbaffichage">
                    <option value="5" <?php if (isset($_GET['nbaffichage'])) if ($_GET['nbaffichage'] == 5) echo "selected";?>>5</option>
                    <option value="15" <?php if (isset($_GET['nbaffichage'])) if ($_GET['nbaffichage'] == 15) echo "selected";?>>15</option>
                    <option value="25" <?php if (isset($_GET['nbaffichage'])) if ($_GET['nbaffichage'] == 25) echo "selected";?>>25</option>
                    <option value="50" <?php if (isset($_GET['nbaffichage'])) if ($_GET['nbaffichage'] == 50) echo "selected";?>>50</option>
                    <option value="75" <?php if (isset($_GET['nbaffichage'])) if ($_GET['nbaffichage'] == 75) echo "selected";?>>75</option>
                    <option value="100" <?php if (isset($_GET['nbaffichage'])) if ($_GET['nbaffichage'] == 100) echo "selected";?>>100</option>
                </select>
            </div>             
    </div>
            <input class="btn btn-success bouton" type="submit" value="Appliquer">
        </form>

        <form action="" method="POST"> <!--  Génération de cochons aléatoires -->
            Génération de cochon :
            <input type="number" name="nombre_cochon" value="">
            <input class="btn btn-success bouton" name="gen_cochon" type="submit" value="Générer">

        </form>

        <form action="" method="POST"> <!--  Reproduction de cochons aléatoires -->
            Reproduction de cochon : <br>
            <div>
                Père :
                <select name="pere">
                    <option value="0">Non renseigné</option>
                <?php foreach ($cochon as $male){
                    echo  "<option value='".$male['id_cochon']."'"; echo ">N° ".$male['id_cochon']." | ".$male['nom']."</option>"; } ?>
                </select>
            </div>
            <div>
                Mère :
                <select name="mere">
                    <option value="0">Non renseigné</option>
                <?php foreach ($cochonne as $femelle){
                    echo  "<option value='".$femelle['id_cochon']."'"; echo ">N° ".$femelle['id_cochon']." | ".$femelle['nom']."</option>";}?>
                </select>
            </div>
            <input class="btn btn-success bouton" name="reprod_cochon" type="submit" value="Reproduire">

        </form>
</div>
    
<div class="div-pagination"> <!-- pagination -->
    <?php 
    
    if($_GET['sexe'] == "%") {    
    
    if($nb_cochon_total[0][0] > $nbaffichage) 
            for($i=1; $i < ($nb_cochon_total[0][0] / $nbaffichage)+1; $i++){ 
                echo "<a href='index.php?order=";
                if(isset($_GET['order'])){
                    echo $_GET['order'];
                } else {
                    echo "created_at";};

                    echo "&sort=";

                if(isset($_GET['sort'])){
                    echo $_GET['sort'];
                } else {
                    echo "DESC";};

                    echo "&sexe=";

                if(isset($_GET['sexe'])){
                    echo $_GET['sexe'];
                } else {
                    echo "%";};

                    echo "&nbaffichage=";

                if(isset($_GET['nbaffichage'])){
                echo $_GET['nbaffichage'];
                } else { 
                    echo "5";};

                    echo "&decalage=";
               
                    echo ($i-1)*$nbaffichage;

                    echo "' class='lien-pagination";
                    if($_POST['decalage'] == $_POST['nbaffichage']/($i-1)) echo " actif";
                    echo "'>".$i."</a><span class='span-lien-pagination'>|</span>";
            }
};
if($_GET['sexe'] == "Male") {    
    
    if($nb_cochon[0][0] > $nbaffichage) 
            for($i=1; $i < ($nb_cochon[0][0] / $nbaffichage)+1; $i++){ 
                echo "<a href='index.php?order=";
                if(isset($_GET['order'])){
                    echo $_GET['order'];
                } else {
                    echo "created_at";};

                    echo "&sort=";

                if(isset($_GET['sort'])){
                    echo $_GET['sort'];
                } else {
                    echo "DESC";};

                    echo "&sexe=";

                if(isset($_GET['sexe'])){
                    echo $_GET['sexe'];
                } else {
                    echo "%";};

                    echo "&nbaffichage=";

                if(isset($_GET['nbaffichage'])){
                echo $_GET['nbaffichage'];
                } else { 
                    echo "5";};

                    echo "&decalage=";
               
                    echo ($i-1)*$nbaffichage;

                    echo "' class='lien-pagination";
                    if($_POST['decalage'] == $_POST['nbaffichage']/($i-1)) echo " actif";
                    echo "'>".$i."</a><span class='span-lien-pagination'>|</span>";
            }
};
if($_GET['sexe'] == "Femelle") {    
    
    if($nb_cochonne[0][0] > $nbaffichage) 
            for($i=1; $i < ($nb_cochonne[0][0] / $nbaffichage)+1; $i++){ 
                echo "<a href='index.php?order=";
                if(isset($_GET['order'])){
                    echo $_GET['order'];
                } else {
                    echo "created_at";};

                    echo "&sort=";

                if(isset($_GET['sort'])){
                    echo $_GET['sort'];
                } else {
                    echo "DESC";};

                    echo "&sexe=";

                if(isset($_GET['sexe'])){
                    echo $_GET['sexe'];
                } else {
                    echo "%";};

                    echo "&nbaffichage=";

                if(isset($_GET['nbaffichage'])){
                echo $_GET['nbaffichage'];
                } else { 
                    echo "5";};

                    echo "&decalage=";
               
                    echo ($i-1)*$nbaffichage;

                    echo "' class='lien-pagination";
                    if($_POST['decalage'] == $_POST['nbaffichage']/($i-1)) echo " actif";
                    echo "'>".$i."</a><span class='span-lien-pagination'>|</span>";
            }
};
    ?>
</div>
</form>

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