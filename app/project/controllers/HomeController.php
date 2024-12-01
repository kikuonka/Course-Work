<?php
    namespace Project\Controllers;

    use Core\Controller;

    class HomeController extends Controller
    {

        public function index()
        {
            $this->title = "Главная страница";
            return $this->render('index');
        }
    }
