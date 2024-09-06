<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");

$error = '';
$IDValid = true;

if (isset($_POST['submit'])) {
    $nume = isset($_POST['nume']) ? htmlentities($_POST['nume'], ENT_QUOTES) : '';
    $tip_sponsorizare = isset($_POST['tip_sponsorizare']) ? htmlentities($_POST['tip_sponsorizare'], ENT_QUOTES) : '';
    $nr_tel = isset($_POST['nr_tel']) ? htmlentities($_POST['nr_tel'], ENT_QUOTES) : '';
    $email = isset($_POST['email']) ? htmlentities($_POST['email'], ENT_QUOTES) : '';
    $adresa = isset($_POST['domeniu']) ? htmlentities($_POST['adresa'], ENT_QUOTES) : '';
    $contract = isset($_POST['contract']) ? htmlentities($_POST['contract'], ENT_QUOTES) : '';
    $suma_alocata = isset($_POST['suma_alocata']) ? htmlentities($_POST['suma_alocata'], ENT_QUOTES) : '';
    $id_evt = isset($_POST['id_evt']) ? htmlentities($_POST['id_evt'], ENT_QUOTES) : '';

    if ($nume == '' || $tip_sponsorizare == '' || $nr_tel == '' || $email == '' || $adresa == ''|| $contract == '' || $suma_alocata == '' || $id_evt == '' ) {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $mysqli->prepare("UPDATE sponsori SET nume=?, tip_sponsorizare=?, nr_tel=?, email=?, adresa=?, contract=?, suma_alocata=?, id_evt=? WHERE ID=?")) {
            $stmt->bind_param("ssssssssi", $nume, $tip_sponsorizare, $nr_tel, $email, $adresa, $contract, $suma_alocata, $id_evt, $_GET['ID']);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: nu se poate executa update.";
        }
    }
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title><?php echo isset($_GET['ID']) ? "Modificare inregistrare" : ""; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
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
<h1><?php echo isset($_GET['ID']) ? "Modificare Inregistrare" : ""; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>

<form action="" method="post">
    <div>
        <?php
        if (isset($_GET['ID']) && $_GET['ID'] != '') {
            ?>
            <input type="hidden" name="ID" value="<?php echo $_GET['ID']; ?>"/>
            <p>ID: <?php echo $_GET['ID'];

            if ($result = $mysqli->query("SELECT * FROM sponsori WHERE ID='" . $_GET['ID'] . "'")) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object();
                    ?>
                    <input type="hidden" name="ID" value="<?php echo $_GET['ID']; ?>"/>
                    <p>ID: <?php echo $_GET['ID']; ?></p>
                    <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo isset($row->nume) ? $row->nume : ''; ?>"/><br/>
                    <strong>Tip Sponsorizare: </strong> <input type="text" name="tip_sponsorizare" value="<?php echo isset($row->tip_sponsorizare) ? $row->tip_sponsorizare : ''; ?>"/><br/>
                    <strong>Nr Telefon: </strong> <input type="text" name="nr_tel" value="<?php echo isset($row->nr_tel) ? $row->nr_tel : ''; ?>"/><br/>
                    <strong>Email: </strong> <input type="text" name="email" value="<?php echo isset($row->email) ? $row->email : ''; ?>"/><br/>
                    <strong>Adresa: </strong> <input type="text" name="adresa" value="<?php echo isset($row->adresa) ? $row->adresa : ''; ?>"/><br/>
                    <strong>Contract: </strong> <input type="text" name="contract" value="<?php echo isset($row->contract) ? $row->contract : ''; ?>"/><br/>
                    <strong>Suma alocata: </strong> <input type="text" name="suma_alocata" value="<?php echo isset($row->suma_alocata) ? $row->suma_alocata : ''; ?>"/><br/>
                    <strong>ID Eveniment: </strong> <input type="text" name="id_evt" value="<?php echo isset($row->id_evt) ? $row->id_evt : ''; ?>"/><br/>



                    <?php
                } else {
                    echo "ID not found in the database.";
                    $IDValid = false;
                }
            } else {
                echo "Error fetching data from the database.";
                $IDValid = false;
            }
        } else {
            $IDValid = false;
        }
        ?>
        <br/>
        <?php if ($IDValid) : ?>
            <input type="submit" name="submit" value="Submit"/>
        <?php endif; ?>
        <a href="Vizualizare.php">Index</a>
    </div>
</form>
</body>
</html>

<?php
$mysqli->close();
?>


