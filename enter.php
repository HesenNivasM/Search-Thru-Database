<?php
	$connection = mysqli_connect('localhost','root','hesennivas','sticker');
	if(mysqli_connect_errno()){
		echo "Failed to connect";
	}
	if(isset($_POST['submit'])){
		$title=mysqli_real_escape_string($connection,$_POST['title']);
		$file=mysqli_real_escape_string($connection,$_POST['file']);
		
		$query="INSERT INTO stock(title,file) VALUES('$title','$file')";
		$result = mysqli_query($connection,$query);
	}
	if(isset($_POST['back'])){
        header('Location:dashboard.php');
  	}
?>

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand text-white"><h3>Sri Krishna Stores<h3></a>
</nav>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
      <div class="container">
        <br>
        <br>
        <br>
        <div class="form-group">
        	<p><h4>Enter the title of the sticker:</h4></p>
          	<input class="form-control form-control-lg" type="text" name="title">
          	<br>
          	<p><h4>Enter the file id:</h4></p>
          	<input class="form-control form-control-lg" type="text" name="file">
          	<br>
          	<div class="row">
          		<div class="container col"><input class="btn btn-primary btn-lg" type="submit" name="submit"></div>
          		<div class="container col"><input class="btn btn-primary btn-lg" type="submit" name="back" value="Back"></div>
          	</div>
        </div>
      </div>
    </form>
  </body>
</html>