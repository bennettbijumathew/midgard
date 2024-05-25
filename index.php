<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>ASR: New Score</title>
    </head>

    <!-- Establishing connection from PHP to SQL -->
    <?php
        require_once("settings.php");
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);      
    ?>

    <body class="body">
        <form action="recordScore.php" method="POST" class="form">
            <div class="title-box box"> 
                <h1> Archery Score Recorder </h1>
                <h3> Add a new score. </h3>
            </div>

            <div class="inputs-box box"> 
                <h2> Choose a round. </h2>

                <!-- Prints out all of the rounds stored in the database -->
                <?php                    

                    $query = "SELECT RoundID, Name FROM Rounds";
                    $result = mysqli_query($conn, $query);

                    echo "<select name='round' class='input'>";

                    while($details = mysqli_fetch_array($result)) {
                        echo "<option value='$details[RoundID]'> $details[RoundID]: $details[Name] </td>";
                    }

                    echo "</select>"
                ?>
            </div>

            <div class="inputs-box box"> 
                <h2> Choose an archer. </h2>

                <!-- Prints out all of the archers stored in the database -->
                <?php     
                    $query = "SELECT ArcherID, FirstName, LastName FROM Archers";
                    $result = mysqli_query($conn, $query);

                    echo '<select name="archer" class="input">';

                    while($details = mysqli_fetch_array($result)) {
                        echo "<option value='$details[ArcherID]'> $details[ArcherID]: $details[FirstName] $details[LastName] </td>";
                    }

                    echo "</select>"
                ?>                
            </div>

            <div class="inputs-box box"> 
                <h2> Choose the equipment used in the round. </h2>

                <!-- Prints out all of the equipment types stored in the database -->
                <?php                                   
                    $query = "SELECT EquipmentID, Name FROM Equipments";
                    $result = mysqli_query($conn, $query);

                    echo "<select name='equipment' class='input'>";

                    while($details = mysqli_fetch_array($result)) {
                        echo "<option value='$details[EquipmentID]'> $details[EquipmentID]: $details[Name] </td>";
                    }

                    echo "</select>"
                ?>                
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