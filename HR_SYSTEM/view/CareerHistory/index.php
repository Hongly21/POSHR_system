<?php
include('../../Config/conect.php');
include('../../root/Header.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career History</title>

    <link href="../../style/career.css" rel="stylesheet">

    <style>
        .dropdown-menu {
            min-width: 120px;
        }

        .dropdown-item {
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dropdown-item i {
            width: 16px;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Career History List</h4>
                            <div class="d-flex gap-2">
                                <a href="create.php" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create New
                                </a>
                                <!-- export -->
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Export
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="../../action/CareerHistory/export_excel.php">
                                                <i class="far fa-file-excel text-success"></i>
                                                Export Excel
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="../../action/CareerHistory/export_pdf.php">
                                                <i class="far fa-file-pdf text-danger"></i>
                                                Export PDF
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="careerHistoryTable" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Career</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Effective Date</th>
                                    <th>Resignation Date</th>
                                    <th>Remark</th>
                                    <th>Increase</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $sql = "SELECT * FROM careerhistory";
                                $sql = "SELECT  P.Description AS PositionDes,
                                        D.Description AS Dept, ch.*, sp.EmpName 
                                        FROM careerhistory ch 
                                        INNER JOIN hrstaffprofile sp ON ch.EmployeeID = sp.EmpCode 
                                        INNER join hrposition P On P.Code=ch.PositionTitle
                                        INNER join hrdepartment D On D.code = Ch.Department 
                                        ORDER BY ch.CreatedAt DESC";
                                $run = $con->query($sql);
                                while ($row = $run->fetch_array()) {
                                ?>
                                    <tr>
                                        <td>
                                            <a href="edit.php? empid=<?php echo $row['EmployeeID']; ?>"> <button class="btn btn-primary"> <i class="far fa-edit"></i></button>
                                            </a>
                                            <button class="btn btn-danger" onclick="deleteLeaveType('<?php echo $row['EmployeeID']; ?>')"><i class="far fa-trash-alt"></i></button>

                                        </td>
                                        <td><?php echo $row['CareerHistoryType']; ?></td>
                                        <td><?php echo $row['EmployeeID']; ?></td>
                                        <td>
                                            <?php
                                            $empID = $row['EmployeeID'];
                                            $empSql = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode = '$empID'";
                                            $empRun = $con->query($empSql);
                                            if ($empRow = $empRun->fetch_array()) {
                                                echo $empRow['EmpName'];
                                            } else {
                                                echo 'N/A';
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $row['PositionDes']; ?></td>
                                        <td><?php echo $row['Dept']; ?></td>
                                        <td><?php echo $row['StartDate']; ?></td>
                                        <td><?php echo $row['EndDate']; ?></td>
                                        <td><?php echo $row['Remark']; ?></td>
                                        <td><?php echo $row['Increase']; ?></td>
                                    </tr>

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


    <script>
        function deleteLeaveType(code) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete the Leave Type record.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../../action/CareerHistory/delete.php',
                        method: 'GET',
                        data: {
                            Code: code
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Career History record has been deleted.',
                                confirmButtonColor: '#3085d6',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); // 🔄 Refresh the page
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Delete Failed',
                                text: 'Could not delete .',
                                footer: error
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>