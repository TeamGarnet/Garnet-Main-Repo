<?php
include('../../services/DatabaseConnection.class.php');
session_start();
if(isset($_SESSION['idUser'])) {
     $_SESSION['idUser'];
} else {
    header('Location: login.php');
}


 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "RapidsCemetery";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td >" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 


?>

<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../pages/css/admin/home.css" type="text/css">
    <link rel="apple-touch-icon" sizes="120x120" href="../../pages/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../pages/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../pages/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/pages/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/pages/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>


</head>
<body>
	<div class="container1">
	<div class="container">
        <div class="row">
            
				<div class="logo col-md-4 col-sm-4 col-xs-4">
				 <img src="images/Logo.png" />
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4">
						 <div id="custom-search-input">
                            <div class="input-group ">
                                <input type="text" class="  search-query form-control" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-4">
					<a href="logout.php" class="logout">Logout</a>
				</div>
		</div>
		</div>
	</div>


 <div class="container">
    			 <div class="row">
                    <div class="col-lg-12">

                        <ul id="myTab" class="nav nav-tabs">
                           <li class="active">
                              <a href="#home" data-toggle="tab">
                                 Entries
                              </a>
                           </li>
                           <li><a href="#a" data-toggle="tab">Groups</a></li>
                           
                           <li><a href="#b" data-toggle="tab">Filters</a></li>
                           <li><a href="#c" data-toggle="tab">Events</a></li>
                           </ul>
                        <div id="myTabContent" class="tab-content">
                           <div class="tab-pane fade in active" id="home">
                              <div class="content_accordion">
                                   <table id="example1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
                                    
<?php

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `contact`"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?> 
</tbody>
          
    </table>
                             </div>
<!--accordion end-->
                           </div>
                           <div class="tab-pane fade" id="a">
                             <div class="content_accordion">
                                    <table id="example2" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>IdGroup</th>
                <th>Name</th>
                <th>Description</th>
                
            </tr>
        </thead>
         <tbody>
                                    
<?php

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `group`"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?> 
</tbody>
          
    </table>
                             </div>
<!--accordion end-->
                           </div>
                           <div class="tab-pane fade" id="b">
                              <div class="content_accordion">
							  <table id="example3" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                
            </tr>
        </thead>
        <tbody>
                                    
<?php

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM typefilter"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?> 
</tbody>
</table>
    
                             </div>
<!--accordion end-->
                           </div>
                           <div class="tab-pane fade" id="c">
                             <div class="content_accordion">
                                    <table id="example4" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>IdEvent</th>
                <th>Name</th>
                <th>Description</th>
                <th>StartTime</th>
                <th>EndTime</th>
                <th>IdWiderAreaMap</th>
            </tr>
        </thead>
        <tbody>
           <?php

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM `event`"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

?> 
        </tbody>
    </table>
                             </div>
<!--accordion end-->
                           </div>
                            
                    </div>
                </div>
                <!-- /.row -->
                
            </div>
            </div>
            <!-- container-fluid -->
			
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    
    //Apply the datatables plugin to your table
    $('#example1').DataTable();
	$('#example2').DataTable();
	$('#example3').DataTable();
	$('#example4').DataTable();
    
});
</script>


</body>
</html>


