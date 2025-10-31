<?php
include("../../root/Header.php");
include("../../Config/conect.php");
?>

<style>
    :root {
        --primary-color: #6366f1;
        /* Modern indigo */
        --secondary-color: #4f46e5;
        /* Deeper indigo */
        --success-color: #10b981;
        /* Fresh emerald */
        --warning-color: #f59e0b;
        /* Warm amber */
        --danger-color: #ef4444;
        /* Vibrant red */
        --info-color: #3b82f6;
        /* Bright blue */
        --border-color: #e2e8f0;
        /* Cool gray */
        --bg-light: #f8fafc;
        /* Slate 50 */
        --bg-dark: #1e293b;
        /* Slate 800 */
        --text-primary: #0f172a;
        /* Slate 900 */
        --text-secondary: #475569;
        /* Slate 600 */
        --text-light: #94a3b8;
        /* Slate 400 */
        --gradient-start: #818cf8;
        /* Indigo 400 */
        --gradient-end: #6366f1;
        /* Indigo 500 */
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
    }

    .filter-section {
        background: var(--bg-light);
        padding: 1.5rem;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
    }

    .detail-card {
        background: white;
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .detail-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .detail-header {
        background: var(--bg-light);
        padding: 1.25rem;
        border-bottom: 1px solid var(--border-color);
        border-radius: 1rem 1rem 0 0;
    }

    .detail-header h6 {
        color: var(--text-primary);
        font-weight: 600;
        margin: 0;
        font-size: 1.1rem;
    }

    .detail-body {
        padding: 1.5rem;
    }

    .info-label {
        font-weight: 600;
        color: var(--text-secondary);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .salary-amount {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--success-color);
    }

    /* Form Controls */
    .form-select,
    .form-control {
        border-radius: 0.5rem;
        border: 1px solid var(--border-color);
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: var(--text-primary);
        background-color: white;
        transition: all 0.2s ease;
    }

    .form-select:hover,
    .form-control:hover {
        border-color: var(--text-light);
    }

    .form-select:focus,
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        outline: none;
    }

    /* Button Styles */
    .btn-primary {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        color: white;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 4px rgba(99, 102, 241, 0.1);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--gradient-end), var(--gradient-start));
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(99, 102, 241, 0.2);
    }

    .btn-primary:active {
        transform: translateY(0);
        box-shadow: 0 1px 2px rgba(99, 102, 241, 0.2);
    }

    /* Table Styles */
    .table {
        border-radius: 0.5rem;
        overflow: hidden;
        border: 1px solid var(--border-color);
        background: white;
    }

    .table thead {
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
    }

    .table thead th {
        color: purple !important;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.25rem 1rem;
        border-bottom: none;
        vertical-align: middle;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    }

    .table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
        color: var(--text-primary);
        font-size: 0.95rem;
    }

    .table tbody tr:hover {
        background-color: var(--bg-light);
    }

    .table tfoot tr {
        background-color: var(--bg-light);
        font-weight: 600;
    }

    .table tfoot th {
        padding: 1.25rem 1rem;
        color: purple
    }

    /* Status Colors */
    .status-active {
        color: var(--success-color);
        background-color: rgba(16, 185, 129, 0.1);
        border-radius: 0.375rem;
        padding: 0.25rem 0.75rem;
        font-weight: 500;
    }

    .status-pending {
        color: var(--warning-color);
        background-color: rgba(245, 158, 11, 0.1);
        border-radius: 0.375rem;
        padding: 0.25rem 0.75rem;
        font-weight: 500;
    }

    /* Modal Styles */
    .salary-detail-modal .swal2-popup {
        padding: 2rem !important;
        border-radius: 1rem !important;
        width: 800px !important;
        box-shadow: var(--shadow-lg) !important;
    }

    .salary-detail-modal .swal2-title {
        color: var(--primary-color) !important;
        font-size: 1.5rem !important;
        font-weight: 600 !important;
        border-bottom: 2px solid var(--border-color);
        padding-bottom: 1rem;
        margin-bottom: 1.5rem !important;
    }

    /* Loading Spinner */
    #loadingSpinner .spinner-border {
        color: var(--primary-color);
        width: 3rem;
        height: 3rem;
    }
</style>
<div class="container-fluid mt-3">

    <div class="card">
        <div class="card-header">
            <h5 class="card-header-title">
                <i class="fas fa-history"></i>
                Salary History Details
            </h5>
        </div>
        <div class="card-body">
            <div class="filter-section">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="employee" class="form-label">Select Employee:</label>
                        <select id="employee" class="form-select">
                            <option value="">Select Employee</option>
                            <?php
                            $sql = "SELECT EmpCode, EmpName FROM hrstaffprofile WHERE Status = 'Active' ORDER BY EmpName";
                            $result = $con->query($sql);
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['EmpCode']; ?>"><?php echo $row['EmpCode'] . ' - ' . $row['EmpName']; ?></option>
                            <?php
                                }
                            } else {
                                echo "<option value=''>No employees found</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="month" class="form-label">Month:</label>
                        <select id="month" class="form-select">
                            <?php
                            $currentMonth = date('Y-m');
                            for ($i = 0; $i < 12; $i++) {
                                $month = date('Y-m', strtotime($currentMonth . " -$i months"));
                                echo "<option value='$month'>" . date('F Y', strtotime($month)) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button id="viewDetails" class="btn btn-primary w-100">
                            <i class="fas fa-search me-2"></i>View Details
                        </button>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['empCode']) && isset($_GET['month'])) {
                $empcode = $_GET['empCode'];
                $month = $_GET['month'];
                $sql = "SELECT hrstaffprofile.*, 
                    hrcompany.Description as CompanyName,
                    hrdepartment.Description as DepartmentName,
                    hrdivision.Description as DivisionName,
                    hrposition.Description as PositionName,
                    hrlevel.Description as LevelName 
                    FROM hrstaffprofile
                    LEFT JOIN hrcompany ON hrstaffprofile.Company = hrcompany.Code
                    LEFT JOIN hrdepartment ON hrstaffprofile.Department = hrdepartment.Code
                    LEFT JOIN hrdivision ON hrstaffprofile.Division = hrdivision.Code
                    LEFT JOIN hrposition ON hrstaffprofile.Position = hrposition.Code
                    LEFT JOIN hrlevel ON hrstaffprofile.Level = hrlevel.Code
                    WHERE hrstaffprofile.EmpCode = '$empcode'";
                $result = $con->query($sql);
                $row = $result->fetch_assoc();
                $empName = $row['EmpName'];
                $department = $row['DepartmentName'];
                $position = $row['PositionName'];

                $sql1 = "SELECT * FROM hisgensalary WHERE EmpCode = '$empcode' AND InMonth = '$month'";


                $result1 = $con->query($sql1);
                if ($result1->num_rows > 0) {
                    echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Successfully',
                            text: 'Salary Details of $empName Loaded Successfully',
                            showConfirmButton: true
                        })
                    </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Salary Details of $empName Not Found',
                            showConfirmButton: true
                        })
                    </script>";
                }
                $row1 = $result1->fetch_assoc();
                $empcode = $row1['EmpCode'];
                // $department = $row1['Department'];
                $salary = $row1['Salary'];
                $allowance = $row1['Allowance'];
                $Ot = $row1['OT'];
                $bonus = $row1['Bonus'];
                $Ded = $row1['Dedction'];
                $leavetax = $row1['LeavedTax'];
                $Amtobetax = $row1['Amtobetax'];
                $Grosspay = $row1['Grosspay'];
                $Family = $row1['Family'];
                $UntaxAm = $row1['UntaxAm'];
                $NSSF = $row1['NSSF'];
                $NetSalary = $row1['NetSalary'];
            } else {
                $empcode = '';
                $empName = '';
                $department = '';
                $position = '';

                $salary = '';
                $allowance = '';
                $Ot = '';
                $bonus = '';
                $Ded = '';
                $leavetax = '';
                $Amtobetax = '';
                $Grosspay = '';
                $Family = '';
                $UntaxAm = '';
                $NSSF = '';
                $NetSalary = '';
            }
            ?>



            <!-- Employee Details Section -->
            <div id="employeeDetails" class="detail-card">
                <div class="detail-header">
                    <h6 class="mb-0">Employee Information</h6>
                </div>
                <div class="detail-body">

                    <div class="row">
                        <div class="col-md-3">
                            <p class="info-label">Employee Code:</p>
                            <b id="empCode"><?php echo $empcode; ?></b>
                        </div>
                        <div class="col-md-3">
                            <p class="info-label">Employee Name:</p>
                            <b id="empName"><?php echo $empName; ?></b>
                        </div>
                        <div class="col-md-3">
                            <p class="info-label">Department:</p>
                            <b id="department"><?php echo $department; ?></b>
                        </div>
                        <div class="col-md-3">
                            <p class="info-label">Position:</p>
                            <b id="position"><?php echo $position; ?> </b>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Salary Details Section -->
            <div id="salaryDetails" class="detail-card">
                <div class="detail-header">
                    <h6 class="mb-0">Salary Components</h6>
                </div>
                <div class="detail-body">
                    <table class="table table-bordered" id="salaryTable">
                        <thead>
                            <tr>
                                <th>Component</th>
                                <th>Description</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Basic Salary</td>
                                <td>Monthly Basic Salary</td>
                                <td class="text-end">$<?php echo $salary; ?></td>
                            </tr>
                            <tr>
                                <td>Allowance</td>
                                <td> Additional benefits</td>
                                <td class="text-end">$<?php echo $allowance; ?></td>
                            </tr>
                            <tr>
                                <td>OT</td>
                                <td> Overtime</td>
                                <td class="text-end">$<?php echo $Ot; ?></td>
                            </tr>
                            <tr>
                                <td>Bonus</td>
                                <td>Performance bonus</td>
                                <td class="text-end">$<?php echo $bonus; ?></td>
                            </tr>
                            <tr>
                                <td>Deduction</td>
                                <td> Total deductions</td>
                                <td class="text-end">$<?php echo $Ded; ?></td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td>Income Tax</td>
                                <td class="text-end">$<?php echo $leavetax; ?></td>
                            </tr>
                            <tr>
                                <td>NSSF</td>
                                <td>Social security contribution</td>
                                <td class="text-end">$<?php echo $NSSF; ?></td>
                            </tr>


                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end">Total Net Pay:</th>
                                <th id="totalNetPay" class="salary-amount">$<?php echo $NetSalary; ?></th>
                            </tr>
                            <a href="exportPDF.php?empCode=<?= $empcode ?>&month=<?= $month ?>" target="_blank" class="btn btn-danger mt-3">
                                <i class="fas fa-file-pdf"></i> Export to PDF
                            </a>
                        </tfoot>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('#viewDetails').click(function() {
            var empCode = $('#employee').val();
            var month = $('#month').val();

            window.location.href = 'paydedail.php?empCode=' + empCode + '&month=' + month;


        })
    })
</script>