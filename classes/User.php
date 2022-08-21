<?php

class User
{

        private $username;
        private $email;
        private $password;


        public function setUsername($username)
        {
                if (empty($username)) {
                        throw new Exception("username cannot be empty.");
                        // in de klasse mocht er nooit een echo geschreven
                }
                $this->$username = $username;
                return $this; //??
        }

        public function getUsername()
        {
                return $this->username;
        }


        /**
         * Get the value of lastname
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of lastname
         *
         * @return  self //???
         */
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of password
         */
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of password
         *
         * @return  self
         */
        public function setPassword($password)
        {
                if (empty($password)) {
                        throw new Exception("Password cannot be empty.");
                }
                $this->password = $password;
                return $this;
        }
}
