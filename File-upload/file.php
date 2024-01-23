<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upload";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];

    $upload_directory = "./upload/";

    if (!file_exists($upload_directory)) {
        mkdir($upload_directory, 0777, true);
    }

    $target_path = $upload_directory . $file_name;

    $sql = "INSERT INTO `user`(`image`) VALUES ('$file_name')";

    if (file_exists($target_path)) {
        echo '<script>alert("File already exists. Please choose a different file.")</script>';
    } else {
        if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
            echo '<script>alert("Sorry, your file is too large. Maximum file size is 2MB.")</script>';
        } else {
            if ($conn->query($sql) === TRUE) {
                move_uploaded_file($file_tmp, $target_path);
                echo '<script>alert("File uploaded successfully.")</script>';
            } else {
                echo '<script>alert("Error: ' . $conn->error . '")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>File Upload Form</title>
    <style> 
    body{
        background-image: url('https://i.ibb.co/6vD38Kw/hj.jpg');
         background-repeat: no-repeat;
        background-size:cover;
    }
        form {
            width: 500px;
            height:20%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: ;
            margin-top:15%;
            background-image: url('https://i.ibb.co/6vD38Kw/hj.jpg');
            background-repeat: no-repeat;
            background-size:cover; 
        }

        input[type="file"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            cursor: pointer; 
            margin-top:13%;
            height:25%;
            margin-left:10%;
        } 
        h1{
            font-size:70px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }

        .error-message,
        .success-message {
            color: white;
            font-weight: bold;
            margin-top: 10px;
            text-align: center;
        }

        .error-message {
            background-color: red;
        }

        .success-message {
            background-color: green;
        }
    </style>
</head>

<body> 
    <center><h1>File Upload Form</h1></center>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" required />
        <input type="submit" name="submit" />
    </form>
</body>

</html>
