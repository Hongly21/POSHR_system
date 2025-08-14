<?php include_once('../../root/Header.php'); ?>

<body>
    <div class="container" style="margin-top: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Company</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Department</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Division</button>
                <button class="nav-link" id="nav-level-tab" data-bs-toggle="tab" data-bs-target="#nav-level" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Level</button>
                <button class="nav-link" id="nav-position-tab" data-bs-toggle="tab" data-bs-target="#nav-position" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Position</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <?php
                include 'TabCompany.php';
                ?>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">..Q.</div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">..D.</div>
            <div class="tab-pane fade" id="nav-level" role="tabpanel" aria-labelledby="nav-level-tab" tabindex="0">...S</div>
            <div class="tab-pane fade" id="nav-position" role="tabpanel" aria-labelledby="nav-position-tab" tabindex="0">...A</div>

        </div>
    </div>

</body>

</html>