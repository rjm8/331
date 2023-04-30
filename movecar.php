<?php
    include_once 'db.php';
    if ($cnx->connect_error){
		die("Database connection failed: " . $cnx->connect_error);
	}

    $branch_query = "SELECT * from BRANCH";
    $branch_results = $cnx->query($branch_query);

    $branch_arr = array_fill(0, 5, 0);
	$i = 0; 
	while ($row = $branch_results->fetch_assoc()){
		$branch_arr[$i++] = $row;
	}
?>

<form method="POST">
    <div>
        <label for="branch">Branch</label>
        <select id="branch" name="branch">
            <?php foreach ($branch_arr as $branch) : ?>
                <option value=<?php echo $branch["BID"] ?>><?php echo $branch["Location"] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</form>