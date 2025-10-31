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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $sql = "SELECT * FROM prapprovesalary WHERE status = 'pending'";
            // $result = $con->query($sql);
            // $row = $result->fetch_assoc();
            // $InMonth = $row['InMonth'];
            // $sql1 = "SELECT * FROM hisgensalary WHERE InMonth='$InMonth'";
            $sql1 = "SELECT 
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
        Where A.status='pending' 
         ";
            $result1 = $con->query($sql1);
            while ($row1 = $result1->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row1['InMonth']; ?></td>
                    <td>$<?php echo $row1['TotalSalary']; ?></td>
                    <td>$<?php echo $row1['TotalAllowance']; ?></td>
                    <td>$<?php echo $row1['TotalOT']; ?></td>
                    <td>$<?php echo $row1['TotalBonus']; ?></td>
                    <td>$<?php echo $row1['TotalDed']; ?></td>
                    <td>$<?php echo $row1['TotalGross']; ?></td>
                    <td>$<?php echo $row1['NetSalary']; ?></td>
                    <td>Panding</td>
                    <td><?php echo $row['Remark']; ?></td>
                    <td>
                        <a href="../../action/PRApproveSalary/approve.php?id=<?php echo $row1['ID']; ?> && InMonth=<?php echo $row1['InMonth']; ?> " class="btn btn-success btn-sm approve-btn">
                            <i class="fas fa-check"></i> Approve </a>
                        <a href="../../action/PRApproveSalary/reject.php?id=<?php echo $row1['ID']; ?> && InMonth=<?php echo $row1['InMonth']; ?> " class="btn btn-danger btn-sm reject-btn">
                            <i class="fas fa-times"></i> Reject</a>

                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<?php
if (isset($_GET['approvedsuccess']) && isset($_GET['inmonthapprove'])) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Salary Approved in $_GET[inmonthapprove] Successfully',
            showConfirmButton: true
        })
    </script>";
} elseif (isset($_GET['rejectedsuccess']) && isset($_GET['monthrejected'])) {
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Salary on $_GET[monthrejected] is Rejected',
            showConfirmButton: true
        })
    </script>";
}
?>