<?php

include_once(__DIR__."/../classes/TodoList.php");

if(!empty($_POST)) {
    $list = new TodoList();

    $list->deleteList($_POST["listID"]);

    $response = [
        'status' => 'success',
        'message' => 'List deleted!'
    ];
    header('Content-Type: application/json');
    echo json_encode($response); 

}
