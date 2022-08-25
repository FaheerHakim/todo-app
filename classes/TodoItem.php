<?php
include_once(__DIR__."/../classes/Db.php");

class TodoItem {
    private $userID;
    private $listID; 
    private $text;
    private $time;
    private $date;
    private $comment;

    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    public function getComment() {
      return $this->comment;
  }

  public function setComment($comment) {
      $this->comment = $comment;
      return $this;
  }


    public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
        return $this;
     }

     public function getListID(){
        return $this->listID;
     }
     public function setListID($listID){
        $this->listID = $listID;
        return $this;
     }
     public function getTime(){
        return strlen($this->time) === 0 ? null : $this->time;
     }
     public function setTime($time){
        $this->time = $time;
        return $this;
     }
     public function getDate(){
        return strlen($this->date) === 0 ? null : $this->date;
     }
     public function setDate($date){
        $this->date = $date;
        return $this;
     }

     public function save() {
        $conn=Db::getConnection();
        $statement = $conn->prepare("INSERT INTO todos (userID, listID, text, time, date) VALUES (:userID, :listID, :text, :time, :date)");
        
        $userID = $this->getUserID();
        $text = $this->getText();
        $listID = $this->getListID();
        $time = $this->getTime();
        $date = $this->getDate();

 
        $statement->bindValue(":userID", $userID);
        $statement->bindValue(":text", $text);
        $statement->bindValue(":listID", $listID);
        $statement->bindValue(":time", $time);
        $statement->bindValue(":date", $date);

        $result = $statement->execute();
        return $result;
     }

     public static function getAllTodos($userID){
        $conn=Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM todos WHERE userID = :userID ORDER BY date DESC");
        $statement->bindValue(":userID", $userID);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteItem($itemID) {
      $conn=Db::getConnection();
      $statement = $conn->prepare("DELETE FROM todos WHERE todos.id = $itemID");
      $statement->execute();
    }

    public function saveComment($itemID) {
      $conn=Db::getConnection();
      $statement = $conn->prepare("UPDATE todos SET comment = :comment WHERE id = $itemID");
      $statement->bindValue(":comment", $this->getComment());
      $statement->execute();
    }

    public function checkItem($itemID, $isChecked) {
      $conn=Db::getConnection();
      $statement = $conn->prepare("UPDATE todos SET done = $isChecked WHERE id = $itemID");
      $statement->execute();
    }
}