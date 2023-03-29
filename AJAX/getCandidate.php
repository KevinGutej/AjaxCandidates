<?php



$connection = new mysqli("localhost", "root", "", "hr");


$id = $_GET["id"];
if(empty($id) || !isset($id) ) {
    echo 'There is no data provided';
    exit();
}

if($connection->errno == 0)
{
    if(!isset($_COOKIE["lastCandidate"])) {
        $request = "SELECT MAX(id) AS maxId FROM candidates;";
        $result = $connection->query($request);
        if($result === false) {
            echo 'Error with getting id of last candidate';
            exit();
        }
        else {
            $row = $result->fetch_assoc();
            setcookie("lastCandidate", $row["maxId"],time() + 3600);
        }
    }
    
    $id = (int)$id;
    $request = "SELECT firstName FROM candidates WHERE id=$id;";
    $result = $connection->query($request);
    if($result === false) {
        echo 'Error getting candidate';
        exit();
    }
    else {
        $row = $result->fetch_assoc();
        echo $row["firstName"];
    }
}else {
    echo 'Failed to connect with database';
}
