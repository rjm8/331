<?php
    include_once 'db.php';
    if ($cnx->connect_error){
		die("Database connection failed: " . $cnx->connect_error);
	}

    if (isset($_POST["model"])){
        $car_count_query = "Select COUNT(*) from CAR";
        $car_count_results = $cnx->query($car_count_query);
        $car_count_result = $car_count_results->fetch_assoc();
        $vin = $car_count_result["COUNT(*)"] + 1;

        $model_choice = explode("/", $_POST["model"]);

        $insert_query = "INSERT INTO CAR(VIN, MName, Year, BID) VALUES (" . $vin . ", '" . $model_choice[0] . "', " . $model_choice[1] . ", " . $_POST["branch"] . ")";
        $cnx->query($insert_query);
        //echo $insert_query;
    }

    $branch_query = "SELECT * from BRANCH";
    $branch_results = $cnx->query($branch_query);

    $branch_arr = array_fill(0, 5, 0);
	$i = 0; 
	while ($row = $branch_results->fetch_assoc()){
		$branch_arr[$i++] = $row;
	}

    $model_query = "SELECT * FROM MODEL";
    $model_results = $cnx->query($model_query);

    $model_arr = array_fill(0, 5, 0);
	$i = 0; 
	while ($row = $model_results->fetch_assoc()){
		$model_arr[$i++] = $row;
	}

?>

<form method="POST">
    <div>
        <label for="model">Model</label>
        <select id="model" name="model">
            <?php foreach ($model_arr as $model) : ?>
                <option value=<?php echo 
                    $model["MName"] . "/" . $model["Year"] ?>
                    ><?php echo $model["Year"] . " " . $model["Make"] . " " . $model["MName"] ?></option>
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

    <input type="submit" value="Add Car" />
</form>