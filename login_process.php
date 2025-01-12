<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hashing password

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login berhasil!";
        // Redirect ke dashboard atau halaman lain
        header("Location: index.php");
        exit();
    } else {
        echo "Email atau password salah!";
    }

    $stmt->close();
}
$conn->close();
?>
