<?php
	$connection = mysqli_connect('localhost','root','hesennivas','sticker');
  $query="SELECT title FROM stock";
  $query1="SELECT file FROM stock";
  $result = mysqli_query($connection,$query);
  $result1 = mysqli_query($connection,$query1);
	if(mysqli_connect_errno()){
		echo "Failed to connect";
	}
  if(isset($_POST['next'])){
        header('Location:search.php');
  }
  if(isset($_POST['back'])){
        header('Location:dashboard.php');
  }
?>
<script type="text/javascript">
  var data = [];
  <?php   while($row = mysqli_fetch_array($result)) { ?>
    var temp = "<?php echo $row["title"]; ?>";
    <?php $row1 = mysqli_fetch_array($result1) ?>
    temp = temp+" - " + "<?php echo $row1["file"]; ?>";
    data.push(temp);
  <?php } ?>
  console.log(data);
</script>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}
body {
  font: 16px Arial;  
}
.autocomplete {
  position: relative;
  display: inline-block;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}
</style>
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
          <form autocomplete="off" action="/action_page.php">
          <div class="autocomplete" style="width:100%;">
          <input class="form-control form-control-lg" id="myInput" type="text" name="myCountry" placeholder="Title">
          </div>

          </form>

          <br>
          <br>
          <br>
          <div class="row">
            <div class="col container"><input class="btn btn-primary btn-lg" type="submit" name="submit" value="Search"></div>
            <div class="col container"><input class="btn btn-primary btn-lg" type="submit" name="next" value="Next Search"></div>
            <div class="col container"><input class="btn btn-primary btn-lg" type="submit" name="back" value="Back"></div>
          </div>
        </div>
      </div>
      <div class="container">
        <?php 

          if(isset($_POST['submit'])){
            $key=mysqli_real_escape_string($connection,$_POST['myCountry']);
            // $query="SELECT * FROM stock WHERE title LIKE CONCAT('%','$key','%')"; //change the query to change the display
            $len = strlen($key)-4;
            $key = substr($key,0,$len);
            $query="SELECT * FROM stock WHERE title='$key'";
            $result = mysqli_query($connection,$query);
            $count=mysqli_num_rows($result);
            if($count>0){
              echo "<table border='3' class='table'>";
              $i = 0;
              while($row = $result->fetch_assoc())
              {
                  if ($i == 0) {
                    $i++;
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                      echo "<th>" . $key . "</th>";
                    }
                    echo "</tr>";
                  }
                  echo "<tr>";
                  foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                  }
                  echo "</tr>";
              }
              echo "</table>";
            }
            else{
              header('Location:https://www.google.com/search?tbm=isch&q='.$key.' image chart');
            }
          }
        ?>
        
      </div>
    </form>
  </body>
</html>
<script type="text/javascript">
  autocomplete(document.getElementById("myInput"), data);
  function autocomplete(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { 
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
      });
}
</script>