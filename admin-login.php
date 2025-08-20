<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['admin'] = $user['id'];
        header("Location: admin-dashboard.html");
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>
<!-- Formulaire HTML identique à admin-login.html, mais action="admin-login.php" method="post" -->