<?php

include("../../../Config/conect.php");
include("../../../root/Header.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaySlip Report</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Add SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Add Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../../Style/career.css">
</head>

<body>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">PaySlip Report</h5>
            </div>
            <div class="card-body">
                <form id="payslipForm" class="row g-3">
                    <div class="col-md-6">
                        <label for="empCode" class="form-label">Employee Code</label>
                        <select class="form-control" id="empCode" required>
                            <option value="">Select Employee</option>
                            <?php
                            $sql = "SELECT EmpName, EmpCode FROM hrstaffprofile WHERE Status='Active' ORDER BY EmpName";
                            $run = $con->query($sql);;
                            while ($row = $run->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['EmpCode']; ?>"><?php echo $row['EmpName'] . '-' . $row['EmpCode']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="payMonth" class="form-label">Month</label>
                        <input type="month" class="form-control" id="payMonth" required>
                    </div>
                    <div class="col-12">
                        <button type="button" id="viewPaySlip" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Run PaySlip
                        </button>
                    </div>
                </form>
                <?php
                if (isset($_GET['empcode']) && isset($_GET['month'])) {
                    $empcode = $_GET['empcode'];
                    $month = $_GET['month'];

                    if ($empcode && !$month || !$empcode && $month || !$empcode && !$month) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Please select both employee code and month.',
                                    showConfirmButton: true
                                })
                            </script>";
                        $empcode = '';
                        $empname = '';
                        $department = '';
                        $position = '';
                        $company = '';
                        $inmonth = '';
                        $salary = '';
                        $allowance = '';
                        $Ot = '';
                        $bonus = '';
                        $Ded = '';
                        $grosspay = '';
                        $UntaxAm = '';
                        $NSSF = '';
                        $NetSalary = '';
                    } elseif ($empcode && $month) {
                        $sql1 = "SELECT 
                                        s.EmpCode,
                                        e.EmpName AS EmployeeName,
                                        d.Description AS DepartmentName,
                                        p.Description AS PositionName,
                                        c.Description AS CompanyName,
                                        s.InMonth,
                                        s.Salary,
                                        s.Allowance,
                                        s.OT,
                                        s.Bonus,
                                        s.Dedction,
                                        s.Grosspay,
                                        s.UntaxAm,
                                        s.NSSF,
                                        s.NetSalary
                                    FROM hisgensalary s
                                    LEFT JOIN hrstaffprofile e ON s.EmpCode = e.EmpCode
                                    LEFT JOIN hrdepartment d ON e.Department = d.Code
                                    LEFT JOIN hrposition p ON e.Position = p.Code
                                    LEFT JOIN hrcompany c ON e.Company = c.Code
                                    WHERE s.InMonth = '$month' AND s.EmpCode = '$empcode'";

                        $run1 = $con->query($sql1);
                        if (!$run1) {
                            echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Failed to generate pay slip.',
                                            showConfirmButton: true
                                        })
                                    </script>";
                        }
                        //  Check if no record found
                        elseif ($run1->num_rows == 0) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Not Found',
                                        text: 'No pay slip found for the selected month.',
                                        showConfirmButton: true
                                    })
                                </script>";

                            $empcode = '';
                            $empname = '';
                            $department = '';
                            $position = '';
                            $company = '';
                            $inmonth = '';
                            $salary = '';
                            $allowance = '';
                            $Ot = '';
                            $bonus = '';
                            $Ded = '';
                            $grosspay = '';
                            $UntaxAm = '';
                            $NSSF = '';
                            $NetSalary = '';
                        } else {
                            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Pay slip has been generated.',
                    showConfirmButton: true
                })
            </script>";
                            while ($row1 = $run1->fetch_assoc()) {
                                $empcode = $row1['EmpCode'];
                                $empname = $row1['EmployeeName'];
                                $department = $row1['DepartmentName'];
                                $position = $row1['PositionName'];
                                $company = $row1['CompanyName'];
                                $inmonth = $row1['InMonth'];
                                $salary = $row1['Salary'];
                                $allowance = $row1['Allowance'];
                                $Ot = $row1['OT'];
                                $bonus = $row1['Bonus'];
                                $Ded = $row1['Dedction'];
                                $grosspay = $row1['Grosspay'];
                                $UntaxAm = $row1['UntaxAm'];
                                $NSSF = $row1['NSSF'];
                                $NetSalary = $row1['NetSalary'];
                            }
                        }
                    }
                } else {
                    $empcode = '';
                    $empname = '';
                    $department = '';
                    $position = '';
                    $company = '';
                    $inmonth = '';
                    $salary = '';
                    $allowance = '';
                    $Ot = '';
                    $bonus = '';
                    $Ded = '';
                    $grosspay = '';
                    $UntaxAm = '';
                    $NSSF = '';
                    $NetSalary = '';
                }
                ?>

                <div id="payslipContent" class="mt-4 ">
                    <div class="payslip-header">
                        <div class="company-logo mb-3">
                            <img id="companyLogo" src="2.png" alt="Company Logo" class="img-fluid company-logo-img"
                                style="width: 80px; height: 80px; border-radius: 50%;">
                        </div>
                        <h1 id="companyName"><?php echo $company; ?></h1>
                        <h2>PAYSLIP</h2>
                        <p class="text-muted">Period: <span id="payslipPeriod"><?php echo $inmonth; ?></span></p>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Employee Code</span>
                            <span class="info-value" id="empCodeDisplay"><?php echo $empcode; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Employee Name</span>
                            <span class="info-value" id="empNameDisplay"> <?php echo $empname; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Department</span>
                            <span class="info-value" id="departmentDisplay"><?php echo $department; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Position</span>
                            <span class="info-value" id="positionDisplay"><?php echo $position; ?></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="amount-section">
                                <h3>Earnings</h3>
                                <div class="amount-row">
                                    <span class="amount-label">Basic Salary</span>
                                    <span class="amount-value" id="basicSalary">$ <?php echo $salary; ?></span>
                                </div>
                                <div class="amount-row">
                                    <span class="amount-label">Allowance</span>
                                    <span class="amount-value" id="allowance">$ <?php echo $allowance; ?></span>
                                </div>
                                <div class="amount-row">
                                    <span class="amount-label">Bonus</span>
                                    <span class="amount-value" id="bonus">$ <?php echo $bonus; ?></span>
                                </div>
                                <div class="amount-row total-row">
                                    <span class="amount-label">Total Earnings</span>
                                    <span class="amount-value" id="totalEarnings">$ <?php echo $grosspay; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="amount-section">
                                <h3>Deductions</h3>
                                <div class="amount-row">
                                    <span class="amount-label">NSSF</span>
                                    <span class="amount-value" id="nssfAmount">$ <?php echo $NSSF; ?></span>
                                </div>
                                <div class="amount-row">
                                    <span class="amount-label">Other Deductions</span>
                                    <span class="amount-value" id="otherDeductions">$ <?php echo $Ded; ?></span>
                                </div>
                                <div class="amount-row total-row">
                                    <span class="amount-label">Total Deductions</span>
                                    <span class="amount-value" id="totalDeductions">$ <?php echo $UntaxAm; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="net-pay mt-4">
                        <div class="net-pay-label">Net Pay</div>
                        <div class="net-pay-value" id="netPay">$ <?php echo $NetSalary; ?></div>
                    </div>

                    <div class="export-buttons justify-content-end mt-4">
                        <button type="button" id="exportExcel" class="btn btn-success btn-export">
                            <i class="fas fa-file-excel"></i>
                            <span>Export to Excel</span>
                        </button>
                        <button type="button" id="exportPDF" class="btn btn-danger btn-export">
                            <i class="fas fa-file-pdf"></i>
                            <span>Export to PDF</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="month" value="<?php echo $inmonth ?>">
    <input type="hidden" id="empcode1" value="<?php echo $empcode ?>">

    <script>
        $(document).ready(function() {
            $('#viewPaySlip').click(function() {
                var empcode = $("#empCode").val();
                var month = $("#payMonth").val();
                window.location.href = "index.php?empcode=" + empcode + "&month=" + month;
            })
            $("#exportPDF").click(function() {
                var empcode = $("#empcode1").val();
                var month = $("#month").val();

                if (empcode && month) {
                    window.location.href = "exportPDF.php?empcode=" + empcode + "&month=" + month;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Please gererate pay slip first.',
                        showConfirmButton: true
                    })
                }


            })

        })
    </script>