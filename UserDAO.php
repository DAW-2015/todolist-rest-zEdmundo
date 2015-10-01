<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserDAO {
   
    public static function getUserByName($username) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "SELECT id, nome, login, email FROM usuarios WHERE login = '$username'");

        return mysqli_fetch_object($handle);   
    }
    
    public static function getUsers() {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "SELECT usuarios.id, usuarios.nome, usuarios.email, usuarios.login FROM usuarios WHERE 1");

        $objs = array();

        while ($row = mysqli_fetch_object($handle)) {
            array_push($objs, $row);
        }
        
        return $objs;
    }
    
    public static function deleteUser($userid) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "DELETE FROM usuarios WHERE id = $userid");
        
        return $handle;
    }
    
    public static function updateUser($object) { 
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        
        $obj = json_decode($object);
        
        $handle = mysqli_query($con, "UPDATE usuarios SET "
                . "nome='$obj->nome',login='$obj->login',email='$obj->email',senha='". md5($obj->senha) . "' WHERE id = $obj->id") or die(mysqli_error($con));
        
        return $handle;
    }
    
    public static function addUser($object) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        
        $obj = json_decode($object);
        
        $handle = mysqli_query($con, "INSERT INTO usuarios (id, nome, login, email, senha) VALUES('', '$obj->nome', '$obj->login', '$obj->email', '" . md5($obj->senha) . "')");
        
        return UserDAO::getUserByName($obj->login);
    }
    
}

?>