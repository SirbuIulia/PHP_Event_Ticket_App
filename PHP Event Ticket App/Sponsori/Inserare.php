<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");
$error='';

if (isset($_POST['submit']))
{
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $tip_sponsorizare = htmlentities($_POST['tip_sponsorizare'], ENT_QUOTES);
    $nr_tel = htmlentities($_POST['nr_tel'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $adresa = htmlentities($_POST['adresa'], ENT_QUOTES);
    $contract = htmlentities($_POST['contract'], ENT_QUOTES);
    $suma_alocata = htmlentities($_POST['suma_alocata'], ENT_QUOTES);
    $id_evt = htmlentities($_POST['id_evt'], ENT_QUOTES);

    if ($nume == '' || $tip_sponsorizare == '' || $nr_tel == '' || $email == '' || $adresa == ''  || $contract == '' || $suma_alocata == ''  || $id_evt == '' )
    {
        $error = 'ERROR: Campuri goale!';
    }
    else
    {
        if ($stmt = $mysqli->prepare("INSERT into sponsori (Nume, Tip_Sponsorizare, Nr_Tel, Email, Adresa, Contract,Suma_alocata, ID_EVT) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"))
        {
            $stmt->bind_param("ssssssss", $nume, $tip_sponsorizare, $nr_tel, $email, $adresa, $contract, $suma_alocata, $id_evt);
            $stmt->execute();
            $stmt->close();
        }
        else
        {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}

$mysqli->close();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title><?php echo "Inserare sponsor"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #8e44ad;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #8e44ad;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #8e44ad;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>

</head>
<body>
<h1><?php echo "Inserare sponsor"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>

<form action="" method="post">
    <div>
        <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
        <strong>Tip Sponsorizare: </strong> <input type="text" name="tip_sponsorizare" value=""/><br/>
        <strong>Numar de telefon: </strong> <input type="text" name="nr_tel" value=""/><br/>
        <strong>Email: </strong> <input type="text" name="email" value=""/><br/>
        <strong>Adresa: </strong> <input type="text" name="andresa" value=""/><br/>
        <strong>Contract: </strong> <input type="text" name="contract" value=""/><br/>
        <strong>Suma alocata: </strong> <input type="text" name="suma_alocata" value=""/><br/>
        <strong>ID_EVT: </strong> <input type="text" name="id_evt" value=""/><br/>
        <p>

            <input type="submit" name="submit" value="Submit" />
            <a href="Vizualizare.php">Index</a>
    </div>
</form>
</body>
</html>


