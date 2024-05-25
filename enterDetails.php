<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>ASR: New Score</title>
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
        <form action="recordScore.php" method="POST" class="form">
            <div class="title-box box"> 
                <h1> Archery Score Recorder </h1>
                <h3> Record details for the score. </h3>
            </div>

            <div class="inputs-box box"> 
                <h2> Selected Round: </h2>

                <select name='round' class='input' readonly>
                    <?php                  
                        // Gets the result from the MySQL query.
                        $result = mysqli_query($connection, "SELECT RoundID, CompetitionID, Name, EquipmentID FROM Rounds WHERE RoundID = $_POST[round]");

                        // Shows the chosen option from the previous page. 
                        while ($rounds = mysqli_fetch_array($result)) {
                            $roundEquipment = returnRowOfDatabase($connection, "SELECT Name FROM Equipment WHERE EquipmentID = $rounds[EquipmentID]");
                            echo "<option value='$rounds[RoundID]'> $rounds[RoundID]: $rounds[Name] ($roundEquipment[0])</td>";
                        }
                    ?>
                </select>
            </div>

            <div class="inputs-box box"> 
                <h2> Choose an archer. </h2>

                <select name="archer" class="input">
                    <?php     
                        // Gets the result from the MySQL query.                        
                        $result = mysqli_query($connection, "SELECT ArcherID, FirstName, LastName FROM Archers");

                        // Adds all of the options for the archers. 
                        while ($archers = mysqli_fetch_array($result)) {
                            echo "<option value='$archers[ArcherID]'> $archers[ArcherID]: $archers[FirstName] $archers[LastName] </td>";
                        }

                    ?>     
                </select>           
            </div>

            <div class="inputs-box box"> 
                <h2> Choose the equipment used in the round. </h2>
                
                <select name='equipment' class='input'>
                    <?php     
                        // Gets the result from the MySQL query.                        
                        $result = mysqli_query($connection, "SELECT EquipmentID, Name FROM Equipment");

                        // Adds all of the options for equipments. The selected equipment is based on the round's default equipment.  
                        while ($equipments = mysqli_fetch_array($result)) {
                            $roundEquipment = returnRowOfDatabase($connection, "SELECT EquipmentID, RoundID FROM Rounds WHERE EquipmentID = $equipments[EquipmentID] AND RoundID = $_POST[round]");

                            if (($equipments['EquipmentID']) == $roundEquipment[0]) {
                                echo "<option value='$equipments[EquipmentID]' selected> $equipments[EquipmentID]: $equipments[Name] </td>";
                            }
                            
                            else {
                                echo "<option value='$equipments[EquipmentID]'> $equipments[EquipmentID]: $equipments[Name] </td>";
                            }                                
                        }
                    ?>      
                </select>
            </div>

            <div class="inputs-box box">
                <h2> How much ends are there? </h2>
                <input type="number" name="numberOfEnds" min="1" max="6" class="input" value="6" required>
            </div>

            <div class="submit-box box">
                <h2> Submit the new score. </h2>
                <input type="submit" class="input">
            </div>
        </form>
    </body>
</html>