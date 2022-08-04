<?php
include 'index.php';
$conn = mysqli_connect("localhost","root","","addmission");

 
  if(isset($_GET['edit'])){
   $Id = $_GET['edit'];
   $fetch = "SELECT * FROM `register` WHERE Id = $Id";
   $query= mysqli_query($conn,$fetch);
   $row = mysqli_fetch_assoc($query);
   $Name = $row['Fullname'];
   $Email = $row['Email'];
   $Password = $row['Password'];
   $Conf_password = $row['Conf_Password'];
  
  }
?>
<!DOCTYPE html>

<head>
    
</head>
<body>
<div class="container container-sm-6 bg-dark border border-dark-5 py-4 text-light my-4 rounded">
<?php
 if(isset($_GET['edit'])){?>
         <form method="POST" enctype="multipart/form-data" action="index.php" class="rounded" > 
              <input type="hidden" name="update_id" value="<?php echo $_GET['edit'];?>">
            <div class="mb-3">
                <label for="fullname " class="form-label">Fullname</label>
                <input type="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Fullname" name="name" value="<?php echo $Name?>" required>
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3 ">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email" name="email" value="<?php echo $Email?>" required>
                <div id="emailHelp" class="form-text"></div>
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">Update Password</label>
                <div class="col-auto ">
                <input type="password"  class="password" id="password"  name="password" placeholder="Create new password" value="<?php echo $Password?>" required>
                <i class="bi bi-eye-slash eye" id="togglePassword" ></i>
                </div>
            </div>
            <div class="mb-3 ">
                <label for="password" class="form-label">Confirm Password</label>
                <div class="col-auto ">
                <input type="password"  class="password" id="password"  name="conf_password" placeholder="Confirm Paswsword" value="<?php echo $Conf_password?>" required>
                <i class="bi bi-eye-slash eye" id="togglePassword" ></i>
                </div>
                <span class="text-danger">*Passwords must be same</span>
            </div>
            <button type="submit" class="btn btn-success" name="update">Update</button>
            </form>
            </div>
<?php }?>
</div>
</div>
</body>

<?php
 