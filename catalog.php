<?php

$valueSite = $_POST['valueSite'] ?? 0;
$personIdentification = $_POST['personID'] ?? null;

// Establish database connection
include "database_connection.txt";
$conn = mysqli_connect($host, $user, $password, $db) or die("". mysqli_error($conn));

if ($valueSite == 0) {

$query = "select * from person_summary";
$result = mysqli_query($conn, $query) or die("Query failed");

// implement basic html structure
ECHO '
<html>

<head>
    <title>Profile creation</title>
    <link rel="stylesheet" href="graphics.css">
</head>

<body>


<h1 style="text-align: center; border-style: solid;">Profile selection</h1>
';

ECHO '<br><br><div style="display: flex; justify-content: center; align-items: center; border-style:solid;">';
ECHO '<form action="main_site.html">';
ECHO '<div style="padding: 5px";>';
ECHO '<input type="submit" value="RETURN"></input>';
ECHO '</div>';
ECHO '</form>';
ECHO '</div>


<div style="display: flex; flex-wrap: wrap; padding: 10em; border-style:solid;">



';
// fetch objects from database query result
while ($row = mysqli_fetch_object($result)) {
     ECHO' 
                <form action="catalog.php" method="POST">
                    <div>
                        <button type="submit">
                        <div class="block_image">
                            <img src="', $row -> picture,'"/>

                        </div>
                        <div class="block_image_text">
                            <p>', $row -> first_name,'</p>
                        </div>
                        <input type="hidden" name="personID" value="', $row -> person_number,'">
                        <input type="hidden" name="valueSite" value="1">
                        </button>
                    </div>
                </form>';
}

ECHO 
'




</div>

</body>
</html>
';
} else if ($valueSite == '1') {
    // person_summary query
    $query = "select * from person_summary where person_number = $personIdentification";
    $result = mysqli_query($conn, $query) or die("Query failed");
    ECHO "<html><head></head><body>";
    // fetch and show data from query
    while ($row = mysqli_fetch_object($result)) {
        ECHO '<h1 style="text-align: center; border-style: solid;">', $row -> first_name,' full profile summary</h1>';
        ECHO '<div style="border-style: solid; display: flex; justify-content: center;">';
        ECHO '<form action="catalog.php" method="POST">';
        ECHO '<div style="padding: 5px";>';
        ECHO '<input type="hidden" name="valueSite" value="0"></input>';
        ECHO '<input type="submit" value="RETURN"></input>';
        ECHO '</div>';
        ECHO '</form>';
        ECHO '<form action="catalog.php" method="POST">';
        ECHO '<div style="padding: 5px;">';
        ECHO '<input type="hidden" name="valueSite" value="2"></input>';
        ECHO '<input type="submit" value="CHANGE"></input>';
        ECHO '</div>';
        ECHO '</form>';
        ECHO '<form action="catalog.php" method="POST">';
        ECHO '<div style="padding: 5px;">';
        ECHO '<input type="hidden" name="valueSite" value="3"></input>';
        ECHO '<input type="submit" value="DELETE"></input>';
        ECHO '</div>';
        ECHO '</form>';
        ECHO '</div>';

        ECHO '<div style="display: flex; flex-wrap: wrap; padding: 1em; border-style: solid;">';
        ECHO '<div>';

        ECHO '<div style="border-style: solid; height: 500px; width: 500px; object-fit: contain; border-color: gray;">';
        ECHO '<img style="width: 100%; height: 100%; object-fit: fill;" src="', $row -> picture,'"/>';
        ECHO '</div>';
        ECHO '<div style="border-style: solid; border-color: gray; text-align: center;">';
        ECHO '<p> First name: ', $row -> first_name ,'</p>';
        ECHO '<p> Middle name: ', $row -> middle_name ,'</p>';
        ECHO '<p> Last name: ', $row -> last_name ,'</p>';
        ECHO '<p> Date of birth: ', $row -> date_of_birth ,'</p>';
        ECHO '<p> State of residence: ', $row -> state_of_residence ,'</p>';
        ECHO '</div>';
        ECHO "</div>";
        ECHO '</div>';
    }

    // record_details query
    $query = "select * from record_details where person_number_record_details = $personIdentification";
    $result = mysqli_query($conn, $query) or die("Query failed");

    // fetch and show data from query
    $i = 1;
    while ($row = mysqli_fetch_object($result)) {
    
    ECHO '<div style="display: flex; flex-wrap: wrap; padding: 2em; border-style: solid;>';
    ECHO '<div style="display: flex;>';
    ECHO '<div>';
    ECHO '<div class="block_image_text">';
    ECHO '<details>';
    ECHO '<summary><h1> OFFENSE NUMBER: ', $i ,'</h1></summary>';
    ECHO '<h1> Offense date: <br><div style="background-color: red; text-align:center;">"', $row -> offense_date,'"</div></h1>';
    ECHO '<h1> Offense: <br><div style="background-color: red; text-align:center;">', $row -> offense ,'</div></h1>';
    ECHO '<h1> Disposition outcome: <br><div style="background-color: red; text-align:center;">', $row -> disposition_outcome ,'</div></h1>';
    ECHO '<h1> Location: <br><div style="background-color: red; text-align:center;">', $row -> offense_location_prefix ,' ', $row -> offense_location_street_number,' ', $row -> offense_location_street_name,' ', 
    $row -> offense_location_unit,' in ', $row -> offense_location_city , ' in the state of ', $row -> offense_location_state ,' with the zip code ', $row -> offense_location_zip_code
    ,' in the county of ', $row -> offense_location_county, '</div></h1>';
    ECHO '</details>';
    ECHO '</div>';
    ECHO "</div>";
    ECHO '</div>';
    ECHO '</div>';
    $i++;
    }
} else if ($valueSite == '2') {
    ECHO '<p> change </p>';
} else if ($valueSite == '3') {
    ECHO '<p> delete </p>';
}

mysqli_close($conn);
