<?php

require './connection.php';



$id = $_GET["id"];

//    echo $id;

$sql ="SELECT * FROM loginfo WHERE id =$id";

$getData = $conn->query($sql);

$info = $getData->fetchAll(PDO::FETCH_OBJ);

// print_r($info);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<div class="form signup">
                <span class="title">Registration</span>

                <form  method="POST">
                    <div class="input-field">
                        <input name="fullname" type="text" value="<?php echo $info[0]->full_name?>" placeholder="name" pattern="^[A-Za-z]+\s[A-Za-z]+\s[A-Za-z]+\s[A-Za-z]+$"
                        title="The name must be in a form of four sections separated by a space" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input name="email" type="text" value="<?php echo $info[0]->email?>" placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input name="mobile" type="text" value="<?php echo $info[0]->mobile?>" placeholder="phone number" pattern="[0-9]{14}" title="Must be a 14 digit number" required>
                        <i class="uil uil-phone"></i>
                    </div>
                    <div class="input-field">
                        <input name="DOB" type="date" value="<?php echo $info[0]->DOB?>" required>
                        <i class="uil uil-calendar-alt"></i>
                    </div>
                    <div class="input-field">
                        <input name="password" type="text" class="password" value="<?php echo $info[0]->password?>" placeholder="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}"
                        title="Must contain at least one number and one uppercase and lowercase letter, one special character,
                        and at least 8 or more characters" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" value="update" name="update">
                    </div>
                </form>
                </div>
            </div>



</body>

</html>

<?php 

if(isset($_POST["update"])){
    $full_name = $_POST["fullname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $DOB = $_POST["DOB"];

    $sql = "UPDATE loginfo SET full_name=:full_name, email=:email, mobile=:mobile, password=:password, DOB=:DOB  WHERE id=$id";


    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':DOB', $DOB);


    $result = $stmt->execute();

    header("location: admin.php");
}

?>