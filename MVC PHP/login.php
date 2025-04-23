<?php

session_start();
if( isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require_once 'controllers/UserControllerr.php';
require_once 'config/database.php'; 

// Inisialisasi koneksi database
$db = Database::getInstance();
$conn = $db->getConnection();

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["email"] = $row["email"];

                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Password salah');</script>";
            }
        } else {
            echo "<script>alert('Email tidak ditemukan');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
   
</head>
<body>
    <h1>Silahkan Login</h1>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" required autocomplete="off">
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </li>
            <li>
            <button type="submit" name="login">Login</button>
            </li>
        </ul>
    </form>
    <div class="register-link">
        <p>Belum punya akun? <a href="register.php">Registrasi di sini</a></p>
    </div>
</body>
</html>