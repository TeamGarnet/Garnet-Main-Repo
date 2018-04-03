<?php
session_start();
if (isset($_SESSION['idUser'])) {
} else {
    header('Location: login.php');
}
include_once '../services/GraveService.class.php';
include_once '../services/NaturalHistoryService.class.php';
include_once '../services/MiscObjectService.class.php';
include_once '../services/ContactService.class.php';
include_once '../services/FAQService.class.php';

include_once '../services/HistoricFilterService.class.php';
include_once '../services/TypeFilterService.class.php';

include_once '../services/WiderAreaMapService.class.php';
include_once '../services/EventService.class.php';

$graveService = new GraveService();
$naturalHistoryService = new NaturalHistoryService();
$miscObjectService = new MiscObjectService();

$contactService = new ContactService();

$fAQService = new FAQService();

$historicFilterService = new HistoricFilterService();
$typeFilterService = new TypeFilterService();

$widerAreaMapService = new WiderAreaMapService();
$eventService = new EventService();


/*
var_dump($graveService->getAllGraveEntries());
$graveService -> createGraveEntry("firstName", "M", "lastName", "2018/11/21", "1962-02-23", "Test Description. I need to test if ' work in words like don't", "1",43.109362, -77.659403, "graveService", "Test", "", 1);
$graveService -> updateGraveEntry("14","5","firstName2Test2", "MTest2", "lastNameTest2", "2018/11/21", "1962-02-23", "Test Description. I need to test if ' work in words like don't. Test2", "1",48.109362, -70.659403, "UpdateTestTest2", "Test2Test2", "Test2", 1);
$graveService -> deleteGraveEntry("5");
/*
echo "<br><br>";
var_dump($naturalHistoryService->getAllNaturalHistoryEntries());
$naturalHistoryService -> createNaturalHistoryEntry("naturalHistoryService", "commonName", "description", 40.109362, -77.659403, "naturalHistoryService", "Test", "", 2);
$naturalHistoryService->updateNaturalHistoryEntry("44","9","Test1", "commonName", "description", 43.109362, -77.659403, "UpdateTest", "Test", "", 2);
$naturalHistoryService->deleteNaturalHistoryEntry("6");

echo "<br><br>";
var_dump($miscObjectService->getAllMiscObjectEntries());
$miscObjectService -> createMiscObjectEntry("miscObjectService", "Yes", "description",43.109362, -77.659403, "miscObjectService", "Test2", "", 3);
$miscObjectService->updateMiscObjectEntry("45", "7", "name1", "Yes", "description",43.109362, -77.659403, "UpdateTest", "Test", "", 3);
$miscObjectService->deleteMiscObjectEntry("4");

echo "<br><br>";
var_dump($contactService->getAllContactEntries());
$contactService->createContactEntry("Name1", "email1@email.com", "description", "333-3333333", "Boss");
$contactService->updateContactEntry("6", "Name3", "email3@email.com", "description1", "333-3333333", "Boss3");
$contactService->deleteContactEntry("6");

echo "<br><br>";
var_dump($fAQService->getAllFAQEntries());
$fAQService->createFAQEntry("make a question?", "make an answer.");
$fAQService->updateFAQEntry("6", "make a question3?", "make an answer.3");
$fAQService->deleteFAQEntry("6");

echo "<br><br>";
var_dump($historicFilterService->getAllHistoricFilterEntries());
$historicFilterService->createHistoricFilterEntry("Name1", "3018/11/31", "description", "3018/11/31", "#4386f4");
$historicFilterService->updateHistoricFilterEntry("8", "Name3", "3318/11/33", "description3", "3038/11/31", "#6g86f4");
$historicFilterService->deleteHistoricFilterEntry("8");

echo "<br><br>";
var_dump($typeFilterService->getAllTypeFilterEntries());
$typeFilterService->createTypeFilterEntry("Name1", null, "#4386f4");
$typeFilterService->updateTypeFilterEntry("7", "Name3", "https:www.moma.org/collection/works/174300", null);
$typeFilterService->deleteTypeFilterEntry("7");

echo "<br><br>";
var_dump($widerAreaMapService->getAllWiderAreaMapEntries());
$widerAreaMapService->createWiderAreaMapEntry("www.google.com", "name1", "description", 43.109363, 43.109363, "Address1", "city1", "state1", 13345);
$widerAreaMapService->updateWiderAreaMapEntry("7", "www.facebook.com", "name3", "description3", -77.659403, -77.659403, "Address3", "city3", "state1", 13345);
$widerAreaMapService->deleteWiderAreaMapEntry("7");

echo "<br><br>";
var_dump($eventService->getAllEventEntries());
$eventService->createEventEntry("name1", "description", "11:00", "12:00", "1");
//TODO figure out how to get the correct time
$eventService->updateEventEntry("5", "name3", "description3", "12:00", "1:00", "2");
$eventService->deleteEventEntry("5");
*/
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/admin/home.css" type="text/css">
    <link rel="apple-touch-icon" sizes="57x57" href="../favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../favicon/favicon-16x16.png">
    <link rel="manifest" href="../favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="../favicon/site.webmanifest">
    <link rel="mask-icon" href="../favicon/safari-pinned-tab.svg" color="#5bbad5">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
    <script src="../js/AdminHome.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" id="navBarContainer">
    <div class="row" id="navBar">

        <div class="logo col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <img src="../images/Logo.png"/>
        </div>

        <div class="links col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <ul class="nav navbar-nav navbar-right" id="nav-right">
                <li><a href="logout.php" class="logout">Logout</a></li>
                <li><a href="../home.php" class="logout">Main Site</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Filters Selects-->
<div class="container" id="tabContainer">
	<div class="row" id="tabRow">
		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" id="leftMenu">
			<ul id="myTab" class="nav nav-tabs">
				<li class="active">
					<a href="#graveDiv" data-toggle="tab">
						Graves
					</a>
				</li>
				<li><a href="#naturalHistoryDiv" data-toggle="tab">Natural History</a></li>
				<li><a href="#miscDiv" data-toggle="tab">Miscellaneous</a></li>
				<li><a href="#typeDiv" data-toggle="tab">Type Filters</a></li>
				<li><a href="#historicDiv" data-toggle="tab">Historic Filters</a></li>
				<li><a href="#faqDiv" data-toggle="tab">FAQ</a></li>
				<li><a href="#widerLocationDiv" data-toggle="tab">Wider Area Locations</a></li>
				<li><a href="#contactDiv" data-toggle="tab">Contacts</a></li>
				<li><a href="#eventDiv" data-toggle="tab">Events</a></li>
			</ul>
		</div>
		<div class="dropdown col-xs-3 col-sm-3 col-md-3 col-lg-3" id="rightMenu">
			<a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
			   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Create +
			</a>
			<ul class="dropdown-menu" id="dropdown-menu" aria-labelledby="dropdownMenuLink">
				<li><a class="dropdown-item" href="#" onclick="createGrave()">Grave</a></li>
				<li><a class="dropdown-item" href="#" onclick="createNH()">Natural History</a></li>
				<li><a class="dropdown-item" href="#" onclick="createMisc()">Micellaneous</a></li>
				<li><a class="dropdown-item" href="#" onclick="createTypeFilter()">Type Filter</a></li>
				<li><a class="dropdown-item" href="#" onclick="createHistoricFilter()">Historic Filter</a></li>
				<li><a class="dropdown-item" href="#" onclick="createFAQ()">FAQ</a></li>
				<li><a class="dropdown-item" href="#" onclick="createWiderLocation()">Wider Area Location</a></li>
				<li><a class="dropdown-item" href="#" onclick="createContact()">Contact</a></li>
				<li><a class="dropdown-item" href="#" onclick="createEventEntry()">Event</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container" id="tabBar">
    <div class="container1">
        <div class="row">
            <div class="col-lg-12">
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active" id="graveDiv">
                        <div class="content_accordion">
                            <table id="grave" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Last Name</th>
                                    <th>Birth Date</th>
                                    <th>Death Date</th>
                                    <th>Description</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Image Description</th>
                                    <th>Image Location</th>
                                    <th>Type Filter</th>
                                    <th>Historic Filter</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                echo $graveService -> getAllEntriesAsRows();
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="naturalHistoryDiv">
                        <div class="content_accordion">
                            <table id="naturalHistory" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Common Name</th>
                                    <th>Scientific Name</th>
                                    <th>Description</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Image Description</th>
                                    <th>Image Location</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                echo $naturalHistoryService -> getAllEntriesAsRows();
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="miscDiv">
                        <div class="content_accordion">
                            <table id="misc" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Is a Hazard?</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Image Description</th>
                                    <th>Image Location</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                echo $miscObjectService -> getAllEntriesAsRows();
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="typeDiv">
                        <div class="content_accordion">
                            <table id="type" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Pin Design</th>
                                    <th>Button Color</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                echo $typeFilterService -> getAllEntriesAsRows();
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="historicDiv">
                        <div class="content_accordion">
                            <table id="historic" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Description</th>
                                    <th>Button Color</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                echo $historicFilterService -> getAllEntriesAsRows();
                                ?>
                                </tbody>


                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="faqDiv">
                        <div class="content_accordion">
                            <table id="faq" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                echo $fAQService -> getAllEntriesAsRows();
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="widerLocationDiv">
                        <div class="content_accordion">
                            <table id="widerLocation" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Site</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Zip Code</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                echo $widerAreaMapService -> getAllEntriesAsRows();
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="contactDiv">
                        <div class="content_accordion">
                            <table id="contact" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Description</th>
                                    <th>Phone</th>
                                    <th>Title</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                echo $contactService -> getAllEntriesAsRows();
                                ?>
                                </tbody>

                            </table>
                        </div>
                        <!--accordion end-->
                    </div>

                    <div class="tab-pane fade" id="eventDiv">
                        <div class="content_accordion">
                            <table id="event" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                echo $eventService -> getAllEntriesAsRows();
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
</div>

<div class="container invisible">
    <select class="form-control form-control-sm typeSelect" id="typeSelect">
        <?php
        echo $typeFilterService -> getAllFiltersForSelect();
        ?>
    </select>
</div>
<div class="container invisible">
    <select class="form-control form-control-sm historicSelect" id="historicSelect">
        <?php
        echo $historicFilterService -> getAllFiltersForSelect();
        ?>
    </select>
</div>
<div class="container invisible">
    <select class="form-control form-control-sm locationSelect" id="locationSelect">
        <?php
        echo $widerAreaMapService -> getAllFiltersForSelect();
        ?>
    </select>
</div>

<!-- Small modal -->
<div class="modal message" id="message" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Object Deletion Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="messageContent" id="messageContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary " data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Object Modal -->
<div class="modal deleteModal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Object Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Delete from database forever?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary confirm" id="confirm">Confirm</button>
                <button type="button" class="btn btn-secondary " data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Update Object Modal -->
<div class="modal updateModal" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="updateModalTitle">Update Object</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelChanges()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="updateModalBody">
                <p>Content goes here</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveChanges">Save Changes</button>
                <button type="button" class="btn btn-secondary" id="cancelChanges" onclick="cancelChanges()">Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Create Object Modal -->
<div class="modal createModal" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="createModalTitle"></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cancelCreate()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="createModalBody"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="createObject">Create</button>
                <button type="button" class="btn btn-secondary" id="cancelChanges" onclick="cancelCreate()">Cancel
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#deleteModal').modal('hide');

        //Apply the datatables plugin to your table
        $('#grave').DataTable();
        $('#naturalHistory').DataTable();
        $('#misc').DataTable();
        $('#type').DataTable();
        $('#historic').DataTable();
        $('#faq').DataTable();
        $('#widerLocation').DataTable();
        $('#contact').DataTable();
        $('#event').DataTable();


    });
</script>
