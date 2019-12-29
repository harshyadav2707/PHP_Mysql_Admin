<html>
    <head>
        <title>Administrator</title>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class='bg-secondary'>
        <h1 class="masthead bg-dark text-center text-light">Administrator</h1>
        
            
            
            
    </body>
</html>
           
<?php 
            $servername = "localhost";
            $username = "cipher";
            $password = "";

            // Create connection
            $db = mysqli_connect($servername, $username, $password, 'site_data');

            // Check connection
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }
            session_start();
            if(empty($_GET['id']))
            {
               // Session['msg']="NO id passed";
               // header('Location: admin.php');
            }
            else
            {
            $id=$_GET['id'];
            $res=mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `data` WHERE id=$id"));
            
            echo "    
            <pre>
            <b>
            <form class='form-group text-bold text-light' action='' method='post' enctype='multipart/form-data'>
            Head : <input type='text' value='".$res['title']."' name='head'><br>
            DO NOT CHOOSE IMAGE IF YOU WANT SAME IMAGE
            Image: <input type='file' value='".$res['image']."'name='image'><br>
            Text :
            <textarea cols='50' rows='10' name='text'>".$res['text']."</textarea>
            <input type='submit' name='add' value='Update Data'>
            </form></b>
            </pre>";
            if(isset($_POST['add']))
            {
            $title =$_POST['head'];
            $text =$_POST['text'];
            $ftemp = $_FILES['image']['tmp_name'];
            $fname = $_FILES['image']['name'];
            //if no new image file is selected update the data   
            if(empty($fname)){
                $sql = "UPDATE `data` SET `title`='$title',`text`='$text' WHERE id=$id";
                mysqli_query($db, $sql);
                header('Location: admin.php');
            } 
            else{  
            //delete old file from disk
            $oldimage = mysqli_fetch_array(mysqli_query($db,"SELECT `image` FROM `data` WHERE id=$id"));
            unlink($oldimage['image']);
            //move new file to disk
            $dest="img/".$fname;
            move_uploaded_file($ftemp,$dest);
            
            //update new file location and data to database
            $sql = "UPDATE `data` SET `title`='$title',`text`='$text',`image`='$dest' WHERE id=$id";
            mysqli_query($db, $sql);
            header('Location: admin.php');
            }
            }
            
            }
            
?>