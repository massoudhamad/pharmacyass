<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    #cadree label.error {
        color: red;
        font-weight: bold;
    }

    #Editcadree label.error {
        color: red;
        font-weight: bold;
    }

    .main {
        width: 600px;
        margin: 0 auto;
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        $("#example3").DataTable({
            "processing": true,
            "paging": true,
            dom: 'Blfrtip',
            bLengthChange: true,
            "lengthMenu": [
                [5, 10, 15, 25, 50, 100, -1],
                [5, 10, 15, 25, 50, 100, "All"]
            ],
            "iDisplayLength": 10,
            bInfo: false,
            "bAutoWidth": false,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [
                [1, 'asc']
            ]
        });
    });
</script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>
<?php

if ($_SESSION['msg'] == 'Data Inserted Successfully') { ?>
    <script>
        alertify.set('notifier', 'position', 'bottom-right');
        alertify.success("User Inserted Successfully");
    </script>
<?php
} elseif ($_SESSION['msg'] == 'Data Already Exist') { ?>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.warning("User Already Exist");
    </script>
<?php
} elseif ($_SESSION['msg'] == 'Something Went Wrong') { ?>
    <script>
        alertify.set('notifier', 'position', 'top-right');
        alertify.error("Ooops! Something Went Wrong");
    </script>

<?php
}
unset($_SESSION['msg']);

?>
<style>
    .alertify-notifier .ajs-message.ajs-error {
        color: white;
    }

    .alertify-notifier .ajs-message.ajs-success {
        color: white;
    }
</style>
<div class="card-content">
    <div class="card-body">
        <div class="card-header">
            <h2><i class="la la-server font-large-2 success"></i>Manage Users</h2>
        </div>
        <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <section id="add-patient">
                        <div class="pull-right" style="margin-right:50px"><br>
                            <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_record_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register User</a>
                        </div>
                    </section>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">

                    <table id="example3" cellspacing="0" width="100%">
                        <thead class="">
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $db = new DBHelper();
                            $cadre = $db->getRows('users', array('order_by' => 'userID ASC'));

                            if (!empty($cadre)) {
                                $count = 1;
                                foreach ($cadre as $cadre) {

                                    $firstname = $cadre['firstName'];
                                    $userID = $cadre['userID'];
                                    $userCode = $cadre['userID'];
                                    $middlename = $cadre['middleName'];
                                    $lastname = $cadre['lastName'];
                                    $fullname = $firstname . " " . $middlename . " " . $lastname;
                                    $role = $db->getData("roles", "role", "roleCode", $cadre['roleCode']);
                            ?>
                                    <tr>
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $cadre['email']; ?></td>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $cadre['phoneNumber']; ?></td>
                                        <td><?php echo $cadre['email']; ?></td>
                                        <td><?php echo $role; ?>
                                        </td>
                                        <td><?php if ($cadre['login'] == 1) {
                                                echo 'Active';
                                            } else {
                                                echo 'Blocked';
                                            } ?></td>
                                        <td>

                                            <?php if ($cadre['login'] == 1) { ?>
                                                <a class="btn  btn-danger btn-sm" title="block User" href="block_user.php?userID=<?php echo $cadre['userID'] ?>" style="color:white;"><i class="ft-shield"></i></a>
                                            <?php

                                            } else { ?>
                                                <a class="btn  btn-success btn-sm" title="Unblock User" href="unblock_user.php?userID=<?php echo $cadre['userID'] ?>" style="color:white;"><i class="ft-shield "></i></a>
                                            <?php
                                            }
                                            ?>

                                            <button class="btn  btn-info btn-sm" style="color:white;" data-toggle="modal" data-target="#cadre<?php echo $cadre['userID']; ?>"><i class="ft-edit default"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Modal zone -->
                                    <div class="modal animated zoomInRight text-left" id="cadre<?php echo $cadre['userID']; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form method="Post" action="action_users.php" id='cadree'>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="Cadre">User Name: </label>
                                                                    <input type="text" id="lname" name="uname" value="<?php echo $cadre['email']; ?>" class="form-control" tabindex="3" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="Cadre">First Name: </label>
                                                                    <input type="text" id="lname" name="fname" value="<?php echo $cadre['firstName']; ?>" class="form-control" tabindex="3" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="Cadre">Middle Name: </label>
                                                                    <input type="text" id="lname" name="mname" value="<?php echo $cadre['middleName']; ?>" class="form-control" tabindex="3" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="Cadre">Last Name: </label>
                                                                    <input type="text" id="lname" name="lname" value="<?php echo $cadre['lastName']; ?>" class="form-control" tabindex="3" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="Cadre">Phone: </label>
                                                                    <input type="text" id="lname" name="phone" value="<?php echo $cadre['phoneNumber']; ?>" class="form-control" tabindex="3" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label for="Cadre">Gender: </label>
                                                                    <select name='gender' class=form-control>
                                                                        <option value='<?php echo $cadre['gender']; ?>'>
                                                                            <?php echo $cadre['gender']; ?></option>
                                                                        <option value=''>select Here</option>
                                                                        <option value='Male'>Male</option>
                                                                        <option value='Female'>Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Cadre">Email: </label>
                                                                    <input type="text" id="lname" name="email" value="<?php echo $cadre['email']; ?>" class="form-control" tabindex="3" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label for="Cadre">Role Name: </label>

                                                                    <select name="primaryroleID" class="form-control">
                                                                        <?php
                                                                        $userRoless = $db->getRows('roles', array('order_by' => 'roleCode ASC'));
                                                                        foreach ($userRoless as $usroles) { ?>
                                                                            <option value='<?php echo $usroles['roleCode']; ?>'>
                                                                                <?php echo $db->getData("roles", "role", "roleCode", $usroles['roleCode']); ?>
                                                                            </option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br />

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                                                        <input type="hidden" name="action_type" value="edit" />
                                                        <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                                                        <input type="hidden" name="userID" value="<?php echo $cadre['userID']; ?>" class="btn btn-primary" tabindex="8">
                                                    </div>
                                            </div>
                                            </form>

                                        </div>
                                    </div>
                </div>

            </div>



        </div>
    </div>
    <!-- modal -->

<?php }
                            } else { ?>
<tr>
    <td colspan="4">No Users (s) found......</td>
<?php } ?>
</tbody>
</table>
</div>
</div>

<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="Post" action="action_users.php" id='cadree'>
                <div class="modal-body">
                    <input type="hidden" id="lname" name="hospitalCode" value="<?php echo  $hospital_code ?>" />
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">First Name: </label>
                                <input type="text" id="lname" name="fname" placeholder="Eg.Makame" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Middle Name: </label>
                                <input type="text" id="lname" name="mname" placeholder="Eg.Issa" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Last Name: </label>
                                <input type="text" id="lname" name="lname" placeholder="Eg.Makame" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Phone: </label>
                                <input type="text" id="lname" name="phone" placeholder="Eg.0776543211" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Gender: </label>
                                <select name='gender' class=form-control>
                                    <option value=''>select Here</option>
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Email: </label>
                                <input type="text" id="lname" name="email" placeholder="Eg.someone@gmail.com" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Role Name: </label>
                                <select name="roleID[]" multiple="multiple" class="form-control multiple1">
                                    <?php
                                    $role = $db->getClientRoles();
                                    if (!empty($role)) {
                                        echo "<option value=''>Select Here</option>";
                                        foreach ($role as $role) {
                                            $roleID = $role['roleCode'];
                                            $roleName = $role['role'];
                                    ?>
                                            <option value="<?php echo $roleID; ?>">
                                                <?php echo $roleName; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="row">
              <div class="col-lg-12">
                  <div class="form-group">
                    <label for="Cadre">Role: </label>
                    <input type="text" id="lname" name="email" value="<?php echo $cadre['email']; ?>" class="form-control" tabindex="3" />
                  </div>
              </div>
              </div> -->

                        <!-- <div class="row">
          <div class="col-lg-12">
                <div class="box-header">
                    <h3 class="box-title">Cadre Description</h3>
            <div class="box-body pad">
                <textarea class="textarea" name="description" placeholder="Please type your Cadre Description here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>-->
                    </div>
                </div>

                <br />

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" tabindex="9">Cancel</button>
                    <input type="hidden" name="action_type" value="add" />
                    <input type="submit" name="doSubmit" value="Save" class="btn btn-primary" tabindex="8">
                </div>
        </div>
        </form>

    </div>
</div>
</div>

</div>



</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Download the latest jquery.validate minfied version -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
    // Waiting until DOM is ready
    $().ready(function() {
        // Selecting the form and defining validation method
        $("#cadree").validate({

            // Passing the object with custom rules
            rules: {
                // login - is the name of an input in the form
                cadrename: {
                    required: true,
                    // Setting email pattern for email input

                },
                description: {
                    required: true,
                    // Setting minimum and maximum lengths of a password

                }
            },
            // Setting error messages for the fields
            messages: {
                cadrename: {
                    required: "This Field is Required",

                },
                description: {
                    required: "This Field is Required",

                },
            },
            // Setting submit handler for the form
            submitHandler: function(form) {
                form.submit();
            }
        });
    });


    $(document).ready(function() {
        // Selecting the form and defining validation method
        $("#Editcadre").validate({

            // Passing the object with custom rules
            rules: {
                // login - is the name of an input in the form
                cadrename: {
                    required: true,
                    // Setting email pattern for email input

                },
                description: {
                    required: true,
                    // Setting minimum and maximum lengths of a password

                }
            },
            // Setting error messages for the fields
            messages: {
                cadrename: {
                    required: "This Field is Required",

                },
                description: {
                    required: "This Field is Required",

                },
            },
            // Setting submit handler for the form
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
<script>
    // Waiting until DOM is ready
</script>
<!-- Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(".multiple1").select2({
        theme: "classic",
        placeholder: "Choose Role",
        allowClear: true
    });

    $(".multiple").select2({
        theme: "classic",
        placeholder: "Choose Role",
        allowClear: true
    });
</script>