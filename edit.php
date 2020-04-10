<?php
//adds the nav bar to the page
$title = 'Edit';
require_once ('header.php');

$name = null;
$location = null;
$description = null;
if(!empty($_GET['destinationId'])) {
    $destinationId = $_GET['destinationId'];


    //connect to the database
    require_once ('db.php');


    //get the values where our userId is equal to the userId of the line we selected from our users table
    $sql = "SELECT * FROM destinations where destinationId = :destinationId";
    //prepare the sql commands
    $cmd = $db->prepare($sql);
    //protection for type and security
    $cmd->bindparam(':destinationId', $destinationId, PDO::PARAM_INT);
    //try to execute the sql command
    $cmd->execute();

    //get all the data and store in userInfo.
    $destinationDetails = $cmd->fetch();
    //set fetched username equal to username
    $name = $destinationDetails['name'];
    $location = $destinationDetails['location'];
    $description = $destinationDetails['description'];


}

?>
<main class="container">
    <h1>Destination</h1>
    <form method="post" action="update.php">
        <fieldset class="form-group">
            <label for="name" class="col-md-2" >Name:</label>
            <input name="name" id="name" required value="<?php echo $name; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="location" class="col-md-2">location:</label>
            <input type="location" required name="location" value="<?php echo $location; ?>"/>
        </fieldset>
        <fieldset class="form-group">
            <label for="description" class="col-md-2">Address:</label>
            <textarea name="description" id="description" type="description" required rows="4" cols="50"><?php echo $description; ?></textarea>
        </fieldset>
        <fieldset>
            <label for="regionId">Regions:</label>
            <select name="regionId" id="regionId">
            <?php
            //connect to the database
            require_once ('db.php');

            //ready the sql query to get the chores for the drop down table from the table chores.
            $sql = "SELECT name FROM regions";
            //prepare the sql command.
            $cmd = $db->prepare($sql);
            //execute the sql command.
            $cmd->execute();
            //store the data in position.
            $regions = $cmd->fetchAll();

            //loop through the chores column and give everything in it a set of option tags so it will appear in the drop down list.
            foreach ($regions as $value) {
                echo '  <option value="'. $value["regionId"] . '">
                                ' . $value["name"] . '
                        </option>';
            }

            ?>
            </select>
        </fieldset>

        <div class="offset-md-2">
            <input type="submit" value="submit" class="btn btn-info" />
            <input name="destinationId" id="destinationId" value="<?php echo $destinationId; ?>" type="hidden" />
        </div>
    </form>
</main>


<?php
//adds footer
require_once ('footer.php');