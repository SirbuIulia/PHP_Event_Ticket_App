<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 50px;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        button {
            background-color: #8e44ad;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'proiect_evenimente';

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if (mysqli_connect_errno()) {
        exit('Nu se poate conecta la MySQL: ' . mysqli_connect_error());
    }

    $query = "SELECT * FROM utilizatori WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($con, $query);

    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        header('Location: pagina_administrator.php');
        exit;
    } else {
        $error_message = 'Invalid username or password.';
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>


<div class="login-container">
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">   admin  </label>

        <input type="text" id="username" name="username" required>

        <label for="password"> password </label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>

        <?php
        $isUtilizatoriLoggedIn = false;
        if (!$isUtilizatoriLoggedIn) {
            echo '<p> </p>';
            echo '<a href="registration.html" class="register-button">New account</a>';
        } else {
        }
        ?>
    </form>
    <?php if(isset($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php } ?>
</div>

</body>
</html>








