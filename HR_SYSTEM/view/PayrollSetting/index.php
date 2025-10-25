<?php
include("../../Config/conect.php");
include("../../root/Header.php");
include("../../root/DataTable.php");
?>

<style>
    /* Container Styling */
 
    .container {
        margin-top: 15px;
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        background-color: #f9f9f9;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    /* Title Styling */
    h3.text-center {
        font-family: 'Segoe UI', sans-serif;
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
    }

    /* Table Styling */
    table#example {
        width: 100%;
        border-collapse: collapse;
        font-family: 'Segoe UI', sans-serif;
        font-size: 14px;
        background-color: #fff;
    }

    table#example thead {
        /* background-color: #f2f4f7ff; */
        color: black;
    }

    table#example th,
    table#example td {
        padding: 10px 12px;
        text-align: center;
        border: 1px solid #ddd;
    }

    /* Hover Effect */
    table#example tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Icon Buttons */
    button {
        background-color: transparent;
        border: none;
        cursor: pointer;
        margin: 0 5px;
        font-size: 16px;
        color: #007bff;
        transition: color 0.3s ease;
    }

    button:hover {
        color: #0056b3;
    }

    /* Status Icons */
    .fas.fa-check {
        color: #28a745;
    }

    .fas.fa-times {
        color: #dc3545;
    }



    /* =================================================================================== */



    /* Container styling */
    .container1 {
        /* max-width: 700px; */
        /* margin: 30px auto; */
        padding: 20px;
        background: #ffffff;
        border-radius: 12px;
        /* box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); */
        font-family: Arial, sans-serif;
    }

    /* Form elements */
    form {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    /* Labels */
    form label {
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    /* Inputs & Selects */
    form input[type="text"],
    form input[type="date"],
    form select {
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        transition: border 0.3s;
        width: 200px;
    }

    form input[type="text"]:focus,
    form input[type="date"]:focus,
    form select:focus {
        border-color: #4A90E2;
        outline: none;
    }

    /* Workday section */
    .workday {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 12px;
        margin-top: 10px;
    }

    /* Each day block */
    .dayy {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .dayy label {
        min-width: 40px;
        font-size: 14px;
        color: #444;
    }

    /* Checkbox */
    .dayy input[type="checkbox"] {
        transform: scale(1.1);
        cursor: pointer;
    }

    /* Select inside days */
    .dayy select {
        width: 70px;
    }

    /* Submit button example */
    form button {
        margin-top: 20px;
        padding: 10px;
        background: #4A90E2;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 15px;
        transition: background 0.3s;
    }

    form button:hover {
        background: #357ABD;
    }
</style>

<h3 class="text-center">PAROLL SETTING</h3>
<div class="container" style="margin-top: 15px; border: 0.4px solid #ccc;  padding: 20px; border-radius: 5px;">
    <table class="display" id="example">
        <button class="btn btn-sm btn-success me-2" style="margin-bottom: 10px;"><i style="margin-right: 10px;" class="fas fa-plus"></i>
            <a href="create.php" style="text-decoration: none; color: #fff;">Add New</a></button>
        <thead>
            <tr>
                <th>Actions</th>
                <th>Code</th>
                <th>Description</th>
                <th>Working Days</th>
                <th>Hour Per Day</th>
                <th>Hour Per Week</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
                <th>Sun</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM prpaypolicy ORDER BY id DESC";
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <button class="btn btn-sm btn-warning me-2 editButton" data-bs-toggle="modal" data-bs-target="#updateModal"
                            data-id="<?php echo $row['id']; ?>"
                            data-code="<?php echo $row['code']; ?>"
                            data-description="<?php echo $row['description']; ?>"
                            data-workday="<?php echo $row['workday']; ?>"
                            data-hourperday="<?php echo $row['hourperday']; ?>"
                            data-hourperweek="<?php echo $row['hourperweek']; ?>"
                            data-fromDate="<?php echo $row['fromdate']; ?>"
                            data-toDate="<?php echo $row['todate']; ?>"
                            data-mon="<?php echo $row['mon']; ?>"
                            data-tues="<?php echo $row['tues']; ?>"
                            data-wed="<?php echo $row['wed']; ?>"
                            data-thur="<?php echo $row['thur']; ?>"
                            data-fri="<?php echo $row['fri']; ?>"
                            data-sat="<?php echo $row['sat']; ?>"
                            data-sun="<?php echo $row['sun']; ?>"
                            data-monhours="<?php echo $row['monhours']; ?>"
                            data-tueshours="<?php echo $row['tueshours']; ?>"
                            data-wedhours="<?php echo $row['wedhours']; ?>"
                            data-thurhours="<?php echo $row['thurhours']; ?>"
                            data-frihours="<?php echo $row['frihours']; ?>"
                            data-sathours="<?php echo $row['sathours']; ?>"
                            data-sunhours="<?php echo $row['sunhours']; ?>">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger me-2" onclick=" deleteCompany('<?php echo $row['id']; ?>')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <td><?php echo $row['code']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['workday']; ?></td>
                    <td><?php echo $row['hourperday']; ?></td>
                    <td><?php echo $row['hourperweek']; ?></td>
                    <td>
                        <?php echo ($row['mon'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['tues'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['wed'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['thur'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['fri'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['sat'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                    <td>
                        <?php echo ($row['sun'] ? "<i class='fas fa-check text-success'></i>" : "<i class='fas fa-times text-danger'></i>") ?>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>

<!-- Modal Update-->
<div class="modal fade " id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Payroll</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-container">
                    <div class="container1">
                        <form>
                            <input type="hidden" id="idUpdate" name="id">
                            <label for="code">Code</label>
                            <input type="text" name="code" id="codeUpdate" readonly>
                            <label for="description">Description</label>
                            <input type="text" name="description" id="descriptionUpdate">
                            <label for="fromDate">FromDate</label>
                            <input type="date" name="fromDate" id="fromDateUpdate">
                            <label for="toDate">ToDate</label>
                            <input type="date" name="toDate" id="toDateUpdate">
                            <label for="workday">Workday</label>
                            <select class="form-select" name="workday" style="width: 80px;" id="workdayUpdate" required>
                                <?php for ($i = 1; $i <= 31; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                            <label for="hourperday">Hour Per Day</label>
                            <select class="form-select" name="hourperday" id="hourperdayUpdate" style="width: 80px;" required>
                                <?php for ($i = 1; $i <= 24; $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php } ?>
                            </select>
                            <div class="workday">
                                <div class="dayy">
                                    <label for="mon">Mon</label>
                                    <input type="checkbox" name="mon" id="monUpdate">
                                    <select class="form-select" name="monhours" id="monhoursUpdate" style="width: 80px;" required>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="dayy">
                                    <label for="tues">Tues</label>
                                    <input type="checkbox" name="tues" id="tuesUpdate">
                                    <select class="form-select" name="tueshours" id="tueshoursUpdate" style="width: 80px;" required>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="dayy">
                                    <label for="wed">Wed</label>
                                    <input type="checkbox" id="wedUpdate" name="wed">
                                    <select class="form-select" name="wedhours" id="wedhoursUpdate" style="width: 80px;" required>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="dayy">
                                    <label for="thur">Thur</label>
                                    <input type="checkbox" name="thur" id="thurUpdate">
                                    <select class="form-select" id="thurhoursUpdate" name="thurhours" style="width: 80px;" required>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="dayy">
                                    <label for="fri">Fri</label>
                                    <input type="checkbox" name="fri" id="friUpdate"> <select class="form-select" id="frihoursUpdate" name="frihours" style="width: 80px;" required>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="dayy">
                                    <label for="sat">Sat</label>
                                    <input type="checkbox" name="sat" id="satUpdate"> <select class="form-select" id="sathoursUpdate" name="sathours" style="width: 80px;" required>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="dayy">
                                    <label for="sun">Sun</label>
                                    <input type="checkbox" name="sun" id="sunUpdate"> <select class="form-select" id="sunhoursUpdate" name="sunhours" style="width: 80px;" required>
                                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id='btnupdate' class="btn btn-primary">Upadate</button>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('.editButton').click(function() {
            var id = $(this).data('id');
            var code = $(this).data('code');
            var description = $(this).data('description');
            var workday = $(this).data('workday');
            var hourperday = $(this).data('hourperday');
            var hourperweek = $(this).data('hourperweek');
            var fromDate = $(this).data('fromdate');
            var toDate = $(this).data('todate');
            var mon = $(this).data('mon');
            var tues = $(this).data('tues');
            var wed = $(this).data('wed');
            var thur = $(this).data('thur');
            var fri = $(this).data('fri');
            var sat = $(this).data('sat');
            var sun = $(this).data('sun');

            var monhours = $(this).data('monhours');
            var tueshours = $(this).data('tueshours');
            var wedhours = $(this).data('wedhours');
            var thurhours = $(this).data('thurhours');
            var frihours = $(this).data('frihours');
            var sathours = $(this).data('sathours');
            var sunhours = $(this).data('sunhours');

            $('#idUpdate').val(id);
            $('#codeUpdate').val(code);
            $('#descriptionUpdate').val(description);
            $('#workdayUpdate').val(workday);
            $('#fromDateUpdate').val(fromDate);
            $('#toDateUpdate').val(toDate);
            $('#hourperdayUpdate').val(hourperday);
            $('#hourperweekUpdate').val(hourperweek);
            $('#monUpdate').prop('checked', mon);
            $('#tuesUpdate').prop('checked', tues);
            $('#wedUpdate').prop('checked', wed);
            $('#thurUpdate').prop('checked', thur);
            $('#friUpdate').prop('checked', fri);
            $('#satUpdate').prop('checked', sat);
            $('#sunUpdate').prop('checked', sun);
            $('#monhoursUpdate').val(monhours);
            $('#tueshoursUpdate').val(tueshours);
            $('#wedhoursUpdate').val(wedhours);
            $('#thurhoursUpdate').val(thurhours);
            $('#frihoursUpdate').val(frihours);
            $('#sathoursUpdate').val(sathours);
            $('#sunhoursUpdate').val(sunhours);
        })
        $('#btnupdate').click(function() {
            var id = $('#idUpdate').val();
            var code = $('#codeUpdate').val();
            var description = $('#descriptionUpdate').val();
            var workday = $('#workdayUpdate').val();
            var hourperday = $('#hourperdayUpdate').val();
            var hourperweek = $('#hourperweekUpdate').val();
            var fromDate = $('#fromDateUpdate').val();
            var toDate = $('#toDateUpdate').val();

            var mon = $('#monUpdate').prop("checked") ? 1 : 0;
            var tues = $('#tuesUpdate').prop("checked") ? 1 : 0;
            var wed = $('#wedUpdate').prop("checked") ? 1 : 0;
            var thur = $('#thurUpdate').prop("checked") ? 1 : 0;
            var fri = $('#friUpdate').prop("checked") ? 1 : 0;
            var sat = $('#satUpdate').prop("checked") ? 1 : 0;
            var sun = $('#sunUpdate').prop("checked") ? 1 : 0;

            var monHours = mon ? $('#monhoursUpdate').val() : 0;
            var tuesHours = tues ? $('#tueshoursUpdate').val() : 0;
            var wedHours = wed ? $('#wedhoursUpdate').val() : 0;
            var thurHours = thur ? $('#thurhoursUpdate').val() : 0;
            var friHours = fri ? $('#frihoursUpdate').val() : 0;
            var satHours = sat ? $('#sathoursUpdate').val() : 0;
            var sunHours = sun ? $('#sunhoursUpdate').val() : 0;

            $.ajax({
                url: '../../action/PayrollSetting/update.php',
                method: 'GET',
                data: {
                    action: 'update',
                    id: id,
                    code: code,
                    Description: description,
                    WorkDay: workday,
                    HourPerDay: hourperday,
                    HourPerWeek: hourperweek,
                    FromDate: fromDate,
                    ToDate: toDate,
                    Mon: mon,
                    Tues: tues,
                    Wed: wed,
                    Thur: thur,
                    Fri: fri,
                    Sat: sat,
                    Sun: sun,
                    MonHours: monHours,
                    TuesHours: tuesHours,
                    WedHours: wedHours,
                    ThurHours: thurHours,
                    FriHours: friHours,
                    SatHours: satHours,
                    SunHours: sunHours
                },
                success: function(response) {
                    if (response === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'The payroll has been updated.',
                            confirmButtonColor: '#3085d6',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload(); // 🔄 Refresh the page
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update the payroll.',
                            confirmButtonColor: '#3085d6',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    }
                }

            });
        })
    })
</script>

<!-- //delete alert mesaages -->
<script>
    function deleteCompany(code) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will permanently delete the payroll record.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../action/PayrollSetting/delete.php',
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
                            text: 'Could not delete the payroll.',
                            footer: error
                        });
                    }
                });
            }
        });
    }
</script>