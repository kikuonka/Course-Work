<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}      
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/project/webroot/style.css">
        <title><?= $title ?></title>
    </head>
    <body>
        <header>
			<div class="logo">
				<a href="/">Посещаемость студентов</a>
            	<?php if (!empty($_SESSION['auth'])): ?>
                	<a href="/logout">Выйти</a>
           	 	<?php endif; ?>
			</div>
            <nav>
                <?php if (empty($_SESSION['auth'])): ?>
                    <a href="/login">Авторизация</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
                    <a href="/register">Регистрация</a>
                    <a href="/students">Список студентов</a>
                    <a href="/attendance">Таблица посещаемости</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['status']) && ($_SESSION['status'] === 'Преподаватель' || $_SESSION['status'] === 'Староста')): ?>
                    <a href="/students">Список студентов</a>
                    <a href="/attendance">Таблица посещаемости</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Студент'): ?>
                    <a href="/attendance">Таблица посещаемости</a>
                <?php endif; ?>
            </nav>
        </header>

        <main>
            <?= $content ?>
        </main>

        <footer>
            <div class="info">
				<div class="info-p">
					<p>2024 Система учета посещаемости студентов с автоматическим оповещением</p>
					<p>Разработано Ефремовой Полиной ИКБО-13-22</p>
					<p>❤️</p>
				</div>
				<div class="info-a">
					<a href="">🐈‍⬛ GitHub</a>
					<a href="">📘 Vk</a>
				</div>
            </div>
        </footer>
    </body>
</html>
