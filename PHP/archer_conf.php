<?php
    echo 'Sart Test <br>';

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD','raspberry');
    define('DB_NAME', 'B3D');
    $port = 3306;
  
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

   
    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
  
    $nickname = $_POST['nickname'];
    $vname = $_POST['fname'];
    $nname = $_POST['lname'];

    echo $nickname . ' ' . $vname . ' ' . $nname . '<br>';
 
    if($result = $mysqli->query("SELECT * FROM User WHERE nickname = '$nickname'"))
    {
        echo "Select erfolgreich! <br>";
        if($result->num_rows)
        {
            echo "num_rows erfolgreich! <br>";
            while($row = $result->fetch_assoc())
            {
                echo "while " . $row['vName'] . ' ' . $row['nName'] . '<br>';
                $vname = $row['vName'];
                $nname = $row['nName'];
            }
        }
        else
        {
            echo "num_rows fehlgeschlagen! <br>";
            $mysqli->query("INSERT INTO User ('user_id', 'vName', 'nName', 'nickname', 'passwort') VALUES (NULL, '$vname', '$nname', '$nickname', NULL);");
            
            echo 'insert <br>';
            if($result = $mysqli->query("SELECT * FROM User WHERE nickname = '$nickname'"))
            {
                echo 'select geglückt!';
                if($result->num_rows)
                {
                    while($row = $result->fetch_assoc())
                    {
                        $mysqli->query("INSERT INTO Freund ('user_id', 'freund_id') VALUES (1, '" . $row['user_id'] . "');"); //TODO: user_id von Login bekommen und hier hinein schreiben
                        echo $row['user_id'] . '<br>';
                    }
                }
            }
        }
    }
    else
    {
        echo "Select fehlgeschlagen! <br>";
    }
?>
