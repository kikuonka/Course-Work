<?php
    namespace Project\Controllers;

    require_once __DIR__ . '/vendor/autoload.php';

    use \Core\Controller;
    use \Project\Models\Attendance;
    use \Project\Models\Student;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class AttendanceController extends Controller
    {
        public function index()
        {
            session_start();
            $this->title = 'Таблица посещений';

            $attendanceModel = new Attendance();
            $studentsAttendance = $attendanceModel->getAttendance();

            return $this->render('attendance/index', ['attendance' => $studentsAttendance]);
        }

        public function mark()
        {
            session_start();

            $attendanceModel = new Attendance();
            $studentModel = new Student();

            $statuses = $_POST['status'] ?? [];

            foreach ($statuses as $studentId => $status) {
                $attendanceId = $attendanceModel->updateStatus($studentId, $status);

                if ($attendanceId) {
                    $student = $studentModel->getStudentById($studentId);
                    $this->sendNotificcation($student, $status, $attendanceId);
                    header('Location: /attendance');
                    exit;
                } else {
                    $_SESSION['error'] = "Не удалось обновить статус для студента ID: $studentId.";
                }
            }
        }

        private function sendNotificcation($student, $status, $attendanceId)
        {
            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.yandex.ru';
                $mail->SMTPAuth = true;
                $mail->Username = 'efr-polina2004';
                $mail->Password = 'wgntzilfnsmfggdx';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->setFrom('efr-polina2004@yandex.ru', 'Attendance System');
                $mail->addAddress($student['email'], $student['name']);

                $mail->CharSet = 'UTF-8';

                $mail->isHTML(true);
                $mail->Subject = 'Посещение занятий';
                $mail->Body = "
                    <p>{$student['name']},</p>
                    <p>Ваш статус посещения был изменен на: <b>{$status}</b>.</p>
                    <p>Дата изменения: " . date('Y-m-d H:i:s') . "</p>
                    <p>------------------</p>
                    <p>Если произошла какая-то ошибка и статус посещения неверен,</p>
                    <p>Пожалуйста, обратитесь к старосте или преподавателю!
                ";

                $mail->send();

                $attendanceModel = new Attendance();
                $attendanceModel->logNotification($student['id'], $attendanceId, "Статус изменен на {$status}");
            } catch (Exception $e) {
                echo ("Ошибка отправки email: {$mail->ErrorInfo}");
            }
        }
    }
