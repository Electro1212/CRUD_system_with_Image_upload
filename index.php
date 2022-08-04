<?php

 $conn = mysqli_connect("localhost","root","","addmission");
// connection query
 if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $exname = strtolower(pathinfo($image,PATHINFO_EXTENSION));
    $rand = rand();
    $imagename = $rand.time().'.'.$exname;
    move_uploaded_file($tmp_name,'images/'.$imagename);
    if($name =="" || $email=="" || $password=="" || $conf_password=="" || $image==""){
        header("Location:index.php?error=1");
        die();
    }
    if($password==$conf_password){
      $sql = "INSERT INTO `register`(`Fullname`, `Email`, `Password`, `Conf_Password`,`Image`) VALUES ('$name','$email','$password','$conf_password','$imagename')";
      mysqli_query($conn,$sql);
      header("Location:index.php?success=1");
    }
    else{
      header("Location:index.php?error=1");
      die();
    }   
 } 
// delete query
 if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $image = $_GET['image'];
  $delete_sql = "DELETE FROM `register` WHERE Id = $id";
  unlink('images/'.$image);
  mysqli_query($conn,$delete_sql);
  header("Location:index.php?deleted=1");
 }

 //  edit query
 
if(isset($_POST['update'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $id = $_POST['update_id'];
  $password = $_POST['password'];
  $conf_password = $_POST['conf_password'];
  
  if($name =="" || $email==""   || $password=="" || $conf_password=="" ){
      header("Location:index.php?error=1");
      die();
  }
  
    $sql = "UPDATE `register` SET `Fullname`='$name',`Email`='$email',`Password`='$password' ,`Conf_Password`='$conf_password' WHERE Id = $id";
    mysqli_query($conn,$sql);
    header("Location:index.php?success2=1");
  
 
} 
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Addmission Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  </head>
  <body class="bg-secondary">
            
        <!-- Button trigger modal -->
      
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title fw-bold  text-light" id="exampleModalLabel">Input Your information here</h5>
                <button type="button" class="btn-close bg-primary" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
<?php
if(isset($_GET['error'])){
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Oops!</strong> Passwords were not same.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
            <form method="POST" enctype="multipart/form-data" >
           
            <div class="mb-3">
                <label for="fullname " class="form-label">Fullname</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Fullname" name="name" required>
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email" name="email" required>
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">Create Password</label>
                <div class="col-auto ">
                <input type="password"  class="password" id="password"  name="password" placeholder="Create new password" required>
                <i class="bi bi-eye-slash eye" id="togglePassword" ></i>
                </div>
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">Confirm Password</label>
                <div class="col-auto ">
                <input type="password"  class="password" id="password"  name="conf_password" placeholder="Confirm Paswsword" required>
                <i class="bi bi-eye-slash eye" id="togglePassword" ></i>
                </div>
                <span class="text-danger">*Passwords must be same</span>
            </div>
            <div class="mb-3 ">
            <label for="formFile" class="form-label">Upload your image</label>
            <input class="form-control color-primary" type="file" id="formFile" name="image" required>
            </div>
            <button type="submit" class="btn btn-success " name="register">Register</button>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

<!-- edit id modal -->

        
        <!-- form container -->
        <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container d-flex justify-content-center">
            <a class="navbar-brand d-flex justify-content-center "  href="#"><h1 class="fw-bold text-light  d-flex justify-content-center ">Addmission Form</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        </nav>

        <div class="container">
        <?php
if(isset($_GET['error'])){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Oops!</strong> Your fields are empty or the passwords are not same.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if(isset($_GET['success'])){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Here we go!</strong> Your form has been submitted successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
};
if(isset($_GET['deleted'])){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Here we go!</strong> Your form has been deleted.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
};
if(isset($_GET['success2'])){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Here we go!</strong> Your form has been updated successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
            <table class="table table-bordered">
            <table class="table table-dark border border-dark-3 table-hover">
              <thead>
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Image</th>
                  <th scope="col">Fullname</th>
                  <th scope="col">Email Address</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
<?php
$fetch = "SELECT * FROM `register`";
$fetch_query = mysqli_query($conn,$fetch);
while($row= mysqli_fetch_assoc($fetch_query)){
  echo'
              <tbody>
                <tr>
                  <th scope="row">'.$row['Id'].'</th>
                  <td><img src="images/'.$row['Image'].'" style="height: 50px; width: 50px;"></td>
                  <td>'.$row['Fullname'].'</td>
                  <td>'.$row['Email'].'</td>
                  <td>
                  <a href="edit.php?edit='.$row['Id'].'"><button type="submit" class="btn btn-primary update" name="update"  >Update</button></a>
                  <a href="index.php?delete='.$row['Id'].'&&image='.$row['Image'].'"><button type="submit" class="btn btn-danger" name="register">Delete</button></a>
                  </td>
                </tr>
              </tbody>';
}
?>              
              
            </table>
            </table>
            <div class="trigger d-flex justify-content-end  my-4">
            <button type="button" class="btn btn-success border border-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Apply for addmission
            </button>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    
  </body>
</html>
<!-- INSERT INTO `register`(`Id`, `Fullname`, `Email`, `Password`, `Conf_Password`, `Image`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]') -->