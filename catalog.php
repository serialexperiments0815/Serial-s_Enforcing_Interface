<?php

$valueSite = $_POST['valueSite'] ?? 0;
$personIdentification = $_POST['personID'] ?? null;
$offenseNumber = $_POST['offenseNumber'] ?? null;

// Establish database connection
include "database_connection.txt";
$conn = mysqli_connect($host, $user, $password, $db) or die("". mysqli_error($conn));

if ($valueSite == 0) {

$query = "select * from person_summary";
$result = mysqli_query($conn, $query) or die("Query failed");
?>
<!-- implement basic html structure -->
<!doctype html>
<html>

<head>
    <title>Profile creation</title>
    <link rel="stylesheet" href="graphics.css">
</head>

<body>


<h1 style="text-align: center; border-style: solid;">Profile selection</h1>

<br><br><div style="display: flex; justify-content: center; align-items: center; border-style:solid;">
<form action="main_site.html">
<div style="padding: 5px;">
<input type="submit" value="RETURN"/>
</div>
</form>
</div>


<div style="display: flex; flex-wrap: wrap; padding: 10em; border-style:solid;">


<?php

// fetch objects from database query result
while ($row = mysqli_fetch_object($result)) {
?>
       <form action="catalog.php" method="POST">
                    <div>
                        <button type="submit">
                        <div class="block_image">
                            <img src="<?php ECHO $row -> picture ?>"/>

                        </div>
                        <div class="block_image_text">
                            <p>
                                <?php ECHO $row -> first_name ?>
                            </p>
                        </div>
                        <input type="hidden" name="personID" value="<?php ECHO $row -> person_number ?>">
                        <input type="hidden" name="valueSite" value="1">
                        </button>
                    </div>
                </form>
<?php
}
?>




</div>

</body>
</html>
<?php
// Full profile summary 
} else if ($valueSite == '1') {
    ?>
    <!doctype html>
    <html>
    
    <head>
        <title>Profile details</title>
        <link rel="stylesheet" href="graphics.css">
    </head>
    <body>
    <?php

    // Check for deleteable offense
    if ($offenseNumber != null) {
        $query = "delete from record_details where record_number = $offenseNumber AND person_number_record_details = $personIdentification"; 
        $result = mysqli_query($conn, $query) or die("Query failed");
    }
    // person_summary query
    $query = "select * from person_summary where person_number = $personIdentification";
    $result = mysqli_query($conn, $query) or die("Query failed");
    // fetch and show data from query
    while ($row = mysqli_fetch_object($result)) {
        ?>
        <h1 style="text-align: center; border-style: solid;"><?php $row -> first_name ?> full profile summary</h1>
        <div style="border-style: solid; display: flex; justify-content: center;">
        <form action="catalog.php" method="POST">
        <div style="padding: 5px;">
        <input type="hidden" name="valueSite" value="0"/>
        <input type="submit" value="RETURN"/>
        </div>
        </form>
        <form action="catalog.php" method="POST">
        <div style="padding: 5px;">
        <input type="hidden" name="valueSite" value="2"/>
        <input type="hidden" name="personID" value="<?php ECHO $personIdentification ?>"/>
        <input type="submit" value="CHANGE"/>
        </div>
        </form>
        <form action="catalog.php" method="POST">
        <div style="padding: 5px;">
        <input type="hidden" name="valueSite" value="3"/>
        <input type="hidden" name="personID" value="<?php ECHO $personIdentification ?>"/>
        <input type="hidden" name="profileAction" value="DEL"/>
        <input type="submit" value="DELETE"/>
        </form>
        </div>
        <form action="profile_create.php" method="POST">
        <div style="padding: 5px;">
        <input type="hidden" name="valueSite" value="1"/>
        <input type="hidden" name="person_number" value="<?php ECHO $row -> person_number ?>"/>
        <input type="hidden" name="person_picture" value="<?php ECHO $row -> picture ?>"/>
        <input type="hidden" name="first_name" value="<?php ECHO $row -> first_name ?>"/>
        <input type="hidden" name="middle_name" value="<?php ECHO $row -> middle_name ?>"/>
        <input type="hidden" name="last_name" value="<?php ECHO $row -> last_name ?>"/>
        <input type="hidden" name="date_of_birth" value="<?php ECHO $row -> date_of_birth ?>"/>
        <input type="hidden" name="state_of_residence" value="<?php ECHO $row -> state_of_residence ?>"/>
        <input type="submit" value="ADD OFFENSE"/>
        </form>
        </div>
        
        </div>

        <!-- Person summary -->
        <div style="display: flex; flex-wrap: wrap; padding: 1em; border-style: solid;">
        <div>
        <div style="border-style: solid; height: 500px; width: 500px; object-fit: contain; border-color: gray;">
        <img style="width: 100%; height: 100%; object-fit: fill;" src="<?php ECHO $row -> picture ?>"/>
        </div>
        <div style="border-style: solid; border-color: gray; text-align: center;">
        <p> First name: <?php ECHO $row -> first_name ?></p>
        <p> Middle name: <?php ECHO $row -> middle_name ?></p>
        <p> Last name: <?php ECHO $row -> last_name ?></p>
        <p> Date of birth: <?php ECHO $row -> date_of_birth ?></p>
        <p> State of residence: <?php ECHO $row -> state_of_residence ?></p>
        </div>
    </div>
    </div>
    <?php
    }
    

    // record_details query
    $query = "select * from record_details where person_number_record_details = $personIdentification";
    $result = mysqli_query($conn, $query) or die("Query failed");

    // fetch and show data from query
    $i = 1;
    while ($row = mysqli_fetch_object($result)) {
    ?>
    <div style="display: flex; flex-wrap: wrap; padding: 2em; border-style: solid;">

    <div style="display: flex;">
    <div>

    <div class="block_image_text">

    <details>
    <summary><h1> OFFENSE NUMBER: <?php ECHO $i ?></h1></summary>
    <h1> Offense date: <br><div style="background-color: red; text-align:center;">
        <?php ECHO $row -> offense_date ?></div></h1>
    <h1> Offense: <br><div style="background-color: red; text-align:center;">
        <?php ECHO $row -> offense ?></div></h1>
    <h1> Disposition outcome: <br><div style="background-color: red; text-align:center;">
        <?php ECHO $row -> disposition_outcome ?></div></h1>
    <h1> Location: <br><div style="background-color: red; text-align:center;">
    <?php ECHO $row -> offense_location_prefix ?> 
    <?php ECHO $row -> offense_location_street_number ?> 
    <?php ECHO $row -> offense_location_street_name ?> 
    <?php ECHO $row -> offense_location_unit ?> in 
    <?php ECHO $row -> offense_location_city ?> in the state of 
    <?php ECHO $row -> offense_location_state ?> 
    <?php if($row -> offense_location_zip_code != 0) { 
    ECHO "with the zip code  ";
    ECHO $row -> offense_location_zip_code;
    }?>
    <?php if($row -> offense_location_county != null) { 
    ECHO "in the county of ";
    ECHO $row -> offense_location_county;
    }?>
    </div></h1>
    </details>
    </div>

    </div>
    </div>

    <!-- Button for deletion and change -->
    <form action="catalog.php" method="POST">
    <div>
    <input type="hidden" name="valueSite" value="1"/>
    <input type="hidden" name="personID" value="<?php ECHO $personIdentification ?>"/>
    <input type="hidden" name="offenseNumber" value="<?php ECHO $row -> record_number ?>"/>
    <input type="submit" value="delete me" style="height: 4.5em; width: 10em; margin-left: 5em"/>
    </div>
    </form>
    <form>    
    <div>
    <input type="submit" value="change me" style="height: 4.5em; width: 10em; margin-left: 5em"/>
    </div>
    </form>

    </div>
    <?php
    $i++;
    }
    ?>
    </body>
    </html>
    <?php

} else if ($valueSite == '2') {

    // $query = "select * from person_summary where person_number = $personIdentification";
    // $result = mysqli_query($conn, $query) or die("Query failed");


    
    // // buttons
    
    // $i = 0;
    // while ($row = mysqli_fetch_object($result)) {
    // ECHO '<h1 style="text-align: center; border-style: solid;"> Edit profile of ', $row -> first_name,'</h1>';
    // ECHO '<div style="border-style: solid; display: flex; justify-content: center;">';
    // ECHO '<form action="catalog.php" method="POST">';
    // ECHO '<div style="padding: 5px";>';
    // ECHO '<input type="hidden" name="valueSite" value="1"></input>';
    // ECHO '<input type="hidden" name="personID" value="',$personIdentification,'"></input>';
    // ECHO '<input type="submit" value="RETURN"></input>';
    // ECHO '</div>';
    // ECHO '</form>';
    // ECHO '</div>';


    //         ECHO '<div style="display: flex; flex-wrap: wrap; padding: 1em; border-style: solid;">';
    //     ECHO '<div>';

    //     ECHO '<div style="border-style: solid; height: 500px; width: 500px; object-fit: contain; border-color: gray;">';
    //     ECHO '<img style="width: 100%; height: 100%; object-fit: fill;" src="', $row -> picture,'"/>';
    //     ECHO '</div>';
    //     ECHO '<div style="border-style: solid; border-color: gray; text-align: center;">';
    //     ECHO '<p> First name: ', $row -> first_name ,'</p>';
    //     ECHO '<p> Middle name: ', $row -> middle_name ,'</p>';
    //     ECHO '<p> Last name: ', $row -> last_name ,'</p>';
    //     ECHO '<p> Date of birth: ', $row -> date_of_birth ,'</p>';
    //     ECHO '<p> State of residence: ', $row -> state_of_residence ,'</p>';
    //     ECHO '</div>';
    //     ECHO "</div>";
    //     ECHO '</div>';


    //     ECHO '<div style="display: flex; flex-wrap: wrap; padding: 2em; border-style: solid;>';
    //     ECHO '<div style="display: flex;>';
    //     ECHO '<div>';
    //     ECHO '<div class="block_image_text">';
    //     ECHO '<details>';
    //     ECHO '<summary><h1> OFFENSE NUMBER: ', $i ,'</h1></summary>';
    //     ECHO '<h1> Offense date: <br><div style="background-color: red; text-align:center;">"', $row -> offense_date,'"</div></h1>';
    //     ECHO '<h1> Offense: <br><div style="background-color: red; text-align:center;">', $row -> offense ,'</div></h1>';
    //     ECHO '<h1> Disposition outcome: <br><div style="background-color: red; text-align:center;">', $row -> disposition_outcome ,'</div></h1>';
    //     ECHO '<h1> Location: <br><div style="background-color: red; text-align:center;">', $row -> offense_location_prefix ,' ', $row -> offense_location_street_number,' ', $row -> offense_location_street_name,' ', 
    //     $row -> offense_location_unit,' in ', $row -> offense_location_city , ' in the state of ', $row -> offense_location_state ,' with the zip code ', $row -> offense_location_zip_code
    //     ,' in the county of ', $row -> offense_location_county, '</div></h1>';
    //     ECHO '</details>';
    //     ECHO '</div>';
    //     ECHO "</div>";
    //     ECHO '</div>';
    //     ECHO '</div>';
    //     $i++;


    // }
    // // change person_summary data
    
    // // change record_details


} else if ($valueSite == '3') {
    ?>
    <h1 style="text-align: center; border-style: solid;"> profile deletion </h1>
        <div style="border-style: solid; display: flex; justify-content: center;">
        <form action="catalog.php" method="POST">
        <div style="padding: 5px;">
        <input type="hidden" name="valueSite" value="0"/>
        <input type="submit" value="RETURN"/>
        </div>
        </form>
        
        </div>
        <?php
    $query = "delete from person_summary where person_number = $personIdentification";
    $result = mysqli_query($conn, $query) or die("Query failed");
    
    $query = "delete from record_details where person_number_record_details = $personIdentification";
    $result = mysqli_query($conn, $query) or die("Query failed");
}

mysqli_close($conn);
