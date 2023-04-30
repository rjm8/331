<?php
    include_once 'db.php';
    if ($cnx->connect_error){
		die("Database connection failed: " . $cnx->connect_error);
	}

    if (isset($_POST["car"])){
        $update_query = "UPDATE CAR SET BID = " . $_POST["branch"] . " WHERE VIN=" . $_POST["car"];
        $cnx->query($update_query);
        echo "Done.";
    }

    $branch_query = "SELECT * from BRANCH";
    $branch_results = $cnx->query($branch_query);

    $branch_arr = array_fill(0, 5, 0);
	$i = 0; 
	while ($row = $branch_results->fetch_assoc()){
		$branch_arr[$i++] = $row;
	}

    $car_count_query = "Select COUNT(*) from CAR";
    $car_count_results = $cnx->query($car_count_query);
    $car_count_result = $car_count_results->fetch_assoc();
    $car_count = $car_count_result["COUNT(*)"];
    
    $car_query = "SELECT * FROM CAR";
    $car_results = $cnx->query($car_query);
    $car_arr = array_fill(0, $car_count, 0);
	$i = 0; 
	while ($row = $car_results->fetch_assoc()){
		$car_arr[$i++] = $row;
	}

?>

<form method="POST">
    <div>
        <label for="car">Car</label>
        <select id="car" name="car">
            <?php foreach ($car_arr as $car) : ?>
                <option value=<?php echo $car["VIN"] ?>><?php echo $car["VIN"] . ", " . $car["Year"] . " " . $car["MName"] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="branch">Branch</label>
        <select id="branch" name="branch">
            <?php foreach ($branch_arr as $branch) : ?>
                <option value=<?php echo $branch["BID"] ?>><?php echo $branch["Location"] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="submit" value="Move Car" />
</form>