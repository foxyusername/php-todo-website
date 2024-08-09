<?php 
session_start();
include('database.php');

if(!isset($_SESSION['id'])){
    header('Location: register.php');
}

$array = [];

function selectTodo(&$array){
    global $conn;

    $query="SELECT * FROM todos WHERE userId={$_SESSION['id']}";

  $result = mysqli_query($conn,$query);

  if($result){
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach($rows as $row){
        array_push($array,"{$row['todo']}, {$row['deadline']}");
    }
  }else{
    die('something went wrong: ' . mysqli_error());
  }

}

selectTodo($array);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div>
   <form action="home.php" method='post'>
   <input type="text" placeholder='Type in your work...' name='todoField'>
   <input type="text" placeholder='Deadline...' name='deadline'>
   <button id='addBtn' onClick='handleClick()' value='1' name=addBtn>+</button>
   </form>

    <div>
        <?php 
        foreach($array as $data){
            echo "<p>" . htmlspecialchars($data) . "</p>";
        }
        ?>
    </div>

</div>

<form action="home.php" method='post'>
<button value='1' name='logout'>log out</button>
</form>

</body>
</html>

<?php

if(isset($_POST['addBtn'])){
    //array_push($array,$_POST['todoField']);    
    $todo=$_POST['todoField'];
    $deadline=$_POST['deadline'];
    InsertTodo($todo,$deadline);
    header('Location: home.php');
    exit();
}

function InsertTodo($todo,$deadline){
    global $conn;

$query="INSERT INTO todos (userId,todo,deadline) VALUES ('{$_SESSION['id']}','{$todo}','{$deadline}')";

$result=mysqli_query($conn,$query);

if(!$result) die("something went wrong: " . mysqli_error());


}

function deleteTodo($todo){
  
}

if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header('Location: register.php');
}
?>