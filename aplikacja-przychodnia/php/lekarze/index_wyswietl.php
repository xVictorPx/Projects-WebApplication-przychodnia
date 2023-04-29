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
        <link rel="stylesheet" href="../../css/show.css">
        <link rel="stylesheet" href="../../css/reset.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../logo/logo.png" type="image/x-icon" />
        <meta name="description" content="Najlepsi w branży projektowej!" />
        <meta name="keywords" content="projekt" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="Wiktor Patajewicz" />
        <meta name="reply-to" content="wg833@zs1.lublin.eu" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <style>
    body {
    width: 100%;
    height: 100vh;
}

#container {
    width: 100%;
    height: 100%;
}
    
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
        <div id="container">
            <div class="box1">
                <h1 class="bigtitle">Wyświetlanie danych lekarzy</h1>
                    <form method="POST">
                        <input type="submit" name="Wyswietl_all" value="Wyświetl wszystkich lekarzy">
                    </form>
                    <?php
                        if (isset($_POST['Wyswietl_all'])){
                            $db = mysqli_connect("localhost", "root", "", "przychodnia");
                            
                            if($db){

                                $zapytanie = "SELECT * FROM lekarz";
                                $query = mysqli_query($db, $zapytanie);

                                echo"<table>";
                                    echo "<tr>";
                                        echo "<td>" . '<b>ID Lekarza</b>'. "</td>";
                                        echo "<td>" . '<b>Tytuł</b>' . "</td>";
                                        echo "<td>" . '<b>Imię</b>' . "</td>";
                                        echo "<td>" . '<b>Nazwisko</b>' . "</td>";
                                        echo "<td>" . '<b>specjalizacja</b>' . "</td>";
                                        
                                    echo "</tr>";

                                while($row = mysqli_fetch_array($query)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id_lekarz'] . "</td>";
                                        echo "<td>" . $row['tytul'] . "</td>";
                                        echo "<td>" . $row['imie'] . "</td>";
                                        echo "<td>" . $row['nazwisko'] . "</td>";
                                        echo "<td>" . $row['specjalizacja'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
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
            
            <div class="box2">
                <h1 class="bigtitle">Wyszukiwanie danych lekarzy</h1>
                <h3><b>Wpisz nazwisko lekarza, którego chcesz wyszukać:</b></h3>
                <form method="POST">
                    <input type="text" name="szukajInput" maxlength="20" placeholder="Kowalski">
                    <input type="submit" name="szukaj" value="Szukaj"><br><br>
                </form>
                <?php
                if(isset($_POST['szukaj'])){

                    $db = mysqli_connect("localhost", "root", "", "przychodnia");
                    $sql_all = "SELECT * FROM lekarz";
                    $query_all = mysqli_query($db, $sql_all);
                    $searchInput = $_POST['szukajInput'];
                        
                    if($db){
                        $sql_search =  "SELECT * FROM lekarz WHERE nazwisko = '$searchInput'";
                        $query_search = mysqli_query($db, $sql_search);

                        if(empty($searchInput)){
                            echo "<b>Wpisz nazwisko lekarza.</b>";
                        }else if (mysqli_num_rows($query_search) == 0){
                            echo "<b>Taki lekarz nie istnieje.</b>";
                        }else {
                            echo"<table>";
                                echo "<tr>";
                                    echo "<td>" . '<b>ID Lekarza</b>'. "</td>";
                                    echo "<td>" . '<b>Tytuł</b>' . "</td>";
                                    echo "<td>" . '<b>Imię</b>' . "</td>";
                                    echo "<td>" . '<b>Nazwisko</b>' . "</td>";
                                    echo "<td>" . '<b>specjalizacja</b>' . "</td>";
                                echo "</tr>";

                        while($row = mysqli_fetch_array($query_search)){
                            echo "<tr>";
                                echo "<td>" . $row['id_lekarz'] . "</td>";
                                echo "<td>" . $row['tytul'] . "</td>";
                                echo "<td>" . $row['imie'] . "</td>";
                                echo "<td>" . $row['nazwisko'] . "</td>";
                                echo "<td>" . $row['specjalizacja'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
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