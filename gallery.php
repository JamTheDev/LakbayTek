<?php
$title = "Gallery";

?>
<style>
 body {
      background-color: #FDF8E5;
    }
  h2 {
	  margin: 20px 40px;
	  font-family: Metropolis Black;
	  letter-spacing: 2px;
  }
  
  h3 {
	  padding: 0px 50px;
	  font-family: Metropolis;
	  letter-spacing: 1px;
	  line-spacing: 3px;
	  margin: 30px auto;
  }
</style>
<!DOCTYPE html>
<html lang="en">
<?php require("config.php") ?>
<body>
    <?php require("components/navbar.php") ?> <br>
	<h2>GALLERY</h2>
	<h3>
	A great way to showcase the beauty and calmness of Casa Querencia Hot Spring Resort. Visitors moves  through a series <br>
	of interconnected spaces which enables them to see the garden and swimming pools separately. Almost every angle of<br>
	this resort is adorned with lovely sceneries of nature that our guest would instantly experience serenity and relaxation</h3>
	<?php require("components/gallery/video.php") ?>
<?php require("components/gallery/pix.php") ?>
</body>
</html>