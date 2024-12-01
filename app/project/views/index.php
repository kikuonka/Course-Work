<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
    if (empty($_SESSION['auth'])) {
        echo '<p>Пожалуйста, авторизуйтесь!</p>';
    }
?>

<?php if (!empty($_SESSION['auth'])): ?>
    <h1>Добро пожаловать в систему!</h1>
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
        <p>Вы зашли в систему как Администратор</p>
    <?php endif; ?>
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Преподаватель'): ?>
        <p>Вы зашли в систему как Преподаватель</p>
    <?php endif; ?>
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Староста'): ?>
        <p>Вы зашли в систему как Староста вашей группы</p>
    <?php endif; ?>
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Студент'): ?>
        <p>Вы зашли в систему как студент</p>
    <?php endif; ?>
<?php endif; ?>
