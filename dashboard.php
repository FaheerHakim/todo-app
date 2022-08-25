<?php
session_start();
$userID = $_SESSION["userID"];
include_once("bootstrap.php");
$allTodoLists = TodoList::getAllTodoLists($userID);
$allTodos = TodoItem::getAllTodos($userID);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div>
    <h2>Todos</h2>
    <form method="post">
    <div class="add-todo">
    <input class="todo-list-title" name="addList" placeholder="Add a todo here" type="text" />
    <button type="submit" id="submit-todo">Add</button>  
    </div>
    </form>    
    <ul>
                <?php foreach($allTodoLists as $list): ?>
                    <li><?php echo $list["title"] ?><button class="delete-list" data-listid="<?php echo $list["id"] ?>">-</button></li>
                    <?php foreach($allTodos as $item): ?>
                        <?php if($item["listID"]==$list['id']){?>
                            <li><?php echo $item['text'] ?></li> 
                            <?php if($item["done"] == 0) {?>
                                <img data-itemid="<?php echo $item["id"] ?>" class="unchecked-square" src="./assets/unchecked.png" alt="unchecked-square">
                            <?php } else { ?>
                                <img data-itemid="<?php echo $item["id"] ?>" class="checked-square" src="./assets/checked.png" alt="checked-square">
                            <?php }?>
                            <button class="delete-item" data-itemid="<?php echo $item["id"] ?>">delete item</button>
                            <?php if($item["comment"]) echo "-" . $item["comment"]  ?>
                            <button data-itemid="<?php echo $item["id"] ?>" class="add-comment">Comment</button>
                        <?php } ?>
                        <?php endforeach; ?>
                     <button class="add-item" data-listid="<?php echo $list["id"] ?>">+</button>
                    <?php endforeach; ?>
            </ul>
    </div>
        <dialog class="add-comment-dialog">
            <input type="text" class="comment-input">
            <button class="add-comment-button">Add comment</button>
        </dialog>  
    <dialog class="dialog-wrapper">
        <form method="post">
        <input placeholder="add a todo item" type="text" class="todo-list-item">
        <input class="time-picker" type="time">
        <input class="date-picker" type="date" >
        <button type="submit" class="add-item-dialog">add item</button>
        </form>
    </dialog>
        </body>
<script src="app.js"></script>
</html>