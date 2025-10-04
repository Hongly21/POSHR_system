<?php
include('../../Config/conect.php');
include('../../root/Header.php');

?>

<body>
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Bouns List</h4>
                            <a href="create.php" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>New Bouns
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="allowanceTable" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Employee Code</th>
                                    <th>EmpName</th>
                                    <th>Bonus Type</th>
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
                                $sql = "SELECT * FROM prbonus";
                                $run = $con->query($sql);
                                while ($row = $run->fetch_array()) {
                                ?>
                                    <tr>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['ID']; ?>" class="btn btn-sm btn-warning me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" onclick="deleteCompanyc('<?php echo $row['ID']; ?>')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        <td><?php echo $row['EmpCode']; ?></td>
                                        <td><?php $code = $row['EmpCode'];
                                            $empsql = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$code'";
                                            $emprun = $con->query($empsql);
                                            $emprow = $emprun->fetch_assoc();
                                            echo $emprow['EmpName'];
                                            ?></td>
                                        <td><?php echo $row['BonusType']; ?></td>
                                        <td><?php echo $row['Description']; ?></td>
                                        <td><?php echo $row['FromDate']; ?></td>
                                        <td><?php echo $row['ToDate']; ?></td>
                                        <td><?php echo $row['Amount']; ?></td>
                                        <td><?php echo $row['Status']; ?></td>
                                        <td><?php echo $row['Remark']; ?></td>

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
        function deleteCompanyc(code) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete the Bonus record.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '../../action/PRBouns/delete.php',
                        method: 'GET',
                        data: {
                            Code: code
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The bonus has been removed.',
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
                                text: 'Could not delete the bonus.',
                                footer: error
                            });
                        }
                    });
                }
            });
        }
    </script>
</body>