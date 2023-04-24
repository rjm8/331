<html>
<body>
<h1>Select Location</h1>
<form onsubmit="return true" method="POST">
    <input type="radio" id="1" name="location" value=1>
    <label for="1">New York</label><br>
    <input type="radio" id="2" name="location" value=2>
    <label for="2">Philadelphia</label><br>
    <input type="radio" id="3" name="location" value=3>
    <label for="3">Boston</label><br>
    <input type="radio" id="4" name="location" value=4>
    <label for="4">Ho Chi Minh</label><br>
    <input type="radio" id="5" name="location" value=5>
    <label for="5">Baltimore</label><br>
    <input type="submit" class="mt-3 btn btn-primary" value="Show Cars" />
</form>
<ul>
    <?php
        if (isset($_POST["location"])) {
            $cnx = new mysqli('localhost', 'root', 'Chicken1!', 'rentacar'); 

            if ($cnx->connect_error)
                die('Connection failed: ' . $cnx->connect_error);
        
            $query = 'SELECT * FROM CAR WHERE BID=' . $_POST["location"];
            $cursor = $cnx->query($query);
            while ($row = $cursor->fetch_assoc()) {
                echo '<li>';
                echo $row['Year'] . ' ' . $row['MName'];
                //echo '<button onclick="window.location.href = \'compare.php?id=' . $row['id'] . '\';">Buy</button>';
                echo '</li>';
            }
        }
    ?>
</ul>
</body>
</html>