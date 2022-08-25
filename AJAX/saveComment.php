
<?php

include_once(__DIR__."/../classes/TodoItem.php");

if(!empty($_POST)) {
    $item = new TodoItem();
    $item->setComment($_POST["comment"]);

    $item->saveComment($_POST["itemID"]);

    

    $response = [
        'status' => 'success',
        'body' => htmlspecialchars($item->getText()),
        'message' => 'Comment added!'
    ];
    header('Content-Type: application/json');
    echo json_encode($response); 

}
