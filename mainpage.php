<?php
include_once("../dbconnect.php");
$sqlproduct = "SELECT * FROM tbl_product ORDER BY productdate DESC";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();


$results_per_page = 5;
if (isset($_GET['pageno']))
{
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
}
else
{
    $pageno = 1;
    $page_first_result = 0;
}

$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlproduct = $sqlproduct . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlproduct);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();


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

    <title>Main Page</title>
    </head>

   

   <!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="#home" class="w3-bar-item w3-button"><b>Kedai Roti Canai Pak Jabar</b> Gerai No.7</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="newproduct.php" class="w3-bar-item w3-button">New Product</a>
      <a href="#Product" class="w3-bar-item w3-button">List Product</a>
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

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Project Section -->
  <div class="w3-container w3-padding-32" id="Product">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16"><b>List Product<b></h3>
  </div>



<div class="w3-grid-template">
<?php
foreach($rows as $product){
    $name = $product['name'];
    $price = $product['price'];
    $description = $product['description']; 
   
    echo "<div class='w3-center w3-padding'>";
    echo "<div class='w3-card-4' style='background:#D0C7C2'>";
    echo "<header class='w3-container w3-text-white' style='background:#6C4A3F'>";
    echo "<h5><b>$name</b></h5>";
    echo "</header>";
    echo "<img class='w3-image' src=../res/images/$name.png" .
    " onerror=this.onerror=null;this.src='../res/menu1.PNG'" 
    . " style='width:100%;height:250px'>";
    echo "<div class='w3-container w3-justify-align '><hr>";
    echo "<p><i class='fas fa-utensils' style='font-size:16px'></i>
    &nbsp&nbsp$name<br>
    <i class='fa fa-usd' style='font-size 16px;'>
    </i>  RM&nbsp&nbsp$price<br>
    <i class='fa fa-thumbs-up' style='font-size 16px;'></i> 
    &nbsp&nbsp$description<br></p><hr>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

}
?>

<!-- End page content -->
</div>


<br>
<br>

  <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "mainpage.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    
<br>
<br>

<!-- Footer -->
    <footer class="w3-center w3-brown w3-padding-64 w3-opacity w3-hover-opacity-off">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
        <p>Copyright: <br> GeraiNo.7@gmail.com</p>
    </footer>
    </body>
</html>
