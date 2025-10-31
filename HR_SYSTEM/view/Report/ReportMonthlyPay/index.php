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
<h2 style="text-align: center; margin-top: 15px; text-transform: uppercase;">Monthly Pay Report</h2>
<div class="container-fluid mt-3" style="max-width: 1200px;">
    <div class="card">
        <div class="card-header">
            <div class="detail-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Monthly Pay Report</h6>
            </div>
        </div>
        <div class="card-body">
            <!-- Monthly Pay Report Section -->
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
                                $sql = "SELECT Code, Description FROM hrdepartment WHERE Status = 'Active' ORDER BY Description";
                                $result = mysqli_query($con, $sql);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . htmlspecialchars($row['Code']) . "'>" . htmlspecialchars($row['Description']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" id="viewPayReport" class="btn btn-primary"><i class="fas fa-search me-2"></i>View Monthly Pay</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="monthlyPayTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Employee Name</th>
                                    <th>Department</th>
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Allowance</th>
                                    <th>Bonus</th>
                                    <th>Deduction</th>
                                    <th>Gross Pay</th>
                                    <th>Untaxed Amount</th>
                                    <th>NSSF</th>
                                    <th>Net Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['month']) && isset($_GET['department'])) {
                                    $month = $_GET['month'];
                                    $department = $_GET['department'];

                                    $sql1 = "SELECT 
                                        d.Code AS DepartmentCode,
                                        d.Description AS DepartmentName,
                                        hrstaffprofile.EmpCode AS EmployeeCode,
                                        hrstaffprofile.EmpName AS EmployeeName,
                                        h.InMonth AS InMonth,
                                        h.Salary AS Salary,
                                        h.Allowance AS Allowance,
                                        h.Bonus AS Bonus,
                                        h.Dedction AS Deduction,
                                        h.Grosspay AS GrossPay,
                                        h.UntaxAm AS UntaxedAmount,
                                        h.NSSF AS NSSF,
                                        h.NetSalary AS NetSalary
                                    FROM hisgensalary h
                                    LEFT JOIN hrstaffprofile ON h.EmpCode = hrstaffprofile.EmpCode
                                    LEFT JOIN hrdepartment d ON hrstaffprofile.Department = d.Code
                                    WHERE h.InMonth = '$month' AND d.Code = '$department'
                                    ORDER BY d.Description;";

                                    $sqldptname = "SELECT Description FROM hrdepartment WHERE Code = '$department'";
                                    $resultdptname = $con->query($sqldptname);
                                    $rowdptname = $resultdptname->fetch_assoc();
                                    $departmentname = $rowdptname['Description'];

                                    $run = $con->query($sql1);
                                    if ($run && $run->num_rows == 0) {
                                        echo "
                                            <script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: 'Pay on the $month and $departmentname is not found',
                                                    showConfirmButton: true 
                                            })
                                            </script>
                                        ";
                                    }
                                    if ($run && $run->num_rows > 0) {
                                        echo "
                                              <script>
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Success',
                                                        text: 'Pay on the $month and $departmentname is found ',
                                                        showConfirmButton: true
                                                    })
                                              </script>
                                        
                                        ";

                                        while ($result = $run->fetch_assoc()) {
                                ?>
                                            <tr>
                                                <td><?php echo $result['EmployeeCode']; ?></td>
                                                <td><?php echo $result['EmployeeName']; ?></td>
                                                <td><?php echo $result['DepartmentName']; ?></td>
                                                <td><?php echo $result['InMonth']; ?></td>
                                                <td><?php echo number_format($result['Salary'], 2); ?></td>
                                                <td><?php echo number_format($result['Allowance'], 2); ?></td>
                                                <td><?php echo number_format($result['Bonus'], 2); ?></td>
                                                <td><?php echo number_format($result['Deduction'], 2); ?></td>
                                                <td><?php echo number_format($result['GrossPay'], 2); ?></td>
                                                <td><?php echo number_format($result['UntaxedAmount'], 2); ?></td>
                                                <td><?php echo number_format($result['NSSF'], 2); ?></td>
                                                <td><?php echo number_format($result['NetSalary'], 2); ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } elseif (isset($_GET['month']) && $_GET['department'] == 'all') {
                                        echo "
                                        <script>
                                             Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: 'PayMonth on the $_GET[month] for all Department',
                                                showConfirmButton: true
                                             })
                                        </script>
                                        ";
                                        $month = $_GET['month'];
                                        $sql1 = "SELECT 
                                        d.Code AS DepartmentCode,
                                        d.Description AS DepartmentName,
                                        hrstaffprofile.EmpCode AS EmployeeCode,
                                        hrstaffprofile.EmpName AS EmployeeName,
                                        h.InMonth AS InMonth,
                                        h.Salary AS Salary,
                                        h.Allowance AS Allowance,
                                        h.Bonus AS Bonus,
                                        h.Dedction AS Deduction,
                                        h.Grosspay AS GrossPay,
                                        h.UntaxAm AS UntaxedAmount,
                                        h.NSSF AS NSSF,
                                        h.NetSalary AS NetSalary
                                    FROM hisgensalary h
                                    LEFT JOIN hrstaffprofile ON h.EmpCode = hrstaffprofile.EmpCode
                                    LEFT JOIN hrdepartment d ON hrstaffprofile.Department = d.Code
                                    WHERE h.InMonth = '$month'
                                    ORDER BY d.Description;";

                                        $run = $con->query($sql1);
                                        if ($run && $run->num_rows == 0) {
                                            echo "
                                                 <script>
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Error',
                                                        text: 'Pay on $month With all Department is not found',
                                                        showConfirmButton: true
                                             })
                                        </script>
                                            ";
                                            echo '<tr><td colspan="12" class="text-center">No records found.</td></tr>';
                                        } elseif ($run && $run->num_rows > 0) {

                                            while ($result = $run->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $result['EmployeeCode']; ?></td>
                                                    <td><?php echo $result['EmployeeName']; ?></td>
                                                    <td><?php echo $result['DepartmentName']; ?></td>
                                                    <td><?php echo $result['InMonth']; ?></td>
                                                    <td><?php echo number_format($result['Salary'], 2); ?></td>
                                                    <td><?php echo number_format($result['Allowance'], 2); ?></td>
                                                    <td><?php echo number_format($result['Bonus'], 2); ?></td>
                                                    <td><?php echo number_format($result['Deduction'], 2); ?></td>
                                                    <td><?php echo number_format($result['GrossPay'], 2); ?></td>
                                                    <td><?php echo number_format($result['UntaxedAmount'], 2); ?></td>
                                                    <td><?php echo number_format($result['NSSF'], 2); ?></td>
                                                    <td><?php echo number_format($result['NetSalary'], 2); ?></td>
                                                </tr>
                                <?php
                                            }
                                        }
                                    } else {
                                        echo '<tr><td colspan="12" class="text-center">No records found.</td></tr>';
                                    }
                                }
                                ?>
                            </tbody>
                            <!-- <tfoot>
                                <tr>
                                    <th colspan="4" style="text-align:right">Total:</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot> -->
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



        })
    })
</script>