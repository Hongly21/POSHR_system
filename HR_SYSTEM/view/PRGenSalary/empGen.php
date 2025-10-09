<?php
include('../../Config/conect.php');
include('../../root/Header.php');
include('../../root/DataTable.php');

?>

<table id="salaryTable" class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Month</th>
            <th>Total Salary</th>
            <th>Total Allowance</th>
            <th>Total OT</th>
            <th>Total Bonus</th>
            <th>Total Deduction</th>
            <th>Total Gross</th>
            <th>Total Net</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM hisgensalary";
        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["InMonth"] . "</td>";
            echo "<td>$" . $row["Salary"] . "</td>";
            echo "<td>$" . $row["Allowance"] . "</td>";
            echo "<td>$" . $row["OT"] . "</td>";
            echo "<td>$" . $row["Bonus"] . "</td>";
            echo "<td>$" . $row["Dedction"] . "</td>";
            echo "<td>$" . $row["Grosspay"] . "</td>";
            echo "<td>$" . $row["NetSalary"] . "</td>";
            echo "</tr>";
        }
        ?>

    </tbody>
</table>