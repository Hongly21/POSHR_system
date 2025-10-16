<?php
session_start();
include("../../../root/Header.php");
include("../../../Config/conect.php");

?>
<link href="../../../Style/career.css" rel="stylesheet">

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
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        width: 100%;
        margin-bottom: 1rem;
    }

    .table {
        border: 1px solid var(--border-color);
        background: white;
        margin-bottom: 0;
        width: 100%;
    }

    .detail-body {
        padding: 1.5rem;
    }

    /* DataTables Styling */
    .dataTables_wrapper {
        position: relative;
    }

    .dataTables_scroll {
        margin-bottom: 0;
    }

    .dataTables_scrollBody {
        min-height: 200px;
    }

    .dataTables_scrollFoot {
        position: sticky;
        bottom: 0;
        z-index: 2;
        background: white;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Ensure buttons stay above scroll */
    .dt-buttons {
        position: sticky;
        left: 0;
        z-index: 1;
    }

    /* Fix pagination alignment */
    .dataTables_paginate {
        margin-top: 1rem !important;
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
        padding: 0.5rem 1rem;
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
        padding: 0.5rem 1rem;
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
                <i class="fas fa-users"></i>
                Employee Family Report
            </h5>
        </div>
        <div class="card-body">
            <!-- Employee Family Report Section -->
            <div class="detail-card mt-4">
                <div class="detail-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Employee Family Details</h6>
                </div>
                <div class="detail-body">
                    <div class="row g-4 mb-5">
                        <div class="col-md-3">
                            <label for="empcode" class="form-label">EmpCode:</label>
                            <select class="form-select" name="empcode" id="empcode">
                                <option value="">Select EmpCode</option>
                                <?php
                                $sql = "SELECT * FROM hrstaffprofile";
                                $run = $con->query($sql);
                                while ($row = $run->fetch_assoc()) {
                                    echo '<option value="' . $row['EmpCode'] . '">' . $row['EmpCode'] . "-" . $row['EmpName'] .  '</option>';
                                }

                                ?>
                            </select>
                        </div>
                        <!-- <div class="col-md-3">
                            <label for="department" class="form-label">Department:</label>
                            <input type="text" id="department" class="form-control" placeholder="Enter department">
                        </div>
                        <div class="col-md-3">
                            <label for="relationshipType" class="form-label">Employee Name:</label>
                            <input type="text" id="employeeName" class="form-control" placeholder="Enter employee name">
                        </div> -->
                        <!-- btn search btn -->
                        <div>
                            <button class="btn btn-primary" id="searchBtn">Search</button>
                            <button class="btn btn-secondary" id="resetBtn">Reset</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="familyTable" class="table table-bordered table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Employee Code</th>
                                    <th>Employee Name</th>
                                    <th>Family Member</th>
                                    <th>Relationship</th>
                                    <th>Gender</th>
                                    <th>Tax Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['empcode'])) {
                                    $empcode = $_GET['empcode'];
                                    $sql = "SELECT * FROM hrfamily WHERE EmpCode = '$empcode'";
                                    $run = $con->query($sql);
                                    while ($row = $run->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['EmpCode']; ?></td>
                                            <td><?php
                                                $empName = $row['EmpCode'];
                                                $sql1 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empName'";
                                                $run1 = $con->query($sql1);
                                                $row1 = $run1->fetch_assoc();
                                                echo $row1['EmpName'];

                                                ?></td>
                                            <td><?php echo $row['RelationName']; ?></td>
                                            <td><?php echo $row['RelationType']; ?></td>
                                            <td><?php echo $row['Gender']; ?></td>
                                            <td>
                                                <?php
                                                if ($row['IsTax'] == 1) {
                                                    echo "<i class='fas fa-check text-success'></i>";
                                                } else {
                                                    echo "<i class='fas fa-times text-danger'></i>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="view.php?empcode=<?php echo $row['EmpCode']; ?>&familymember=<?php echo $row['FamilyMember']; ?>" class="btn btn-primary">View</a>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                } else {
                                    $sql3 = "SELECT * FROM hrfamily";
                                    $run3 = $con->query($sql3);
                                    while ($row3 = $run3->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row3['EmpCode']; ?></td>
                                            <td><?php
                                                $empName = $row3['EmpCode'];
                                                $sql1 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empName'";
                                                $run1 = $con->query($sql1);
                                                $row1 = $run1->fetch_assoc();
                                                echo $row1['EmpName'];

                                                ?></td>
                                            <td><?php echo $row3['RelationName']; ?></td>
                                            <td><?php echo $row3['RelationType']; ?></td>
                                            <td><?php echo $row3['Gender']; ?></td>
                                            <td>
                                                <?php
                                                if ($row3['IsTax'] == 1) {
                                                    echo "<i class='fas fa-check text-success'></i>";
                                                } else {
                                                    echo "<i class='fas fa-times text-danger'></i>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary viewDetail"
                                                    data-id="<?php echo $row3['EmpCode'] ?>" ;
                                                    data-empname="<?php

                                                                    $empname = $row3['EmpCode'];
                                                                    $sql4 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empname'";
                                                                    $run4 = $con->query($sql4);
                                                                    $row4 = $run4->fetch_assoc();
                                                                    echo $row4['EmpName'];
                                                                    ?>" ;
                                                    data-familymember="<?php echo $row3['RelationName'] ?>" ;
                                                    data-relationship="<?php echo $row3['RelationType'] ?>" ;
                                                    data-gender="<?php echo $row3['Gender'] ?>" ;
                                                    data-taxstatus="<?php echo $row3['IsTax'] ?>" ;

                                                    data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                            </td>
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


<!-- view Detail modal -->


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                    <h3>Family History</h3>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-x: hidden; overflow-y: hidden; padding: 10px; box-sizing: border-box;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>Employee Name</th>
                            <th>Family Member</th>
                            <th>Relationship</th>
                            <th>Gender</th>
                            <th>Tax Status</th>
                        </tr>
                    </thead>

                    <tbody id="detailTable">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // if select form is selected set value on department and employee name

        $("#searchBtn").click(function() {
            var empcode = $("#empcode").val();
            window.location.href = "index.php?empcode=" + empcode;

        })

        $("#resetBtn").click(function() {
            window.location.href = "index.php";
        })

        $(".viewDetail").click(function() {
            var empCode = $(this).data('id');
            var empName = $(this).data('empname');
            var familyMember = $(this).data('familymember');
            var relationship = $(this).data('relationship');
            var gender = $(this).data('gender');
            var taxStatus = $(this).data('taxstatus');
            var html = '';
            html += '<tr>';
            html += '<td>' + empCode + '</td>';
            html += '<td>' + empName + '</td>';
            html += '<td>' + familyMember + '</td>';
            html += '<td>' + relationship + '</td>';
            html += '<td>' + gender + '</td>';
            html += '<td>' + taxStatus + '</td>';
            html += '</tr>';
            $("#detailTable").html(html);
        })

    });
</script>