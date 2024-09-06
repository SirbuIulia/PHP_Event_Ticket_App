<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <title>Bilete Eveniment</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        .bilet {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
            padding: 20px;
            display: inline-block;
            width: 200px;
        }

        .bilet h3 {
            color: #3498db;
        }

        .bilet p {
            margin: 5px 0;
        }

        .buton-adauga {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px;
            width: 80%;
            cursor: pointer;
        }

        .buton-adauga:hover {
            background-color: #2980b9;
        }

        #cos-link {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #3498db;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<header>
    <h1>Bilete Eveniment</h1>
</header>

<a id="cos-link" href="cos_cumparaturi.php">Coș de Cumpărături</a>

<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");

if (isset($_GET['ID'])) {
    $eveniment_id = $_GET['ID'];

    $query = "SELECT * FROM bilete WHERE id_eveniment = $eveniment_id";
    $result = $mysqli->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            echo "<div class='bilet'>";
            echo "<h3>".$row->tip_bilet."</h3>";
            echo "<p><strong>Pret:</strong> ".$row->pret." lei</p>";
            echo "<p><strong>Facilități:</strong> ".$row->facilitati."</p>";
            echo "<button class='buton-adauga' onclick='adaugaInCos(\"".$row->tip_bilet."\")'>Adaugă în Coș</button>";
            echo "</div>";
        }
    } else {
        echo "Nu sunt bilete disponibile pentru acest eveniment.";
    }
} else {
    echo "ID eveniment lipsă.";
}

$mysqli->close();
?>

<script>
    function adaugaInCos(tip_bilet) {
        alert("Ai adăugat în coș un bilet de tip " + tip_bilet + "!");
    }
</script>

</body>
</html>

