<?php
include('../../Config/conect.php');
include('../../root/Header.php');
?>

<div class="table-responsive">
    <table id="approvedTable" class="table table-bordered table-striped w-100">
        <thead class="table-light">
            <tr>
                <th>Month</th>
                <th>Total Salary</th>
                <th>Total Allowance</th>
                <th>Total OT</th>
                <th>Total Bonus</th>
                <th>Total Deduction</th>
                <th>Total Gross</th>
                <th>Net Salary</th>
                <th>Status</th>
                <th>Remark</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT 
        sum(s.Salary) as TotalSalary,
        sum(s.Allowance) as TotalAllowance,
        sum(s.OT) as TotalOT,
        sum(s.Bonus) as TotalBonus,
        sum(s.Dedction) as TotalDed,
        sum(s.Grosspay) as TotalGross,
        Sum(s.NetSalary) as NetSalary,
        A.InMonth,
        A.status,
        A.Remark,
        A.ID
        FROM hisgensalary S
        INNER JOIN prapprovesalary A ON S.InMonth = A.InMonth 
        Where A.status='Approved' 
        GROUP BY A.InMonth, A.status, A.Remark, A.ID";

            // Execute the query
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            // Fetch the results
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['InMonth'] . '</td>';
                echo '<td>$' . $row['TotalSalary'] . '</td>';
                echo '<td>$' . $row['TotalAllowance'] . '</td>';
                echo '<td>$' . $row['TotalOT'] . '</td>';
                echo '<td>$' . $row['TotalBonus'] . '</td>';
                echo '<td>$' . $row['TotalDed'] . '</td>';
                echo '<td>$' . $row['TotalGross'] . '</td>';
                echo '<td>$' . $row['NetSalary'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '<td>' . $row['Remark'] . '</td>';
                echo '</tr>';
            }

            ?>



        </tbody>
    </table>
</div>