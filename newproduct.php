<?php
if (isset($_POST["submit"])) {
    include_once ("../dbconnect.php");
    $name = $_POST["name"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $sqlinsert = "INSERT INTO `tbl_product`(`name`, `price`, `description`) 
    VALUES('$name', '$price', '$description')";
     try {
        $conn->exec($sqlinsert);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
        uploadImage($name);
        }
        echo "<script>alert('Add New Product Successfully ')</script>";
        echo "<script>window.location.replace('mainpage.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Add New Product Failed')</script>";
        echo "<script> window.location.replace('newproduct.php')</script>";

    }
}
function uploadImage($name) {
    $target_dir = "../res/images/";
    $target_file = $target_dir . $name . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/1dd357b823.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="../javascript/script.js"></script>

    <title>New Add Product</title>
    </head>

    <body>
        <!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>Kedai Roti Canai Pak Jabar</b> Gerai No. 7</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="mainpage.php" class="w3-bar-item w3-button">Home</a>
     
    </div>
  </div>
</div>

<!-- Header with image -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
<img class="w3-images" src="../res/pic1.jpg" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-black w3-opacity-min"><b>Kedai Roti Canai Pak Jabar</b></span> <span class="w3-hide-small w3-text-black w3-light-grey "><b>Gerai No. 7</b></span></h1>
  </div>
  <div class="w3-display-bottomright w3-center w3-padding-large">
    <span class="w3-text-white w3-brown w3-padding w3-opacity-min"><i class="fa fa-map-marker">  Kampung Batu Enam, 09600 Lunas, Kedah</span></i>
  </div>
</header>
    
  
    <div class="w3-container w3-padding-64 form-container-reg"> 
        <div class="w3-card">
            <div class="w3-container w3-brown">
                <p> New Product</p>
            </div>
            <form class="w3-container w3-padding" name="registerForm" action="newproduct.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmDialog()">
                <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin" src="../res/menu1.PNG" style="width: 100%; max-width: 600px;"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                </div>
                
                
                <p>
                    <i class="fas fa-utensils icon"></i>
                    <label>Name</label>
                    <input class="w3-input w3-border w3-round" name="name" id="idname" type="text" required>
                </p>

                <p>
                    <i class="fa fa-usd icon"></i>
                    <label>Price</label>
                    <input class="w3-input w3-border w3-round" name="price" id="idprice" type="text" required>
                </p>
              
                <p>
                    <i class="fa fa-thumbs-up icon"></i>
                    <label>Description</label>
                    <textarea class="w3-input w3-border" id="iddescription" name="description" rows="4" cols="50" width="100%" placeholder="Description of the product" required></textarea>
                </p>


                <div class="row">
                    <input class="w3-input w3-border w3-block w3-brown w3-round" type="submit" name="submit" value="Submit">
                </div>

            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="w3-center w3-brown w3-padding-64 w3-opacity w3-hover-opacity-off">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
        <p>Copyright: <br> GeraiNo.7@gmail.com</p>
    </footer>
    </body>
</html>