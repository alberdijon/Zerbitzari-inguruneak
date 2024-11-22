<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Txanpon bihurgailua</title>
</head>

<body>

    <?php
    $mostrarFormulario = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Bidali"])) {
        $izenburua = $_POST["izenburua"];
        $testua = $_POST["Testua"];
        $mota = $_POST["mota"];
        
        if (isset($_FILES["irudia"])) {
            $irudia = $_FILES["irudia"];

            if ($irudia["error"] === UPLOAD_ERR_OK) {
                $tempFilePath = $irudia["tmp_name"];
                $fileName = basename($irudia["name"]);
                $imageInfo = getimagesize($tempFilePath);

                if ($imageInfo === false) {
                    echo "<p style='color: red;'>Igotako fitxategia ez da irudi bat. Mesedez, saiatu berriro.</p>";
                } else {
                    $destination = "uploads/" . $fileName;
                    if (move_uploaded_file($tempFilePath, $destination)) {
                        echo "<h1>Fitxategiak igo. Formularioen emaitza</h1>";
                        echo "<p>Berria ondo jaso da:</p>";
                        echo "<p>Izenburua: {$izenburua}</p>";
                        echo "<p>Testua: {$testua}</p>";
                        if ($mota != null) {
                            echo "<p>Kategoria: {$mota}</p>";
                        }
                        echo "<p>Irudia ondo igo da: <a href='{$destination}' download>{$fileName}</a></p>";
                        $mostrarFormulario = false;
                    } else {
                        echo "<p style='color: red;'>Errorea fitxategia gordetzean. Saiatu berriro.</p>";
                    }
                }
            } else {
                echo "<p style='color: red;'>Errore bat gertatu da fitxategia igotzean. (Error kodea: {$irudia["error"]})</p>";
            }
        } else {
            echo "<p style='color: red;'>Ez da irudirik igo. Mesedez, hautatu fitxategi bat.</p>";
        }
    }

    if ($mostrarFormulario):
    ?>
    <h1 id="titulo">Fitxategiak igo</h1>
    <h2 id="sub-titulo">Berri bat gehitu</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="izenburua">Izenburua*:</label>
            <input type="text" name="izenburua" id="izenburua" required>
            <br/>
            <label for="Testua">Testua*:</label>
            <input type="text" name="Testua" id="Testua" required>
            <br/>
            <label for="mota">Mota:</label>
            <select name="mota" id="mota">
                <option value="Eskaintzak">Eskaintzak</option>
                <option value="Iragarkiak">Iragarkiak</option>
                <option value="Bestelakoa">Bestelakoa</option>
            </select>
            <br><br>
            <label for="irudia">Irudia:</label>
            <input type="file" id="irudia" name="irudia">
            <br><br>
            <button type="submit" name="Bidali">Bidali</button>
        </form>
    <?php endif; ?>
</body>

</html>
