<?php
require "Slim/Slim.php";
Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

/* ... */
$app->get("/users/", function () {
   echo json_encode(UserDAO::getUsers());
});

$app->get('/user/:username/', function ($username) {
    echo json_encode(UserDAO::getUserByName($username));
});

$app->delete('/deluser/:id/', function ($userid) {
    echo json_encode(UserDAO::deleteUser($userid));
});

$app->post('/adduser/', function () {
   global $app;
    
   $request = $app->request; 
   $body    = $request->getBody();
   
   $output;
   parse_str($body, $output);
   
   $output = json_encode($output);
   
   echo json_encode(UserDAO::addUser($output));
});

$app->put('/updateuser/', function () {
    global $app;
    
    $request = $app->request();
    $body    = $request->getBody();
    
    $output;
    parse_str($body, $output);
    
    $output = json_encode($output);
    
    echo json_encode(UserDAO::updateUser($output));
});
/* ... */
$app->get("/cats/", function () {
    echo json_encode(CatDAO::getCats());
});

$app->get('/category/:catname/', function ($catname) {
    echo json_encode(CatDAO::getCatByName($catname));
});

$app->delete('/delcat/:id/', function ($catid) {
    echo json_encode(CatDAO::deleteCat($catid));
});

$app->post('/addcat/', function () {
   global $app;
   
   $request = $app->request;
   $body    = $request->getBody();
   
   $output;
   parse_str($body, $output);
   
   $output = json_encode($output);
   
   echo json_encode(CatDAO::addCat($output));
});
/* ... */
$app->get('/task/:userid/:catid/', function ($userid, $catid) {
    echo json_encode(TaskDAO::getTaskByCategory($userid, $catid));
});

$app->delete('/deltask/:taskid/', function ($taskid) {
    echo json_encode(TaskDAO::deleteTask($taskid));
});

$app->post('/addtask/', function () {
     global $app;
     
     $body = $app->request()->getBody();
     
     $output;
     parse_str($body, $output);
     
     $output = json_encode($output);
     
     echo json_encode(TaskDAO::addTask($output));
});
/* ... */

$app->run();
?>