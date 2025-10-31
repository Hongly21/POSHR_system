<?php
include('../../Config/conect.php');
include('../../root/Header.php');
include('../../root/DataTable.php');



?>

<h2 style="text-align: center; margin-top: 10px;">Generate Salary</h2>

<div class="container1" style="margin: auto; margin-top: 20px; 
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 5px;">
    <!-- Main Content -->
    <div class="card">
        <div class="card-header bg-white p-0">
            <ul class="nav nav-tabs" id="leaveTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active px-4 py-3" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab">

                        <i class="fas fa-clock text-warning me-1"></i>Employee List

                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-3" id="waiting-tab" data-bs-toggle="tab" data-bs-target="#waiting" type="button" role="tab">
                        <i class="fas fa-check-circle text-success me-1"></i> Generate History
                    </button>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="leaveTabContent">
                <!-- List Tab -->
                <div class="tab-pane fade show active" id="list" role="tabpanel">
                    <?php include('emplist.php'); ?>
                </div>

                <!-- Waiting List Tab -->
                <div class="tab-pane fade" id="waiting" role="tabpanel">
                    <?php include('empGen.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>