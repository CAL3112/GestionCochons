<?php


class BDD {

    var $host = "localhost";
    var $user = "lucas"; //"root"
    var $pasw = "lucas2021*"; //""
    var $dbname = "cochon";

    var $db = "";

    function __construct(){

        try {
            $this->db = new
            PDO("mysql:host=".$this->host.";dbname=".$this->dbname, $this->user, $this->pasw);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e) {
            echo "Erreur :".$e->getMessage()."<br/>";
        }
    }

    function Query($req){
        $myreq = explode(' ', $req);
        $res = $this->db->query($req);
        if($myreq[0]=='SELECT')$res = $res->fetchAll();
        if($myreq[0]=='INSERT')$res = $this->db->lastInsertId();
        return $res;
    }

    function InsertNew($table){
        $requete = "INSERT INTO ".$table." (`id_".$table."`, `created_at`) VALUES (NULL, '".date('Y-m-d H:i:s')."');";
        return $this->Query($requete);
    }


    function Update($table, $col, $value, $id){

        $requete = "UPDATE `".$table."` SET `".$col."` = '".$value."', `updated_at` = '".date('Y-m-d H:i:s')."' WHERE `id_".$table."` = ".$id."";
        $this->Query($requete);
    }

    function Select($table, $col, $id){
        $requete = "SELECT `".$col."` FROM `".$table."` WHERE `id_".$table."` = ".$id." ";
        return $this->Query($requete);
    }

}
