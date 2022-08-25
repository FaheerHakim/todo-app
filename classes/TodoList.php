<?php
include_once(__DIR__."/../classes/Db.php");

class TodoList {
    private $userID;
    private $title;
    private $time;
    private $date;

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
        return $this;
    }

    public function setTime($time) {
        $this->time = $time;
        return $this;
    }
    public function getTime() {
        return $this->time;
    }

    public function setDate($date) {
        $this->date = $date;
        return $this;
    }
    public function getDate() {
        return $this->date;
    }

    public function save() {
       $conn=Db::getConnection();
       $statement = $conn->prepare("INSERT INTO todoList (userID, title) VALUES (:userID, :title)");
       
       $userID = $this->getUserID();
       $title = $this->getTitle();

       $statement->bindValue(":userID", $userID);
       $statement->bindValue(":title", $title);

       $result = $statement->execute();
       return $result;
    }

    public static function getAllTodoLists($userID){
        $conn=Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM todoList WHERE userID = :userID");
        $statement->bindValue(":userID", $userID);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteList($listID) {
        $conn=Db::getConnection();
        $statementList = $conn->prepare("DELETE FROM todolist WHERE todolist.id = $listID");
        $statementTodos = $conn->prepare("DELETE FROM todos WHERE todos.listID = $listID");

        $statementList->execute();
        $statementTodos->execute();
    } 
}