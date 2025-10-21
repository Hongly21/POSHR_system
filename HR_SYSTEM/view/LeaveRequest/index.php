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
    <!-- Custom CSS -->
    <link href="../../style/career.css" rel="stylesheet">
    <style>
        .status-pending {
            color: #ffc107;
            font-weight: 600;
        }

        .status-approved {
            color: #28a745;
            font-weight: 600;
        }

        .status-rejected {
            color: #dc3545;
            font-weight: 600;
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
                            <h4 class="mb-0">Leave Request List</h4>
                            <a href="create.php" class="btn btn-primary">
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
                                            
                                                <a href="../../action/LeaveRequest/delete.php?id=<?php echo ($row['ID']); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                        

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
                                            <?php
                                            $statusClass = 'status-' . strtolower($row['Status']);
                                            echo "<span class='{$statusClass}'>" . htmlspecialchars($row['Status']) . "</span>";
                                            ?>
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