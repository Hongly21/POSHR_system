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

<h2 style="text-align: center; margin-top: 15px; text-transform: uppercase;">Employee InOut Report</h2>
<div class="container-fluid mt-3" style="max-width: 1200px;">
    <div class="card">
        <div class="card-header">
            <h5 class="card-header-title">
                <i class="fas fa-history"></i>
                Employee InOut Report
            </h5>
        </div>
        <div class="card-body">
            <div class="filter-section">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="startDate" class="form-label">Start Date:</label>
                        <input type="date" id="startDate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="endDate" class="form-label">End Date:</label>
                        <input type="date" id="endDate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status:</label>
                        <select id="status" class="form-select">
                            <option value="all">All</option>
                            <option value="NEW">New Join</option>
                            <option value="PROMOTE">Promote</option>
                            <option value="TRANSFER">Transfer</option>
                            <option value="RESIGN">Resign</option>
                            <option value="INCREASE">Increase Salary</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="department" class="form-label">Department:</label>
                        <select id="department" class="form-select">
                            <option value="all">All Departments</option>
                            <?php
                            $sql = "SELECT * FROM hrdepartment";
                            $result = $con->query($sql);
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <option value="<?php echo $row['Code']; ?>"><?php echo $row['Description']; ?></option>
                            <?php
                                }
                            }

                            ?>
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button id="viewReport" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Generate Report
                        </button>
                        <button id="resetFilters" class="btn btn-secondary ms-2"><i class="fas fa-undo me-2"></i>Reset Filters</button></button>
                    </div>
                </div>
            </div>
            <!-- Report Table Section -->
            <div class="detail-card mt-4">
                <div class="detail-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Employee Movement Report</h6>
                </div>
                <div class="detail-body">
                    <table id="employeeTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Employee Code</th>
                                <th>Employee Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_GET['startDate']) && isset($_GET['endDate']) && isset($_GET['status']) && isset($_GET['department'])) {
                                $startDate = $_GET['startDate'];
                                $endDate = $_GET['endDate'];
                                $status = $_GET['status'];
                                $department = $_GET['department'];
                                $sql1 = "SELECT Remark,EmployeeID,Department,PositionTitle,CareerHistoryType,StartDate FROM CareerHistory 
                                WHERE CareerHistoryType = '$status'AND Department = '$department' AND StartDate BETWEEN '$startDate' AND '$endDate'";
                                $run1 = $con->query($sql1);
                                if ($run1->num_rows > 0) {
                                    echo "
                                    <script>
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'Report on " . $startDate . " to " . $endDate . " Generated Successfully',
                                            icon: 'success',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        })
                                    </script>
                                    ";
                                    while ($row = $run1->fetch_assoc()) {
                            ?>
                                        <tr>
                                            <td><?php echo $row['EmployeeID']; ?>
                                            <td><?php $empcode = $row['EmployeeID'];
                                                $sql2 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                                $run2 = $con->query($sql2);
                                                $row2 = $run2->fetch_assoc();
                                                echo $row2['EmpName']; ?></td>
                                            <td><?php $department = $row['Department'];
                                                $sql3 = "SELECT Description FROM hrdepartment WHERE Code='$department'";
                                                $run3 = $con->query($sql3);
                                                $row3 = $run3->fetch_assoc();
                                                echo $row3['Description'];
                                                ?>

                                            </td>
                                            <td><?php $position = $row['PositionTitle'];
                                                $sql4 = "SELECT Description FROM hrposition WHERE Code='$position'";
                                                $run4 = $con->query($sql4);
                                                $row4 = $run4->fetch_assoc();
                                                echo $row4['Description'];
                                                ?></td>
                                            <td><?php echo $row['CareerHistoryType']; ?></td>
                                            <td><?php echo $row['StartDate']; ?></td>
                                            <td>
                                                <button class="btn btn-primary viewDetail" data-id="<?php echo $row['EmployeeID'] ?>" ;
                                                    data-startdate="<?php echo $row['StartDate'] ?>" ;
                                                    data-enddate="<?php echo $row['Remark'] ?>" ;
                                                    data-department="<?php
                                                                        $departmentcode = $row['Department'];
                                                                        $sql5 = "SELECT Description FROM hrdepartment WHERE Code='$departmentcode'";
                                                                        $run5 = $con->query($sql5);
                                                                        $row5 = $run5->fetch_assoc();
                                                                        echo $row5['Description'];
                                                                        ?>" ;
                                                    data-position="<?php $position = $row['PositionTitle'];
                                                                    $sql6 = "SELECT Description FROM hrposition WHERE Code='$position'";
                                                                    $run6 = $con->query($sql6);
                                                                    $row6 = $run6->fetch_assoc();
                                                                    echo $row6['Description'];
                                                                    ?>" ;
                                                    data-status="<?php echo $row['CareerHistoryType'] ?>" ;

                                                    data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>


                                        </tr>

                                <?php
                                    }
                                } elseif ($run1->num_rows == 0) {
                                    echo "
                                    <script>
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'No Record Found',
                                            icon: 'error',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        })
                                    </script>
                                    ";
                                }
                            } else {
                                ?>
                        <tbody>

                            <?php
                                $sql = "SELECT * FROM CareerHistory";
                                $run = $con->query($sql);
                                while ($row = $run->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row['EmployeeID']; ?>
                                    <td><?php $empcode = $row['EmployeeID'];
                                        $sql4 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                        $run4 = $con->query($sql4);
                                        $row4 = $run4->fetch_assoc();
                                        echo $row4['EmpName'];
                                        ?></td>
                                    <td><?php $department = $row['Department'];
                                        $sql3 = "SELECT Description FROM hrdepartment WHERE Code='$department'";
                                        $run3 = $con->query($sql3);
                                        $row3 = $run3->fetch_assoc();
                                        echo $row3['Description'];
                                        ?></td>
                                    <td><?php $position = $row['PositionTitle'];
                                        $sql5 = "SELECT Description FROM hrposition WHERE Code='$position'";
                                        $run5 = $con->query($sql5);
                                        $row5 = $run5->fetch_assoc();
                                        echo $row5['Description'];
                                        ?></td>
                                    <td><?php echo $row['CareerHistoryType']; ?></td>
                                    <td><?php echo $row['StartDate']; ?></td>
                                    <td>
                                        <button class="btn btn-primary viewDetail" data-id="<?php echo $row['EmployeeID'] ?>" ;
                                            data-startdate="<?php echo $row['StartDate'] ?>" ;
                                            data-enddate="<?php echo $row['Remark'] ?>" ;
                                            data-department="<?php
                                                                $departmentcode = $row['Department'];
                                                                $sql5 = "SELECT Description FROM hrdepartment WHERE Code='$departmentcode'";
                                                                $run5 = $con->query($sql5);
                                                                $row5 = $run5->fetch_assoc();
                                                                echo $row5['Description'];
                                                                ?>" ;
                                            data-position="<?php $position = $row['PositionTitle'];
                                                            $sql6 = "SELECT Description FROM hrposition WHERE Code='$position'";
                                                            $run6 = $con->query($sql6);
                                                            $row6 = $run6->fetch_assoc();
                                                            echo $row6['Description'];
                                                            ?>" ;
                                            data-status="<?php echo $row['CareerHistoryType'] ?>" ;

                                            data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>


                                </tr>

                            <?php
                                }

                            ?>
                        </tbody>
                    <?php
                            }
                    ?>
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 
view Detail modal  -->


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style=" max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                    <h3>Career History</h3>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-x: hidden; overflow-y: hidden; padding: 10px; box-sizing: border-box;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Remarks</th>
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
        $('#viewReport').on('click', function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            var status = $('#status').val();
            var department = $('#department').val();
            window.location.href = 'index.php?startDate=' + startDate + '&endDate=' + endDate + '&status=' + status + '&department=' + department;


        })
        $('#resetFilters').on('click', function() {
            window.location.href = 'index.php';
        })

        $(".viewDetail").click(function() {
            var empCode = $(this).data('id');
            var startDate = $(this).data('startdate');
            var endDate = $(this).data('enddate');
            var department = $(this).data('department');
            var position = $(this).data('position');
            var status = $(this).data('status');

            var html = '';
            html += '<tr>';
            html += '<td>' + startDate + '</td>';
            html += '<td>' + department + '</td>';
            html += '<td>' + position + '</td>';
            html += '<td>' + status + '</td>';
            html += '<td>' + endDate + '</td>';
            html += '</tr>';
            $('#detailTable').html(html);
        })
    })
</script>