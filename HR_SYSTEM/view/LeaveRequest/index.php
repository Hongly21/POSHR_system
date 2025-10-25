<?php
include("../../Config/conect.php");
session_start();

// Fetch leave request data
$sql = "SELECT * FROM lmleaverequest  ORDER BY FromDate DESC";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Leave Request List</h4>
                            <a href="create.php" class="btn btn-sm btn-primary me-2">
                                <i class="fas fa-plus me-2"></i>New Leave Request
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="leaveRequestTable" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Leave Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Status</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td class="action-buttons">
                                            <a href="edit.php?id=<?php echo ($row['ID']); ?>"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>


                                            <button class="btn btn-sm btn-danger" onclick="deleteCompanyd('<?php echo $row['ID']; ?>')"><i class="fa fa-trash"></i></button>




                                        </td>
                                        <td><?php echo htmlspecialchars($row['EmpCode']); ?></td>
                                        <td>
                                            <?php $empcode = ($row['EmpCode']);
                                            $slq = "SELECT EmpName FROM hrstaffprofile WHERE EmpCode='$empcode'";
                                            $result1 = $con->query($slq);
                                            $row1 = $result1->fetch_assoc();
                                            echo $row1['EmpName'];
                                            ?></td>
                                        <td><?php echo htmlspecialchars($row['LeaveType']); ?></td>
                                        <td><?php echo date('d M Y', strtotime($row['FromDate'])); ?></td>
                                        <td><?php echo date('d M Y', strtotime($row['ToDate'])); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo $row['Status'] === 'Approved' ? 'success' : ($row['Status'] === 'Rejected' ? 'danger' : 'warning'); ?>"><?php echo $row['Status']; ?></span>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['Reason'] ?? '-'); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>

<!-- //delete alert mesaages -->
<script>
    function deleteCompanyd(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the Leave record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/LeaveRequest/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The Leave request has been removed.',
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
                            text: 'Could not delete the Leave request.',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>