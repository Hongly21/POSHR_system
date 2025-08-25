<?php include_once('../../root/Header.php');
include '../../root/DataTable.php';
include '../../Config/conect.php';
?>
<style>
    .modal-container {
        background-color: #f9f9f9;
        padding: 25px 30px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        max-width: 500px;
        margin: auto;
    }

    .modal-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .modal-container label {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
    }

    .modal-container input[type="text"],
    .modal-container select {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .modal-container input[type="text"]:focus,
    .modal-container select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    .modal-container select {
        background-color: #fff;
        cursor: pointer;
    }

    .modal-container button {
        padding: 10px 15px;
        border: none;
        border-radius: 6px;
        background-color: #007bff;
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .modal-container button:hover {
        background-color: #0056b3;
    }
</style>
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <?php
    $sql = "SELECT * FROM lmleavetype";
    $result = $con->query($sql);
    ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLeaveTypeModal">
                        <i style="margin-right: 5px;" class="fa fa-plus"></i> Add
                    </button>
                </th>
                <th>Leave Code</th>
                <th>Leave Type </th>
                <th>Is Probation</th>
                <th>Is Deduction</th>
                <th>Is OverBalance</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateLeaveTypeModal" class="btn btn-primary editButton"
                            data-code="<?php echo $row['Code']; ?>"
                            data-leaveType="<?php echo $row['LeaveType']; ?>"
                            data-isprobation="<?php echo $row['IsProbation']; ?>"
                            data-isdeduction="<?php echo $row['IsDeduct']; ?>"
                            data-isoverbalance="<?php echo $row['IsOverBalance']; ?>">

                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deleteLeaveType('<?php echo $row['Code']; ?>')"><i class="fa fa-trash"></i></button>
                    </td>
                    <td><?php echo $row['Code']; ?></td>
                    <td><?php echo $row['LeaveType']; ?></td>
                    <td>
                        <center>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" <?php echo $row['IsProbation'] == 1 ? 'checked' : ''; ?> disabled>
                            </div>
                        </center>
                    </td>
                    <td>
                        <center>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" <?php echo $row['IsDeduct'] == 1 ? 'checked' : ''; ?> disabled>
                            </div>
                        </center>
                    </td>
                    <td>
                        <center>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" <?php echo $row['IsOverBalance'] == 1 ? 'checked' : ''; ?> disabled>
                            </div>
                        </center>
                    </td>
                </tr>

            <?php
            } ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addLeaveTypeModal" tabindex="-1" aria-labelledby="addLeaveTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Add New Leave Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLeaveTypeForm">
                    <div class="mb-3">
                        <label for="code" class="form-label">Leave Code</label>
                        <input type="text" class="form-control" id="LeaveCode" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Leave Type</label>
                        <input type="text" class="form-control" id="LeaveType" required>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsProbation">
                            <label class="form-check-label" for="IsProbation">Is Probation</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsDeduction">
                            <label class="form-check-label" for="IsDeduction">Is Deduction</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsOverBalance">
                            <label class="form-check-label" for="IsOverBalance">Is OverBalance</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveLeaveType">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Updata Modal -->
<div class="modal fade" id="updateLeaveTypeModal" tabindex="-1" aria-labelledby="addLeaveTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Edit Leave Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLeaveTypeForm">
                    <div class="mb-3">
                        <label for="code" class="form-label">Leave Code</label>
                        <input type="text" class="form-control" id="LeaveCodeUpdate" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Leave Type</label>
                        <input type="text" class="form-control" id="LeaveTypeUpdate" required>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsProbationUpdate">
                            <label class="form-check-label" for="IsProbationUpdate">Is Probation</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsDeductionUpdate">
                            <label class="form-check-label" for="IsDeductionUpdate">Is Deduction</label>
                        </div>
                    </div>
                    <div class="mb-3 form-switch-custom">
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="IsOverBalanceUpdate">
                            <label class="form-check-label" for="IsOverBalance">Is OverBalance</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateLeaveType">Update</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#saveLeaveType').click(function() {
            var code = $("#LeaveCode").val();
            var leavetype = $('#LeaveType').val();

            var isprobation = $('#IsProbation').prop('checked') ? 1 : 0;
            var isdeduction = $('#IsDeduction').prop('checked') ? 1 : 0;
            var isoverbalance = $('#IsOverBalance').prop('checked') ? 1 : 0;

            $.ajax({
                url: '../../action/LeavePolicy/add.php',
                method: 'Post',
                data: {
                    action: 'addLeaveType',
                    code: code,
                    leavetype: leavetype,
                    isprobation: isprobation,
                    isdeduction: isdeduction,
                    isoverbalance: isoverbalance
                },
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Add Successfully',
                        text: 'Add Leave Type Successfully'
                    }).then(function() {
                        location.reload();
                    })

                }
            })



        })

        $('.editButton').click(function() {
            var code = $(this).data('code');
            var leavetype = $(this).data('leavetype');
            var isprobation = $(this).data('isprobation');
            var isdeduction = $(this).data('isdeduction');
            var isoverbalance = $(this).data('isoverbalance');

            // set value to modal update
            $('#LeaveCodeUpdate').val(code);
            $('#LeaveTypeUpdate').val(leavetype);
            $('#IsProbationUpdate').prop('checked', isprobation == 1); // set checked
            $('#IsDeductionUpdate').prop('checked', isdeduction == 1); // set checked
            $('#IsOverBalanceUpdate').prop('checked', isoverbalance == 1); // set checked
        })

        $('#updateLeaveType').click(function() {
            var code = $('#LeaveCodeUpdate').val();
            var leavetype = $('#LeaveTypeUpdate').val();

            var isprobation = $('#IsProbationUpdate').prop('checked') ? 1 : 0;
            var isdeduction = $('#IsDeductionUpdate').prop('checked') ? 1 : 0;
            var isoverbalance = $('#IsOverBalanceUpdate').prop('checked') ? 1 : 0;


            $.ajax({
                url: '../../action/LeavePolicy/update.php',
                method: 'POST',
                data: {
                    action: 'updateLeaveType',
                    code: code,
                    leavetype: leavetype,
                    isprobation: isprobation,
                    isdeduction: isdeduction,
                    isoverbalance: isoverbalance
                },
                success: function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Update Successfully',
                        text: 'Update LeaveType Successfully'
                    }).then(function() {
                        location.reload(); //  Refresh the page

                    })
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            })
        })



    })
</script>

<!-- //delete alert mesaages -->
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
                    url: '../../action/LeavePolicy/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The Leave Type has been removed.',
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
                            text: 'Could not delete the leave type .',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>