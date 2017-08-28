<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CLICK Web Design</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="margin: 20px">

<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "acreditare";

if($_GET['q']==2){

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM mesaj WHERE id=". $_GET['ms'];

if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-danger'>
  <strong>Danger!</strong> Mesajul a fost sters cu succes!
</div>";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
echo "<br><a class='w3-btn' href='index.html'>Home</a>";
}else if($_GET['q']== 1){
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM mesaj";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='alert alert-success pad'>
  <strong>" . $row['numele']. "</strong> <u>". $row['email']. "</u> " . $row['mesaj']." <a class='btn btn-danger' href='mesaj.php?q=2&ms=".$row["id"]."'>Stergere</a></div><br>";
    }
} else {
    echo "
    <div class='alert alert-warning'>
  <strong>Warning!</strong> Nu ai nici un mesaj.
</div>";
}
echo "<br><a class='w3-btn' href='index.html'>Home</a>";
$conn->close();
}
if(isset($_POST['sendMesaj'])){
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO mesaj (numele, email, mesaj)
VALUES ('".$_POST['nume']."', '".$_POST['email']."', '".$_POST['msg']."')";

if ($conn->query($sql) === TRUE) {

    echo "    <div class='alert alert-info'>
  <strong>Info!</strong> Mesajul a fost trimis cu scucces!
</div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br><a class='w3-btn' href='index.html'>Home</a>";
$conn->close();
}
?>
</body>
</html>

