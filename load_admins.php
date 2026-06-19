<?php
include "connection.php";
session_start();
?>
<table class="table table-striped table-sm">
    <thead>
        <tr>
            <th scope="col" style="font-weight: normal;">ID</th>
            <th scope="col" style="font-weight: normal;">EMAIL ADDRESS</th>
            <th scope="col" style="font-weight: normal;">FIRST NAME</th>
            <th scope="col" style="font-weight: normal;">LAST NAME</th>
            <th scope="col" style="font-weight: normal;">MOBILE NUMBER</th>
            <th scope="col" style="font-weight: normal;">INSTITUTE</th>
            <th scope="col" style="font-weight: normal; text-align: center;">STATUS</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $query1 = Database::search("SELECT `admin`.*, `admin`.`id` AS `admin_id`, `institute`.`name` AS `institute_name` 
                            FROM `admin` 
                            LEFT JOIN `institute` ON `admin`.`institute_id` = `institute`.`id`");
        $num = $query1->num_rows;

        for ($i = 0; $i < $num; $i++) {
            $rs = $query1->fetch_assoc();
        ?>
            <tr>
                <td><?php echo ($rs["id"]); ?></td>
                <td><?php echo ($rs["email"]); ?></td>
                <td><?php echo ($rs["fname"]); ?></td>
                <td><?php echo ($rs["lname"]); ?></td>
                <td><?php echo ($rs["mobile"]); ?></td>
                <td>
                    <?php
                    if (!empty($rs["institute_name"])) {
                        echo ($rs["institute_name"]); // Institute එකක් තියෙනවා නම් ඒ නම වැටෙනවා
                    } else {
                        echo ("<span class='text-muted' style='font-size: 13px;'>Not Assigned</span>"); // නැත්නම් මේක වැටෙනවා
                    }
                    ?>
                </td>
                <td><?php
                    if ($rs["status_id"] == 1) {
                    ?>
                        <button class="btn d-grid col-12 border-0 text-info bg-transparent" style="border-radius: 0; font-size: 14px;">Active</button>
                    <?php
                    } elseif ($rs["status_id"] == 2) {
                    ?>
                        <button class="btn btn-danger d-grid col-12" style="border-radius: 0; font-size: 14px;">Blocked</button>
                    <?php
                    } elseif ($rs["status_id"] == 3) {
                    ?>
                        <button class="btn d-grid col-12 border-0 text-info bg-transparent" style="border-radius: 0; font-size: 14px;">Active</button>
                    <?php
                    } else {
                    ?>
                        <button class="btn d-grid col-12 border-0 text-warning bg-transparent" style="border-radius: 0; font-size: 14px; cursor: not-allowed;">Pending</button>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>

</table>