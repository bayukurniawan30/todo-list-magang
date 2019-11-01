<?php
    class UsersClass {
        private $pdo;
         
        public function __construct($pdo) 
        {
            $this->pdo = $pdo;
        }
        public function register($data)
        {
            $data = json_decode($data, true);
            $data = array_map('trim', $data);
            $data['created'] = date('Y-m-d H:i:s');
            $username = $data['username'];
            $email    = $data['email'];

            if ($data['password'] == $data['repeatpassword']) {
                $checkUser = $this->pdo->query("SELECT * FROM users WHERE username = '$username' OR email = '$email'");
                if ($checkUser->rowCount() == 0) {
                    unset($data['repeatpassword']);
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    $result  = $this->pdo->prepare("INSERT INTO users(
                        first_name, 
                        last_name, 
                        username, 
                        email, 
                        password,
                        created) 
                    VALUES (:first_name, :last_name, :username, :email, :password, :created)");
                    foreach ($data as $key => &$value) {
                        $field = ':' . $key;
                        $result->bindParam($field, $value);
                    }

                    if($result->execute()) {
                        return true;
                    }
                    else {
                        return false;
                    }
                }
            }
            
            return false;
        }
        public function signin($data)
        {
            $data = json_decode($data, true);
            $data = array_map('trim', $data);
            $username = $data['username'];
            $password = $data['password'];

            $checkUser = $this->pdo->query("SELECT * FROM users WHERE username = '$username' LIMIT 1");
            if ($checkUser->rowCount() > 0) {
                $user = $checkUser->fetch(PDO::FETCH_OBJ);
                if (password_verify($password, $user->password)) {
                    // Set Session
                    $_SESSION['id']       = $user->id;
                    $_SESSION['password'] = $user->password;

                    return true;
                }
            }

            return false;
        }
        public function userData($id)
        {
            $user = $this->pdo->query("SELECT * FROM users WHERE id = '$id' LIMIT 1");
            $user = $user->fetch(PDO::FETCH_OBJ);
            return $user;
        }
    }
?>