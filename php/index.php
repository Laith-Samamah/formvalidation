<?php 
require './connection.php';

try {
    ini_set('display_errors', 0);

//*****************register****************** */
    if(isset($_REQUEST['Signup'])){
    // insert a row
    $full_name = $_POST["fullname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];
    $DOB = $_POST["DOB"];

 
        $age = (int)(date("Y-m-d") -$DOB);
        if($age>=16){
            $agecheck=1;
        }else{
            $agecheck=0;
            echo "<script> alert(' Must 16 or older')</script>";
        }
      
if($password==$_POST["password2"]){
    $passcheck=1;
}else{
    $passcheck=0;
    echo "<script> alert(' Passwords does not match')</script>";
}

if($agecheck && $passcheck){
      // prepare sql and bind parameters
        $stmt = $conn->prepare("INSERT INTO loginfo (full_name, email, 
        mobile, password, DOB ) 
        VALUES (:full_name, :email, :mobile, :password, :DOB)");
    $stmt->bindParam(':full_name', $full_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':DOB', $DOB);
   $stmt->execute();
   header("location:welcome.php");
}




// echo "New records created successfully";
// header('Refresh:0');
// 
    }
    
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}

//*****************login check****************** */

if(isset($_REQUEST['Login'])){
    $logemail = $_POST["logemail"];
    $logpassword = $_POST["logpassword"];
    // $sql2= $conn->prepare("SELECT * FROM loginfo where email=:elog");
    // $sql2->bindParam(':elog',$logemail);
    // $sql2->execute();
    $sql = "SELECT * FROM loginfo where email='$logemail' and password='$logpassword'";
    $result = $conn->query($sql);
    $user= $result->fetch();
    print_r($result);
    echo "<br>";
    print_r($user);
    if($user){
        if($user['role']=='Admin'){
            header("location:admin.php");
        }else{
        header("location:welcome.php");
    }
}
    header('Refresh:0');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="../css/test.css">

    <!--<title>Login & Registration Form</title>-->
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form method="POST">
                    <div class="input-field">
                        <input name="logemail" type="text" placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                        <i class="uil uil-envelope icon"></i>
                        
                    </div>
                    <div class="input-field">
                        <input name="logpassword" type="password" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <a href="#" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Login" name="Login">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup Now</a>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <span class="title">Registration</span>

                <form action="./index.php" method="POST">
                    <div class="input-field">
                        <input name="fullname" type="text" placeholder="Enter your name" pattern="^[A-Za-z]+\s[A-Za-z]+\s[A-Za-z]+\s[A-Za-z]+$"
                        title="The name must be in a form of four sections separated by a space" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input name="email" type="text" placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input name="mobile" type="text" placeholder="Enter your phone number" pattern="[0-9]{14}" title="Must be a 14 digit number" required>
                        <i class="uil uil-phone"></i>
                    </div>
                    <div class="input-field">
                        <input name="DOB" type="date" placeholder="Enter your birth date" required>
                        <i class="uil uil-calendar-alt"></i>
                    </div>
                    <div class="input-field">
                        <input name="password" type="password" class="password" placeholder="Create a password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}"
                        title="Must contain at least one number and one uppercase and lowercase letter, one special character,
                        and at least 8 or more characters" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input name="password2" type="password" class="password" placeholder="Confirm a password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon">
                            <label for="termCon" class="text">I accepted all terms and conditions</label>
                        </div>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Signup" name="Signup">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already a member?
                        <a href="#" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/script.js"></script>
</body>
</html>