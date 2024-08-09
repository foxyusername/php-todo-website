<?php 

session_start();         //starts the session for this page
include('database.php'); //includes database connection function

if(isset($_SESSION['id'])){
    header('Location: home.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER</title>
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" placeholder='Username...' name="username">
        <input type="password" placeholder='Password...' name="password">
        <button value='clicked' name='registerBtn'>register</button>
    </form>
</body>
</html>

<?php 

if(isset($_POST['registerBtn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    InsertCredentials($username,$password);
}

function InsertCredentials($username,$password){
  global $conn;

$query="INSERT INTO users (username,passkey) values ('${username}','${password}')";

$result=mysqli_query($conn,$query);

if($result){
    $inserted_id = mysqli_insert_id($conn);  //get id of the inserted row
    $_SESSION['id'] = $inserted_id;          //set session variable of that id
    header('Location: home.php');
}else{
    die('something is wrong');
}

}

?>