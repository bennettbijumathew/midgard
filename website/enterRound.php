<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>Score Recorder</title>
    </head>

    <?php
        // Establishes connection from PHP to MySQL.
        require_once("settings.php");
        $connection = @mysqli_connect($host, $user, $pwd, $sql_db); 
        
        // This function returns an array that has the required columns of a row.
        function returnRowOfDatabase($dbConnection, $websiteQuery) {
            $result = mysqli_query($dbConnection, $websiteQuery);
            $row = mysqli_fetch_row($result);
            return $row;
        }    
    ?>

    <body class="body">
        <form action="enterDetails.php" method="POST" class="form">
            <div class="title-box box"> 
                <h1> Archery Score Recorder </h1>
                <h3> Enter round </h3>
            </div>

            <div class="inputs-box box"> 
                <h2> Choose a round. </h2>

                <select name='round' class='input'>
                    <?php                  
                        // Gets the result from the MySQL query.
                        $result = mysqli_query($connection, "SELECT RoundID, CompetitionID, Name, EquipmentID FROM Round WHERE CompetitionID = $_POST[competition]");

                        // Adds all of the round option's with the default equipment used for the round.
                        while ($details = mysqli_fetch_array($result)) {
                            $roundEquipment = returnRowOfDatabase($connection, "SELECT Name FROM Equipment WHERE EquipmentID = $details[EquipmentID]");
                            echo "<option value='$details[RoundID]'> $details[RoundID]: $details[Name] ($roundEquipment[0])</td>";
                        }
                    ?>
                </select>
            </div>

            <div class="submit-box box">
                <h2> Submit the round choice. </h2>
                <input type="submit" class="input">
            </div>
        </form>
    </body>
</html>