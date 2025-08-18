<?php
// Rendered site number
$valueSite = $_POST['valueSite'] ?? null;

// Json file declaration/initialisation
$json = file_get_contents('intermediary.json');
$profileData = json_decode($json, true);



function renderOffenseTypeOption() {
$offenseTypes = [
    'Animal Cruelty','Arson','Assault','Battery','Bribery',
    'Burglary','Child Abuse','Child Pornography','Conspiracy','Contempt of Court',
    'Cybercrime','Disorderly Conduct','Domestic Violence','Driving Under the Influence (DUI)',
    'Driving Without a License','Embezzlement','Escape','Extortion','Forgery','Fraud','Hate Crime',
    'Homicide','Human Trafficking','Identity Theft','Illegal Weapons Possession','Kidnapping','Larceny',
    'Manslaughter','Money Laundering','Obstruction of Justice','Perjury','Public Intoxication','Resisting Arrest',
    'Robbery','Sexual Assault','Shoplifting','Smuggling','Solicitation','Soliciting Prostitution','Stalking',
    'Tax Evasion','Terrorism','Theft','Trespassing','Violation of Probation'
];
    
    foreach($offenseTypes as $offense){
        echo "<option value=\"{$offense}\">{$offense}</option>\n ";
    }
}

function renderDispositionOutcomes() {
    $dispositionOutcomes = ['Acquittal','Amnesty','Charges dropped/No charges filed','Commutation',
    'Convicted','Deferred Prosecution','Dismissal','Expungement','Pardon','Pending','Reprieve',
    'Sealed','Suspended sentence','Vacated'
    ];


    foreach($dispositionOutcomes as $disposition){
        echo "<option value=\"{$disposition}\">{$disposition}</option>\n ";
    }
}

function renderOffenseLocationState() {
    $offenseLocation = [
    'ALABAMA','ALASKA','ARIZONA','ARKANSAS','CALIFORNIA','COLORADO','CONNECTICUT','DELAWARE','FLORIDA',
    'GEORGIA','HAWAII','IDAHO','ILLINOIS','INDIANA','IOWA','KANSAS','KENTUCKY','LOUISIANA','MAINE',
    'MARYLAND','MASSACHUSETTS','MICHIGAN','MINNESOTA','MISSISSIPPI','MISSOURI','MONTANA','NEBRASKA',
    'NEVADA','NEW HAMPSHIRE','NEW JERSEY','NEW MEXICO','NEW YORK','NORTH CAROLINA','NORTH DAKOTA',
    'OHIO','OKLAHOMA','OREGON','PENNSYLVANIA','RHODE ISLAND',
    'SOUTH CAROLINA','SOUTH DAKOTA','TENNESSEE','TEXAS',
    'UTAH','VERMONT','VIRGINIA','WASHINGTON',
    'WEST VIRGINIA','WISCONSIN','WYOMING'];
    
    
    foreach ($offenseLocation as $location) {
        echo "<option value=\"{$location}\">{$location}</option>\n ";
    }
}

function renderOffenseLocationStreetType()  {
    $OffenseLocationStreetType = [
        'Avenue','Boulevard','Circle','Court','Drive','Highway',
    'Lane','Parkway','Place','Road','Street','Terrace','Trail','Way'
];


    foreach ( $OffenseLocationStreetType as $location) {
        echo "<option value=\"{$location}\">{$location}</option>\n ";
}
}

function renderProfileDisplay($profileData) {

    echo    '<img src="Images/', htmlspecialchars(basename($profileData['picture'])),'"></img> <br>';
    echo    '        <div class="block_image_text">';
    echo    '            <p> FIRST NAME: </p>', $profileData['firstname'],' <br>';
    echo    '            <p> MIDDLE NAME: </p>', $profileData['middlename'],' <br>';
    echo    '            <p> LAST NAME: </p>', $profileData['lastname'],' <br>';
    echo    '            <p> DATE OF BIRTH: </p>', $profileData['dateofbirth'],' <br>';
    echo    '            <p> STATE OF RESIDENCE: </p>', $profileData['stateofresidence'];
    echo    '        </div>';

}


if ($valueSite == null) {
    
    $profileData = [
        "picture" => "",
        "firstname" => "",
        "middlename" => "",
        "lastname" => "",
        "dateofbirth" => "",
        "stateofresidence" => "",
        "criminalrecord" => "[]"
    ];

    $updateData = json_encode($profileData, JSON_PRETTY_PRINT);
    file_put_contents("intermediary.json", $updateData);

ECHO '
<html>

<head>
    <title>Profile creation</title>
    <link rel="stylesheet" href="graphics.css">
</head>

<body>
<div class="block_text">
            <h1>Create a profile</h1>
</div>

<div class="block_image_text">
               <form action="profile_create.php" method="POST" enctype="multipart/form-data">
                    <br>
                    <p>Picture:</p>
                    <input name="person_picture" type="file">
                    <p>First name:</p>
                    <input name="first_name">
                    <p>Middle name:</p>
                    <input name="middle_name">
                    <p>Last name:</p>
                    <input name="last_name">
                    <p>Date of birth:</p>
                    <input name="date_of_birth" type="date">
                    <p>State of residence:</p>
                    <select name="state_of_residence">
                '; 
                        $state_of_residence = [
                        'ALABAMA', 'ALASKA', 'ARIZONA', 'ARKANSAS', 'CALIFORNIA',
                        'COLORADO', 'CONNECTICUT', 'DELAWARE', 'FLORIDA', 'GEORGIA',
                        'HAWAII', 'IDAHO', 'ILLINOIS', 'INDIANA', 'IOWA',
                        'KANSAS', 'KENTUCKY', 'LOUISIANA', 'MAINE', 'MARYLAND',
                        'MASSACHUSETTS', 'MICHIGAN', 'MINNESOTA', 'MISSISSIPPI', 'MISSOURI',
                        'MONTANA', 'NEBRASKA', 'NEVADA', 'NEW HAMPSHIRE', 'NEW JERSEY',
                        'NEW MEXICO', 'NEW YORK', 'NORTH CAROLINA', 'NORTH DAKOTA', 'OHIO',
                        'OKLAHOMA', 'OREGON', 'PENNSYLVANIA', 'RHODE ISLAND', 'SOUTH CAROLINA',
                        'SOUTH DAKOTA', 'TENNESSEE', 'TEXAS', 'UTAH', 'VERMONT',
                        'VIRGINIA', 'WASHINGTON', 'WEST VIRGINIA', 'WISCONSIN', 'WYOMING'
                        ];
                        foreach ($state_of_residence as $state){
                            ECHO "<option value=\"{$state}\">{$state}</option>\n ";
                        };
                    ECHO '   
                    </select>
                    <br>
                    <input type="hidden" name="valueSite" value="1">
                    <button type="submit">NEXT</button>
                    <br>
                </form>
</div>
</body>

</html>
';
}

if ($valueSite == "1") {

    if ($profileData['firstname'] === "") {
    $var_person_picture = $_FILES['person_picture'];
    $var_first_name = $_POST['first_name'];
    $var_middle_name = $_POST['middle_name'];
    $var_last_name = $_POST['last_name'];
    $var_date_of_birth = $_POST['date_of_birth'];
    $var_state_of_residence = $_POST['state_of_residence'];
    $var_directory = "Images/";
    $var_target_file = $var_directory.basename($_FILES['person_picture']['name']);
    move_uploaded_file($_FILES["person_picture"]["tmp_name"], $var_target_file);

    $profileData = [
        "picture" => $var_target_file,
        "firstname" => $var_first_name,
        "middlename" => $var_middle_name,
        "lastname" => $var_last_name,
        "dateofbirth" => $var_date_of_birth,
        "stateofresidence" => $var_state_of_residence,
        "criminalrecord" => []
    ];

    $updateData = json_encode($profileData, JSON_PRETTY_PRINT);
    file_put_contents("intermediary.json", $updateData);
    }


if (isset($_POST['criminalEntry']))
    {
        // Clear criminal entries
        $profileData['criminalrecord'][] = [
            'offensedate' => $_POST['offense_date'],
            'typeofoffense' => $_POST['type_of_offense'],
            'dispositionoutcome' => $_POST['disposition_outcome'],
            'offenselocationprefix' => $_POST['offense_location_prefix'],
            'offenselocationstreetnumber' => $_POST['offense_location_street_number'],
            'offenselocationstreetname' => $_POST['offense_location_street_name'],
            'offenselocationstreettype' => $_POST['offense_location_street_type'],
            'offenselocationunit' => $_POST['offense_location_unit'],
            'offenselocationcity' => $_POST['offense_location_city'],
            'offenselocationstate' => $_POST['offense_location_state'],
            'offenselocationzipcode' => $_POST['offense_location_zip_code'],
            'offenselocationcounty' => $_POST['offense_location_county']
        ];
        $updateData = json_encode($profileData, JSON_PRETTY_PRINT);
        file_put_contents("intermediary.json", $updateData);
    }

if (isset($_POST["clearSession"])) {
    $profileData['criminalrecord'] = [];
    $updateData = json_encode($profileData, JSON_PRETTY_PRINT);
    file_put_contents("intermediary.json", $updateData);
}


function renderCriminalRecordEntries($profileData){
    if ($profileData['criminalrecord'] != []){
        ECHO 'criminal record entries ('.count($profileData['criminalrecord'])." total)";
        
        foreach ( $profileData["criminalrecord"] as $entry ){
        ECHO '
        <div class="block_image_text"> ';
            echo "Type of Offense: <b>" . $entry["typeofoffense"] . "</b> - ";
            echo "Offense Date: <b>" . $entry["offensedate"] . "</b> - ";
            echo "Disposition Outcome: <b>" . $entry["dispositionoutcome"] . "</b><br>";
            echo "Location Prefix: <b>" . $entry["offenselocationprefix"] . "</b> - ";
            echo "Street Number: <b>" . $entry["offenselocationstreetnumber"] . "</b> - ";
            echo "Street Name: <b>" . $entry["offenselocationstreetname"] . "</b> - ";
            echo "Street Type: <b>" . $entry["offenselocationstreettype"] . "</b><br>";
            echo "Unit: <b>" . $entry["offenselocationunit"] . "</b> - ";
            echo "City: <b>" . $entry["offenselocationcity"] . "</b> - ";
            echo "State: <b>" . $entry["offenselocationstate"] . "</b><br>";
            echo "Zip Code: <b>" . $entry["offenselocationzipcode"] . "</b> - ";
            echo "County: <b>" . $entry["offenselocationcounty"] . "</b> - ";
            echo "<hr>";
        ECHO '
        </div>
        '; 
     }}
      else {
        ECHO 'No criminal record entries exist';
    }
}

function renderAll($profileData){
    ECHO ' 
<html>

<head>
    <title>Criminal Profile</title>
    <link rel="stylesheet" href="graphics.css">
</head>

<body>
    <div class="block_text">
            <h1>Create a profile</h1>
    </div>
    <div style="display: flex; flex-direction: row;
    height: 100vh;">
        <div class="container-column">
            <div class="block_image_text">
        </div>
';
renderProfileDisplay($profileData);
ECHO 
'
    </div>
        <div class="block_image_text">
            <h1>Add criminal record entry</h1> <br>
            <form action="profile_create.php" method="POST">
<h2>Date of offense</h2><input name="offense_date" type="date"><br><br>
<h2>Type of offense</h2>
<select name="type_of_offense">';
renderOffenseTypeOption();
ECHO '
</select><br><br>
<h2>Disposition outcome</h2>
<select name="disposition_outcome">
';
renderDispositionOutcomes();
ECHO '
</select><br><br>
<div class="container-column-group">
<h2>Location of offense</h2>
Precisation of location
<select name="offense_location_prefix">
<option value="at">AT</option>
<option value="in">IN</option>
<option value="near">NEAR</option>
</select><br>
street number
<input name="offense_location_street_number" type="number"><br>
street name
<input name="offense_location_street_name" type="text"><br>
street type
<select name="offense_location_street_type">
';
renderOffenseLocationStreetType();
ECHO '
</select><br>
street unit (optional)
<input name="offense_location_unit"><br>
city
<input name="offense_location_city"><br>
state
<select name="offense_location_state">
';
renderOffenseLocationState();
ECHO '
</select><br>
zip code (optional)
<input name="offense_location_zip_code" type="number"><br>
county (optional)
<input name="offense_location_county" type="text"><br>
<div>
<br>
<input type="hidden" name="valueSite" value="1">
<br>
<input type="submit" name="criminalEntry" value="Add Entry">
</div>
</div>

</form>
</div>
<div class="block_image_text">
<h1>Criminal record entries</h1> <br>

';
renderCriminalRecordEntries($profileData);
ECHO '
<br><br>

<form action="profile_create.php" method="POST"><br><br>
<input type="hidden" name="valueSite" value="1">
<input type="submit" name="clearSession" value="CLEAR CRIMINAL RECORD">
</form>
<form action="profile_create.php" method="POST"><br><br>
<input type="hidden" name="valueSite" value="2">
<input type="submit" name="finishProfileCreation" value="FINISH CRIMINAL RECORD CREATION"><br><br>
</form>
</div>
</form>
</div>
</body>
</html>';
}

renderAll($profileData);
}

if ($valueSite == "2") {
    include "database_connection.txt";
    $conn = mysqli_connect($host, $user, $password, $db) or die("Connection has failed");
    $query = "insert into person_summary values (NULL, '{$profileData["picture"]}', '{$profileData["firstname"]}','{$profileData["lastname"]}', '{$profileData["middlename"]}', '{$profileData["dateofbirth"]}', '{$profileData["stateofresidence"]}')";
    
    $result = mysqli_query($conn, $query) or die("query failed");

    $person_number = mysqli_insert_id($conn);

    foreach ($profileData["criminalrecord"] as $entry) {
    $query = "insert into record_details values (
    '{$person_number}', 
    '{$entry["offensedate"]}', 
    '{$entry["typeofoffense"]}', 
    '{$entry["dispositionoutcome"]}', 
    '{$entry["offenselocationprefix"]}', 
    '{$entry["offenselocationstreetnumber"]}', 
    '{$entry["offenselocationstreetname"]}', 
    '{$entry["offenselocationstreettype"]}', 
    '{$entry["offenselocationunit"]}', 
    '{$entry["offenselocationcity"]}', 
    '{$entry["offenselocationstate"]}', 
    '{$entry["offenselocationzipcode"]}', 
    '{$entry["offenselocationcounty"]}',
    NULL)";
     mysqli_query($conn, $query) or die("query failed");
    }

    
    $profileData = [
        "picture" => "",
        "firstname" => "",
        "middlename" => "",
        "lastname" => "",
        "dateofbirth" => "",
        "stateofresidence" => "",
        "criminalrecord" => "[]"
    ];

    $updateData = json_encode($profileData, JSON_PRETTY_PRINT);
    file_put_contents("intermediary.json", $updateData);


    ECHO "There seem to have been no issues with the profile creation.";
    ECHO '<form action="main_site.html">';
    ECHO '<input type="submit" value="Return to main page"/>';
    ECHO '</form>';
}
?>