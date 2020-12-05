<?php 
        include_once("connect.php");
        if(isset($_POST['dodaj'])){
            $email = $_POST['email'];
            $title = $_POST['title'];
            $data = date('Y-m-d');
            if(isset($_FILES['Photo'])){
                $errors= array();
                $file_name = $_FILES['Photo']['name'];
                $file_size =$_FILES['Photo']['size'];
                $file_tmp =$_FILES['Photo']['tmp_name'];
                $file_type=$_FILES['Photo']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['Photo']['name'])));
                
                $extensions= array("jpeg","jpg","png");
                
                if(in_array($file_ext,$extensions)=== false){
                   $errors[]="Błędne rozszerzenie. Wybierz plik o rozszerzeniu JPEG, JPG lub PNG";
                }
                
                if($file_size > 10485760){
                   $errors[]='Zdjęcie nie może być większe niż 10MB';
                }
                
                if(empty($errors)==true){
                   move_uploaded_file($file_tmp,"img/".$file_name);
                   echo "Dodano";
                }else{
                   print_r($errors);
                }
                
                $query = $conn -> query("INSERT INTO `photos` (`photo`, `checked`, `add_date`, `title`, `email`) 
                         VALUES ('".$file_name."', '0', '".$data."', '".$title."', '".$email."');");
             }
        }
    ?>