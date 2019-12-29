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
            }
            else
            {
                $id = $_GET['id'];
                $sql = "DELETE FROM `data` WHERE id='$id'";
                mysqli_query($db, $sql);
            
            }
            header('Location: admin.php');
?>