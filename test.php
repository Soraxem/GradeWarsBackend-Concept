<?php
$servername = "localhost";
$username = "parfellox";
$password = "passwort";
$dbname = "GWS";


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT ID, username, password FROM users WHERE username='" . $_POST['username'] ."'";
$result = mysqli_query($conn, $sql);


$verivied = 0;
if (mysqli_num_rows($result) > 0) {
    // output data of each row
	if(mysqli_num_rows($result) == 1){
    		while($row = mysqli_fetch_assoc($result)) {
        		if($row["password"] == $_POST['password']){
				$verivied = 1;
				$id = $row["ID"];
			}
    		}
	}
}







sleep(10);




if($verivied == 1){
	$newKey = generateRandomString(50);
	$sql = "UPDATE `users` SET `session_key`= '" . $newKey . "' WHERE `ID` = " . $id;
	mysqli_query($conn, $sql);
	echo $newKey;
} else {
	echo "falseArgs";
}


mysqli_close($conn);
?>
