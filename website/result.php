<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>Score Recorder</title>
    </head>

    <?php
        // Establishing connection from PHP to SQL
        require_once("settings.php");
        $connection = @mysqli_connect($host, $user, $pwd, $sql_db);   

        // This function returns an array, that has the required propeties of a row 
        function returnRowOfDatabase($dbConnection, $websiteQuery) {
            $result = mysqli_query($dbConnection, $websiteQuery);
            $row = mysqli_fetch_row($result);
            return $row;
        }        
    ?>

    <body class="body">
        <div class="form">
            <div class="title-box box">
                <h1> Archery Score Recorder </h1>
            </div>

            <div class="title-box box"> 
                <h3> The new score has been added. </h3>
            </div>

            <?php
                $totalArrowScore = 0;

                // Grabs the arrowScores array from the previous page. 
                $arrowScores = $_POST['arrowScores'];

                // Gets the most recent score entry from the database. 
                $score = returnRowOfDatabase($connection, "SELECT * FROM Score ORDER BY ScoreID DESC LIMIT 1");

                // This loops through each end and sorts them out. 
                for ($endNumber = 0; $endNumber < count($arrowScores); $endNumber++) {
                    rsort($arrowScores[$endNumber]);

                    // After a loop for the end, each arrow in the end is inserted into the database. 
                    for ($arrowNumber = 0; $arrowNumber < 6; $arrowNumber++) {
                        $endScore = $arrowScores[$endNumber][$arrowNumber];
                        $totalArrowScore += $endScore;
                        $result = mysqli_query($connection, "INSERT INTO `ArrowScore` (`ScoreID`, `EndNumber`, `ArrowNumber`, `Number`) VALUES ($score[0], $endNumber+1, $arrowNumber, $endScore);");    
                    }

                    $result = mysqli_query($connection, "UPDATE Score SET Number = $totalArrowScore ORDER BY ScoreID DESC LIMIT 1");
                }

                if(!$result){
                    $error = mysqli_error($connection);
                    echo "<p> $$error </p>";
                }    
            ?>

            <!-- Showing the most recent input of the scores table.  -->
            <div class='inputs-box box'>
                <h3> New Score </h3>

                <table class="table"> 
                    <?php
                        $result = mysqli_query($connection, 'SELECT * FROM Score ORDER BY ScoreID DESC LIMIT 1');

                        echo 
                            '
                            <tbody> 
                                <tr>
                                    <th>Score ID</th>
                                    <th>Round ID</th>
                                    <th>Archer ID</th>
                                    <th>Equipment</th>
                                    <th>Number</th>
                                    <th>Date</th>
                                </tr>
                        ';

                        while($details = mysqli_fetch_array($result)) {
                            echo 
                                "<tr> 
                                    <td> $details[ScoreID] </td>
                                    <td> $details[RoundID] </td>
                                    <td> $details[ArcherID] </td>
                                    <td> $details[EquipmentID] </td>
                                    <td> $details[Number] </td>
                                    <td> $details[Date] </td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>

            <div class='inputs-box box'>
                <h3> Arrows Shot </h3>

                <table class="table"> 
                    <?php
                        $score = returnRowOfDatabase($connection, 'SELECT ScoreID FROM Score ORDER BY ScoreID DESC LIMIT 1');               
                        $result = mysqli_query($connection, "SELECT * FROM ArrowScore WHERE ScoreID = $score[0]");
                        
                        echo 
                            '<tr>
                                <th>Shot ID</th>
                                <th>End Number</th>
                                <th>Arrow Number</th>
                                <th>Score</th>
                            </tr>
                        ';

                        while($details = mysqli_fetch_array($result)) {
                            echo 
                                "<tr>
                                    <td> $details[ArrowScoreID] </td>
                                    <td> $details[EndNumber] </td>
                                    <td> $details[ArrowNumber] </td>
                                    <td> $details[Number] </td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>