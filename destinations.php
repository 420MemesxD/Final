<?php
//adds the nav bar to the page
$title = 'Destinations';
require_once ('header.php');

$regionId = $_GET['regionId'];

    //connect to the database
    require_once ('db.php');

    //sql query to select all from users
    $query = "SELECT * FROM destinations where regionId = :regionId;";



    //prepare and execute
    $cmd = $db->prepare($query);
    //bind pram for regionId
    $cmd->bindParam(':regionId', $regionId, PDO::PARAM_INT);
    $cmd->execute();

    //fetch all the data and store in users
    $users = $cmd->fetchAll();

    //create a table
    echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Location</th><th>Photo</th><th>Edit</th></thead>';

    //foreach loop to insert all the data into the table
    foreach ($users as $value) {

        echo '<tr>';

        echo '<td>' . $value['name'] . '</td>';

        echo '<td>' . $value['location'] . '</td>';

        echo '<td><div class="offset-2">
                    <img src="img/' . $value['photo'] . '" alt=" " />
                </td></div>';


        echo '<td><a href="edit.php?destinationId=' . $value['destinationId'] . '">Edit</a></td>';




        echo '</tr>';
    }

//close the html table
    echo '</table>';

//disconnect from the database
    $db = null;

?>

<!-- js -->
<script src="js/scripts.js" type="text/javascript"></script>
<?php
//adds footer
require_once ('footer.php');
?>