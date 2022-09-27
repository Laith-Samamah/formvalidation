<?php
echo "you are admin";
require './connection.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
      <!-- ===== Iconscout CSS ===== -->
      <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body class=" p-5">

<table class="table table-striped">
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">full name</th>
      <th scope="col">mobile </th>
      <th scope="col">password</th>
      <th scope="col">birth date</th>
      <th scope="col">role</th>
      <th scope="col">regdate</th>
      <th scope="col">lastlogin</th>
      <th scope="col">edit</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = $conn->query('SELECT * FROM loginfo');
    while ($user = $sql->fetch(PDO::FETCH_ASSOC)) {
        print_r($user);
        ?>
    <tr>
    <th scope="col"><?php echo $user['id']; ?></th>
      <th scope="col"><?php echo $user['full_name']; ?></th>
      <th scope="col"><?php echo $user['mobile']; ?></th>
      <th scope="col"><?php echo $user['password']; ?></th>
      <th scope="col"><?php echo $user['DOB']; ?></th>
      <th scope="col"><?php echo $user['role']; ?></th>
      <th scope="col"><?php echo $user['regdate']; ?></th>
      <th scope="col"><?php echo $user['lastlogin']; ?></th>
      <th scope="col"><i class="uil uil-edit"></i></th>
      <th scope="col"><i class="uil uil-trash-alt"></i></th>
    </tr>
    <?php }?>
    </tbody>
</table>
</body>
</html>

