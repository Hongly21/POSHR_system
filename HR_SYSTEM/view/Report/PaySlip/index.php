<?php

include("../../../Config/conect.php");
include("../../../root/Header.php");

?>
<style>
    #payslipContent {
        max-width: 1000px;
        margin: 40px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .payslip-header {
        text-align: center;
        border-bottom: 2px solid #e0e0e0;
        padding-bottom: 20px;
        margin-bottom: 30px;
    }

    .company-logo-img {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    #companyName {
        font-size: 28px;
        font-weight: 700;
        margin: 10px 0 5px;
        color: #2c3e50;
    }

    .payslip-header h2 {
        font-size: 22px;
        color: #16a085;
        margin-bottom: 5px;
    }

    .payslip-header p {
        font-size: 14px;
        color: #7f8c8d;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-item {
        background: #f9f9f9;
        padding: 15px 20px;
        border-radius: 8px;
        border-left: 5px solid #3498db;
    }

    .info-label {
        display: block;
        font-weight: 600;
        color: #555;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 16px;
        color: #2c3e50;
    }

    .amount-section {
        background: #f4f6f8;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid #e1e1e1;
    }

    .amount-section h3 {
        font-size: 20px;
        color: #34495e;
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 8px;
    }

    .amount-row {
        display: flex;
        justify-content: space-between;
        padding: 8px 0;
        font-size: 15px;
    }

    .amount-label {
        color: #555;
    }

    .amount-value {
        font-weight: 600;
        color: #2c3e50;
    }

    .total-row {
        border-top: 1px solid #ccc;
        margin-top: 10px;
        padding-top: 10px;
        font-size: 16px;
        font-weight: bold;
        color: #2980b9;
    }

    .net-pay {
        width: 30%;
        text-align: center;
        background: linear-gradient(to right, #608670ff, #b7bcb9ff);
        color: white;
        padding: 10px;
        border-radius: 10px;
        font-size: 22px;
        font-weight: bold;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .net-pay-label {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .export-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
    }

    .btn-export {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        padding: 10px 18px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-export i {
        font-size: 16px;
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
</style>
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
<h2 style="text-align: center; margin-top: 15px; text-transform: uppercase;">PaySlip Report</h2>

<body>
    <div class="container-fluid py-4" style="max-width: 1200px;">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Generate PaySlip</h5>
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

                        // find EmpName  
                        $slqempname = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                        $runempname = $con->query($slqempname);
                        $rowempname = $runempname->fetch_assoc();
                        $EmpName = $rowempname['EmpName'];
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
                                        text: 'No pay slip found for $EmpName in $month.',
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
                                        text: 'Pay slip for $EmpName in $month has been generated.',
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

                <div id="payslipContent">
                    <div class="payslip-header">
                        <div class="company-logo mb-3">
                            <img id="companyLogo" src="2.png" alt="Company Logo" class="img-fluid company-logo-img">
                        </div>
                        <h1 id="companyName"><?php echo $company; ?></h1>
                        <h2>PAYSLIP</h2>
                        <p class="text-muted">Period: <span id="payslipPeriod"><?php echo $inmonth; ?></span></p>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Employee Code:</span>
                            <span class="info-value" id="empCodeDisplay"><?php echo $empcode; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Employee Name:</span>
                            <span class="info-value" id="empNameDisplay"> <?php echo $empname; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Department:</span>
                            <span class="info-value" id="departmentDisplay"><?php echo $department; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Position:</span>
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

                    <div class="net-pay">
                        <div class="net-pay-label">Net Pay</div>
                        <div class="net-pay-value" id="netPay">$ <?php echo $NetSalary; ?></div>
                    </div>

                    <div class="export-buttons justify-content-end mt-4">
                
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


</body>