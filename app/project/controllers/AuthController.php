<?php
    namespace Project\Controllers;
    use Core\Controller;
    use Project\Models\User;

    class AuthController extends Controller {
        public function login() {
            session_start();
            $this->title = 'Авторизация';

            if(!empty($_POST['password']) and !empty($_POST['login'])) {
                $login = $_POST['login'];
                $password = $_POST['password'];

                $userModel = new User();
                $user = $userModel->getUser($login, $password);

                if ($user) {
                    $_SESSION['auth'] = true;
                    $_SESSION['login'] = $login;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['status'] = $user['status'];

                    header('Location: /');
                    exit;
                } else {
                    return $this->render('auth/login');
                }
            }
            return $this->render('auth/login');
        }

        public function logout() {
            session_start();
            session_destroy();
            header('Location: /');
            exit;
        }

        public function register() {
            session_start();
            $this->title = 'Регистрация пользователя';

            if (!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirm']) and !empty($_POST['email']) and !empty($_POST['status'])) {
                if ($_POST['password'] === $_POST['confirm']) {
                    $login = $_POST['login'];
                    $password = $_POST['password'];
                    $email = $_POST['email'];
                    $status = $_POST['status'];

                    $allowedStatuses = ['Администратор', 'Преподаватель', 'Староста', 'Студент'];
                    if (!in_array($status, $allowedStatuses)) {
                        return $this->render('auth/register');
                    }

                    $userModel = new User();
                    $user = $userModel->addUser($login, $email, $password, $status);
                } else {
                    return $this->render('auth/register');
                }
            }
            return $this->render('auth/register');
        }
    }
