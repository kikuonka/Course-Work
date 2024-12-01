<?php
    namespace Project\Models;
    use Core\Model;

    class Student extends Model
    {
        public function getAllStudent() 
        {
            return $this->findMany("SELECT * FROM students");
        }
        
        public function getStudentById($id)
        {
            $id = intval($id);
            $query = "
                SELECT * FROM students
                WHERE id = $id
            ";
            
            return $this->findOne($query);
        }

        public function addStudent($name, $email)
        {
            $save_name = $this->getSave($name);
            $save_email = $this->getSave($email);
            
            return $this->addOne("INSERT INTO students (name, email) VALUES ('$save_name', '$save_email')");
        }

        public function deleteStudent($id)
        {
            $id = intval($id);
            $query = "
                DELETE FROM students
                WHERE id = $id;
            ";

            return $this->deleteOne($query);
        }

        public function updateStudent($id, $name, $email)
        {
            $id = intval($id);
            $name = $this->getSave($name);
            $email = $this->getSave($email);
            $query = "
                UPDATE students
                SET name = '$name', email = '$email'
                WHERE id = $id
            ";

            return $this->updateOne($query);
        }
    }
