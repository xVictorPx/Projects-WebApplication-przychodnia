<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja Wizyty</title>
    <link rel="stylesheet" href="../css/rejestr.css">
    <style> 
    .infoW { margin-bottom: 30px; }
    </style>

</head>
<body>
    <div class="container">
        <div class="menu">
            <nav class="nav">
                <a href="./login.php">Zaloguj się</a>
                <a href="./rejestracjaP.php">Zarejestruj się</a>
                <a href="./rejestracjaW.php">Zarejestruj Wizyte</a>
                <a href="../index.html">Strona główna</a>
            </nav>
            <header class="header">
                <h1>Przychodnia</h1>
            </header>
        </div>
        <div class="form">
            <h1>Rejestracja Wizyty</h1>
            <form action="" method="post">
                <div class="grid">
                    <label style="font-size: 18px;">Wpisz PESEL: </label>
                    <input type="text" name="peselInput" maxlength="11">
                </div>
                <input type="submit" name="pesel" value="Wyszukaj swoje ID!" id="submit">
                <br>
            </form>
<?php
    if(isset($_POST['pesel'])) {
        $db = mysqli_connect("localhost", "root", "", "przychodnia");
        $peselInput = $_POST['peselInput'];

        $query = mysqli_query($db, "SELECT id_pacjent FROM pacjent WHERE pesel = $peselInput");

        if (empty($peselInput)) {
            echo "
            <div class='info'>
                <p>Musisz wpisać numer PESEL!</p>
            </div>                       
            ";
        } else if (mysqli_num_rows($query) == 0) {
            echo "
            <div class='info'>
                <p>Nie znaleziono takiego numeru PESEL</p>
            </div>                       
            ";
        } else {
            while ($row = mysqli_fetch_array($query)){
                echo "
                <div class='info'>
                    <p>Twoje ID to: ".$row['id_pacjent']."</p>
                </div>                       
                ";
            }
        }
        mysqli_close($db);
    }

?>

            <form action="" method="post">
                <div class="grid">
                    <label >ID Pacjenta: </label>
                    <input type="number" min="0" name="id_p" required><br>
                    <label>Nazwisko lekarza: </label>
                    <input type="text" name="nazwisko" required><br>
                    <label>data: </label>
                    <input type="date" name="data" required><br>
                    <label>Godzina: </label>
                    <input type="time" name="godzina" required><br>
                </div>

                <input type="submit" value="Zarejestruj wizytę!" name="zarejestruj" id="submit">
            </form>
<?php
    if (isset($_POST['zarejestruj'])) {
        $db = mysqli_connect("localhost", "root", "", "przychodnia");

        $id_pacjent = mysqli_real_escape_string($db, $_POST['id_p']);
        $nazwisko = mysqli_real_escape_string($db, $_POST['nazwisko']);
        $data = mysqli_real_escape_string($db, $_POST['data']);
        $godzina = mysqli_real_escape_string($db, $_POST['godzina']);

        if ($db) {

            $sql_id_l = "SELECT id_lekarz FROM lekarz WHERE nazwisko = '$nazwisko'";
            $query_id_lekarza = mysqli_query($db, $sql_id_l);
            $id_lekarz = '';

            while ($row = mysqli_fetch_array($query_id_lekarza)){
                $id_lekarz = $row['id_lekarz'];
            }

            $query = mysqli_query($db, "INSERT INTO wizyty VALUES (null, '$id_pacjent', '$id_lekarz', '$data', '$godzina', 2)");

            if (mysqli_affected_rows($db) > 0){ 
                echo "
                <div class='info'>
                    <p>Pomyślnie dodano wizyte!</p>
                </div>
                ";
            } else {
                echo "
                <div class='info'>
                    <p>Błąd zapisu danych! Spróbuj ponownie.</p>
                </div>
                ";
                echo mysqli_error($db);
            }
        } else {
            echo "
            <div class='info'>
                <p>Błąd połączenia z bazą</p>
            </div>                       
            ";
        }

        mysqli_close($db);
    }
?>
        </div>
    </div>

</body>
</html>