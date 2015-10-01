<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaskDAO {
    
    public static function getTaskByCat($userid, $catid) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "SELECT tarefas.title, tarefas.descricao, categorias.nome FROM tarefas"
                . " INNER JOIN usuarios ON tarefas.usuarios_id = usuarios.id"
                . " INNER JOIN categorias ON tarefas.categorias_id = categorias.id"
                . " WHERE tarefas.usuarios_id = $userid AND tarefas.categorias_id = $catid") or die(mysqli_error($con));

        $objs = array();

        while ($row = mysqli_fetch_object($handle)) {
            array_push($objs, $row);
        }
    
        return $objs;
    }
    
    public static function deleteTask($taskid) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        $handle = mysqli_query($con, "DELETE FROM tarefas WHERE id = $taskid");
        
        return $handle;
    }
    
    public static function addTask($object) {
        $con = mysqli_connect("150.164.102.160", "daw-aluno8", "edmundo", "daw-aluno8");
        
        $obj = json_decode($object);
        
        $handle = mysqli_query($con, "INSERT INTO tarefas (id, title, descricao, categorias_id, usuarios_id) VALUES ('', '$obj->title', '$obj->descricao', $obj->catid, $obj->userid)");
    
        return $handle;
    }
    
}

?>