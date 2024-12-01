<?php
    namespace Project\Controllers;
    use Core\Controller;
    use Project\Models\Student;

    class StudentController extends Controller
    {
        public function index()
        {
            $this->title = 'Список студентов';

            $model = new Student();
            $students = $model->getAllStudent();
            return $this->render('student/index', ['students' => $students]);
        }

        public function add()
        {
            $this->title = 'Добавить студента';
            
            if ($_POST) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $model = new Student();
                $model->addStudent($name, $email);
                header("Location: /students");
            } else {
                return $this->render('student/add');
            }
        }

        public function update($params)
        {
            $this->title = 'Редактировать студента';

            $studentModel = new Student();
            $student = $studentModel->getStudentById($params['id']);

            if ($_POST) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $studentModel->updateStudent($params['id'], $name, $email);
                header("Location: /students");
            } else {
                return $this->render('student/update', ['student' => $student]);
            }
        }

        public function delete($params)
        {
            $studentModel = new Student();
            $studentModel->deleteStudent($params['id']);
            header("Location: /students");
        }
    }
