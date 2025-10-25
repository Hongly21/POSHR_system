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
<script>
    $(document).ready(function() {
        $('#example1').DataTable();
    });
</script>
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <?php
    $sql = "SELECT * FROM public_holidays";
    $result = $con->query($sql);
    ?>
    <table class="table" id="example1">
        <thead>
            <tr>
                <th>
                    <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#addHolidayModalLabel">
                        <i style="margin-right: 5px;" class="fa fa-plus"></i> Add New
                    </button>
                </th>
                <th>ID</th>
                <th>HolidayName</th>
                <th>Description</th>
                <th>HolidayDate</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#UpdateHolidayModalLabel" class="btn btn-sm btn-warning me-2 editButton"
                            data-id="<?php echo $row['id']; ?>"
                            data-holiday_name="<?php echo $row['holiday_name']; ?>"
                            data-description="<?php echo $row['description']; ?>"
                            data-holiday_date="<?php echo $row['holiday_date']; ?>">

                            <i class="fa fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger me-2" onclick="deleteHoliday('<?php echo $row['id']; ?>')"><i class="fa fa-trash"></i></button>
                    </td>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['holiday_name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['holiday_date']; ?></td>
                </tr>

            <?php
            } ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addHolidayModalLabel" tabindex="-1" aria-labelledby="addHolidayModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Add New HolidayDay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLeaveTypeForm">
                    <div class="mb-3">
                        <label for="holidayName" class="form-label">Holiday Name</label>
                        <input type="text" class="form-control" id="holidayName" name="holidayName" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="holidayDate" class="form-label">Holiday Date</label>
                        <input type="date" class="form-control" id="holidayDate" name="holidayDate" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveHoliday">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Updata Modal -->
<div class="modal fade" id="UpdateHolidayModalLabel" tabindex="-1" aria-labelledby="UpdateHolidayModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLeaveTypeModalLabel">Edit HolidayDay</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addLeaveTypeForm">
                    <div class="mb-3">
                        <input type="hidden" id="Updateholidayid" name="holidayId">
                        <label for="holidayName" class="form-label">Holiday Name</label>
                        <input type="text" class="form-control" id="UpdateholidayName" name="holidayName" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="Updatedescription" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="holidayDate" class="form-label">Holiday Date</label>
                        <input type="date" class="form-control" id="UpdateholidayDate" name="holidayDate" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="Updateholiday">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- for active on tab page -->
<script>
    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        tab.addEventListener('shown.bs.tab', function(event) {
            localStorage.setItem('activeTab', event.target.getAttribute('data-bs-target'));
        });
    });

    window.addEventListener('DOMContentLoaded', () => {
        const activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            const triggerEl = document.querySelector(`[data-bs-target="${activeTab}"]`);
            if (triggerEl) {
                const tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#saveHoliday').click(function() {
            var holidayName = $('#holidayName').val();
            var description = $('#description').val();
            var holidayDate = $('#holidayDate').val();

            $.ajax({
                url: '../../action/PublicHoliday/add.php',
                type: 'POST',
                data: {
                    action: 'btnsave',
                    holidayName: holidayName,
                    description: description,
                    holidayDate: holidayDate
                },
                success: function(response) {
                    if (response == "Success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Add Successfully',
                            text: 'Add Leave Type Successfully'
                        }).then(function() {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response
                        })
                    }
                }
                // success: function() {
                //     Swal.fire({
                //         icon: 'success',
                //         title: 'Add Successfully',
                //         text: 'Add Leave Type Successfully'
                //     }).then(function() {
                //         location.reload();
                //     })

                // }
            })
        })

        $('.editButton').click(function() {
            var id = $(this).data('id');
            var holidayName = $(this).data('holiday_name');
            var description = $(this).data('description');
            var holidayDate = $(this).data('holiday_date');
            //set value to modal
            $('#Updateholidayid').val(id);
            $('#UpdateholidayName').val(holidayName);
            $('#Updatedescription').val(description);
            $('#UpdateholidayDate').val(holidayDate);


        })
        $('#Updateholiday').click(function() {
            var id = $('#Updateholidayid').val();
            var holidayName = $('#UpdateholidayName').val();
            var description = $('#Updatedescription').val();
            var holidayDate = $('#UpdateholidayDate').val();

            $.ajax({
                url: '../../action/PublicHoliday/update.php',
                type: 'GET',
                data: {
                    action: 'btnupdate',
                    id: id,
                    holidayName: holidayName,
                    description: description,
                    holidayDate: holidayDate
                },
                success: function(response) {
                    if (response == "Success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Update Successfully',
                            text: 'Update Public_Holiday Successfully'
                        }).then(function() {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response
                        })
                    }
                }
            })
        })
    })
</script>

<!-- //delete alert mesaages -->
<script>
    function deleteHoliday(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the Holiday record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/PublicHoliday/delete.php',
                    method: 'GET',
                    data: {
                        Code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'The Holiday has been removed.',
                            confirmButtonColor: '#3085d6',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); //  Refresh the page
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