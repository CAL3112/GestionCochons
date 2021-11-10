<?php

class cochon{

    var $id;
    var $tbl = "cochon";
    var $nbaffichage = 50;
    var  $depart = 0;

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

    function SelectAll($order = "created_at", $sort = "DESC"){//
        $conn  =  new BDD();
        $req = "SELECT * FROM ".$this->tbl." WHERE deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00'   ORDER BY `".$order."` ".$sort." LIMIT ".$this->depart.", ".$this->nbaffichage."";  
        return $res = $conn->query($req);
    }

    function SelectAllM($order = "created_at", $sort = "DESC"){//
        $conn  =  new BDD();
        $req = "SELECT * FROM ".$this->tbl." WHERE (deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00') AND `sexe`='Male' ORDER BY `".$order."` ".$sort." LIMIT ".$this->depart.", ".$this->nbaffichage."";  
        return $res = $conn->query($req);
    }

    function SelectAllF($order = "created_at", $sort = "DESC"){//
        $conn  =  new BDD();
        $req = "SELECT * FROM ".$this->tbl." WHERE (deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00') AND `sexe`='Femelle' ORDER BY `".$order."` ".$sort." LIMIT ".$this->depart.", ".$this->nbaffichage."";  
        return $res = $conn->query($req);
    }

    function CompteCochonH(){
        $conn  =  new BDD();
        $req = "SELECT COUNT(*) FROM ".$this->tbl." WHERE (deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00') AND `sexe`='Male' ";
        return $res = $conn->query($req);
    }

    function CompteCochonF(){
        $conn  =  new BDD();
        $req = "SELECT COUNT(*) FROM ".$this->tbl." WHERE (deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00') AND `sexe`='Femelle' ";
        return $res = $conn->query($req);
    }

    function CompteCochon(){
        $conn  =  new BDD();
        $req = "SELECT COUNT(*) FROM ".$this->tbl." WHERE deleted_at IS NULL OR deleted_at = '000-00-00 00:00:00'";
        return $res = $conn->query($req);
    }

}