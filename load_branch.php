<?php
require "connection.php";

if (isset($_GET["institute_id"]) && $_GET["institute_id"] != "0") {
    $institute_id = $_GET["institute_id"];
    
    $rs = Database::search("SELECT * FROM `branch` WHERE `institute_id`='$institute_id'");
    $num = $rs->num_rows;

    if ($num > 0) {
        for ($i = 0; $i < $num; $i++) {
            $data = $rs->fetch_assoc();
            ?>
            <option value="<?php echo $data["id"]; ?>"><?php echo $data["name"]; ?></option>
            <?php
        }
    } else {
        echo '<option value="0" disabled>No branches found</option>';
    }
}
?>