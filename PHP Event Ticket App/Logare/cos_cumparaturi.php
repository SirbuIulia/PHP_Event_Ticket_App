<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eveniment - Bilete</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            padding: 8px;
            margin-bottom: 16px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        #cos-cumparaturi {
            margin-top: 30px;
        }

        b {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            border-bottom: 1px solid #ddd;
            padding: 10px;
            display: flex;
            justify-content: space-between;
        }

        .total {
            font-weight: bold;
            margin-top: 10px;
        }

        .footer {
            margin-top: 30px;
            padding: 10px;
            background-color: #333;
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>

<?php
class Bilet {
    public $id_bilet;
    public $id_eveniment;
    public $denumire_eveniment;
    public $pret;
    public $stoc;

    public function __construct($id_bilet, $id_eveniment, $denumire_eveniment, $pret, $stoc) {
        $this->id_bilet = $id_bilet;
        $this->id_eveniment = $id_eveniment;
        $this->nume_eveniment = $denumire_eveniment;
        $this->pret = $pret;
        $this->stoc = $stoc;
    }
}

class CosCumparaturi {
    private $bilete = array();

    public function adaugaBilet(Bilet $bilet, $cantitate) {
        if ($bilet->stoc >= $cantitate) {
            if (isset($this->bilete[$bilet->id_bilet])) {
                $this->bilete[$bilet->id_bilet]->cantitate += $cantitate;
            } else {
                $bilet->cantitate = $cantitate;
                $this->bilete[$bilet->id_bilet] = $bilet;
            }
            $bilet->stoc -= $cantitate;
        } else {
            echo "Stoc insuficient pentru biletul cu ID " . $bilet->id_bilet;
        }
    }

    public function afiseazaCos() {
        return $this->bilete;
    }

    public function totalPlata() {
        $total = 0;
        foreach ($this->bilete as $bilet) {
            $total += $bilet->pret * $bilet->cantitate;
        }
        return $total;
    }
    public function deleteCartItem($id_cos)
    {
        $query = "DELETE FROM cos_cumparaturi WHERE id_bilet = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id_cos
            )
        );

        $this->updateDB($query, $params);
    }
    function emptyCart($id_utilizator)
    {
        $query = "DELETE FROM cos_cumparaturi WHERE id_utilizator = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id_utilizator
            )
        );

        $this->updateDB($query, $params);
    }

    public function finalizareCumparaturi() {
        $this->bilete = array();
    }
}

$bilet1 = new Bilet(1, 1, "TedxAvramIancu", 50.00, 100);

session_start();

if (!isset($_SESSION['cos_cumparaturi'])) {
    $_SESSION['cos_cumparaturi'] = new CosCumparaturi();
}

if (isset($_POST['adauga_in_cos'])) {
    $cantitate = $_POST['cantitate'];
    $_SESSION['cos_cumparaturi']->adaugaBilet($bilet1, $cantitate);
}
?>

<div class="container">
    <h1>Detalii Eveniment</h1>

    <form method="post" action="">
        <label for="cantitate">Cantitate:</label>
        <input type="number" name="cantitate" value="1" min="1">
        <button type="submit" name="adauga_in_cos">Adaugă în coș</button>
    </form>

    <div id="cos-cumparaturi">
        <h2>Coș de Cumpărături</h2>
        <ul>
            <?php foreach ($_SESSION['cos_cumparaturi']->afiseazaCos() as $bilet_cos) : ?>
                <li>
                    <span><?= $bilet_cos->nume_eveniment; ?></span>
                    <span>Cantitate: <?= $bilet_cos->cantitate; ?></span>
                    <span>Pret: <?= $bilet_cos->pret; ?> RON</span>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="total">Total de plată: <?= $_SESSION['cos_cumparaturi']->totalPlata(); ?> RON</p>
        <button onclick="finalizareCumparaturi()">Finalizează Cumpărăturile</button>
    </div>
</div>

<script>
    function finalizareCumparaturi() {
        alert("Cumpărăturile au fost finalizate!");
        location.reload();
    }
</script>

<div class="footer">
    <p>&copy; 2023 TEDX Events. All rights reserved.</p>
</div>

</body>
</html>
