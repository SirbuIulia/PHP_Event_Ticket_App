<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");

$error = '';

if (isset($_POST['submit'])) {
    $denumire = isset($_POST['denumire']) ? htmlentities($_POST['denumire'], ENT_QUOTES) : '';
    $data = isset($_POST['data']) ? date('Y-m-d', strtotime($_POST['data'])) : '';
    $ora = isset($_POST['ora']) ? htmlentities($_POST['ora'], ENT_QUOTES) : '';
    $locatie = isset($_POST['locatie']) ? htmlentities($_POST['locatie'], ENT_QUOTES) : '';
    $descriere = isset($_POST['descriere']) ? htmlentities($_POST['descriere'], ENT_QUOTES) : '';
    $website = isset($_POST['website']) ? htmlentities($_POST['website'], ENT_QUOTES) : '';
    $topic = isset($_POST['topic']) ? htmlentities($_POST['topic'], ENT_QUOTES) : '';

    if ($denumire == '' || $data == '' || $ora == '' || $locatie == '' || $descriere == '' || $website == '' || $topic == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $mysqli->prepare("UPDATE evenimente SET denumire=?, data=?, ora=?, locatie=?, descriere=?, website=?, topic=? WHERE ID=?")) {
            $stmt->bind_param("sssssssi", $denumire, $data, $ora, $locatie, $descriere, $website, $topic, $_GET['ID']);
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
            ?>
            <input type="hidden" name="ID" value="<?php echo $_GET['ID']; ?>"/>
            <p>ID: <?php echo $_GET['ID'];
            if ($result = $mysqli->query("SELECT * FROM evenimente where ID='" . $_GET['ID'] . "'")) {

                if ($result->num_rows > 0) {
                    $row = $result->fetch_object();
                    ?>
                    </p>
                    <strong>Denumire: </strong> <input type="text" name="denumire" value="<?php echo isset($row->denumire) ? $row->denumire : ''; ?>"/><br/>
                    <strong>Data: </strong> <input type="text" name="data" value="<?php echo isset($row->data) ? $row->data : ''; ?>"/><br/>
                    <strong>Ora: </strong> <input type="text" name="ora" value="<?php echo isset($row->ora) ? $row->ora : ''; ?>"/><br/>
                    <strong>Locatie: </strong> <input type="text" name="locatie" value="<?php echo isset($row->locatie) ? $row->locatie : ''; ?>"/><br/>
                    <strong>Descriere: </strong> <input type="text" name="descriere" value="<?php echo isset($row->descriere) ? $row->descriere : ''; ?>"/><br/>
                    <strong>Website: </strong> <input type="text" name="website" value="<?php echo isset($row->website) ? $row->website : ''; ?>"/><br/>
                    <strong>Topic: </strong> <input type="text" name="topic" value="<?php echo isset($row->topic) ? $row->topic : ''; ?>"/><br/>
                    <?php
                } else {
                    echo "ID not found in the database.";
                }
            } else {
                echo "Error fetching data from the database.";
            }
        }
        ?>
        <br/>
        <input type="submit" name="submit" value="Submit"/>
        <a href="Vizualizare.php">Index</a>
        <p>
            <?php

            if (isset($_GET['ID']) && $_GET['ID'] != '') {
                echo '<a href="../Parteneri/Vizualizare.php?ID=' . $_GET['ID'] . '" >Parteneri</a>';
                echo ' | ';
                echo '<a href="../Sponsori/Vizualizare.php?ID=' . $_GET['ID'] . '">Sponsori</a>';
                echo ' | ';
                echo '<a href="../Speakeri/Vizualizare.php?ID=' . $_GET['ID'] . '">Speakeri</a>';
            }


            ?>


    </div>
</form>
</body>
</html>
