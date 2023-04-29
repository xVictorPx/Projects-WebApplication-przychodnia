<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="../css/rejestr.css">

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
            <h1>Rejestracja Pacjenta</h1>
            <form action="" method="post">
                <div class="grid">
                    <label >Imię: </label>
                    <input type="text" name="imie"  required><br>
                    <label >Nazwisko: </label>
                    <input type="text" name="nazwisko" required><br>
                    <label>PESEL: </label>
                    <input type="text" maxlength="11" name="pesel" required><br>
                    <label>Miejscowość: </label>
                    <input type="text" name="miejscowosc" required><br>
                    <label>Kod pocztowy: </label>
                    <input type="text" name="pocztowy" required><br>
                    <label>Ulica: </label>
                    <input type="text" name="ulica" required><br>
                    <label>Numer domu: </label>
                    <input type="text" name="nr_domu" required><br>
                    <label>Numer mieszkania: </label>
                    <input type="text" name="nr_mieszkania" placeholder="wpisz '-' jeżeli nie posiadasz"required> <br>
                    <label>Telefon: </label>
                    <input type="text" name="telefon" maxlength="9" required><br>
                </div>

                <input type="submit" value="Zarejestruj Się!" name="zarejestruj" id="submit">
            </form>
            <?php
                if (isset($_POST['zarejestruj'])){
                    $db = mysqli_connect("localhost", "root", "", "przychodnia");

                    $imie = mysqli_escape_string($db, $_POST['imie']);
                    $nazwisko = mysqli_escape_string($db, $_POST['nazwisko']);
                    $pesel = mysqli_escape_string($db, $_POST['pesel']);
                    $miejscowosc = mysqli_escape_string($db, $_POST['miejscowosc']);
                    $kod_pocztowy = mysqli_escape_string($db, $_POST['pocztowy']);
                    $ulica = mysqli_escape_string($db, $_POST['ulica']);
                    $nr_domu = mysqli_escape_string($db, $_POST['nr_domu']);
                    $nr_mieszkania = mysqli_escape_string($db, $_POST['nr_mieszkania']);
                    $telefon = mysqli_escape_string($db, $_POST['telefon']);

                    if($db){
                        $sql = "INSERT INTO pacjent VALUES (null, '$imie', '$nazwisko', '$pesel', '$miejscowosc', '$kod_pocztowy', '$ulica', '$nr_domu', '$nr_mieszkania', '$telefon')";

                        $query = mysqli_query($db, $sql);

                        if (mysqli_affected_rows($db)>0){
                            echo "
                            <div class='info'>
                                <p>Pomyślnie zarejestrowanao!</p>
                            </div>
                            ";
                        } else {
                            echo "
                            <div class='info'>
                                <p>Błąd zapisu danych!</p>
                            </div>
                            ";
                        }

                    } else {
                        echo "
                        <div class='info'>
                            <p>Błąd połączenia z bazą danych</p>
                        </div>
                        ";
                    }

                    mysqli_close($db);
                }
            ?>
            <!-- <div class='info'>
                <p>Błąd przy rejestracji!</p>
            </div> -->
        </div>
    </div>

</body>
</html>