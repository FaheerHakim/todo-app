<?php

include_once(__DIR__."/../classes/TodoList.php");

if(!empty($_POST)) {
    $list = new TodoList();
    session_start();
    $list->setUserID($_SESSION['userID']);
    $list->setTitle($_POST['title']);

    $list->save();

    $response = [
        'status' => 'success',
        'body' => htmlspecialchars($list->getTitle()),
        'message' => 'List added!'
    ];
    header('Content-Type: application/json');
    echo json_encode($response); 

}
