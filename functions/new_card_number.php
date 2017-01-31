<?php
    require_once("../db/db.php");
    $query = "SELECT active FROM cards WHERE new=1;";
    $result = mysqli_query($connection, $query);
        
    if(!$result){
        die('QUERY FAILED' . mysqli_errno());
    }
    
    $rowcount=mysqli_num_rows($result);
    echo $rowcount;
?>