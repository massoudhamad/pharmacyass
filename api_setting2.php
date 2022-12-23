<style>
#user label.error {
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
    $("#example").DataTable({
        paging: true,
        dom: 'Blfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ]
    });
});
</script>
<div class="card-content">
    <div class="card-body">
        <div class="card-header">
            <h2><i class="la la-server font-large-2 success"></i>API Setting</h2>
        </div>
        <div class="tab-content">
            <div class="row">
                <div class="col-md-12">
                    <section id="add-patient">
                        <div class="pull-right" style="margin-right:50px"><br>
                            <a class="btn btn-info  btn-sm" data-toggle="modal" data-target="#add_new_record_modal"
                                style="color:white;"><i class="la la-plus font-small-2"></i>Add API</a>
                        </div>
                    </section>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-12">
                    <?php  
                    $db = new DBHelper();
                   
                    $api_setting = $db->getRows('api_setting',array('order_by'=>'setting_id ASC'));
                    ?>
                    <table id="example" cellspacing="0" width="100%">
                        <thead class="">
                            <tr>
                                <th>No.</th>
                                <th>Token Type</th>
                                <th>Client ID </th>
                                <th>Token</th>
                                <th>Source</th>
                                <th>Scope</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
            if(!empty($api_setting)){ $count = 1; foreach($api_setting as $api){ 
                          
                         
                        ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php if($api['token_type'] == ""){echo '-';}else{echo  $api['token_type'];}?></td>
                                <td><?php if($api['client_id'] == ""){echo '-';}else{echo  $api['client_id'];}?></td>
                                <td><?php if($api['token'] == ""){echo '-';}else{echo  $api['token'];}?></td>
                                <td><?php if($api['source'] == ""){echo '-';}else{echo  $api['source'];}?></td>
                                <td><?php if($api['scope'] == ""){echo '-';}else{echo  $api['scope'];}?></td>
                                <td><?php if($api['URL'] == ""){echo '-';}else{echo  $api['URL'];}?></td>
                                <td>

                                    <button class="btn  btn-info btn-sm" style="color:white;" data-toggle="modal"
                                        data-target="#cadre<?php echo $cadre['userID'];?>"><i
                                            class="ft-edit default"></i>Update</button>
                                </td>
                            </tr>
                            <!-- Modal zone -->
                            <div class="modal animated zoomInRight text-left" id="cadre<?php echo $cadre['userID'];?>"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Add New Record</h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <form method="Post" action="action_users.php" id='cadree'>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="Cadre">Username: </label>
                                                            <input type="text" id="usname" name="uname"
                                                                value="<?php echo $cadre['userName'];?>"
                                                                class="form-control" tabindex="3" />
                                                            <div class="error" id="erroruname"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="Cadre">Token: </label>
                                                            <input type="text" id="fname" name="fname"
                                                                value="<?php echo $cadre['firstName'];?>"
                                                                class="form-control" tabindex="3" />
                                                            <div class="error" id="errorname"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="Cadre">Token Type: </label>
                                                            <input type="text" id="mname" name="mname"
                                                                value="<?php echo $cadre['middleName'];?>"
                                                                class="form-control" tabindex="3" />
                                                            <div class="error" id="errormname"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="Cadre">Source: </label>
                                                            <input type="text" id="lname" name="lname"
                                                                value="<?php echo $cadre['lastName'];?>"
                                                                class="form-control" tabindex="3" />
                                                            <div class="error" id="errorlname"></div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="Cadre">URL: </label>
                                                            <input type="text" id="email" name="email"
                                                                value="<?php echo $cadre['email'];?>"
                                                                class="form-control" tabindex="3" />
                                                            <div class="error" id="erroremail"></div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <br />

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"
                                                        tabindex="9">Cancel</button>
                                                    <input type="hidden" name="action_type" value="edit" />
                                                    <input type="submit" name="doSubmit"
                                                        onclick="return userValidation()" value="Save"
                                                        class="btn btn-primary" tabindex="8">
                                                    <input type="HIDDEN" name="userID"
                                                        value="<?php echo $cadre['userID'];?>" class="btn btn-primary"
                                                        tabindex="8">
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

        <?php } }else{ ?>
        <tr>
            <td colspan="8">No API (s) found......</td>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form method="Post" action="action_api_setting.php" id='user'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Token Type: </label>
                                <select name="tokenType" id='tokenType' class='form-control'>
                                    <option value="oAuth">oAuth</option>
                                    <option value="token">Token</option>
                                    <option value="Auth">Auth</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="oAuth">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="C">Client ID: </label>
                                    <input type="text" id="mname" name="clientID" placeholder="Eg.Ali"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadr">Client Secret: </label>
                                    <input type="text" id="email" name="secret" placeholder="Eg.example@someone.com"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadr">Scope: </label>
                                    <input type="text" id="email" name="scope" placeholder="Eg.example@someone.com"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadr">URL: </label>
                                    <input type="text" id="email" name="url" placeholder="Eg.example@someone.com"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="AuthToken" style="display:None">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="C">Client ID: </label>
                                    <input type="text" id="mname" name="clientID" placeholder="Eg.Ali"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadr">Token: </label>
                                    <input type="text" id="email" name="token" placeholder="Eg.example@someone.com"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadr">Source: </label>
                                    <input type="text" id="email" name="source" placeholder="Eg.example@someone.com"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="Cadr">URL: </label>
                                    <input type="text" id="email" name="url" placeholder="Eg.example@someone.com"
                                        class="form-control" tabindex="3" />
                                </div>
                            </div>
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
<script>
function userValidation() {
    var usname = document.getElementById('usname').value;
    var fname = document.getElementById('fname').value;
    var mname = document.getElementById('mname').value;
    var lname = document.getElementById('lname').value;
    var phone = document.getElementById('phone').value;
    var email = document.getElementById('email').value;
    var status = document.getElementById('status').value;

    var erroruname = document.getElementById('erroruname');
    var errorname = document.getElementById('errorname');
    var errormname = document.getElementById('errormname');
    var errorlname = document.getElementById('errorlname');
    var errorphone = document.getElementById('errorphone');
    var erroremail = document.getElementById('erroremail');
    if (usname == '') {
        erroruname.innerHTML = 'This field is required';
        erroruname.style.color = 'red';
        return false;

    } else if (fname == '') {
        errorname.innerHTML = 'This field is required';
        errorname.style.color = 'red';
        return false;

    } else if (mname == '') {
        errormname.innerHTML = 'This field is required';
        errormname.style.color = 'red';
        return false;


    } else if (phone == '') {
        errorphone.innerHTML = 'This field is required';
        errorphone.style.color = 'red';
        return false;


    } else if (email == '') {
        erroremail.innerHTML = 'This field is required';
        erroremail.style.color = 'red';
        return false;

    }
}
</script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Download the latest jquery.validate minfied version -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
<script>
// Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#user").validate({

        // Passing the object with custom rules
        rules: {
            // login - is the name of an input in the form
            fname: {
                required: true,
                // Setting email pattern for email input

            },
            mname: {
                required: true,
                // Setting minimum and maximum lengths of a password

            },
            lname: {
                required: true,
                // Setting minimum and maximum lengths of a password

            },
            phone: {
                required: true,
                digits: true
                // Setting minimum and maximum lengths of a password

            },
            email: {
                required: true,
                email: true
                // Setting minimum and maximum lengths of a password

            },
        },
        // Setting error messages for the fields
        messages: {
            fname: {
                required: "This Field is Required",

            },
            mname: {
                required: "This Field is Required",

            },
            lname: {
                required: "This Field is Required",

            },
            phone: {
                required: "This Field is Required",

            },
            email: {
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




<script type="text/javascript">
$(document).change(function() {
    $("#tokenType").on('click', function() {
        var tokenType = $(this).val();
        if (tokenType == 'token' | tokenType == 'Auth') {
            $('#AuthToken').show()
            $('#oAuth').hide()
        } else {
            $('#oAuth').show()
            $('#AuthToken').hide()

        }
        //alert(tokenType);




    });
});
</script>