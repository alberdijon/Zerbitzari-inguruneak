<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txanpon bihurgailua</title>
</head>

<body>
    <h1>Txanpon bihurgailua</h1>

    <?php
    $mostrarFormulario = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kalkulatu"])) {
        $izenburura = $_POST["txanpona"];
        $testua = $_POST["kantitatea"]; 

        if (!is_numeric($testua) || intval($testua) <= 0) {
            echo "<p style='color: red;'>Mesedez, sartu zenbaki bat baliozkoa den aldea edo erradioa zehazteko.</p>";
        } else {
            $testua = floatval($testua);
            $azalera = 0;

            switch ($izenburura) {
                case "1":
                    $totala = $testua * 1.08;
                    echo "<p>{$testua} euro {$totala} dolar amerikar dira</p>";
                    break;
                case "2":
                    $totala = $testua * 0.83;
                    echo "<p>{$testua} euro {$totala} libera britaniar dira</p>";
                    break;
                case "3":
                    $totala = $testua * 164.3;
                    echo "<p>{$testua} euro {$totala} yen japoniar dira</p>";
                    break;
                case "4":
                    $totala = $testua *  0.94;
                    echo "<p>{$testua} euro {$totala} franko suitzar dira</p>";
                    break;
                default:
                    echo "<p>Errorea: Kantitatea ez da baliozkoa.</p>";
            }
            $mostrarFormulario = false;
        }
    }

    if ($mostrarFormulario):
    ?>
        <form method="POST" action="">
            <label for="kantitatea">Euro kantitatea:</label>
            <input type="text" name="kantitatea" id="kantitatea">

            <select name="txanpona" id="txanpona" required>
                <option value="1">dolar amerikar</option>
                <option value="2"> libera britaniar</option>
                <option value="3">yen japoniar</option>
                <option value="4">franko suitzar</option>
            </select>
            <label for="irudia">-etan bihurtu</label>
            <br><br>


            <br><br>

            <button type="submit" name="kalkulatu">Kalkulatu</button>
        </form>
    <?php endif; ?>
</body>

</html>