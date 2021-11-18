<?php

class cochon{

    var $id;
    var $tbl = "cochon";

    function __construct($monid)
    {
        if (is_int($monid)) {
            $this->id = $monid;
        } elseif ($monid == "new") {
            $conn = new BDD();
            $this->id = $conn->InsertNew($this->tbl);
        }
    }

    function Set($col, $valeur){
        $conn  =  new BDD();
        $conn->Update($this->tbl, $col, $valeur, $this->id);
    }

    function Get($col){
        $conn = new BDD();
        $result = $conn->Select($this->tbl, $col, $this->id);
        return $result[0][0];
    }

    function SelectAll($sexe = "%", $order = "created_at", $sort = "DESC", $depart, $nbaffichage){
        $conn  =  new BDD();
        $req = "SELECT * FROM ".$this->tbl." WHERE (deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00') AND `sexe` LIKE '".$sexe."' ORDER BY `".$order."` ".$sort." LIMIT ".$depart.", ".$nbaffichage."";  
        return $res = $conn->query($req);
    }

    function CompteCochon($sexe){
        $conn  =  new BDD();
        $req = "SELECT COUNT(*) FROM ".$this->tbl." WHERE (deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00') AND `sexe` LIKE '".$sexe."' ";
        return $res = $conn->query($req);
    }

}
?>