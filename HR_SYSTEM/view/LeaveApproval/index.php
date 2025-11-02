<?php
include("../../Config/conect.php");
include '../../root/Header.php';


// Fetch leave request data
$sql = "SELECT * FROM lmleaverequest WHERE Status = 'Pending' ORDER BY FromDate DESC";
$result = $con->query($sql);
?>


<body>
    <div class="container-fluid mt-4 mb-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Leave List Employee </h4>
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
                                            <button class="btn btn-sm btn-success me-2 btnapprove"
                                                data-id="<?php echo $row['ID']; ?>">Approved <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger btnreject"
                                                data-id="<?php echo $row['ID'] ?>">Reject <i class="fas fa-times"></i>
                                            </button>

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


</body>

</html>
<script>
    $(document).ready(function() {
        $('.btnapprove').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '../../action/LeaveApproval/approve.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'You have approve successfully',

                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response
                    })
                }
            })

        });


        $('.btnreject').click(function() {
            var id = $(this).data('id');
            $.ajax({
                url: '../../action/LeaveApproval/reject.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'You have reject successfully',

                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response
                    })
                }
            })
        });



    })
</script>