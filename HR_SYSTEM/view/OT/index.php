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

<h3 class="text-center"
    style="margin: 20px 0px;">OT SETTING</h3>
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <?php
    $sql = "SELECT * FROM protrate";
    $result = $con->query($sql);
    ?>
    <table class="table" id="example">
        <thead>
            <tr>
                <th>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaxRateModal">
                        <i style="margin-right: 5px;" class="fa fa-plus"></i> Add
                    </button>
                </th>
                <th>Code</th>
                <th>Description </th>
                <th>Rate</th>

            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateTaxRateModal" class="btn btn-primary editButton"
                            data-code="<?php echo $row['Code']; ?>"
                            data-des="<?php echo $row['Des']; ?>"
                            data-rate="<?php echo $row['Rate']; ?>">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" onclick="deletetax('<?php echo $row['Code']; ?>')"><i class="fa fa-trash"></i></button>
                    </td>
                    <td><?php echo $row['Code']; ?></td>
                    <td><?php echo $row['Des']; ?></td>
                    <td><?php echo $row['Rate']; ?></td>
                </tr>

            <?php
            } ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addTaxRateModal" tabindex="-1" aria-labelledby="addTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Add New OTSetting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <form id="addTaxRateForm">
                    <div class="mb-3">
                        <label for="amountFrom" class="form-label">Amount From</label>
                        <input type="number" class="form-control" id="amountFrom" name="amountFrom" required>
                    </div>
                    <div class="mb-3">
                        <label for="amountTo" class="form-label">Amount To</label>
                        <input type="number" class="form-control" id="amountTo" name="amountTo" required>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Rate (%)</label>
                        <input type="number" class="form-control" id="rate" name="rate" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form> -->
                <form id="addTaxRateForm">
                    <div class="mb-3">
                        <label for="amountFrom" class="form-label">Code</label>
                        <input type="text" class="form-control" id="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Rate</label>
                        <input type="number" class="form-control" id="rate" name="rate" required>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveOT">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Updata Modal -->
<div class="modal fade" id="updateTaxRateModal" tabindex="-1" aria-labelledby="addTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Edit Tax Rate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addTaxRateForm">
                    <div class="mb-3">
                        <label for="amountFrom" class="form-label">Code</label>
                        <input type="text" class="form-control" id="codeupdate" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="descriptionupdate" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="rate" class="form-label">Rate</label>
                        <input type="number" class="form-control" id="rateupdate" name="rate" required>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateTax">Update</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#saveOT').click(function() {
            var code = $('#code').val();
            var description = $('#description').val();
            var rate = $('#rate').val();
            $.ajax({
                url: '../../action/OT/action.php',
                method: 'POST',
                data: {
                    action: 'add',
                    code: code,
                    description: description,
                    rate: rate
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'OT added successfully.',
                        confirmButtonColor: '#3085d6',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    })
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add OT.',
                        footer: error
                    });
                }
            })
        })
        $('.editButton').click(function() {
            code = $(this).data('code');
            des = $(this).data('des');
            rate = $(this).data('rate');
            $('#codeupdate').val(code);
            $('#descriptionupdate').val(des);
            $('#rateupdate').val(rate);

        })
        $('#updateTax').click(function() {
            var code = $('#codeupdate').val();
            var des= $('#descriptionupdate').val();
            var rate = $('#rateupdate').val();
            $.ajax({
                url: '../../action/OT/action.php',
                method: 'POST',
                data: {
                    action: 'update',
                    code: code,
                    des: des,
                    rate: rate
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'OT updated successfully.',
                        confirmButtonColor: '#3085d6',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Refresh the page
                    })
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to update OT.',
                        footer: error
                    });
                }
            })
        })



    })
</script>

<!-- //delete alert mesaages -->
<script>
    function deletetax(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the OT record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/OT/action.php',
                    method: 'GET',
                    data: {
                        action: 'delete',
                        code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The OTsettinng has been removed.',
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
                            text: 'Could not delete the OTsetting .',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>