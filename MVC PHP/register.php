<?php
session_start();
require_once 'config/database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

if (isset($_POST["register"])) {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $password2 = $_POST["password2"];

    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email sudah digunakan');</script>";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindValue(":name", $name);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":password", $hashedPassword);

            if ($stmt->execute()) {
                echo "<script>alert('Registrasi berhasil!'); window.location='login.php';</script>";
            } else {
                echo "<script>alert('Registrasi gagal.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="name">Nama:</label>
                <input type="text" name="name" id="name" required>
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required autocomplete="off">
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password2">Konfirmasi Password:</label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>