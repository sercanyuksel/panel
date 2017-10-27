<?php
require('../include/ayar.php');
if($_GET){
    $car_id=$_GET['id'];
    $sth=$conn->prepare("SELECT c.*,ca.camera as type  from car_camera c INNER JOIN camera_types ca  ON c.type_id=ca.id WHERE c.car_id=? AND c.status=0");
    $sth->execute(array(
        $car_id
    ));
    $car_cameras=$sth->fetchAll();
   
        echo '
        <div class="form-group" id="dynamicInput">
        <label for="camera">Kamera :</label>
        <select class="form-control" name="camera" id="camera">';
        foreach($car_cameras as $value)
        {
         echo '<option value="'.$value['id'].'">'.$value['type'].'</option>';
        }
        echo '                     
        </select>
        </div>

            ';
    
}
?>