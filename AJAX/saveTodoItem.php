
<?php

include_once(__DIR__."/../classes/TodoItem.php");

if(!empty($_POST)) {
    $item = new TodoItem();
    session_start();
    $item->setUserID($_SESSION['userID']);
    $item->setText($_POST['text']);
    $item->setListID($_POST['listID']);
    $item->setTime($_POST['time']);
    $item->setDate($_POST['date']);

    $item->save();

    $response = [
        'status' => 'success',
        'body' => htmlspecialchars($item->getText()),
        'message' => 'Item added!'
    ];
    header('Content-Type: application/json');
    echo json_encode($response); 

}
