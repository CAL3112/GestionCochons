<?php

    foreach ($result_cochon as $ligne) {
        if(intval($ligne['id_race'])>0) $Obj_Race = new Race(intval($ligne['id_race']));
?>
        <tr class="ligne_<?php echo $ligne['id_cochon']; ?>">
            <td>
            <a href='index.php?page=form_cochon&id=<?php echo $ligne['id_cochon'];?>'> <i class="fas fa-pen"></i> </a>
            <a href="javascript:deletebox(<?php echo $ligne['id_cochon'];?>, 'cochon');"><i class="fas fa-trash-alt"></i></a>

            </td>
            <td><?php echo $ligne['nom'];?></td>
            <td><?php echo date('d/m/Y', strtotime($ligne['date_naissance']));?></td>
            <td><?php echo $ligne['poids'];?></td>
            <td><?php echo $ligne['taille'];?></td>
            <td><?php if(intval($ligne['id_race'])>0) echo $Obj_Race->GET('nom'); ?></td>
            <td><?php echo $ligne['created_at'];?></td>
            <td><?php echo $ligne['updated_at'];?></td>
        </tr>

        <?php } ?>