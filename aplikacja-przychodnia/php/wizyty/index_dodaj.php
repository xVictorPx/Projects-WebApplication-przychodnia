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
            <h1 class="bigtitle">Dodawanie wizyt</h1>
            <div id="form1">
                <form method="POST">
                    <div class="grid">
                        <label><b>ID Pacjenta: </b></label>
                        <input type="text" name="id_pacjent" maxlength="11" placeholder="1" required>
                        <label><b>ID Lekarza: </b></label>
                        <input type="text" name="id_lekarz" maxlength="11" placeholder="1" required>
                        <label><b>Data: </b></label>
                        <input type="date" name="daty" required>
                        <label><b>Godzina: </b></label>
                        <input type="time" name="godzina" required>
                        <label><b>ID Gabinetu: </b></label>
                        <input type="text" name="id_gabinet"  maxlength="11" placeholder="1" required>
                        <input type="submit" name="Dodaj" value="Dodaj">  
                    </div>
                <?php
                    if (isset($_POST['Dodaj'])){
                        $db = mysqli_connect("localhost", "root", "", "przychodnia");

                        $id_pacjent = mysqli_real_escape_string($db, $_POST['id_pacjent']);
                        $id_lekarz = mysqli_real_escape_string($db, $_POST['id_lekarz']);
                        $daty = mysqli_real_escape_string($db, $_POST['daty']);
                        $godzina = mysqli_real_escape_string($db, $_POST['godzina']);
                        $id_gabinet = mysqli_real_escape_string($db, $_POST['id_gabinet']);
                        
                        if($db){
                            $zapytanie = "INSERT INTO wizyty VALUES (null, '$id_pacjent', '$id_lekarz', '$daty', '$godzina', '$id_gabinet')";
                            $query = mysqli_query($db, $zapytanie);

                            if (mysqli_affected_rows($db)>0){
                                echo "
                                <div class='alert'>
                                    <p>Pomyślnie dodano wizyte!</p>
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
                </form>
            </div>   
        </div>
    </body>
</html>