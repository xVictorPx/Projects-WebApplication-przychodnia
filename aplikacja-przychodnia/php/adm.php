<?php
    session_start();
    if (!$_SESSION['zalogowany']){
        header("Location: ./login.php");
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/adm.css">
    <title>Panel Administracyjny</title>
</head>
<body>
        <div class="menu">
            <nav class="nav">
                <a href="./logout.php">Wyloguj się</a>
                <a href="./rejestracjaP.php">Zarejestruj się</a>
                <a href="./rejestracjaW.php">Zarejestruj Wizyte</a>
                <a href="../index.html">Strona główna</a>
            </nav>
            <header class="header">
                <h1>Przychodnia</h1>
            </header>
        </div>
        <div class="container">
            <div class="lekarze box">
                <h2>Lekarze</h2>
                <div class="flex">
                    <a href="./lekarze/index_dodaj.php">Dodaj</a>
                    <a href="./lekarze/index_edit.php">Modyfikuj</a>
                    <a href="./lekarze/index_wyswietl.php">Wyświetl</a>
                </div>
                
                
            </div>
            <div class="pacjenci box">
                <h2>Pacjenci</h2>
                <div class="flex">
                    <a href="./pacjenci/index_dodaj.php">Dodaj</a>
                    <a href="./pacjenci/index_edit.php">Modyfikuj</a>
                    <a href="./pacjenci/index_wyswietl.php">Wyświetl</a>
                </div>
                

            </div>
            <div class="wizyty box">
                <h2>Wizyty</h2>
                <div class="flex">
                    <a href="./wizyty/index_dodaj.php">Dodaj</a>
                    <a href="./wizyty/index_edit.php">Modyfikuj</a>
                    <a href="./wizyty/index_wyswietl.php">Wyświetl</a>
                </div>
                

            </div>
        </div>
</body>
</html>