<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");
$error='';

if (isset($_POST['submit']))
{
    $denumire = htmlentities($_POST['denumire'], ENT_QUOTES);
    $data = date('Y-m-d', strtotime($_POST['data']));
    $ora = htmlentities($_POST['ora'], ENT_QUOTES);
    $locatie = htmlentities($_POST['locatie'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $website = htmlentities($_POST['website'], ENT_QUOTES);
    $topic = htmlentities($_POST['topic'], ENT_QUOTES);

    if ($denumire == '' || $data == '' || $ora == '' || $locatie == '' || $descriere == '' || $website == '' || $topic == '')
    {
        $error = 'ERROR: Campuri goale!';
    }
    else
    {
        if ($stmt = $mysqli->prepare("INSERT into evenimente (Denumire, Data, Ora, Locatie, Descriere, Website,Topic) VALUES (?, ?, ?, ?, ?, ?, ?)"))
        {
            $stmt->bind_param("sssssss", $denumire, $data, $ora, $locatie, $descriere, $website, $topic);
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
    <title><?php echo "Inserare eveniment"; ?></title>
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
<h1><?php echo "Inserare eveniment"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>

<form action="" method="post">
    <div>
        <strong>Denumire: </strong> <input type="text" name="denumire" value=""/><br/>
        <strong>Data: </strong> <input type="text" name="data" value=""/><br/>
        <strong>Ora: </strong> <input type="text" name="ora" value=""/><br/>
        <strong>Locatie: </strong> <input type="text" name="locatie" value=""/><br/>
        <strong>Descriere: </strong> <input type="text" name="descriere" value=""/><br/>
        <strong>Website: </strong> <input type="text" name="website" value=""/><br/>
        <strong>Topic: </strong> <input type="text" name="topic" value=""/><br/>
        <p>

        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare.php">Index</a>
    </div>
</form>
</body>
</html>
