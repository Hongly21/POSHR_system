<?php

include("../../Config/conect.php");
include("../../root/Header.php");
?>

<body>
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Deduction List</h4>
                            <a href="create.php" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>New Deduction
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="deductionTable" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Employee Code</th>
                                    <th>Name</th>
                                    <th>Deduction Type</th>
                                    <th>Description</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM prdeduction ORDER BY id DESC";
                                $result = $con->query($sql);
                                while ($row = $result->fetch_assoc()):

                                ?>
                                    <tr>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn btn-primary edit-button"><i class="fas fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger delete-button" onclick="deleteCompany('<?php echo $row['ID']; ?>')"><i class="fas fa-trash"></i></button>
                                        </td>
                                        <td> <?php echo $row['EmpCode']; ?></td>
                                        <td>
                                            <?php
                                            $empcode = $row['EmpCode'];
                                            $sql1 = "SELECT EmpCode, EmpName FROM hrstaffprofile WHERE EmpCode = '$empcode'";
                                            $run1 = $con->query($sql1);
                                            $row1 = $run1->fetch_assoc();
                                            echo $row1['EmpName'];
                                            ?>
                                        </td>
                                        <td><?php echo $row['DeductType']; ?></td>
                                        <td><?php echo $row['Description']; ?></td>
                                        <td><?php echo $row['FromDate']; ?></td>
                                        <td><?php echo $row['ToDate']; ?></td>
                                        <td><?php echo $row['Amount']; ?></td>
                                        <td><?php echo $row['Status']; ?></td>
                                        <td><?php echo $row['Remark']; ?></td>
                                    </tr>
                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {


            // Check for success/error messages
            const urlParams = new URLSearchParams(window.location.search);
            const successMsg = urlParams.get('success');
            const errorMsg = urlParams.get('error');

            if (successMsg) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: decodeURIComponent(successMsg),
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            } else if (errorMsg) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: decodeURIComponent(errorMsg),
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        });
    </script>
</body>

<!-- //delete alert mesaages -->
<script>
    function deleteCompany(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the prDeduction record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/PRDeduction/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The payroll has been removed.',
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
                            text: 'Could not delete PRDeduction.',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>