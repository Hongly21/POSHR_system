<?php

include("../../../root/Header.php");
include("../../../Config/conect.php");

?>

<style>
    /* General Container */
    .container-fluid {
        background-color: #f5f6fa;
        padding: 20px;
        border-radius: 12px;
    }

    /* Card Style */
    .card {
        border: none;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        background-color: #fff;
        overflow: hidden;
    }

    /* Header */
    .card-header {
        background: linear-gradient(90deg, #007bff, #0056b3);
        color: #fff;
        padding: 15px 20px;
    }

    .card-header-title {
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .card-header-title i {
        margin-right: 8px;
    }

    /* Filter Section */
    .filter-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .filter-section label {
        font-weight: 600;
        color: #333;
    }

    .filter-section .form-control,
    .filter-section .form-select {
        border-radius: 8px;
        border: 1px solid #ccc;
        transition: all 0.2s ease-in-out;
    }

    .filter-section .form-control:focus,
    .filter-section .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    /* Buttons */
    .btn {
        border-radius: 8px;
        padding: 8px 15px;
        font-weight: 500;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    /* Table Section */
    .detail-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
        overflow-x: auto;
    }

    .detail-header {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .detail-header h6 {
        font-weight: 600;
        margin: 0;
    }

    .table {
        margin: 0;
        border-radius: 10px;
        overflow: hidden;
    }

    .table th {
        background-color: #f1f1f1;
        color: #333;
        font-weight: 600;
        text-align: center;
        vertical-align: middle;
    }

    .table td {
        vertical-align: middle;
        text-align: center;
        color: #555;
    }

    /* Hover effect */
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background 0.3s ease;
    }

    /* Action button inside table */
    .table .btn-primary {
        background-color: #17a2b8;
        border: none;
        padding: 5px 10px;
        border-radius: 6px;
    }

    .table .btn-primary:hover {
        background-color: #138496;
    }

    /* SweetAlert style override (optional) */
    .swal2-popup {
        border-radius: 12px !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .filter-section .row>div {
            margin-bottom: 15px;
        }
    }
</style>

<h2 style="text-align: center; margin-top: 15px;">Monthly Summary Report</h2>
<div class="container-fluid mt-3" style="max-width: 1200px;">
    <div class="card">
        <div class="card-header">
            <div class="detail-header d-flex justify-content-between align-items-center">

                <h6 class="mb-0"> <i style="margin-right: 10px;" class="fas fa-chart-bar"></i> Monthly Department Summary Report</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="detail-card mt-4">
                <div class="detail-body">
                    <div class="row g-3 mb-3">

                        <div class="col-md-3">
                            <label for="payMonth" class="form-label">Month:</label>
                            <input type="month" id="payMonth" class="form-control" value="<?php echo date('Y-m'); ?>">
                        </div>

                        <div class="col-md-3">
                            <label for="payDepartment" class="form-label">Department:</label>
                            <select id="payDepartment" class="form-select">
                                <option value="all">All Departments</option>
                                <?php
                                $sql = "SELECT Code, Description FROM hrdepartment WHERE Status = 'Active'";
                                $run = $con->query($sql);
                                while ($row = $run->fetch_assoc()) {
                                    $selected = (isset($_GET['department']) && $_GET['department'] == $row['Code']) ? 'selected' : '';
                                    echo '<option value="' . $row['Code'] . '" ' . $selected . '>' . $row['Description'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" id="viewPayReport" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>View Monthly Pay
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="monthlySummaryTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Employee Count</th>
                                    <th>Total Salary</th>
                                    <th>Total Allowance</th>
                                    <th>Total OT</th>
                                    <th>Total Bonus</th>
                                    <th>Total Deduction</th>
                                    <th>Total Leave Tax</th>
                                    <th>Total Amt to be Tax</th>
                                    <th>Total Gross Pay</th>
                                    <th>Total Family</th>
                                    <th>Total Untaxed</th>
                                    <th>Total NSSF</th>
                                    <th>Total Net Salary</th>
                                    <th>Average Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['month']) && isset($_GET['department'])) {
                                    $month = $_GET['month'];
                                    $department = $_GET['department'];

                                    if ($department != 'all') {
                                        $sql1 = "SELECT 
                                            d.Code as DepartmentCode,
                                            d.Description as DepartmentName,
                                            COUNT(DISTINCT hrstaffprofile.EmpCode) as EmployeeCount,
                                            SUM(h.Salary) as TotalSalary,
                                            SUM(h.Allowance) as TotalAllowance,
                                            SUM(h.OT) as TotalOT,
                                            SUM(h.Bonus) as TotalBonus,
                                            SUM(h.Dedction) as TotalDeduction,
                                            SUM(h.LeavedTax) as TotalLeavedTax,
                                            SUM(h.Amtobetax) as TotalAmtobetax,
                                            SUM(h.Grosspay) as TotalGrossPay,
                                            SUM(h.Family) as TotalFamily,
                                            SUM(h.UntaxAm) as TotalUntaxedAmount,
                                            SUM(h.NSSF) as TotalNSSF,
                                            SUM(h.NetSalary) as TotalNetSalary,
                                            AVG(h.NetSalary) as AverageSalary
                                        FROM hisgensalary h
                                        LEFT JOIN hrstaffprofile ON h.EmpCode = hrstaffprofile.EmpCode
                                        LEFT JOIN hrdepartment d ON hrstaffprofile.Department = d.Code
                                        WHERE h.InMonth = '$month' AND d.Code = '$department'
                                        GROUP BY d.Code, d.Description
                                        ORDER BY d.Description";
                                        $run1 = $con->query($sql1);

                                        //find department name from code
                                        $deptname = " SELECT Description FROM hrdepartment WHERE Code = '$department'";
                                        $run2 = $con->query($deptname);
                                        $result2 = $run2->fetch_assoc();
                                        $departmentname = $result2['Description'];
                                        if ($run1->num_rows > 0) {
                                            echo "
                                            <script>
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success',
                                                        text: 'Monthly on $month With $departmentname Summary Report is generated',
                                                        showConfirmButton: true
                                                    })
                                            </script>
                                            ";
                                            while ($row1 = $run1->fetch_assoc()) {
                                ?>
                                                <tr>
                                                    <td><?php echo $row1['DepartmentName']; ?></td>
                                                    <td><?php echo $row1['EmployeeCount']; ?></td>
                                                    <td>$<?php echo $row1['TotalSalary']; ?></td>
                                                    <td>$<?php echo $row1['TotalAllowance']; ?></td>
                                                    <td>$<?php echo $row1['TotalOT']; ?></td>
                                                    <td>$<?php echo $row1['TotalBonus']; ?></td>
                                                    <td>$<?php echo $row1['TotalDeduction']; ?></td>
                                                    <td>$<?php echo $row1['TotalLeavedTax']; ?></td>
                                                    <td>$<?php echo $row1['TotalAmtobetax']; ?></td>
                                                    <td>$<?php echo $row1['TotalGrossPay']; ?></td>
                                                    <td>$<?php echo $row1['TotalFamily']; ?></td>
                                                    <td>$<?php echo $row1['TotalUntaxedAmount']; ?></td>
                                                    <td>$<?php echo $row1['TotalNSSF']; ?></td>
                                                    <td>$<?php echo $row1['TotalNetSalary']; ?></td>
                                                    <td>$<?php echo $row1['AverageSalary']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4" style="text-align:right">Total:</th>
                                                    <th colspan="11">$<?php echo $row1['TotalSalary']; ?></th>
                                                </tr>
                                            <?php
                                            }
                                        } elseif ($run1->num_rows == 0) {
                                            echo "
                                            <script>
                                                    Swal.fire({
                                                        icon: 'warning',
                                                        title: 'Not Found',
                                                        text: 'Monthly on $month With $departmentname No Record Found.',
                                                        showConfirmButton: true
                                                    })
                                            </script>
                                            ";
                                            echo '<tr><td colspan="12" class="text-center">No records found.</td></tr>';
                                        }
                                    } else {
                                        $sql5 = "SELECT 
                                            d.Code as DepartmentCode,
                                            d.Description as DepartmentName,
                                            COUNT(DISTINCT hrstaffprofile.EmpCode) as EmployeeCount,
                                            SUM(h.Salary) as TotalSalary,
                                            SUM(h.Allowance) as TotalAllowance,
                                            SUM(h.OT) as TotalOT,
                                            SUM(h.Bonus) as TotalBonus,
                                            SUM(h.Dedction) as TotalDeduction,
                                            SUM(h.LeavedTax) as TotalLeavedTax,
                                            SUM(h.Amtobetax) as TotalAmtobetax,
                                            SUM(h.Grosspay) as TotalGrossPay,
                                            SUM(h.Family) as TotalFamily,
                                            SUM(h.UntaxAm) as TotalUntaxedAmount,
                                            SUM(h.NSSF) as TotalNSSF,
                                            SUM(h.NetSalary) as TotalNetSalary,
                                            AVG(h.NetSalary) as AverageSalary
                                        FROM hisgensalary h
                                        LEFT JOIN hrstaffprofile ON h.EmpCode = hrstaffprofile.EmpCode
                                        LEFT JOIN hrdepartment d ON hrstaffprofile.Department = d.Code
                                        WHERE h.InMonth = '$month'
                                        GROUP BY d.Code, d.Description
                                        ORDER BY d.Description";
                                        $run5 = $con->query($sql5);
                                        if ($run5->num_rows > 0) {
                                            echo "
                                            <script>
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success',
                                                        text: 'Monthly on $month for All Departements Summary Report is generated',
                                                        showConfirmButton: true
                                                    })
                                            </script>
                                            ";
                                            while ($row5 = $run5->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row5['DepartmentName']; ?></td>
                                                    <td><?php echo $row5['EmployeeCount']; ?></td>
                                                    <td>$<?php echo $row5['TotalSalary']; ?></td>
                                                    <td>$<?php echo $row5['TotalAllowance']; ?></td>
                                                    <td>$<?php echo $row5['TotalOT']; ?></td>
                                                    <td>$<?php echo $row5['TotalBonus']; ?></td>
                                                    <td>$<?php echo $row5['TotalDeduction']; ?></td>
                                                    <td>$<?php echo $row5['TotalLeavedTax']; ?></td>
                                                    <td>$<?php echo $row5['TotalAmtobetax']; ?></td>
                                                    <td>$<?php echo $row5['TotalGrossPay']; ?></td>
                                                    <td>$<?php echo $row5['TotalFamily']; ?></td>
                                                    <td>$<?php echo $row5['TotalUntaxedAmount']; ?></td>
                                                    <td>$<?php echo $row5['TotalNSSF']; ?></td>
                                                    <td>$<?php echo $row5['TotalNetSalary']; ?></td>
                                                    <td>$<?php echo $row5['AverageSalary']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th colspan="4" style="text-align:right">Total:</th>
                                                    <th colspan="11">$<?php echo $row5['TotalSalary']; ?></th>
                                                </tr>
                                        <?php
                                            }
                                        } elseif ($run5->num_rows == 0) {
                                            echo "
                                            <script>
                                                    Swal.fire({
                                                        icon: 'warning',
                                                        title: 'Not Found',
                                                        text: 'No Record Found.',
                                                        showConfirmButton: true
                                                    })
                                            </script>
                                            ";
                                            echo '<tr><td colspan="12" class="text-center">No records found.</td></tr>';
                                        }
                                    }
                                } else {
                                    $sql1 = "SELECT 
                                        d.Code as DepartmentCode,
                                        d.Description as DepartmentName,
                                        COUNT(DISTINCT hrstaffprofile.EmpCode) as EmployeeCount,
                                        SUM(h.Salary) as TotalSalary,
                                        SUM(h.Allowance) as TotalAllowance,
                                        SUM(h.OT) as TotalOT,
                                        SUM(h.Bonus) as TotalBonus,
                                        SUM(h.Dedction) as TotalDeduction,
                                        SUM(h.LeavedTax) as TotalLeavedTax,
                                        SUM(h.Amtobetax) as TotalAmtobetax,
                                        SUM(h.Grosspay) as TotalGrossPay,
                                        SUM(h.Family) as TotalFamily,
                                        SUM(h.UntaxAm) as TotalUntaxedAmount,
                                        SUM(h.NSSF) as TotalNSSF,
                                        SUM(h.NetSalary) as TotalNetSalary,
                                        AVG(h.NetSalary) as AverageSalary
                                    FROM hisgensalary h
                                    LEFT JOIN hrstaffprofile ON h.EmpCode = hrstaffprofile.EmpCode
                                    LEFT JOIN hrdepartment d ON hrstaffprofile.Department = d.Code
                                    GROUP BY d.Code, d.Description
                                    ORDER BY d.Description";
                                    $run1 = $con->query($sql1);
                                    while ($row1 = $run1->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row1['DepartmentName']; ?></td>
                                            <td><?php echo $row1['EmployeeCount']; ?></td>
                                            <td>$<?php echo $row1['TotalSalary']; ?></td>
                                            <td>$<?php echo $row1['TotalAllowance']; ?></td>
                                            <td>$<?php echo $row1['TotalOT']; ?></td>
                                            <td>$<?php echo $row1['TotalBonus']; ?></td>
                                            <td>$<?php echo $row1['TotalDeduction']; ?></td>
                                            <td>$<?php echo $row1['TotalLeavedTax']; ?></td>
                                            <td>$<?php echo $row1['TotalAmtobetax']; ?></td>
                                            <td>$<?php echo $row1['TotalGrossPay']; ?></td>
                                            <td>$<?php echo $row1['TotalFamily']; ?></td>
                                            <td>$<?php echo $row1['TotalUntaxedAmount']; ?></td>
                                            <td>$<?php echo $row1['TotalNSSF']; ?></td>
                                            <td>$<?php echo $row1['TotalNetSalary']; ?></td>
                                            <td>$<?php echo $row1['AverageSalary']; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $("#viewPayReport").click(function() {
            var month = $("#payMonth").val();
            var department = $("#payDepartment").val();
            window.location.href = "index.php?month=" + month + "&department=" + department;

        });


    });
</script>