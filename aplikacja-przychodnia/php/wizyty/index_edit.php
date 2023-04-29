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
    </head>
    <body>
        <a href="../adm.php" class="goback">Powrót</a>
        <div id="content">
            <h1 class="bigtitle">Edytowanie wizyt</h1>
            <div id="form1">
                <form method="POST">
                <div class="grid">
                    <label><b>ID Wizyty: </b></label>
                    <input type="text" name="id_wizyty" maxlength="11" placeholder="1" required>
                    <label><b>ID Pacjenta: </b></label>
                    <input type="text" name="id_pacjent" maxlength="11" placeholder="1" >
                    <label><b>ID Lekarza: </b></label>
                    <input type="text" name="id_lekarz" maxlength="11" placeholder="1">
                    <label><b>Data: </b></label>
                    <input type="date" name="daty">
                    <label><b>Godzina: </b></label>
                    <input type="time" name="godzina">
                    <label><b>ID Gabinetu: </b></label>
                    <input type="text" name="id_gabinet" maxlength="11" placeholder="1">
                    <input type="submit" name="Edytuj" value="Edytuj">  
                </div>

            <?php
                if (isset($_POST['Edytuj'])){
                    $db = mysqli_connect("localhost", "root", "", "przychodnia");
                    
                    $i = 0;
                    $id_wizyty = mysqli_real_escape_string($db, $_POST['id_wizyty']);
                    $id_pacjent = mysqli_real_escape_string($db, $_POST['id_pacjent']);
                    $id_lekarz = mysqli_real_escape_string($db, $_POST['id_lekarz']);
                    $daty = mysqli_real_escape_string($db, $_POST['daty']);
                    $godzina = mysqli_real_escape_string($db, $_POST['godzina']);
                    $id_gabinet = mysqli_real_escape_string($db, $_POST['id_gabinet']);
                    
                    if($db){
                        $zapytanie1 = "SELECT * FROM wizyty";
                        $query2 = mysqli_query($db,$zapytanie1);

                        while ($row = mysqli_fetch_array($query2)){

                            if($row['id_wizyty'] == $id_wizyty){

                                if (!empty($_POST['id_pacjent'])){
                                    $id_pacjent = $_POST['id_pacjent'];
                                }else{
                                    $id_pacjent = $row['id_pacjent'];
                                }

                                if (!empty($_POST['id_lekarz'])){
                                    $id_lekarz = $_POST['id_lekarz'];  
                                }else{
                                    $id_lekarz = $row['id_lekarz'];
                                }

                                if(!empty($_POST['daty'])){
                                    $daty = $_POST['daty'];
                                }else{
                                    $daty = $row['daty'];
                                }
                                
                                if(!empty($_POST['godzina'])){
                                    $godzina = $_POST['godzina'];
                                }else{
                                    $godzina = $row['godzina'];
                                }

                                if(!empty($_POST['id_gabinet'])){
                                    $id_gabinet = $_POST['id_gabinet'];
                                }else{
                                    $id_gabinet = $row['id_gabinet'];
                                }

                                $i += 1;

                                $zapytanie = "UPDATE wizyty SET  id_pacjent = '$id_pacjent', id_lekarz ='$id_lekarz', daty ='$daty', godzina = '$godzina', id_gabinet = '$id_gabinet' WHERE id_wizyty = '$id_wizyty'";
                                $query = mysqli_query($db, $zapytanie);;
                                echo "
                                <div class='alert'>
                                    <p>Wizyta została zmodyfikowana</p>
                                </div>
                                ";

                            } 
                        }  
                        if ($i == 0){
                            echo "
                            <div class='alert'>
                                <p>W bazie nie ma wizyty o podanym ID</p>
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