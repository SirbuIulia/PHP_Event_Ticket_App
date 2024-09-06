<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualizare Inregistrari Speakeri</title>
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

        nav {
            background-color: #444;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            margin: 0 10px;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <h1>Speakeri</h1>
</header>
<nav>
    <a href="../Logare/pagina_pornire.html">Acasa</a>
    <a href="../Evenimente/Vizualizare_guest.php">Evenimente</a>
    <a href="../Sponsori/Vizualizare_guest.php">Sponsori</a>
    <a href="../Speakeri/Vizualizare_guest.php">Speakeri</a>
    <a href="../Parteneri/Vizualizare_guest.php">Parteneri</a>
</nav>

<?php
include("C:/xampp/htdocs/PROIECT/Conectare.php");
if ($result = $mysqli->query("SELECT * FROM speakeri ORDER BY ID"))
{
    if ($result->num_rows > 0)
    {
        echo "<table>";
        echo "<tr><th>Nume</th><th>Prenume</th><th>Email</th><th>Domeniu</th></tr>";
        while ($row = $result->fetch_object())
        {
            echo "<tr>";
            echo "<td>".$row->Nume."</td>";
            echo "<td>".$row->Prenume."</td>";
            echo "<td>".$row->Email."</td>";
            echo "<td>".$row->Domeniu."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else
    {
        echo " Nu sunt inregistrari in tabela!";
    }
}
else
{
    echo "Error: " .$mysqli->error();
}
$mysqli->close();
?>
</body>
</html>
