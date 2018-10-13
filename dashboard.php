<?php
  $connection = mysqli_connect('localhost','root','hesennivas','sticker');
  if(mysqli_connect_errno()){
    echo "Failed to connect";
  }
  if(isset($_POST['search'])){
        header('Location:search.php');
  }
  if(isset($_POST['enter'])){
        header('Location:enter.php');
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
        <div class="row">
          <div class="col container"><p><h4>To search for a stricker from the database</h4></p><input class="btn btn-primary btn-lg col border border-dark" type="submit" name="search" value="Search"></div>
          <br>
          <div class="col container"><p><h4>To enter data about a new sticker</h4></p><input class="btn btn-primary btn-lg col border border-dark" type="submit" name="enter" value="Enter new data">
        </div>
      </div>
    </form>
  </body>
</html>