<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>ASR: Arrow Scores</title>
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
        <form method="POST" action="result.php" class="form">
            <div class="title-box box"> 
                <h1> Archery Score Recorder </h1>
                <h3> Record each arrow shot. </h3>
            </div>

            <div class="title-box box"> 
                <h3> Scores will be sorted out after submission. </h3>
            </div>

            <div class="inputs-box box">
                <h2> Selected Archer </h2>

                <?php
                    // This section prints out the chosen archer from the previous page.
                    $row = returnRowOfDatabase($connection, "SELECT FirstName, LastName, ArcherID FROM Archer WHERE ArcherID = $_POST[archer]");
                    echo "<p> Archer: $row[0] $row[1] ($row[2]) </p>";
                ?> 

                
                <?php
                    // This section prints out the chosen round from the previous page.
                    $row = returnRowOfDatabase($connection, "SELECT Name, RoundID FROM Round WHERE RoundID = $_POST[round]");
                    echo "<p> Current Round: $row[0] ($row[1]) </p>";
                ?> 

                
                <?php
                    // This section prints out the chosen round from the previous page.
                    $row = returnRowOfDatabase($connection, "SELECT Name, EquipmentID FROM Equipment WHERE EquipmentID = $_POST[equipment]");
                    echo "<p> Equipment Used: $row[0] ($row[1]) </p>";
                ?>
            </div>

            <?php
                // Loops through number of ends entered previously. 
                for ($i = 0; $i < $_POST['numberOfEnds']; $i++) {
                    echo "<div class='inputs-box box'>";
                    echo "<h2> End " . ($i + 1) . "</h2>";

                    // Prints the archer chosen in the previous page.
                    $row = returnRowOfDatabase($connection, "SELECT FirstName, LastName, ArcherID FROM Archer WHERE ArcherID = $_POST[archer]");
                    echo "<p> Shot By: $row[0] $row[1] ($row[2]) </p>";

                    // Prints the chosen round from the previous page
                    $row = returnRowOfDatabase($connection, "SELECT TargetFace FROM Round WHERE RoundID = $_POST[round]");
                    echo "<p> Target Face: $row[0] </p>";

                    // Creates inputs with the name being attached to an two dimension array that accesses end number and the arrows shot for that end
                    for ($j = 0; $j < 6; $j++) {
                        echo "<input type='number' name='arrowScores[$i][$j]' min='1' max='10' class='input-end'>";
                    }

                    echo "</div>";

                    // Inserts a new score into the database
                    $date = date_create()->format('Y-m-d');
                    $query = "INSERT INTO `Score` (`RoundID`, `ArcherID`, `EquipmentID`, `Number`, `Date`) VALUES ($_POST[round], $_POST[archer], $_POST[equipment], 0, '$date')";
                    $result = mysqli_query($connection, $query);    
        
                    if(!$result){
                        $error = mysqli_error($connection);
                        echo "<p> $$error </p>";
                    }    
                }
            ?> 
            
            <div class="submit-box box">
                <input type='submit' class="input">
            </div>
        </form>
    </body>
</html>