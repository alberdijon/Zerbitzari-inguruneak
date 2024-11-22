<?php
session_start();

if (!isset($_SESSION['votes'])) {
    $_SESSION['votes'] = ['bai' => 0, 'ez' => 0];
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Bidali"])) {
    $respuesta = $_POST["erantzuna"];
    $_SESSION['votes'][$respuesta]++;
    $_SESSION['last_vote'] = $respuesta;
    header("Location: " . $_SERVER['PHP_SELF'] . "?confirm=true");
    exit;
}

$showResults = isset($_GET['results']);
?>

<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inkesta</title>
    <style>
        .chart-container {
            width: 50%;
            margin: auto;
            text-align: center;
        }
        canvas {
            max-width: 100%;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<?php if (!$showResults && !isset($_GET['confirm'])): ?>
    <h1 id="titulo">Inkesta bete</h1>
    <form method="POST" action="">
        <label for="textua">Etxebizitzaren prezioa igotzen jarraituko duela uste duzu?</label><br>
        <input type="radio" id="bai" name="erantzuna" value="bai" required>
        <label for="bai">BAI</label><br>
        <input type="radio" id="ez" name="erantzuna" value="ez" required>
        <label for="ez">EZ</label><br><br>
        <button type="submit" name="Bidali">Bidali</button>
    </form>
<?php elseif (isset($_GET['confirm'])): ?>
    <h1>Zure erantzuna erregistratu dugu.</h1>
    <button onclick="window.location.href='?results=true';">Emaitzak</button>
<?php elseif ($showResults): ?>
    <div class="chart-container">
        <canvas id="resultsChart"></canvas>
    </div>
    <p>Jasotako bozkak guztira: <?= array_sum($_SESSION['votes']) ?></p>
    <button onclick="window.location.href='<?= $_SERVER['PHP_SELF'] ?>';">Bueltatu bozkatzeko orrira</button>

    <script>
        const ctx = document.getElementById('resultsChart').getContext('2d');
        const chartData = {
            labels: ['Bai', 'Ez'],
            datasets: [{
                data: [<?= $_SESSION['votes']['bai'] ?>, <?= $_SESSION['votes']['ez'] ?>],
                backgroundColor: ['#36a2eb', '#ff6384'],
            }]
        };

        new Chart(ctx, {
            type: 'pie',
            data: chartData,
        });
    </script>
<?php endif; ?>

</body>
</html>
