<?php
require_once("../db/db.php");
$query = "SELECT * FROM attendance ORDER BY id DESC LIMIT 20;";
$result = mysqli_query($connection, $query);
    
if(!$result){
    die('QUERY FAILED' . mysqli_errno());
}


echo '<table class="table table-hover table-condensed">';
echo '<tr>';
echo '<th>#</th>';
echo '<th>Nombre</th>';
echo '<th>Fecha</th>';
echo '<th>Hora</th>';
echo '<th class="text-center">Hora Ac.</th>';
echo '<th class="text-center">Estado</th>';
echo '<th class="text-center">Entrada</th>';
echo '<th class="text-center">ID Tarjeta</th>';
echo '</tr>';
echo '<tbody class="searchable">';
    $i = 1;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)):
        echo '<tr>';
        echo '<td>' . $i . '</td>';
        $get_user = "SELECT * FROM employee WHERE id=".$row['name']." LIMIT 1;";
        $rt = mysqli_query($connection, $get_user);
        $user = mysqli_fetch_array($rt, MYSQLI_ASSOC);
        echo '<td>' . $user['name']. '</td>';
        echo '<td>' . $row['date']. '</td>';
        echo '<td>' . $row['time']. '</td>';
        echo '<td class="text-center">' . $row['timetable']. '</td>';
        echo '<td class="text-center" ';
            if($row['status']=='in') echo "bgcolor=#009a57><font color='#fff'>";
           
            else if($row['status']=='out') echo "bgcolor=#186dee><font color='#fff'>";
            else if($row['status']=='block') echo "bgcolor=#dc4c38><font color='#fff'>";
            echo $row['status'];
        echo '</font></td>';
        echo '<td class="text-center">' . $row['entrance']. '</td>';
        $card_id = 'SELECT * FROM cards WHERE id="' . $row["card_id"] .'" LIMIT 1;';
        $rt = mysqli_query($connection, $card_id);
        $card_id = mysqli_fetch_array($rt, MYSQLI_ASSOC);
        echo '<td class="text-center">' . $card_id['card_id']. '</td>';
        echo '<tr>';
        $i++;
    endwhile;
echo '</tbody>';
echo '</table>';

?>