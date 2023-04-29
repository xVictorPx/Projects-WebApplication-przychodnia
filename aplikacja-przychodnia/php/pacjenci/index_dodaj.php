<?php
    session_start();
    if (!$_SESSION['zalogowany']){
        header("Location: ../login.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Przychodnia "Zdrowie"</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../logo/logo.png" type="image/x-icon" />
    <meta name="description" content="Najlepsi w branży projektowej!" />
    <meta name="keywords" content="projekt" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Wiktor Patajewicz" />
    <meta name="reply-to" content="wg833@zs1.lublin.eu" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/add.css">
    <style>
    .alert {
        width: 60%;
        height: 70px;
        border: dotted 3px #fff;
        margin: 20px auto;
    }

    .alert p {
        text-align: center;
        line-height: 65px;
        color: #fff;
        font-size: 16px;
    }  
    </style>
</head>
    <body>
        <a href="../adm.php" class="goback">Powrót</a>
        <div id="content">
            <h1 class="bigtitle">Dodawanie danych pacjentów</h1>
            <div style="height: 15px;"></div>
            <div id="form1">
            <form method="POST">
                <div class="grid">
                    <label><b>Imię: </b></label>
                    <input type="text" name="imie" maxlength="30" placeholder="Jan" required>
                    <label><b>Nazwisko: </b></label>
                    <input type="text" name="nazwisko"   maxlength="30" placeholder="Kowalski" required>
                    <label><b>PESEL: </b></label>
                    <input type="text" name="pesel" maxlength="11" placeholder="00000000000" required>
                    <label><b>Miejscowość: </b></label>
                    <input type="text" name="miejscowosc"  maxlength="30" placeholder="Warszawa" required>
                    <label><b>Kod Pocztowy: </b></label>
                    <input type="text" name="pocztowy"  maxlength="6" placeholder="00-000" pattern="[0-9]{2}-[0-9]{3}"  required>
                    <label><b>Ulica: </b></label>
                    <input type="text" name="ulica"  maxlength="30" placeholder="Szkolna" required>
                    <label><b>Numer domu: </b></label>
                    <input type="number" name="nr_domu"  maxlength="5" placeholder="1" required>
                    <label><b>Numer mieszkania: </b></label>
                    <input type="number" name="nr_mieszkania"  maxlength="5" placeholder="12">
                    <label><b>Telefon: </b></label>
                    <input type="tel" name="telefon"  maxlength="11" placeholder="000-000-000" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" required>
                    <input type="submit" name="Dodaj" value="Dodaj">     
                </div>
            </form>
            <?php
                if (isset($_POST['Dodaj'])){
                    $db = mysqli_connect("localhost", "root", "", "przychodnia");

                    $imie = mysqli_real_escape_string($db, $_POST['imie']);
                    $nazwisko = mysqli_real_escape_string($db, $_POST['nazwisko']);
                    $pesel = mysqli_real_escape_string($db, $_POST['pesel']);
                    $miejscowosc = mysqli_real_escape_string($db, $_POST['miejscowosc']);
                    $pocztowy = mysqli_real_escape_string($db, $_POST['pocztowy']);
                    $ulica = mysqli_real_escape_string($db, $_POST['ulica']);
                    $nr_domu = mysqli_real_escape_string($db, $_POST['nr_domu']);
                    $nr_mieszkania = mysqli_real_escape_string($db, $_POST['nr_mieszkania']);
                    $telefon = mysqli_real_escape_string($db, $_POST['telefon']);
                    
                    if($db){
                        $zapytanie = "INSERT INTO pacjent VALUES (null, '$imie', '$nazwisko', '$pesel', '$miejscowosc', '$pocztowy', '$ulica', '$nr_domu', '$nr_mieszkania', '$telefon')";
                        $query = mysqli_query($db, $zapytanie);

                        if (mysqli_affected_rows($db)>0){
                            echo "
                            <div class='alert'>
                                <p>Pomyślnie dodano pacjenta!</p>
                            </div>
                            ";
                        }else{
                            echo "
                            <div class='alert'>
                                <p>Błąd zapisu danych!</p>
                            </div>
                            ";
                        }
                    }else{
                        echo "
                        <div class='alert'>
                            <p>Błąd połączenia z bazą danych</p>
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