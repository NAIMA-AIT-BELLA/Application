<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Openlayers CSS -->
    <link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
    <!-- Openlayers JS -->
    <script src="https://openlayers.org/en/v4.6.5/build/ol.js" type="text/javascript"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="completecode-lecture-2-master/custom/css/style.css">
    <!-- Fontawesome Icons -->
    <link href="completecode-lecture-2-master/assets/fontawesome/css/all.css" rel="stylesheet"> <!--load all styles -->
    <!-- Jquery  -->
    <script
  src="https://code.jquery.com/jquery-3.5.1.js"
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <!-- OL-ext CSS -->
    <link rel="stylesheet" href="assets/css/ol-ext.css">
    <!-- OL-ext JS -->
    <script src="completecode-lecture-2-master/assets/js/ol-ext.js"></script>
        <title>Survey App</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p>This is secure area.</p>
<p><a href="dashboard.php"></a></p>
<p><a href="completecode-lecture-2-master"></a></p>
<a href="logout.php">Logout</a>
<i id='currentLocation' class="fas fa-street-view fa-2x"></i>
    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
          <i class="fas fa-house-user fa-2x"></i> surveyor Application
        </a>
      </nav>

      <!-- Map Div -->
      <div class="map" id="mymap"></div>

      <!--begin: Start draw Modal -->
<div class="modal fade" id="startdrawModal" tabindex="-1" role="dialog" aria-labelledby="startdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="startdrawModalLabel">Select Draw type</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style='text-align: center;'>
          <!-- Cards -->
          <div class="row">
              <div class="col-4">
          <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Point</h5>
              <h6 class="card-subtitle mb-2 text-muted">ATM, Tree, Pole, Bus Stop, etc.</h6>
              <p class="card-text"><i class="fas fa-map-marker-alt fa-2x"></i></p>
              <a onclick="startDraw('Point')" class="card-link">Add Point</a>
              
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Line</h5>
              <h6 class="card-subtitle mb-2 text-muted">Road, River, Telephone Wire, etc.</h6>
              <p class="card-text"><i class="fas fa-road fa-2x"></i></p>
              <a onclick="startDraw('LineString')" class="card-link">Add Line</a>
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Polygon</h5>
              <h6 class="card-subtitle mb-2 text-muted">Building, Garden, Ground, etc.</h6>
              <p class="card-text"><i class="fas fa-draw-polygon fa-2x"></i></p>
              <a onclick="startDraw('Polygon')" class="card-link">Add Polygon</a>
            </div>
          </div>
        </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>
  <!--end: Start draw Modal -->
   <!--begin: enter information Modal -->
<div class="modal fade" id="enterInformationModal" tabindex="-1" role="dialog" aria-labelledby="enterInformationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="enterInformationModalLabel">Enter Feature's Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style='text-align: center;'>
          <!-- begin: Input -->
          <div class="form-group">
            <label for="typeofFeatures">Type of Feature</label>
            <select class="form-control" id="typeofFeatures">
             
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputtext1">Name</label>
            <input type="text" class="form-control" id="exampleInputtext1" aria-describedby="textHelp">
            <small id="textHelp" class="form-text text-muted">Address, Name, etc.</small>
          </div>
          <!-- end: Input -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearDrawSource()">Close</button>
          <button type="button" class="btn btn-primary" onclick="savetodb()">Save Featues</button>
          
        </div>
      </div>
    </div>
  </div>
  
  <!--end: enter information Modal -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
      <!-- Custom JS -->
      <script src="completecode-lecture-2-master/custom/js/main.js"></script>
</div>
</body>
</html>