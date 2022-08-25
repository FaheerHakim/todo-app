<?php

include_once(__DIR__."/../classes/TodoItem.php");

if(!empty($_POST)) {
    $item = new TodoItem();

    $item->checkItem($_POST["itemID"], $_POST["isChecked"]);

    $response = [
        'status' => 'success',
        'message' => 'Item checked!'
    ];
    header('Content-Type: application/json');
    echo json_encode($response); 

}
