<?php
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
    if (!empty($_SESSION['auth'])) {
        echo '<p>Вы уже авторизованы в системе</p>';
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

<?php if (empty($_SESSION['auth'])): ?>
    <h1>Авторизация пользователя</h1>
    <form action="" method="POST">
        <input name="login" placeholder="Логин">
        <input name="password" type="password" placeholder="Пароль">
        <button type="submit">Войти</button>
    </form>
<?php endif; ?>
