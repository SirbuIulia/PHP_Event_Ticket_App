<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");
$error='';

if (isset($_POST['submit']))
{
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $tip_partener = htmlentities($_POST['tip_partener'], ENT_QUOTES);
    $adresa = htmlentities($_POST['adresa'], ENT_QUOTES);
    $contract = htmlentities($_POST['contract'], ENT_QUOTES);
    $nr_tel = htmlentities($_POST['nr_tel'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $website = htmlentities($_POST['website'], ENT_QUOTES);


    if ($nume == '' || $tip_partener == '' || $adresa == '' || $contract == '' || $nr_tel == '' || $email == '' || $website == '')
    {
        $error = 'ERROR: Campuri goale!';
    }
    else
    {
        if ($stmt = $mysqli->prepare("INSERT into parteneri (Nume, Tip_Partener, Adresa, Contract, Nr_tel, Email, Website) VALUES (?, ?, ?, ?, ?, ?, ?)"))
        {
            $stmt->bind_param("sssssss", $nume, $tip_partener, $adresa, $contract, $nr_tel, $email, $website);
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
    <title><?php echo "Inserare partener"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php echo "Inserare partener"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>

<form action="" method="post">
    <div>
        <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
        <strong>Tip Partener: </strong> <input type="text" name="tip_partener" value=""/><br/>
        <strong>Adresa: </strong> <input type="text" name="adresa" value=""/><br/>
        <strong>Contract: </strong> <input type="text" name="contract" value=""/><br/>
        <strong>Numar de telefon: </strong> <input type="text" name="nr_tel" value=""/><br/>
        <strong>Email: </strong> <input type="text" name="email" value=""/><br/>
        <strong>Website: </strong> <input type="text" name="website" value=""/><br/>
        <p>

            <input type="submit" name="submit" value="Submit" />
            <a href="Vizualizare.php">Index</a>
    </div>
</form>
</body>
</html>

