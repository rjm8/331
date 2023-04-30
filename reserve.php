<html>
<body>
<form onsubmit="return true" method="POST">
    <h1>Customer Info:</h1>
    <label for="SSN">SSN</label><br>
    <input type="number" id="SSN" name="SSN"><br>
    <label for="FName">First Name</label><br>
    <input type="text" id="FName" name="FName"><br>
    <label for="LName">Last Name</label><br>
    <input type="text" id="LName" name="LName"><br>
    <label for="StreetAddr">Street Address</label><br>
    <input type="text" id="StreetAddr" name="StreetAddr"><br>
    <label for="City">City</label><br>
    <input type="text" id="City" name="City"><br>
    <label for="State">State</label><br>
    <input type="text" id="State" name="State"><br>
    <br>
    <h1>Rental Info:</h1>
    <label for="Class">Class</label><br>
    <input type="number" id="Class" name="Class" min="1" max="5"><br><br>
    <label for="StarteM">Start Date</label>
    <input type="number" id="StarteM" name="StarteM" min="1" max="12" placeholder="Month">
    /
    <input type="number" id="StarteD" name="StarteD" min="1" max="31" placeholder="Day">
    /
    <input type="number" id="StarteY" name="StarteY" placeholder="Year"><br><br>
    <label for="StarteH">Start Time</label>
    <input type="number" id="StarteH" name="StarteH" min="0" max="23" placeholder="Hour">
    :
    <input type="number" id="StarteMin" name="StarteMin" min="0" max="59" placeholder="Minute"><br><br>
    <label for="EndeM">End Date</label>
    <input type="number" id="EndeM" name="EndeM" min="1" max="12" placeholder="Month">
    /
    <input type="number" id="EndeD" name="EndeD" min="1" max="31" placeholder="Day">
    /
    <input type="number" id="EndeY" name="EndeY" placeholder="Year"><br><br>
    <label for="EndeH">End Time</label>
    <input type="number" id="EndeH" name="EndeH" min="0" max="23" placeholder="Hour">
    :
    <input type="number" id="EndeMin" name="EndeMin" min="0" max="59" placeholder="Minute"><br><br>
    <input type="submit" value="Make Reservation" />
</form>
<?php
    include_once 'db.php';
    if ($cnx->connect_error){
		die("Database connection failed: " . $cnx->connect_error);
	}

    if (isset($_POST["SSN"]) && 
        isset($_POST["FName"]) &&
        isset($_POST["LName"]) &&
        isset($_POST["StreetAddr"]) &&
        isset($_POST["City"]) &&
        isset($_POST["State"]) &&
        isset($_POST["Class"]) &&
        isset($_POST["StarteM"]) &&
        isset($_POST["StarteD"]) &&
        isset($_POST["StarteY"]) &&
        isset($_POST["StarteH"]) &&
        isset($_POST["StarteMin"]) &&
        isset($_POST["EndeM"]) &&
        isset($_POST["EndeD"]) &&
        isset($_POST["EndeY"]) &&
        isset($_POST["EndeH"]) &&
        isset($_POST["EndeMin"])) {
            //getting RID
            $query = 'SELECT COUNT(*) FROM RESERVATION';
            $count_r_rs = $cnx->query($query);
            $count_r_r = $count_rs->fetch_assoc();
            $count_r = $count_r_r["COUNT(*)"];
            $count_r = $count_r + 1;
            
            //customer insert
            $query = 'INSERT INTO CUSTOMER(SSN, Fname, Lname, StreetAddr, City, State)
                      VALUES (' . $_POST["SSN"] . ', \'' . $_POST["FName"] . '\', \'' . $_POST["LName"] . '\', \'' . $_POST["StreetAddr"] . '\', \'' . $_POST["City"] . '\', \'' . $_POST["State"] . '\')';
            $cnx->query($query);

            //reservation insert
            $query = 'INSERT INTO RESERVATION(RID, Starte, Ende, CID, SSN)
                      VALUES (' . $count_r . ', \'' . $_POST["StarteY"] . '-' . $_POST["StarteM"] . '-' . $_POST["StarteD"] . " " . $_POST["StarteH"] . ":" . $_POST["StarteMin"] . ':00\', \'' . $_POST["EndeY"] . '-' . $_POST["EndeM"] . '-' . $_POST["EndeD"] . " " . $_POST["EndeH"] . ":" . $_POST["EndeMin"] . ':00\', ' . $_POST["Class"] . ', ' . $_POST["SSN"] . ')';
            $cnx->query($query);

            //confirm
            echo '<br><p>Done.</p>';
    }
?>
</body>
</hmtl>