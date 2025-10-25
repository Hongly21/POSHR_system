<?php
include("../../Config/conect.php");
include("../../root/Header.php");
?>
<style>
    /* Base Reset and Typography */
    body {
        margin: 0;
        padding: 20px;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f6f8;
        color: #333;
    }

    /* Title Styling */
    h1 {
        text-align: center;
        color: #007bff;
        margin-bottom: 30px;
    }

    /* Container Styling */
    .container {
        max-width: 800px;
        margin: auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Form Labels and Inputs */
    form label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
    }

    form input[type="text"],
    form input[type="date"],
    form select {
        width: 100%;
        padding: 8px 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }

    form input[type="text"]:focus,
    form input[type="date"]:focus,
    form select:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Weekday Section */
    .workday {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .dayy {
        flex: 1 1 180px;
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .dayy label {
        display: inline-block;
        margin-right: 8px;
        font-weight: 500;
    }

    .dayy input[type="checkbox"] {
        transform: scale(1.2);
        margin-right: 5px;
        vertical-align: middle;
    }

    .dayy .form-select {
        width: 80px;
        display: inline-block;
        vertical-align: middle;
    }

    /* Buttons */
    form button {
        margin-top: 25px;
        margin-right: 10px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #0056b3;
    }

    form button:last-of-type {
        background-color: #6c757d;
    }

    form button:last-of-type:hover {
        background-color: #5a6268;
    }
</style>

<body>
    <h1>Payroll Policy</h1>
    <div class="container">
        <form>
            <label for="code">Code</label>
            <input type="text" name="code" id="code"><br>
            <label for="description">Description</label>
            <input type="text" name="description" id="description"><br>
            <label for="fromDate">FromDate</label>
            <input type="date" name="fromDate" id="fromDate"><br>
            <label for="toDate">ToDate</label>
            <input type="date" name="toDate" id="toDate"><br>
            <label for="workday">Workday</label>
            <select class="form-select" name="workday" style="width: 80px;" id="workday" required>
                <?php for ($i = 1; $i <= 31; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <label for="hourperday">Hour Per Day</label>
            <select class="form-select" name="hourperday" id="hourperday" style="width: 80px;" required>
                <?php for ($i = 1; $i <= 24; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
            <div class="workday">
                <div class="dayy">
                    <label for="mon">Mon</label>
                    <input type="checkbox" name="mon" id="mon">
                    <select class="form-select" name="monHours" id="monHours" style="width: 80px;" required>
                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="dayy">
                    <label for="tues">Tues</label>
                    <input type="checkbox" name="tues" id="tues">
                    <select class="form-select" name="tuesHours" id="tuesHours" style="width: 80px;" required>
                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="dayy">
                    <label for="wed">Wed</label>
                    <input type="checkbox" id="wed" name="wed">
                    <select class="form-select" name="wedHours" id="wedHours" style="width: 80px;" required>
                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="dayy">
                    <label for="thur">Thur</label>
                    <input type="checkbox" name="thur" id="thur">
                    <select class="form-select" id="thurHours" name="thurHours" style="width: 80px;" required>
                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="dayy">
                    <label for="fri">Fri</label>
                    <input type="checkbox" name="fri" id="fri"> <select class="form-select" id="friHours" name="friHours" style="width: 80px;" required>
                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="dayy">
                    <label for="sat">Sat</label>
                    <input type="checkbox" name="sat" id="sat"> <select class="form-select" id="satHours" name="satHours" style="width: 80px;" required>
                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="dayy">
                    <label for="sun">Sun</label>
                    <input type="checkbox" name="sun" id="sun"> <select class="form-select" id="sunHours" name="sunHours" style="width: 80px;" required>
                        <?php for ($i = 1; $i <= 24; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button type="button" class="btnsubmit">Add</button>
            <button><a href="index.php" style="text-decoration: none; color: #fff;">Back</a></button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".btnsubmit").click(function() {

                var code = $("#code").val();
                var name = $("#name").val();
                var description = $("#description").val();
                var workday = $("#workday").val();
                var hourperday = $("#hourperday").val();
                var fromdate = $("#fromDate").val();
                var todate = $("#toDate").val();

                //Get values from checkboxes
                var mon = $("#mon").prop("checked") ? 1 : 0;
                var tues = $("#tues").prop("checked") ? 1 : 0;
                var wed = $("#wed").prop("checked") ? 1 : 0;
                var thur = $("#thur").prop("checked") ? 1 : 0;
                var fri = $("#fri").prop("checked") ? 1 : 0;
                var sat = $("#sat").prop("checked") ? 1 : 0;
                var sun = $("#sun").prop("checked") ? 1 : 0;

                //Get values from input fields for hours the value will be 0 if unchecked
                var monHours = mon ? $("#monHours").val() : 0;
                var tuesHours = tues ? $("#tuesHours").val() : 0;
                var wedHours = wed ? $("#wedHours").val() : 0;
                var thurHours = thur ? $("#thurHours").val() : 0;
                var friHours = fri ? $("#friHours").val() : 0;
                var satHours = sat ? $("#satHours").val() : 0;
                var sunHours = sun ? $("#sunHours").val() : 0;

                // var monHours = $("#monHours").val();
                // var tuesHours = $("#tuesHours").val();
                // var wedHours = $("#wedHours").val();
                // var thurHours = $("#thurHours").val();
                // var friHours = $("#friHours").val();
                // var satHours = $("#satHours").val();
                // var sunHours = $("#sunHours").val();

                $.ajax({
                    url: "../../action/PayrollSetting/add.php",
                    method: "Post",
                    data: {
                        action: 'btnsave',
                        code: code,
                        name: name,
                        description: description,
                        workday: workday,
                        hourperday: hourperday,
                        fromdate: fromdate,
                        todate: todate,
                        mon: mon,
                        tues: tues,
                        wed: wed,
                        thur: thur,
                        fri: fri,
                        sat: sat,
                        sun: sun,
                        monHours: monHours,
                        tuesHours: tuesHours,
                        wedHours: wedHours,
                        thurHours: thurHours,
                        friHours: friHours,
                        satHours: satHours,
                        sunHours: sunHours
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Add Successfully',
                            text: response
                        }).then(function() {
                            window.location.href = "index.php";
                            // location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        alert('Error: ' + error);
                    }
                })
            })
        })
    </script>


</body>

</html>