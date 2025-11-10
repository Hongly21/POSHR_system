<?php
include('../../../root/Header.php');
include('../../../Config/conect.php');

?>

<body>
    <h2 style="text-align: center; margin-top: 10px; text-transform: uppercase;">Staff Details</h2>
    <div class="container" style="margin-top: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <nav>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Family</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Education</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Documents</button>
                </li>

            </ul>
        </nav>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <h4 style="text-align: center; margin-top:15px;">FAMILY MEMBERS</h4>
                <div class="family_member" style="margin: 20px;">
                    <?php
                    $sqlfamily = "SELECT * FROM hrfamily";
                    $runfamily = $con->query($sqlfamily);

                    ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    <button type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Add New
                                    </button>
                                </th>
                                <th>EmpCode</th>
                                <th>Relation Name</th>
                                <th>Relation Type</th>
                                <th>Gender</th>
                                <th>Is Tax</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $runfamily->fetch_assoc()) {

                            ?>

                                <tr>
                                    <td><?php
                                        //count number of family member
                                        echo $no++;

                                        ?></td>
                                    <td><?php echo $row['EmpCode']; ?></td>
                                    <td><?php echo $row['RelationName']; ?></td>
                                    <td><?php echo $row['RelationType']; ?></td>
                                    <td><?php echo $row['Gender']; ?></td>
                                    <td><?php if ($row['IsTax'] == 1) echo '<span class="badge bg-success">Yes</span>';
                                        else echo '<span class="badge bg-danger">No</span>'; ?></td>
                                    <td>
                                        <button onclick="deleteFamilyMember('<?php echo $row['RelationName']; ?>')" class="btn btn-sm btn-danger me-2"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="btn btn-sm btn-primary me-2 btnupdate" data-bs-toggle="modal" data-bs-target="#editmemberModal"
                                            data-empcode="<?php echo $row['EmpCode']; ?>"
                                            data-relationname="<?php echo $row['RelationName']; ?>"
                                            data-relationtype="<?php echo $row['RelationType']; ?>"
                                            data-relationgender="<?php echo $row['Gender']; ?>"
                                            data-istax="<?php echo $row['IsTax']; ?>">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php


                            }


                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- add family member modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Family Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="familyMemberForm">
                                    <input type="hidden" id="familyMemberIndex" value="">
                                    <div class="mb-3">
                                        <label for="empcode" class="form-label ">EmpCode</label> <br>
                                        <select class="form-select" style="border-radius: 10px;" name="empcode" id="empcode">
                                            <option value="">Select EmpCode</option>
                                            <?php
                                            $sql = 'SELECT * FROM hrstaffprofile';
                                            $run = $con->query($sql);
                                            while ($row = $run->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $row['EmpCode'] ?>"><?php echo $row['EmpCode'] . ' - ' . $row['EmpName'] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="relationName" class="form-label ">Name</label>
                                        <input type="text" class="form-control" id="relationName">
                                    </div>
                                    <div class="mb-3">
                                        <label for="relationType" class="form-label  ">Relation Type</label>
                                        <select class="form-select" id="relationType">
                                            <option value="">Select Relation</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Child">Child</option>
                                            <option value="Parent">Parent</option>
                                            <option value="Sibling">Sibling</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="relationGender" class="form-label  ">Gender</label>
                                        <select class="form-select" id="relationGender">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="isTax">
                                            <label class="form-check-label" for="isTax">Include in Tax Calculation</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="saveFamilyMember">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit family member modal -->
                <div class="modal fade" id="editmemberModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Family Member</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="familyMemberForm">
                                    <input type="hidden" id="familyMemberIndex" value="">
                                    <div class="mb-3">
                                        <label for="empcodeupdate" class="form-label ">EmpCode</label>
                                        <input type="text" class="form-control" id="empcodeupdate" disabled>
                                        <input type="hidden" class="form-control" id="empnameforupdate" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="relationNameupdate" class="form-label ">Name</label>
                                        <input type="text" class="form-control" id="relationNameupdate">
                                    </div>
                                    <div class="mb-3">
                                        <label for="relationTypeupdate" class="form-label  ">Relation Type</label>
                                        <select class="form-select" id="relationTypeupdate">
                                            <option value="">Select Relation</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Child">Child</option>
                                            <option value="Parent">Parent</option>
                                            <option value="Sibling">Sibling</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="relationGenderupdate" class="form-label  ">Gender</label>
                                        <select class="form-select" id="relationGenderupdate">
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="isTaxupdate">
                                            <label class="form-check-label" for="isTaxupdate">Include in Tax Calculation</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="Updatefamilymember">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                <h4 style="text-align: center; margin-top:15px;">EDUCATION DETAILS</h4>
                <table class="table table-bordered " style="margin:20px">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#eduModal">
                                    <i class="fa fa-plus"></i> Add New
                                </button>
                            </th>
                            <th>No</th>
                            <th>EmpCode</th>
                            <th>Institution</th>
                            <th>Degree</th>
                            <th>Field of Study</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqleducation = "SELECT * FROM hreducation";
                        $runeducation = $con->query($sqleducation);
                        $no = 1;

                        while ($row = $runeducation->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['EmpCode'] ?></td>
                                <td><?php echo $row['Institution'] ?></td>
                                <td><?php echo $row['Degree'] ?></td>
                                <td><?php echo $row['FieldOfStudy'] ?></td>
                                <td><?php echo $row['StartDate'] ?></td>
                                <td><?php echo $row['EndDate'] ?></td>
                                <td>
                                    <button onclick="deleteEducation('<?php echo $row['Id']; ?>')" class="btn btn-sm btn-danger me-2 btndelete"><i class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-sm btn-primary me-2 btneditedu" data-bs-toggle="modal" data-bs-target="#eduupdateModal"

                                        data-empcode="<?php echo $row['EmpCode']; ?>"
                                        data-institution="<?php echo $row['Institution']; ?>"
                                        data-degree="<?php echo $row['Degree']; ?>"
                                        data-fieldofstudy="<?php echo $row['FieldOfStudy']; ?>"
                                        data-startdate="<?php echo $row['StartDate']; ?>"
                                        data-enddate="<?php echo $row['EndDate']; ?>"
                                        data-id="<?php echo $row['Id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>

                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>

                </table>


                <!-- add  education modal -->
                <div class="modal fade" id="eduModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Education Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="empcodeeducation" class="form-label ">EmpCode</label> <br>
                                    <select class="form-select" style="border-radius: 10px;" id="empcodeeducation">
                                        <option value="">Select EmpCode</option>
                                        <?php
                                        $sql = 'SELECT * FROM hrstaffprofile';
                                        $run = $con->query($sql);
                                        while ($row = $run->fetch_assoc()) {
                                        ?>
                                            <option value="<?php echo $row['EmpCode'] ?>"><?php echo $row['EmpCode'] . ' - ' . $row['EmpName'] ?></option>
                                        <?php
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="institution" class="form-label  ">Institution</label>
                                    <input type="text" class="form-control" id="institution">
                                </div>
                                <div class="mb-3">
                                    <label for="degree" class="form-label  ">Degree</label>
                                    <select class="form-select" id="degree">
                                        <option value="">Select Degree</option>
                                        <option value="High School">High School</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Bachelor">Bachelor's Degree</option>
                                        <option value="Master">Master's Degree</option>
                                        <option value="Doctorate">Doctorate</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fieldOfStudy" class="form-label  ">Field of Study</label>
                                    <input type="text" class="form-control" id="fieldOfStudy">
                                </div>
                                <div class="mb-3">
                                    <label for="startDate" class="form-label  ">Start Date</label>
                                    <input type="date" class="form-control" id="Datestart">
                                </div>
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="endDate">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveEducation">Save</button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Update education modal -->
                <div class="modal fade" id="eduupdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Education Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="empcodeeducationupdate" class="form-label ">EmpCode</label> <br>
                                    <input type="text" class="form-control" id="empcodeeducationupdate" disabled>
                                    <input type="hidden" class="form-control" id="ideducationupdate">
                                </div>
                                <div class="mb-3">
                                    <label for="institutionupdate" class="form-label  ">Institution</label>
                                    <input type="text" class="form-control" id="institutionupdate">
                                </div>
                                <div class="mb-3">
                                    <label for="degree" class="form-label">Degree</label>
                                    <select class="form-select" id="degreeupdate">
                                        <option value="">Select Degree</option>
                                        <option value="High School">High School</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Bachelor">Bachelor's Degree</option>
                                        <option value="Master">Master's Degree</option>
                                        <option value="Doctorate">Doctorate</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="fieldOfStudyupdate" class="form-label  ">Field of Study</label>
                                    <input type="text" class="form-control" id="fieldOfStudyupdate">
                                </div>
                                <div class="mb-3">
                                    <label for="startDateupdate" class="form-label  ">Start Date</label>
                                    <input type="date" class="form-control" id="Datestartupdate">
                                </div>
                                <div class="mb-3">
                                    <label for="endDateupdate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="endDateupdate">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="Updateeducation">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                <h4 style="text-align: center; margin-top:15px;">DOCUMENTS</h4>
                <table class="table table-bordered" style="margin-top:15px">
                    <thead>
                        <tr>
                            <th>
                                <button type="button" class="btn btn-sm btn-primary me-2" data-bs-toggle="modal" data-bs-target="#documentModal">
                                    <i class="fa fa-plus"></i> Add New
                                </button>
                            </th>
                            <th>EmpCode</th>
                            <th>Document Type</th>
                            <th>Description</th>
                            <th>File Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $slqduc = "SELECT * FROM hrstaffdocument";
                        $resduc = $con->query($slqduc);
                        while ($rowduc = $resduc->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $rowduc['EmpCode']; ?></td>
                                <td><?php echo $rowduc['DocType']; ?></td>
                                <td><?php echo $rowduc['Description']; ?></td>
                                <td><?php echo $rowduc['Photo']; ?></td>
                                <td>


                                    <button onclick="deleteDocument('<?php echo $rowduc['Photo']; ?>')" class="btn btn-sm btn-danger me-2 btndeletedoc"><i class="fa fa-trash"></i></button>
                                    <button type="button" class="btn btn-sm btn-primary me-2 btnupdatedoc" data-bs-toggle="modal" data-bs-target="#updatedocumentModal"

                                        data-empcode="<?php echo $rowduc['EmpCode']; ?>"
                                        data-doctype="<?php echo $rowduc['DocType']; ?>"
                                        data-description="<?php echo $rowduc['Description']; ?>"
                                        data-photo="<?php echo $rowduc['Photo']; ?>">
                                        <i class="fa fa-edit "></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-info view-document" data-bs-toggle="modal" data-bs-target="#viewdocumentModal" data-file="<?php echo $rowduc['Photo']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>

                        <?php
                        }

                        ?>

                    </tbody>
                </table>


                <!-- add  document modal -->
                <div class=" modal fade" id="documentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Document</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="documentForm" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="empcodedoc" class="form-label ">EmpCode</label> <br>
                                        <select class="form-select" style="border-radius: 10px;" name="empcodedoc" id="empcodedoc">
                                            <option value="">Select EmpCode</option>
                                            <?php
                                            $sql = 'SELECT * FROM hrstaffprofile';
                                            $run = $con->query($sql);
                                            while ($row = $run->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $row['EmpCode'] ?>"><?php echo $row['EmpCode'] . ' - ' . $row['EmpName'] ?></option>
                                            <?php
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="docType" class="form-label  ">Document Type</label>
                                        <select class="form-select" id="docType">
                                            <option value="">Select Document Type</option>
                                            <option value="Contract">Contract</option>
                                            <option value="CV">CV</option>
                                            <option value="Certificate">Certificate</option>
                                            <option value="IDCard">ID card</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="docFile" class="form-label  ">Document File</label>
                                        <!-- we add only file pdf  -->
                                        <input type="file" class="form-control" id="docFile" name="docFile" accept=".pdf,application/pdf"> <br>
                                        <p style="color: gray; font-size: 14px;">Only PDF files are allowed.</p>

                                        <!-- <input type="file" class="form-control" id="photo" name="photo" accept="image/*"> -->
                                        <!-- preview file after choose -->
                                        <div id="preview">
                                            <iframe id="docPreview" src="../../../assets/documents/" style="width:100%; height:400px; display:none;"></iframe>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="saveDocument">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Update  document modal -->
                <div class="modal fade" id="updatedocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Document</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form id="documentForm" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="empcodedocUpdate" class="form-label ">EmpCode</label> <br>
                                        <input type="text" class="form-control" id="empcodedocUpdate" name="empcodedocUpdate" disabled>
                                    </div>

                                    <div class="mb-3">
                                        <label for="docTypeUpdate" class="form-label  ">Document Type</label>
                                        <select class="form-select" id="docTypeUpdate">
                                            <option value="">Select Document Type</option>
                                            <option value="Contract">Contract</option>
                                            <option value="CV">CV</option>
                                            <option value="Certificate">Certificate</option>
                                            <option value="IDCard">ID card</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descriptionUpdate" class="form-label">Description</label>
                                        <textarea class="form-control" id="descriptionUpdate" rows="3"></textarea>
                                        <input type="hidden" id="dcsforupdate" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="docFileUpdate" class="form-label">Document File</label>
                                        <input type="file" class="form-control" id="docFileUpdate" name="docFileUpdate"> <br>
                                        <!-- preview file -->
                                        <div id="previewFileUpdate">
                                            <iframe id="docPreviewUpdate" src="../../../assets/documents/" style="width:100%; height:400px; display:none;"></iframe>
                                        </div>
                                        <!-- <input type="file" class="form-control" id="photo" name="photo" accept="image/*"> -->
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="updateDocument">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal view document -->
                <div class="modal fade" id="viewdocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">View Document</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <iframe id="documentPreviewView" src="../../../assets/documents/" style="width:100%; height:400px;  display:none;"></iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a id="downloadDocument" class="btn btn-success mt-2">Download</a>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
    </div>


</body>





</html>

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
        $('#saveFamilyMember').click(function() {
            var empcode = $('#empcode').val();
            var relationname = $('#relationName').val();
            var relationtype = $('#relationType').val();
            var relationgender = $('#relationGender').val();
            var istax = $('#isTax').is(':checked') ? 1 : 0;


            if (relationgender && relationname && relationtype) {
                $.ajax({
                    url: '../../../action/StaffInfor/create.php',
                    method: 'POST',
                    data: {
                        relationname: relationname,
                        relationtype: relationtype,
                        relationgender: relationgender,
                        istax: istax,
                        empcode: empcode
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Added',
                                text: 'Family member of ' + empcode + ' has been added.',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error adding the family member: ' + response,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error',
                            text: 'There was an error processing your request.',
                        });

                    }

                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Data',
                    text: 'Please fill in all required fields.',
                });
            }

        })


        $('.btnupdate').on('click', function() {
            var empcode = $(this).data('empcode');
            var relationname = $(this).data('relationname');
            var relationtype = $(this).data('relationtype');
            var relationgender = $(this).data('relationgender');
            var istax = $(this).data('istax');


            $('#empcodeupdate').val(empcode);
            $('#empnameforupdate').val(relationname);
            $('#relationNameupdate').val(relationname);
            $('#relationTypeupdate').val(relationtype);
            $('#relationGenderupdate').val(relationgender);
            if (istax == 1) {
                $('#isTaxupdate').prop('checked', true);
            } else {
                $('#isTaxupdate').prop('checked', false);
            }
        });

        $('#Updatefamilymember').click(function() {
            var nameforupdate = $('#empnameforupdate').val();
            var relationname = $('#relationNameupdate').val();
            var relationtype = $('#relationTypeupdate').val();
            var relationgender = $('#relationGenderupdate').val();
            var istax = $('#isTaxupdate').is(':checked') ? 1 : 0;

            if (relationgender && relationname && relationtype) {
                $.ajax({
                    url: '../../../action/StaffInfor/update.php',
                    method: 'POST',
                    data: {
                        relationname: relationname,
                        relationtype: relationtype,
                        relationgender: relationgender,
                        istax: istax,
                        nameforupdate: nameforupdate
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Updated',
                                text: nameforupdate + ' has been updated.',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error updating the family member: ' + response,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error',
                            text: 'There was an error processing your request.',
                        });

                    }

                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Data',
                    text: 'Please fill in all required fields.',
                });
            }
        });

        $('#saveEducation').click(function() {
            var institution = $('#institution').val();
            var degree = $('#degree').val();
            var fieldOfStudy = $('#fieldOfStudy').val();
            var startDate = $('#Datestart').val();
            var endDate = $('#endDate').val();
            var empcode = $('#empcodeeducation').val();

            if (institution && degree && fieldOfStudy && startDate && endDate) {
                $.ajax({
                    url: '../../../action/StaffInfor/educationCreate.php',
                    method: 'POST',
                    data: {
                        institution: institution,
                        degree: degree,
                        fieldOfStudy: fieldOfStudy,
                        startDate: startDate,
                        endDate: endDate,
                        empcode: empcode
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Added',
                                text: 'Education record has been added.',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error adding the education record: ' + response,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error',
                            text: 'There was an error processing your request.',
                        });

                    }

                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Data',
                    text: 'Please fill in all required fields.',
                });
            }

        });


        $('.btneditedu').on('click', function() {
            var empcode = $(this).data('empcode');
            var institution = $(this).data('institution');
            var degree = $(this).data('degree');
            var fieldofstudy = $(this).data('fieldofstudy');
            var startdate = $(this).data('startdate');
            var enddate = $(this).data('enddate');
            var id = $(this).data('id');

            $('#empcodeeducationupdate').val(empcode);
            $('#institutionupdate').val(institution);
            $('#fieldOfStudyupdate').val(fieldofstudy);
            $('#Datestartupdate').val(startdate);
            $('#endDateupdate').val(enddate);
            $('#ideducationupdate').val(id);

            $('#degreeupdate').val(degree).trigger('change');
        });


        $('#Updateeducation').click(function() {
            var empcode = $('#empcodeeducationupdate').val();
            var institution = $('#institutionupdate').val();
            var degree = $('#degreeupdate').val();
            var fieldofstudy = $('#fieldOfStudyupdate').val();
            var startdate = $('#Datestartupdate').val();
            var enddate = $('#endDateupdate').val();
            var id = $('#ideducationupdate').val();

            if (institution && degree && fieldofstudy && startdate && enddate) {
                $.ajax({
                    url: '../../../action/StaffInfor/educationUpdate.php',
                    method: 'POST',
                    data: {
                        id: id,
                        institution: institution,
                        degree: degree,
                        fieldOfStudy: fieldofstudy,
                        startDate: startdate,
                        endDate: enddate
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Updated',
                                text: 'Education record has been updated.',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error updating the education record: ' + response,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error',
                            text: 'There was an error processing your request.',
                        });

                    }

                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Data',
                    text: 'Please fill in all required fields.',
                });
            }
        });

        $('#saveDocument').click(function() {
            var empcode = $('#empcodedoc').val();
            var docType = $('#docType').val();
            var description = $('#description').val();
            var docFile = $('#docFile')[0].files[0];

            if (docType && description) {
                var formData = new FormData();
                formData.append('empcodedoc', empcode);
                formData.append('docType', docType);
                formData.append('description', description);
                formData.append('docFile', docFile);
                $.ajax({
                    url: '../../../action/StaffInfor/documentCreate.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Added',
                                text: 'Document has been added.',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error adding the document: ' + response,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error',
                            text: 'There was an error processing your request.',
                        });

                    }

                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Data',
                    text: 'Please fill in all required fields.',

                })
            }
        });

        $('.btnupdatedoc').on('click', function() {
            var empcode = $(this).data('empcode');
            var doctype = $(this).data('doctype');
            var description = $(this).data('description');
            var photo = $(this).data('photo');


            $('#empcodedocUpdate').val(empcode);
            $('#docTypeUpdate').val(doctype);
            $('#descriptionUpdate').val(description);
            $('#dcsforupdate').val(description);
            // $('#docFileUpdate').val(photo);


            $('#docPreviewUpdate').attr('src', '../../../assets/documents/' + photo).show();

        });

        $('#updateDocument').click(function() {
            var empcode = $('#empcodedocUpdate').val();
            var docType = $('#docTypeUpdate').val();
            var description = $('#descriptionUpdate').val();
            var dcsforupdate = $('#dcsforupdate').val();
            var docFile = $('#docFileUpdate')[0].files[0];
            // var photoName = docFile ? docFile.name : null;

            if (docType && description) {
                var formData = new FormData();
                formData.append('empcodedoc', empcode);
                formData.append('docType', docType);
                formData.append('description', description);
                formData.append('dcsforupdate', dcsforupdate);
                if (docFile) {
                    formData.append('docFile', docFile);
                }
                $.ajax({
                    url: '../../../action/StaffInfor/documentUpdate.php',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Successfully Updated',
                                text: 'Document has been updated.',
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'There was an error updating the document: ' + response,
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'AJAX Error',
                            text: 'There was an error processing your request.',
                        });

                    }

                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Data',
                    text: 'Please fill in all required fields.',

                })
            }

        })



    });




    //preview file on update document
    $('#docFileUpdate').on('change', function() {
        var file = this.files[0];
        var fileType = file.type;
        var preview = $('#docPreviewUpdate');

        var reader = new FileReader();
        reader.onload = function(e) {
            var fileURL = e.target.result;

            if (fileType === 'application/pdf') {
                preview.attr('src', fileURL).show();
            } else if (fileType.startsWith('image/')) {
                preview.attr('src', fileURL).show();
            } else {
                preview.hide();
                Swal.fire({
                    icon: 'info',
                    title: 'Preview not available',
                    text: 'Not found preview for this file type.',
                })
            }
        };
        reader.readAsDataURL(file);
    });


    //preview file on add document
    $('#docFile').on('change', function() {
        var file = this.files[0];
        var fileType = file.type;
        var preview = $('#docPreview');

        var reader = new FileReader();
        reader.onload = function(e) {
            var fileURL = e.target.result;

            if (fileType === 'application/pdf') {
                preview.attr('src', fileURL).show();
            } else if (fileType.startsWith('image/')) {
                preview.attr('src', fileURL).show();
            } else {
                preview.hide();
                Swal.fire({
                    icon: 'info',
                    title: 'Preview not available',
                    text: 'Not found preview for this file type.',
                })
            }
        };
        reader.readAsDataURL(file);
    });

    //view document 
    $('.view-document').on('click', function() {
        var fileName = $(this).data('file');
        var preview = $('#documentPreviewView');
        var filePath = '../../../assets/documents/' + fileName;
        var fileExtension = fileName.split('.').pop().toLowerCase();

        if (fileName == '') {
            Swal.fire({
                icon: 'info',
                title: 'Preview not available',
                text: 'This user does not have any document.',
            })
            preview.hide();
        } else {
            preview.attr('src', filePath).show();
        }


        //dowload file
        $('#downloadDocument').attr('href', filePath);
        $('#downloadDocument').attr('download', fileName);

    });
</script>

<!-- delete function script -->
<script>
    //Delete member fuction 
    function deleteFamilyMember(memberId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../../action/StaffInfor/delete.php',
                    method: 'POST',
                    data: {
                        id: memberId
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire(
                                'Deleted!',
                                'Family member has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the family member: ' + response,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'AJAX Error!',
                            'There was an error processing your request.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    //Delete education fuction
    function deleteEducation(recordId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../../action/StaffInfor/educationDelete.php',
                    method: 'POST',
                    data: {
                        id: recordId
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire(
                                'Deleted!',
                                'Education record has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the education record: ' + response,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'AJAX Error!',
                            'There was an error processing your request.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    //Delete ducument fuction 
    function deleteDocument(documentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../../action/StaffInfor/documentDelete.php',
                    method: 'POST',
                    data: {
                        id: documentId
                    },
                    success: function(response) {
                        if (response.trim() == 'success') {
                            Swal.fire(
                                'Deleted!',
                                'Document has been deleted.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'There was an error deleting the document: ' + response,
                                'error'
                            );
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'AJAX Error!',
                            'There was an error processing your request.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>