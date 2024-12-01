<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['auth'])) {
        echo '<p>Пожалуйста, авторизуйтесь!</p>';
    }     
?>

<style>
    form {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: #A599B5;
        padding: 2rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        margin: 2rem auto;
    }

    form input {
        color: #A599B5;
        width: 100%;
        padding: 0.8rem; 
        margin-bottom: 1rem;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        box-sizing: border-box;
        background: #F2EFEA;
    }

    form input:focus {
        border-color: #A599B5;
        outline: none;
        box-shadow: 0 0 4px rgba(0, 115, 230, 0.5);
    }

    form button {
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
        color: #403D58;
        background: #F2EFEA;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    form button:hover {
        background: #A599B5;
    }
</style>

<?php if (!empty($_SESSION['auth'])): ?>
    <?php if (isset($_SESSION['status']) && $_SESSION['status'] === 'Администратор'): ?>
        <h1>Добавить студента</h1>
        <form method="POST" action="/students/add">
            <label>ФИО: <input type="text" name="name" required></label>
            <label>Email: <input type="email" name="email" required></label>
            <button type="submit">Добавить</button>
        </form>
    <?php endif; ?>
<?php endif; ?>
