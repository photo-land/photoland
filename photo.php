<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo - Land | Street</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="photo.css">
</head>
<body>
    <!-- Nagłówek -->
    <div id="header">
        <div id="back">
            <a href="index.php">
                <span id="arrow" class="material-icons">
                    keyboard_backspace
                </span>
            </a>    
        </div>
        <img src="row_black_photoland300px.png" alt="Photo - Land" id="logo">
    </div>
    <div id="main">
        <?php 
            include_once("connect.php");    
        ?>
        <!-- zdjęice + Tytuł -->
        <div id="img">
            <?php 
                $id = $_GET['id'];
                $query = $conn -> query("SELECT * FROM photos WHERE `id_photo` = '".$id."'");
                $row = mysqli_fetch_assoc($query);
            ?>
            <p><?php echo $row['title']?></p>
            <img src="img/<?php echo $row['photo']?>" alt="<?php echo $row['title']?>" id="photo">
        </div>
        <!-- Gwiazdy -->
        <div id="star">
        <?php 
            $id = $_GET['id'];
            $query_star = $conn -> query("SELECT (`all_recents`/`count_recent`) AS AVG FROM recents WHERE `id_photo` = '".$id."'");
            if(mysqli_num_rows($query_star)!=0){
                $row_star = mysqli_fetch_assoc($query_star);
                $count_star = $row_star["AVG"];
            } else {
                $count_star = 0;
            }
            for($i=1;$i<=5;$i++){
                if($i<=$count_star) : ?>
                <a href="<?php echo $i.".php?id=".$id?>">
                    <span style="text-decoration: none; color: rgb(194, 194, 64);" class="material-icons star">
                        star
                    </span>
                </a>
            <?php else : ?>
                <a href="<?php echo $i.".php?id=".$id?>">
                    <span style="text-decoration: none; color: rgb(194, 194, 64);" class="material-icons star">
                        star_border
                    </span>
                </a>
            <?php endif;
                } 
                ?> 
        </div>
        <!-- email + komentarz -->
        <div id="form">
        <form action="" method="POST">
            <input type="email" name="email" id="email" placeholder="E-mail">
            <input type="text" name="kom" id="kom" placeholder="Komentarz">
            <input type="submit" value="WYŚLIJ" name="wyslij" id="wyslij" placeholder="WYŚLIJ">
        </form>
        <?php
            if(isset($_POST['wyslij'])){
                $id = $_GET['id'];
                $email = $_POST['email'];
                $com = $_POST['kom'];
                $data=date('Y-m-d');
                $com_query = $conn -> query("INSERT INTO comments (`conntent`, `email`, `id_photo`, `add_date`) VALUES ('".$com."', '".$email."', '".$id."',  '".$data."')");
            }
        ?>
        <!-- Komentarze -->
        <div id="komentarze">
            <?php 
                $id = $_GET['id'];
                $query1 = $conn -> query("SELECT DISTINCT * FROM comments WHERE `id_photo` = '".$id."' ORDER BY `add_date` DESC");
                while($row1 = mysqli_fetch_assoc($query1)){
            ?>
                <div class="com">
                    <p class="date"><?php echo $row1['add_date']."  ".$row1['email']?></p>
                    <p class="content"><?php echo $row1['conntent']?></p>
                </div>
            <?php } ?>
        </div>  
        </div>
    </div>
    
</body>
</html>