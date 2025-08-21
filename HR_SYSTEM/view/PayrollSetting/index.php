<?php
include("../../Config/conect.php");
include("../../root/Header.php");
include("../../root/DataTable.php");

?>


<h3 class="text-center">PAROLL SETTING</h3>

<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <table border="1" class="display" id="example">
        <thead>
            <tr>
                <th>Actions</th>
                <th>Code</th>
                <th>Description</th>
                <th>Working Days</th>
                <th>Hour Per Day</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM prpaypolicy ORDER BY id DESC";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button><i class="fas fa-edit"></i></button>
                        <button><i class="fas fa-trash"></i></button>
                    </td>
                    <td><?php echo $row['code']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['workday']; ?></td>
                    <td><?php echo $row['hourperday']; ?></td>
                    <td>
                        <?php
                        echo ($row['mon'] ? "<i class='fas fa-check text-success'></i>" :
                         "<i class='fas fa-times text-danger'></i>") 
                        ?>
                        </td>
                    <td>
                        <?php echo ($row['tues'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['wed'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['thur'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['fri'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['sat'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['sun'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>

    </table>
</div>

