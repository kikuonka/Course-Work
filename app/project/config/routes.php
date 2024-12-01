<?php
	use \Core\Route;
	
	return [
		new Route('/', 'home', 'index'),
		new Route('/attendance', 'attendance', 'index'),
		new Route('/attendance/mark', 'attendance', 'mark'),
		new Route('/login', 'auth', 'login'),
		new Route('/register', 'auth', 'register'),
		new Route('/logout', 'auth', 'logout'),
		new Route('/students', 'student', 'index'),
		new Route('/students/add', 'student', 'add'),
		new Route('/students/update/:id/', 'student', 'update'),
		new Route('/students/delete/:id/', 'student', 'delete'),
	];
	