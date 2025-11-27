<?php 
    require_once "connect.php";
    $failure = false;
    $success = false;

    if(!isset($_GET['email'])){
        die('Email Params Missing');
    }else if(isset($_POST['logout']) && $_POST['logout'] == 'Logout'){
        header('Location: index.php');
    }else if(isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])){
        if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
            $failure = "Year & MileAge must be numeric";
        }elseif (strlen($_POST['make']) < 1){
            $failure = "make is Required";
        }else {

            $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :make, :year, :mileage)');
        $stmt->execute(array(
                ':make' => $_POST['make'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage'])
        );
        $success = 'Record inserted';
        }
    }
    $stmt = $pdo->query('SELECT make, year, mileage FROM autos');
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>38d08</title>
</head>
<body>
<h1>Tracking Autos for <?php echo $_GET['email']; ?></h1>

    <?php
    if ($failure !== false) {
        // Look closely at the use of single and double quotes
        echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
    }
    if ($success !== true) {
        // Look closely at the use of single and double quotes
        echo('<p style="color: green;">' . htmlentities($success) . "</p>\n");
    }
    ?>


    <form method="post">
        <p>Make:
            <input type="text" name="make" size="60"/></p>
        <p>Year:
            <input type="text" name="year"/></p>
        <p>Mileage:
            <input type="text" name="mileage"/></p>
        <input type="submit" value="Add">
        <input type="submit" name="logout" value="Logout">
    </form>

    <h2>Automobiles</h2>
    <ul>
        <?php  
        foreach($rows as $row){
            echo '<li>';
            echo htmlentities($row['make'] . ' ' .$row['year'] . ' ' . $row['mileage']);
            echo '</li><br>';
        }
        ?>
    </ul>
</body>

</html>
