<?php
//adds the nav bar to the page
$title = 'Update';
require_once ('header.php');

?>

<body>

<?php
//stores the values from the form inputs in variables
$name = $_POST['name'];
$location = $_POST['location'];
$description = $_POST['description'];
$regionId = $_POST['regionId'];
$destinationId = $_POST['destinationId'];
$ok = true;


//if username is empty say username is required
if(empty($name)){
    echo 'Username is required';
    $ok = false;
}

//if password empty say password is required
if(empty($location)){
    echo 'location is required';
    $ok = false;
}
if(empty($description)){
    echo 'description is required';
    $ok = false;
}



if($ok)
{


                $sql = "UPDATE destinations SET name = :name, location = :location, description = :description, regionId = :regionId WHERE destinationId = :destinationId";
                echo "updated";


            //prepare command
            $cmd = $db->prepare($sql);
            //bind parameters
            $cmd->bindParam(':name', $name, PDO::PARAM_STR, 255);
            $cmd->bindParam(':location', $location, PDO::PARAM_STR, 255);
            $cmd->bindParam(':description', $description, PDO::PARAM_STR, 2000);
            $cmd->bindParam(':regionId', $regionId, PDO::PARAM_INT);
            $cmd->bindParam(':destinationId', $destinationId, PDO::PARAM_INT);
            //execute command
            $cmd->execute();



            echo ' Name: ', $name, ' ';
            echo ' Location: ', $location, ' ';
            echo ' Description: ', $description, ' ';
            echo ' regionID: ', $regionId, ' ';
            echo ' destinationID: ', $destinationId, ' ';

                //header('location:index.php');




}
?>

</body>
</html>