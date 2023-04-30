<?php
    include_once 'db.php';
    if ($cnx->connect_error){
		die("Database connection failed: " . $cnx->connect_error);
	}

    if (isset($_POST["class"])){
        $insert_query = "INSERT INTO MODEL(MName, Year, CID, Make) VALUES('" 
        . $_POST["model"] . "', " . $_POST["year"] . ", " . $_POST["class"] . ", '" . $_POST["make"] . "')";
        $cnx->query($insert_query);
        header("Location: newcar.php");
    }


?>

<form method="POST">
    <div>
        <label for="class">Class</label>
        <select id="class" name="class">
            <?php foreach (range(1, 5, 1) as $class) : ?>
                <option value=<?php echo $class ?>><?php echo $class ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="year">Year</label>
        <select id="year" name="year">
            <?php foreach (range(1980, 2023, 1) as $year) : ?>
                <option value=<?php echo $year ?>><?php echo $year ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="make">Make</label>
        <input type="text" id="make" name="make" required />
    </div>
    <div>
        <label for="model">Model</label>
        <input type="text" id="model" name="model" required />
    </div>
    <input type="submit" value="Add Model" />
</form>