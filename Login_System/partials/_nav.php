<?php
if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']==false){
 $login=false;
}
else{
 $login=true;
}

echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
     <div class="container-fluid">
     <a class="navbar-brand" href="/Login_system/"> Digital_Library</a>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarScroll">
     <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
     <li class="nav-item">
     <a class="nav-link active" aria-current="page" href="/Login_system/welcome.php">Home</a>
     </li>';
     if(!$login){
      echo' <li class="nav-item">
      <a class="nav-link" href="/Login_system/login.php">Login</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="/Login_system/signup.php">Signup</a>
       </li>';
     }
     if($login){
       echo' <li class="nav-item">
          <a class="nav-link " href="/Login_system/logout.php">Logout</a>
          </li>';
     }
     echo
    ' </ul>
     <form class="d-flex">
     <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
     <button class="btn btn-outline-success" type="submit">Search</button>
   </form>
  </div>
 </div>
</nav>';
?>