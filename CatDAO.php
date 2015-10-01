<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CatDAO {
    
    public static function getCatByName($catname) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "SELECT * FROM categorias WHERE nome = '$catname'");
    
        return mysqli_fetch_object($handle);
    } 
    
    public static function getCats() {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "SELECT categorias.id, categorias.nome FROM categorias WHERE 1");

        $objs = array();

        while ($row = mysqli_fetch_object($handle)) {
            array_push($objs, $row);
        }
    
        return $objs;
    }
    
    public static function deleteCat($catid) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "DELETE FROM categorias WHERE id = $catid");
        
        return $handle;
    }
    
    public static function addCat($object) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        
        $obj = json_decode($object);
        
        $handle = mysqli_query($con, "INSERT INTO categorias (id, nome) VALUES ('', '$obj->nome')");
        
        return CatDAO::getCatByName($obj->nome);
    }
    
}

?>