<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");

$error = '';
$IDValid = true;

if (isset($_POST['submit'])) {
    $nume = isset($_POST['nume']) ? htmlentities($_POST['nume'], ENT_QUOTES) : '';
    $tip_partener = isset($_POST['tip_partener']) ? htmlentities($_POST['tip_partener'], ENT_QUOTES) : '';
    $adresa = isset($_POST['adresa']) ? htmlentities($_POST['adresa'], ENT_QUOTES) : '';
    $contract = isset($_POST['contract']) ? htmlentities($_POST['contract'], ENT_QUOTES) : '';
    $nr_tel = isset($_POST['nr_tel']) ? htmlentities($_POST['nr_tel'], ENT_QUOTES) : '';
    $email = isset($_POST['email']) ? htmlentities($_POST['email'], ENT_QUOTES) : '';
    $website = isset($_POST['website']) ? htmlentities($_POST['website'], ENT_QUOTES) : '';

    if ($nume == '' || $tip_partener == '' || $adresa == '' || $contract == '' || $nr_tel == '' || $email == '' || $website == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $mysqli->prepare("UPDATE parteneri SET nume=?, tip_partener=?, adresa=?, contract=?, nr_tel=?, email=?, website=? WHERE ID=?")) {
            $stmt->bind_param("sssssssi", $nume, $tip_partener, $adresa, $contract, $nr_tel, $email, $website, $_GET['ID']);
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

        .error {
            padding: 10px;
            border: 1px solid red;
            color: red;
            border-radius: 5px;
            margin-bottom: 10px;
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
            $evenimentID = isset($_GET['ID_EVT']) ? $_GET['ID_EVT'] : '';
            $partenerID = isset($_GET['partenerID']) ? $_GET['partenerID'] : '';

            if ($result = $mysqli->query("SELECT * FROM parteneri WHERE ID='" . $_GET['ID'] . "'")) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object();
                    ?>
                    <input type="hidden" name="ID" value="<?php echo $_GET['ID']; ?>"/>
                    <p>ID: <?php echo $_GET['ID']; ?></p>
                    <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo isset($row->nume) ? $row->nume : ''; ?>"/><br/>
                    <strong>Tip Partener: </strong> <input type="text" name="tip_partener" value="<?php echo isset($row->tip_partener) ? $row->tip_partener : ''; ?>"/><br/>
                    <strong>Adresa: </strong> <input type="text" name="adresa" value="<?php echo isset($row->adresa) ? $row->adresa : ''; ?>"/><br/>
                    <strong>Contract: </strong> <input type="text" name="contract" value="<?php echo isset($row->contract) ? $row->contract : ''; ?>"/><br/>
                    <strong>Nr Telefon: </strong> <input type="text" name="nr_tel" value="<?php echo isset($row->nr_tel) ? $row->nr_tel : ''; ?>"/><br/>
                    <strong>Email: </strong> <input type="text" name="email" value="<?php echo isset($row->email) ? $row->email : ''; ?>"/><br/>
                    <strong>Website: </strong> <input type="text" name="website" value="<?php echo isset($row->website) ? $row->website : ''; ?>"/><br/>
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
