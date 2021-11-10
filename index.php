<?php

if(isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'liste_cochon';
}

$tbl_classes = scandir('classes');

foreach ($tbl_classes as $oneclass){
    if ($oneclass != '.' && $oneclass != '..') include ("classes/".$oneclass);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Cochons</title>
    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.css"
            rel="stylesheet"
    />
    <!-- style PERSO -->
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!-- MDB -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.5.0/mdb.min.js"
    ></script>
    <script
			  src="https://code.jquery.com/jquery-1.12.4.js"
			  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
			  crossorigin="anonymous">
    </script>
    
</head>
<body>
    <div id="form_center">
        <!-- <input type="button" value ="Annuler" onClick="closebox();"> -->
    </div>
    <div id="cache_noir"></div>
<!-- contient tout le site -->
<div class="container">
    <!-- contient logo + le menu -->
    <div class="top">
        <!-- Menu de navigation -->
        <?php include('menu.php'); ?>
    </div>
    <!-- contient contenu de la page -->
    <?php include($page.'.php'); ?>
    <!-- contient informations légales + liens -->
    <div class="footer">
    </div>
</div>

</body>

<script>

    function closebox(){
        $('#form_center').hide();
        $('#cache_noir').hide();
    }

</script>

</html>