<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    //public function showForm() {
        //require __DIR__ . '/../views/auth/login_register.php';
    //}

    public function handleRequest($pdo) {
        $userModel = new User($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['register'])) {
                $name = trim($_POST['name']);
                $email = trim($_POST['email']);
                $password = $_POST['password'];

                if ($userModel->register($name, $email, $password)) {
                    echo "Sikeres regisztráció!";
                } else {
                    echo "Hiba a regisztráció során!";
                }
            }

            if (isset($_POST['login'])) {
                $email = trim($_POST['email']);
                $password = $_POST['password'];

                $user = $userModel->login($email);
                if ($user && password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Hibás adatok!";
                }
            }

            if (isset($_POST['logout'])) {
                session_start();
                session_destroy();
                header("Location: index.php");
                exit();
            }
        }
    }
    
}

?>