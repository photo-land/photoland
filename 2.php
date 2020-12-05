<?php 
    include("connect.php");
    $id = $_GET['id'];
    $query = $conn -> query("SELECT * FROM `recents` WHERE `id_photo` = '".$id."'");
    if(mysqli_num_rows($query)!=0){
        $query1 = $conn -> query("UPDATE recents SET `all_recents` = `all_recents`+2 WHERE `id_photo` = '".$id."'");
        $query2 = $conn -> query("UPDATE recents SET `count_recent` = `count_recent`+1 WHERE `id_photo` = '".$id."'");
        header('Location: photo.php?id='.$id);
    } else {
        $query1 = $conn -> query("INSERT INTO `recents` (`all_recents`, `count_recent`, `id_photo`) 
                        VALUES ('2', '1', '".$id."');");
        header('Location: photo.php?id='.$id);
    }
?>