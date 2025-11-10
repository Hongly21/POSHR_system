<?php

include("../../../Config/conect.php");
include('../../../root/Header.php');

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

<h2 style="text-align: center; margin-top: 15px; text-transform: uppercase;">Employee Family</h2>
<div class="container-fluid mt-3" style="max-width: 1200px;">
    <div class="card">
        <div class="card-header">
            <h5 class="card-header-title">
                <i class="fas fa-history"></i>
                Employee Family Report
            </h5>
        </div>
        <div class="card-body">
            <div class="filter-section">
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

                    <div>
                        <button class="btn btn-primary" id="searchBtn">Search</button>
                        <button class="btn btn-secondary" id="resetBtn">Reset</button>
                    </div>
                </div>
            </div>
            <div class="detail-body">

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

                                $slq5 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                $run5 = $con->query($slq5);
                                $result5 = $run5->fetch_assoc();
                                $EmpName = $result5['EmpName'];

                                if ($run->num_rows > 0) {

                                    echo "
                                        <script>
                                               Swal.fire({
                                               icon: 'success',
                                               title: 'Family Members',
                                               text: 'Family Members Of $EmpName',
                                               })
                                            
                                    </script>
                                        ";
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
                                                <button class="btn btn-primary viewDetail"
                                                    data-id="<?php echo $row['EmpCode'] ?>" ;
                                                    data-empname="<?php

                                                                    $empname = $row['EmpCode'];
                                                                    $sql4 = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empname'";
                                                                    $run4 = $con->query($sql4);
                                                                    $row4 = $run4->fetch_assoc();
                                                                    echo $row4['EmpName'];
                                                                    ?>" ;
                                                    data-familymember="<?php echo $row['RelationName'] ?>" ;
                                                    data-relationship="<?php echo $row['RelationType'] ?>" ;
                                                    data-gender="<?php echo $row['Gender'] ?>" ;
                                                    data-taxstatus="<?php echo $row['IsTax'] ?>" ;

                                                    data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                                    <i class="fas fa-eye"></i>
                                                </button>

                                            </td>
                                        </tr>

                                    <?php
                                    }
                                } else {
                                    echo "
                                        <script>
                                        // no members of employee family
                                               Swal.fire({
                                               icon: 'info',
                                               title: 'No Members',
                                               text: 'No Members Of $EmpName Family',
                                               })
                                        </script>
                                        ";
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

<div class="modal fade " id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class=" modal-dialog modal-dialog-centered" style=" max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">
                    <h3>Family History</h3>
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
            html += '<td>';

            if (taxStatus == 1) {
                html += '<i class="fas fa-check text-success"></i>';
            } else {
                html += '<i class="fas fa-times text-danger"></i>';
            }

            html += '</td>';
            html += '</tr>';

            $("#detailTable").html(html);
        });

    });
</script>