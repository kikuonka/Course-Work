<?php
    namespace Project\Models;
    use Core\Model;

    class User extends Model
    {
        public function getUser($login, $password)
        {
            $login = $this->getSave($login);
            $password = $this->getSave($password);
            $query = "
                SELECT * FROM users
                WHERE login = '$login' AND password = '$password'
            ";

            return $this->findOne($query);
       }

       public function addUser($login, $email, $password, $status)
       {
            $login = $this->getSave($login);
            $email = $this->getSave($email);
            $password = $this->getSave($password);

            $query = "INSERT INTO users SET login='$login', email='$email', password='$password', status='$status'";

            return $this->addOne($query);
       }

       public function getUserId()
       {
            return $this->getId();
       }
    }
