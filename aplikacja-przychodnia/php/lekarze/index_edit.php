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
        <link rel="stylesheet" href="../../css/edit.css">
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
            <h1 class="bigtitle">Edytowanie danych lekarzy</h1>
            <div id="form1">
                <form method="POST">
                    <div class="grid">
                        <label><b>ID Lekarza </b></label>
                        <input type="text" name="id_lekarz" maxlength="10" placeholder="1" required>
                        <label><b>Tytuł: </b></label>
                        <input type="text" name="tytul" placeholder="Lek. med." maxlength="20">
                        <label><b>Imię: </b></label>
                        <input type="text" name="imie" maxlength="30" placeholder="Jan">
                        <label><b>Nazwisko: </b></label>
                        <input type="text" name="nazwisko"   maxlength="30" placeholder="Kowalski">
                        <label><b>Specjalizacja: </b></label>
                        <input type="text" name="specjalizacja" maxlength="30" placeholder="chirurg">
                        <input type="submit" name="Edytuj" value="Edytuj">  
                    </div>

    <?php
        if (isset($_POST['Edytuj'])){
            $db = mysqli_connect("localhost", "root", "", "przychodnia");
            
            $i = 0;
            $id_lekarz = mysqli_real_escape_string($db, $_POST['id_lekarz']);
            $tytul = mysqli_real_escape_string($db, $_POST['tytul']);
            $imie = mysqli_real_escape_string($db, $_POST['imie']);
            $nazwisko = mysqli_real_escape_string($db, $_POST['nazwisko']);
            $specjalizacja = mysqli_real_escape_string($db, $_POST['specjalizacja']);
            
            if($db){
                $zapytanie1 = "SELECT * FROM lekarz";
                $query2 = mysqli_query($db,$zapytanie1);

                while ($row = mysqli_fetch_array($query2)){

                    if($row['id_lekarz'] == $id_lekarz){

                        if (!empty($_POST['tytul'])){
                            $tytul = $_POST['tytul'];
                        }else{
                            $tytul = $row['tytul'];
                        }

                        if (!empty($_POST['imie'])){
                            $imie = $_POST['imie'];  
                        }else{
                            $imie = $row['imie'];
                        }

                        if(!empty($_POST['nazwisko'])){
                            $nazwisko = $_POST['nazwisko'];
                        }else{
                            $nazwisko = $row['nazwisko'];
                        }
                        
                        if(!empty($_POST['specjalizacja'])){
                            $specjalizacja = $_POST['specjalizacja'];
                        }else{
                            $specjalizacja = $row['specjalizacja'];
                        }

                        $i += 1;

                        $zapytanie = "UPDATE lekarz SET  tytul = '$tytul', imie ='$imie', nazwisko ='$nazwisko', specjalizacja = '$specjalizacja' WHERE id_lekarz = '$id_lekarz'";
                        $query = mysqli_query($db, $zapytanie);

                        echo "
                        <div class='alert'>
                            <p>Dane lekarza zostały zmodyfikowane!</p>
                        </div>
                        ";
                    } 
                }  
                if ($i == 0){
                    echo "
                    <div class='alert'>
                        <p>W bazie nie ma lekarza o podanym ID</p>
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
        }
    ?>  
                </form>
            </div>
        </div>
    </body>
</html>