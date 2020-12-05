<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo - Land | Dodaj Zdjęcie</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
    <link rel="stylesheet" href="add_photo.css">
</head>
<body>
    <!-- nagłówek -->

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
    <!-- Formularz -->
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="email" name="email" id="email" placeholder="E-mail">
        <input type="text" name="title" id="title" placeholder="Title">
        <!-- Napis "Dodaj zdjęcie" -->
        <div id="add_photo">
            <span id="img" class="material-icons">
                image
            </span>
            <p>Dodaj zdjęcie:</p>
        </div>
        <div id="kreska"></div>
        <!-- Input[file] -->
        <input type="file" name="Photo" id="Photo" placeholder="Prześlij">
        <label for="Photo" class="custom-file-upload">
            <div id="sended_photo">
                <p>Kliknij aby dodać zdjęcie</p>
            </div>   
        </label>
        <!-- przyciski -->
        <div id="button">
            <input type="submit" name="dodaj" id="dodaj" value="Dodaj" class="btn">
            
        </div>
    </form>
    
    <?php 
        include_once("connect.php");
        if(isset($_POST['dodaj'])){
            $email = $_POST['email'];
            $title = $_POST['title'];
            $data = date('Y-m-d');
            $target_dir = "img/";
            $target_file = $target_dir . basename($_FILES["Photo"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST["dodaj"])) {
                $check = getimagesize($_FILES["Photo"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "</p style='color:white'>Plik nie jest zdjęciem</p>";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                ?>
                <script>
                    document.getElementById('sended_photo').innerHTML += "<p style='color:red'>Plik o tej nazwie znajduję się w bazie danych</p>";
                </script>
                <?php
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["Photo"]["size"] > 10485760) {
                ?>
                <script>
                    document.getElementById('sended_photo').innerHTML += "<p style='color:red'>Wybierz zdjęcie o mniejszym rozmiarze</p>";
                </script>
                <?php
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                ?>
                <script>
                    document.getElementById('sended_photo').innerHTML += "<p style='color:red'>Wybierz zdjęcie o rozszerzeniu: JPG, JPEG lub PNG</p>";
                </script>
                <?php
                
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                ?>
                <script>
                    document.getElementById('sended_photo').innerHTML += "<p style='color:red'>Przykro nam, zdjęcie nie zostało przesłane.</p>";
                </script>
                <?php
                
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["Photo"]["tmp_name"], $target_file)) {
                    ?>
                    <script>
                        document.getElementById('sended_photo').innerHTML += "<p style='color:red'> Plik ". <?php> htmlspecialchars( basename( $_FILES["Photo"]["name"]))?> ." został przesłany.</p>";
                    </script>
                    <?php
                    // echo "<p style='color:white'> Plik ". htmlspecialchars( basename( $_FILES["Photo"]["name"])). " został przesłany.</p>";
                    $query = $conn -> query("INSERT INTO `photos` (`photo`, `checked`, `add_date`, `title`, `email`) 
                         VALUES ('".$_FILES['Photo']['name']."', '0', '".$data."', '".$title."', '".$email."');");
                } else {
                    ?>
                    <script>
                        document.getElementById('sended_photo').innerHTML += "<p style='color:red'>Przepraszamy, wystąpił błąd z przesyłaniem zdjęcia.</p>";
                    </script>
                    <?php
                    
                }
            }
        }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        var input = document.getElementById( 'Photo' );
        var infoArea = document.getElementById( 'sended_photo' );

        input.addEventListener( 'change', showFileName );

        function showFileName( event ) {
        
        // the change event gives us the input it occurred in 
        var input = event.srcElement;
        
        // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
        var fileName = input.files[0].name;
        
        // use fileName however fits your app best, i.e. add it into a div
        infoArea.textContent = 'Nazwa zdjęcia do przesłania: ' + fileName;
        }
    </script>
</body>
</html>