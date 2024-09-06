<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari Parteneri</title>
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
<body>
<body>
<header>
    <h1>Sponsori</h1>
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
if ($result = $mysqli->query("SELECT * FROM parteneri ORDER BY ID"))
{
    if ($result->num_rows > 0)
    {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>Nume</th><th>Tip Partener</th><th>Adresa</th><th>Email</th><th>Website</th></tr>";
        while ($row = $result->fetch_object())
        {
            echo "<tr>";
            echo "<td>".$row->Nume."</td>";
            echo "<td>".$row->Tip_Partener."</td>";
            echo "<td>".$row->Adresa."</td>";
            echo "<td>".$row->Email."</td>";
            echo "<td>".$row->Website."</td>";


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
{ echo "Error: " .$mysqli->error(); }
$mysqli->close();
?>
<p>

</body>
</html>

