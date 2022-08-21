<?php 

class Student extends User {
    public function is_member($email) {
        $conn=Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users WHERE email='$email'");
        $statement->execute();
        $response = $statement->fetch(PDO::FETCH_ASSOC);

        $results = (is_array($response) && count($response) > 0);
        return $results;
    }

    public function can_signup($username, $email, $password)
    {
        try {
            $conn=Db::getConnection();
            $statement = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $statement->bindValue("username", $username);
            $statement->bindValue("email", $email);
            $options = [
                'cost' => 12,
            ];
            $hash = password_hash($password, PASSWORD_DEFAULT,  $options);
            $statement->bindValue("password", $hash);
            return  $statement->execute();
        } catch (Throwable $e) {

            echo $e->getMessage();
        }
    }

    public function can_login($email, $password) {
            $conn=Db::getConnection();
            $statement = $conn->prepare("SELECT * FROM users WHERE email='$email'");
            $statement->execute();
            $user = $statement->fetch();
            $hash = $user['password'];
           if(password_verify($password, $hash)) {
            return true;
           } else {
            return false;
           }
    }
}