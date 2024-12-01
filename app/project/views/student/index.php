<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
    if (empty($_SESSION['auth'])) {
        echo '<p>Пожалуйста, авторизуйтесь!</p>';
    } 
?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 2rem 0;
        font-size: 1rem;
        text-align: left;
        background: #F2EFEA;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 0.8rem;
    }

    table th {
        background-color: #A599B5;
        color: #fff;
        text-align: center;
    }

    table tr:nth-child(even) {
        background-color: #F8F8F8;
    }

    table tr:hover {
        background-color: #EFEFEF;
    }

    table td a {
        color: #0073e6;
        text-decoration: none;
        font-weight: bold;
        margin-right: 0.5rem;
    }

    table td a:hover {
        text-decoration: underline;
        color: #005bb5;
    }

    a {
        color: #403D58 ;
        text-decoration: none; 
    }
</style>

<?php if (!empty($_SESSION['auth'])): ?>
    <?php if (isset($_SESSION['status']) || ($_SESSION['status'] === 'Администратор' || $_SESSION['status'] === 'Преподаватель' || $_SESSION['status'] === 'Староста')): ?>
        <h1>Список студентов</h1>
        <table>
            <thead>
                <tr>
                <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
                        <th>ID</t>
                    <?php endif; ?>
                    <th>ФИО</th>
                    <th>email</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
                            <td><?= $student['id'] ?></td>
                        <?php endif; ?>
                        <td><?= $student['name'] ?></td>
                        <td><?= $student['email'] ?></td>
                        <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
                            <td>
                                <a href="/students/update/<?= $student['id'] ?>/">Редактировать</a>
                                <a href="/students/delete/<?= $student['id'] ?>/" onclick="return confirm('Вы уверены, что хотите удалить этого студента?')">Удалить</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
            <a href="/students/add">Добавить студента</a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
