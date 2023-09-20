<!DOCTYPE html>
<html>
<head>
    <title>INF115 - CE3</title>
</head>
<body>
<h1>INF115 - Compulsary exercise 3</h1>

<?php
/*
    Database configuration
*/

// Connection parameters
$host 		= 'localhost';
$user 		= 'root';
$password 	= '';
$db 		= 'bysykkel';

// Connect to the database
$conn = mysqli_connect($host, $user, $password, $db);

// Connection check
if(!$conn) {
    exit('Error: Could not connect to the database.');
}

// Set the charset
mysqli_set_charset($conn, 'utf8');
?>

<h1> Task 1 </h1>
<h2> a) </h2>

<?php
if (isset($_POSTT["student_id"]) || isset($_POST["name"])){
    echo "<b>".$_POST["name"]."</b>"."<br>";
    echo "<b>".$_POST["student_id"]."</b>"."<br>";
    exit();
}
?>
<html>
<body>
<form action='<?php $_SERVER["PHP_SELF"]?>' method="post">
    Name:<br><input type="text" name="name"><br>
    Student ID:<br><input type="text" name="student_id"><br>
    <input type="submit">
</form>
</body>
</html>

<h2> b) </h2>

<head>
    <title>Required Field Validator</title>
</head>
<form method="post" action="CE3.php">
    Name:<br><input type="text" name="s_name">
    <br>
    Email:<br><input type="text" name="EmailAddress">
    <br>
    Phone Number:<br><input type="text" name="PhoneNumber">
    <br>
    <input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
    </div>
</form>
</center>
<?php


if(isset($_POST['submit'])){
    $s_name=$_POST['s_name'];
    $PhoneNumber=$_POST['PhoneNumber'];
    $EmailAddress=$_POST['EmailAddress'];

    //If one of these fields are empty, it will ask you to try again until all fields are filled in.
    if($s_name=='') {
        echo "<script>alert('Please enter a name')</script>";
        exit();
    }
    if($PhoneNumber=='') {
        echo "<script>alert('please enter a phone number')</script>";
        exit();
    }
    if($EmailAddress=='') {
        echo "<script>alert('please enter an email address')</script>";
        exit();
    }

?>

<h2> c) </h2>

    <?php
    // This script shows up when you have submitted details to b).
    ?>

    <h2> Valid or not?</h2>
<?php
    if ( !preg_match ("/^[a-zA-Z\s]+$/",$s_name)) {
        echo $s_name." is not Valid<br>";
    }
    else
    {
        echo $s_name." is Valid<br>";
    }
    $length = strlen ($PhoneNumber);
    if ( $length == 8) {
        echo $PhoneNumber." is Valid<br>";
    } else {
        echo $PhoneNumber." is not Valid<br>";
    }
    if (!filter_var($EmailAddress, FILTER_VALIDATE_EMAIL)) {
        echo $EmailAddress." is not Valid<br>";
    }
    else{
        echo $EmailAddress." is Valid<br>";

    }
}
?>

<h1> Task 2 </h1>
<h2> a) </h2>
<?php
//Styling
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Name</th></tr>";
echo "</table>";
echo "<br>";
?>

<?php
$sql = "SELECT name FROM users ORDER BY name";
$result = $conn->query($sql);
if(mysqli_num_rows($result) > 0){
    echo "<table>";
    echo "<tr>";
    echo "</tr>";
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<h2> b) </h2>
<?php
//Styling
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Bike Name</th><th>Status</th></tr>";
echo "</table>";
?>

<?php
    $sql = "SELECT name,status FROM bikes GROUP BY name;";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0){

        while($row = $result->fetch_assoc()) {
        echo "<br>". $row["name"]. " ". $row["status"]. "<br>";
        }
    }
?>

<h2> c) </h2>
<?php
//Styling
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Table</th><th>Rows</th></tr>";
echo "</table>";
?>

<?php
    $sql = "SELECT table_name, table_rows FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'bysykkel'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0){

        while($row = $result->fetch_assoc()) {
            echo  $row["table_name"]. " ". $row["table_rows"]. "<br>";
        }
}
?>

<h1> Task 3 </h1>
<h2> a) </h2>
<?php
//Styling
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Table</th><th>Attributes</th>";
?>

<?php
    $result = mysqli_query($conn, "show tables");
    while($row = mysqli_fetch_array($result)) {
        $result2 = mysqli_query($conn, "SELECT group_concat(COLUMN_NAME) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'bysykkel' AND TABLE_NAME = '" . $row[0] . "'");
        $row2 = mysqli_fetch_row($result2);
        echo "<tr><td>" . $row[0] . " " .  "</td><td>" . $row2[0] . "<br>". " " . "</td></tr>";
    }
    echo "</table>";
?>

<h2> b) </h2>
<?php
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Station_id</th><th>Name</th><th>Trips</th></tr>";
?>

<?php
$sql = "SELECT station_id, name, end_station, COUNT(*) as count FROM stations, trips GROUP BY station_id"; //Unsure how to approach this..
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo  "<td>". $row["station_id"]. "</td>" ." ". "<td>". $row["name"]. " " . "</td>" . " " . "<td>". $row["count"]. "<br>" . "</td>";
}
echo "</table>";
?>

<h2> c) </h2>
<?php
//Styling
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>User_ID</th><th>Name</th><th>2021</th><th>2020</th><th>2019</th><th>2018</th></tr>";
?>

<?php
    $result = mysqli_query($conn, "SELECT user_id, name FROM users");
    while($row = mysqli_fetch_array($result)) {
        $result2 = mysqli_query($conn, "SELECT YEAR(start_time) as year, COUNT(*) as count from subscriptions WHERE user_id = " . $row["user_id"] . " GROUP BY year");
        $year2018 = 0;
        $year2019 = 0;
        $year2020 = 0;
        $year2021 = 0;
        while($row2 = mysqli_fetch_array($result2)) {
            ${"year" . $row2["year"]} = $row2["count"];
        }
        echo "<tr><td>".$row["user_id"]."</td><td>".$row["name"]."</td><td>".$year2021."</td><td>".$year2020."</td><td>".$year2019."</td><td>".$year2018."</td></tr>";
    }
echo "</table>";

?>



<h1> Task 4 </h1>
<?php
$station = "";
if (isset($_POST['station'])){
    $station = $_POST['station'];
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <label for="station">Choose a station:</label>
    <select name="station" id="station">

        <?php
        $sql = "SELECT name FROM stations";
        $result = $conn->query($sql);
        if(mysqli_num_rows($result) > 0){
            while($row = $result->fetch_assoc()) {
                ?>
                <option value="<?php echo $row["name"]?>" <?php echo ($row["name"] == $station)?"selected":""?> ><?php echo $row["name"]?></option>
                <?php
            }
        }
        ?>
    </select>
    <input type="submit" id="stationSubmit" name="stationSubmit" value="Submit">
</form>
<br/>
<?php
if (isset($_POST['stationSubmit'])){
    //Styling
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Name</th><th>Availability</th><th>Location</th></tr>";
    //
    $sql = "SELECT name, available_spots,max_spots, latitude, longitude FROM stations WHERE name = '".$station."'";
    $result = $conn->query($sql);
    if(mysqli_num_rows($result) > 0){

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo  "<td>". $row["name"]. "</td>";
            $avai_percent = number_format($row["available_spots"] * 100.0 / $row["max_spots"], 2);
            echo  "<td>". $avai_percent. "%</td>";
            echo  "<td><a href='https://www.google.com/maps?q=". $row["latitude"].",". $row["longitude"]. "'>Link</a></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}

?>

<br/><br/><br/>


</body>
</html>