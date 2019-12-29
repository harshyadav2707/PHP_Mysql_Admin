<html>
    <head>
        <title>Admin</title>
         <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class='bg-secondary'>
        <h1 class="masthead bg-dark text-center text-light">Administrator</h1>
        <pre >
        <form class="form-group text-bold text-light" action="admin.php" method="post" enctype="multipart/form-data">
        <b>Head : <input  type="text" name="head"><br>
        Image: <input type="file" name="image"><br>
        Text :</b>
        <textarea cols="50" rows="10" name="text"></textarea>
        <input  type="submit" name="add" value="Add Item">
        </form>
        </pre>
            
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
                
            if(isset($_POST['add']))
            {
            $title =$_POST['head'];
            $text =$_POST['text'];
            $ftemp = $_FILES['image']['tmp_name'];
            $fname = $_FILES['image']['name'];
            $dest="img/".$fname;  
            move_uploaded_file($ftemp,$dest);
                
            $sql = "INSERT INTO data(title, text, image) VALUES('$title', '$text', '$dest')";
            mysqli_query($db, $sql);
            header('Location: admin.php');
            }
        
            $result = mysqli_query($db,"SELECT * FROM `data`");
            echo "<table class='container-fluid margin table table-dark table-striped table-hover' border='1'>
            <tr>
            <th scope='col'>Id</th>
            <th scope='col'>Title</th>
            <th scope='col'>Text</th>
            <th scope='col'>Image</th>
            <th colspan='2' scope='col'>Action</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['text'] . "</td>";
            echo "<td><img src='" . $row['image'] . "' height='100px' width='100px'></td>";
            echo "<td><a class='btn btn-danger' href='delete.php?id=". $row['id'] ."'>Delete</a></td><td><a class='btn btn-warning' href='edit.php?id=" .$row['id']. "'>Edit</a></td>";
            echo "</tr>";
            }
            echo "</table>";

            mysqli_close($db);
            ?>
            
    </body>
</html>