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
    ?>

    <body class="body">
        <form action="enterRound.php" method="POST" class="form">
            <div class="title-box box"> 
                <h1> Archery Score Recorder </h1>
                <h3> Enter competition </h3>
            </div>

            <div class="title-box box"> 
                <h3> Welcome to the Archery Score Recorder. To start, choose a competition. </h3>
            </div>

            <div class="inputs-box box"> 
                <h2> Choose a competition. </h2>

                <select name='competition' class='input'>
                    <?php             
                        // Gets the result from the MySQL query.     
                        $result = mysqli_query($connection, "SELECT CompetitionID, Name FROM Competition");

                        // Prints out all of the competitions stored in the database.
                        while ($competitions = mysqli_fetch_array($result)) {
                            echo "<option value='$competitions[CompetitionID]'> $competitions[CompetitionID]: $competitions[Name] </td>";
                        }
                    ?>
                </select>
            </div>

            <div class="submit-box box">
                <h2> Submit competition choice. </h2>
                <input type="submit" class="input">
            </div>
        </form>
    </body>
</html>