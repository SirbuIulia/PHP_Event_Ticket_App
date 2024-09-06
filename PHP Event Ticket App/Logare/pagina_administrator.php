<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panou de control administrator</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
        }

        button {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #8e44ad;
            color: #fff;
            border: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .logout-container {
            position: absolute;
            top: 10px;
            right: 50px;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        button:hover {
            background-color: #45a049;
        }


    </style>
</head>
<body>

<h2>Bine ai venit pe panoul de control!</h2>

<button onclick="window.location.href='../Logare/pagina_administrator.php'">Acasa</button>
<button onclick="window.location.href='../Evenimente/Vizualizare.php'">Evenimentele</button>
<button onclick="window.location.href='../parteneri/Vizualizare.php'">Parteneri</button>
<button onclick="window.location.href='../Sponsori/Vizualizare.php'">Sponosori</button>
<button onclick="window.location.href='../Speakeri/Vizualizare.php'">Speakeri</button>

<button class="logout-container" onclick="window.location.href='../Logare/logout.php'">LOGOUT</button>
<script>
    function goHome() {
        window.location.href = '../Logare/pagina_administrator.html';
    }
</script>

</body>
</html>

