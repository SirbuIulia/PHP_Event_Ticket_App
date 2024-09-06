<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari Parteneri</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        header {
            background-color:#333;
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
            background-color: white;
            color: #7d3c98;
        }

        a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
        .modificare {
            background-color: #8e44ad;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 8px;
            text-decoration: none;
        }

        .modificare:hover {
            background-color: #7d3c98;
        }
        .stergere {
            background-color: #8e44ad;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 8px;
            text-decoration: none;
        }

        .stergere:hover {
            background-color: #7d3c98;
        }
        .inserare {
            background-color: #8e44ad;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 8px;
            text-decoration: none;
        }

        .inserare:hover {
            background-color: #7d3c98;
        }
    </style>
</head>
<body>

<header>
    <h1>Parteneri</h1>
</header>

<nav>
    <a href="../Logare/pagina_administrator.php">Acasa</a>
    <a href="../Evenimente/Vizualizare.php">Evenimente</a>
    <a href="../Sponsori/Vizualizare.php">Sponsori</a>
    <a href="../Speakeri/Vizualizare.php">Speakeri</a>
    <a href="../Parteneri/Vizualizare.php">Parteneri</a>
</nav>


<p>
    <?php
    include("C:/xampp/htdocs/PROIECT/Conectare.php");
    if ($result = $mysqli->query("SELECT * FROM parteneri ORDER BY ID"))
    {
        if ($result->num_rows > 0)
        {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>Nume</th><th>Tip Partener</th><th>Adresa</th><th>Contract</th><th>Numar de telefon</th><th>Email</th><th>Website</th><th>ID Eveniment</th><th></th><th></th></tr>";
            while ($row = $result->fetch_object())
            {
                echo "<tr>";
                echo "<td>".$row->Nume."</td>";
                echo "<td>".$row->Tip_Partener."</td>";
                echo "<td>".$row->Adresa."</td>";
                echo "<td>".$row->Contract."</td>";
                echo "<td>".$row->Nr_Tel."</td>";
                echo "<td>".$row->Email."</td>";
                echo "<td>".$row->Website."</td>";
                echo "<td>".$row->ID_EVT."</td>";

                echo "<td><a href='Modificare.php?ID=".$row->ID."' class='modificare'>Modificare</a></td>";
                echo "<td><a href='Stergere.php?ID=".$row->ID."' class='stergere'>Stergere</a></td>";
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
    <a href='Inserare.php?ID=".$row->ID."' class='inserare'> Adaugare partener</a>
</body>
</html>


















