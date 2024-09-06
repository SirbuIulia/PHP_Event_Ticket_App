<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $tip_utilizator = $_POST['tip_utilizator'];

    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'proiect_evenimente';

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
        exit('Nu se poate conecta la MySQL: ' . mysqli_connect_error());
    }

    $query = "SELECT * FROM utilizatori WHERE username = ? AND tip_utilizator = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "ss", $username, $tip_utilizator);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            if ($tip_utilizator === 'admin') {
                header('Location: pagina_administrator.php');
            } else {
                header('Location: pagina_utilizator.php');
            }
            exit;
        } else {
            echo 'Invalid username or password.';
        }
    } else {
        echo 'Invalid username or password.';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
