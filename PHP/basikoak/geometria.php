<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuren Azalera Kalkulatu</title>
</head>
<body>
    <h1>Figuren Azalera Kalkulatu</h1>

    <?php
    $mostrarFormulario = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kalkulatu"])) {
        $irudia = $_POST["irudia"];
        $neurriak = $_POST["neurriak"]; // Sin validar todavía

        // Validar que el campo contiene un número válido
        if (!is_numeric($neurriak) || floatval($neurriak) <= 0) {
            echo "<p style='color: red;'>Mesedez, sartu zenbaki bat baliozkoa den aldea edo erradioa zehazteko.</p>";
        } else {
            $neurriak = floatval($neurriak); // Convertir a número para cálculos
            $azalera = 0;

            switch ($irudia) {
                case "karratua":
                    $azalera = $neurriak * $neurriak;
                    echo "<p>Karratuaren azalera: {$azalera} unitate karratu.</p>";
                    break;
                case "zirkulua":
                    $azalera = pi() * pow($neurriak, 2);
                    echo "<p>Zirkuluaren azalera: " . round($azalera, 2) . " unitate karratu.</p>";
                    break;
                case "triangelua":
                    $azalera = ($neurriak * $neurriak) / 2;
                    echo "<p>Triangeluaren azalera: {$azalera} unitate karratu.</p>";
                    break;
                default:
                    echo "<p>Errorea: Irudia ez da baliozkoa.</p>";
            }
            // El formulario no se muestra si todo es correcto
            $mostrarFormulario = false;
        }
    }

    if ($mostrarFormulario): 
    ?>
        <form method="POST" action="">
            <label for="irudia">Irudia:</label>
            <select name="irudia" id="irudia" required>
                <option value="karratua">Karratua</option>
                <option value="zirkulua">Zirkulua</option>
                <option value="triangelua">Triangelua</option>
            </select>
            <br><br>

            <label for="neurriak">Aldea/Erradioa:</label>
            <input type="text" name="neurriak" id="neurriak">
            <br><br>

            <button type="submit" name="kalkulatu">Kalkulatu</button>
        </form>
    <?php endif; ?>
</body>
</html>
