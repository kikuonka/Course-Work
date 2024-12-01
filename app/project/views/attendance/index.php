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

    form select {
        width: 100%;
        padding: 0.8rem;
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        box-sizing: border-box;
        background: #F2EFEA;
        color: #403D58;
        appearance: none;
        cursor: pointer;
    }

    form select:focus {
        border-color: #A599B5;
        outline: none;
        box-shadow: 0 0 4px rgba(0, 115, 230, 0.5);
    }

    form option {
        background: #F2EFEA;
        color: #403D58;
        font-size: 1rem;
        padding: 0.5rem;
    }

    button {
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
        color: #F2EFEA;
        background: #403D58;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background: #A599B5;
    }
</style>

<?php if (!empty($_SESSION['auth'])): ?>
    <h1>Таблица посещаемости</h1>
    <form method="POST" action="/attendance/mark">
        <table border="1">
            <tr>
                <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
                    <th>ID</t>
                <?php endif; ?>
                <th>Студент</th>
                <th>email</th>
                <th>Статус</th>
            </tr>
            <?php foreach ($attendance as $student): ?>
                <tr>
                    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
                        <td><?= $student['id'] ?></td>
                    <?php endif; ?>
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= htmlspecialchars($student['email']) ?></td>
                    <td>
                        <?php if (isset($_SESSION['status']) && ($_SESSION['status'] === 'Администратор' || $_SESSION['status'] === 'Преподаватель' || $_SESSION['status'] === 'Староста')): ?>
                            <select name="status[<?= $student['id'] ?>]">
                                <option value="+" <?= isset($student['status']) && $student['status'] === '+' ? 'selected' : '' ?>>Присутствует</option>
                                <option value="-" <?= isset($student['status']) && $student['status'] === '-' ? 'selected' : '' ?>>Отсутствует</option>
                                <option value="ОП" <?= isset($student['status']) && $student['status'] === 'ОП' ? 'selected' : '' ?>>Опоздал</option>
                                <option value="Б" <?= isset($student['status']) && $student['status'] === 'Б' ? 'selected' : '' ?>>Болен</option>
                            </select>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Студент'): ?>
                            <?= htmlspecialchars($student['status']) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php if (isset($_SESSION['status']) && ($_SESSION['status'] === 'Администратор' || $_SESSION['status'] === 'Преподаватель' || $_SESSION['status'] === 'Староста')): ?>
        <button type="submit">Обновить</button>
        <?php endif; ?>
    </form>
<?php endif; ?>
