<?php

include_once(__DIR__."/../classes/TodoItem.php");

if(!empty($_POST)) {
    $item = new TodoItem();

    $item->deleteItem($_POST["itemID"]);

    $response = [
        'status' => 'success',
        'message' => 'Item deleted!'
    ];
    header('Content-Type: application/json');
    echo json_encode($response); 

}
