<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Kalkulatu faktoriala</h1>
    <form action="POST">
        <label for="zenbakia">Sartu zure zenbakia</label>
        <input type="number" name="zenbakia" id="zenbakia" required>
        
        <br>
        <button type="submit" name="kalkulatu">Kalkulatu</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["kalkulatu"])) {
        $zenbakia = $_POST["zenbakia"];

        $resultado =1;

        for ($i = 0; $i < count($zenbakia); $i++) {
            $resultado = $resultado * $i;
        }

        echo"Faktoriala:{$resultado}";
    }
    ?>
</body>

</html>