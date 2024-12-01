<?php
    namespace Project\Models;
    use \Core\Model;

    class Attendance extends Model
    {
        public function getAttendance()
        {
            $query = "
                SELECT students.id, students.name, students.email, attendance.status 
                FROM students
                LEFT JOIN attendance ON students.id = attendance.student_id
            ";
            return $this->findMany($query);
        }

        public function updateStatus($studentId, $status)   
        {
            $studentId = $this->getSave($studentId);
            $status = $this->getSave($status);

            $query = "
                INSERT INTO attendance (student_id, status)
                VALUES ('$studentId', '$status')
                ON DUPLICATE KEY UPDATE status = '$status'
            ";
            return $this->addOne($query);
        }

        public function logNotification($studentId, $attendanceId, $message)
        {
            $studentId = $this->getSave($studentId);
            $attendanceId = $this->getSave($attendanceId);
            $message = $this->getSave($message);

            $query = "INSERT INTO notifications (student_id, attendance_id, message)
                      VALUES ('$studentId', '$attendanceId', '$message')";
            
            return $this->addOne($query);
        }
    }
