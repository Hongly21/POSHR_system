<?php
include("../../../root/Header.php");
include("../../../Config/conect.php");
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
                                $sql1 = "SELECT Remark,EmployeeID,Department,PositionTitle,CareerHistoryType,StartDate FROM CareerHistory WHERE CareerHistoryType = '$status'OR Department = '$department' AND StartDate BETWEEN '$startDate' AND '$endDate'";
                                $run1 = $con->query($sql1);
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


<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                    <h3>Career History</h3>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="overflow-x: hidden; overflow-y: hidden; padding: 10px; box-sizing: border-box;" >
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