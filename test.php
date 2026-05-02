<?php

class User {
    public $email;
    private $password;
    
    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }
    
    public function checkPassword($pwd) {
        return $this->password == $pwd;  // ← Compare dedans
    }
}

$user = new User("alice@email.com", "secret123");
echo $user->email;                      // ← Ok, public
var_dump($user->checkPassword("secret123"));  // ← Ok
// echo $user->password;                // ← ERROR! private