 <!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHOTO-LAND | Strona główna</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c22f07ca69.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main-mobile.css">
</head>

<body id="body">
    <div id="main-container">
        <div id="header">
            

        </div>
        <img id="logo" src="photoland.png" alt="logo">
        <div id="timer">00:00:00</div>
        <div id="menu-icon">
            <input type="checkbox" onclick="myFunction()" id="klik">
            <label for="klik" class="btna">
                <div class="center">
                    <div class="meni">
                        <div class="line"></div>
                    </div>
                </div>
            </label>
            

        </div>
        <div id="blur"></div>
        <div id="menu">
            <div id="cont-container">
                <a href="O_nas.php">
                    <div class="content">O NAS</div>
                </a>
                <a href="contact.php">
                    <div class="content">KONTAKT</div>
                </a>
                <a href="add_photo.php">
                    <div class="content">DODAJ ZDJĘCIE</div>
                </a>
            </div>
        </div>
        
        <div id="background">
        
            <div id="photo-container">
                <?php 
                    include_once("connect.php");
                    $query = $conn -> query("SELECT * FROM `photos` WHERE `checked` = '1' ORDER BY `add_date` DESC");
                    
                    while($row = mysqli_fetch_assoc($query)){
                ?>
               
                <div id="photo">
                <div id="pinezka">
                    <img src="pinezka.png" alt="">
                </div>
                <div id="date" style=" position:absolute; margin-left: -27vw; top:30vh; border-bottom: 3px solid black; font-size:5vh;transform: rotate(270deg);"><?php echo $row["add_date"];?></div>
                    <img src="img/<?php echo $row["photo"];?>" alt="<?php echo $row["title"];?>">
                    <a style="text-decoration: none; color:black;" href="photo.php?id=<?php echo $row["id_photo"];?>">
                        <div id="add">
                            <p style="display: none"><?php echo $row["id_photo"];?></p>
                            <i style="text-decoration: none;"  class="fas fa-comment-dots"></i>
                        </div>
                    </a>
                    <div id="title">
                        <span><?php echo $row["title"];?></span>
                        <span id="add_mail"><?php echo $row["email"];?></span>
                        <?php 
                        $id_photo = $row['id_photo'];
                        $query_licz = $conn -> query("SELECT * FROM `photos` JOIN `comments` ON `photos`.`id_photo` = `comments`.`id_photo` WHERE `comments`.`id_photo` = $id_photo"); 
                        $licz = mysqli_num_rows($query_licz);
                        ?>
                        <span id="count_comments">Komentarzy: <?php echo $licz ?></span>
                    </div>
                </div>
                <?php } ?>
                </div>
        </div>
        
        </div>
    </div>
    <script src="timer.js"></script>
    <script src="hamburger.js"></script>
</body>

</html>