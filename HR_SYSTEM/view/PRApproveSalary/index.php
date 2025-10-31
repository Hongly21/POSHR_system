<?php
include("../../root/Header.php");
include("../../Config/conect.php");
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Approval Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<div class="container-fluid mt-3">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">
                <i class="fas fa-money-check-alt text-primary"></i> Salary Approval Management
            </h4>
        </div>
    </div>

    <!-- Filter Section -->
    <!-- <div class="card mb-3">
        <div class="card-body">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label for="inYear" class="form-label">In Year:</label>
                    <select id="inYear" class="form-select">
                        <?php
                        $currentYear = date("Y");
                        for ($year = $currentYear; $year <= $currentYear + 1; $year++) {
                            echo '<option value="' . $year . '" ' . ($year === $currentYear ? 'selected' : '') . '>' . $year . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button id="btnGo" class="btn btn-primary w-100">
                        <i class="fas fa-search me-1"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Main Content -->
    <div class="card">
        <div class="card-header bg-white p-0">
            <ul class="nav nav-tabs" id="leaveTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active px-4 py-3" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">
                        <i class="fas fa-check-circle text-success me-1"></i> Approved List
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-3" id="waiting-tab" data-bs-toggle="tab" data-bs-target="#waiting" type="button" role="tab">
                        <i class="fas fa-clock text-warning me-1"></i> Pending List
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="leaveTabContent">
                <!-- List Tab -->
                <div class="tab-pane fade show active" id="list" role="tabpanel">
                    <?php include('TabApproveList.php'); ?>
                </div>

                <!-- Waiting List Tab -->
                <div class="tab-pane fade" id="waiting" role="tabpanel">
                    <?php include('TabPendinglist.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>