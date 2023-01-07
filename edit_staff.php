<style type="text/css">
#EditStaff label.error {
    color: red;
    font-weight: bold;
}

.main {
    width: 600px;
    margin: 0 auto;
}
</style>
<?php
$db = new DBHelper();
$staffId=$db->my_simple_crypt($_GET['id'],'d');
//$patients = $db->getPatientEdit();
$staff = $db->getRows('staff',array('where'=>array('staffId'=>$staffId)));
if(!empty($staff))
{
    $x=0;
    foreach ($staff as $st)
    {
        $x++;
        $staffId=$st['staffId'];
        $fname=$st['firstname'];
        $mname=$st['middlename'];
        $lname=$st['lastname'];
        $physcalAddress=$st['physicalAddress'];
        $dob=$st['dateofbirth'];
        $profile=$st['profile'];
        $phone=$st['tell'];
        $eduLevel=$st['eduLevel'];
        $graduationDate=$st['graduationDate'];
        $award=$st['award'];
        $email=$st['email'];
        $facebook=$st['facebook'];
        $profile=$st['profile'];
        
                                                         
        
       
       
    }
}
?>
<?php $db=new DBHelper();?>
<div class="card-content">
    <div class="card-body">
        <div class="card-header">
            <h2>Staff Registration</h2>
        </div>
        <br><br>
        <div class="container-fluid">
            <!-- Row separator layout section start -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body">
                            <div class="container-fluid">
                                    <form class="form form-horizontal row-separator" enctype="multipart/form-data" action="action_addstaff.php" method="POST" id='registerStaff'>
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-user"></i> Personal Info</h4>
                                            <div class="responsive" style="width:150px;float:right">
                                                <center>Profile Picture:</center>
                                                <div class="image-box" style="height:175px;  ">
                                                    <img alt="Profile picture" src="index.png" id="profile" style="height:150px;" class="card-img-top mb-1 patient-img img-fluid rounded-circle">
                                                    <input type="file" name="profile" id="image">
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="firstName">First Name:<span class="danger">*</span></label>
                                                    <input type="text" class="form-control required"  value="<?php echo $fname ?>"  id="firstname" name="firstName" />
                                                    <div class="error" id="errorfirstname"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-control">Middle Name</label>
                                                    <input type="text" class="form-control" id="middlename" value="<?php echo $mname ?>" name="middleName">
                                                    <div class="error" id="errormiddlename"></div>

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="lastname">Last Name: <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control required" value="<?php echo $lname ?>" name="lastName" id="lastname">
                                                    <div class="error" id="errorlastname"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="label-control">Physical Address:<span class="danger">*</span></label>
                                                    <input type="text" class="form-control" id="physicalAddress" value="<?php echo $physcalAddress ?>" name="physicalAddress">
                                                    <div class="error" id="errorphysicalAddress"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-control">Date of Birth;<span class="danger">*</span></label>
                                                    <input type="date" class="form-control" id="dob" value="<?php echo $dob ?>" name="dateofbirth">
                                                    <div class="error" id="dob"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-control" for="Contact Number">Contact
                                                        Number:<span class="danger">*</span></label>
                                                    <input type="text" class="form-control" id="cont" value="<?php echo $phone ?>" name="tell">
                                                    <div class="error" id="errorcont"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="Cadree">Email:<span class="danger">*</span></label>
                                                    <input type="text" class="form-control" id="cont" value="<?php echo $email ?>" name="email">
                                                    <div class="error" id="errorcont"></div>
                                                    <div class="error" id="errorcadre">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <h4 class="form-section"><i class="la la-book"></i> Highest Education Level</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="firstName">Education Level:<span class="danger">*</span></label>
                                                    <select name="eduLevel" class="form-control">
                                                        <option value="">Select Education Level</option>
                                                        <option value="Certification">Certification</option>
                                                        <option value="Diploma">Diploma</option>
                                                        <option value="Bachelor">Bachelor</option>
                                                        <option value="Master">Master</option>
                                                    </select>
                                                    <div class="error" id="errorfirstname"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-control">Award</label>
                                                    <input type="text" class="form-control" id="middlename"  value="<?php echo $award ?>" name="award" placeholder="Pharmacist">
                                                    <div class="error" id="errormiddlename"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="lastname">Graduation Date: <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control required" value="<?php echo $graduationDate ?>" name="graduationDate" id="lastname">
                                                    <div class="error" id="errorlastname"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <h4 class="form-section"><i class="la la-book"></i> Authentication</h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label for="Cadree">Role:<span class="danger">*</span></label>
                                                <!-- <select name="cadreID" class="form-control chosen-select"> -->
                                                <select name="roleId" class="form-control">
                                                    <option value="">Select Role</option>
                                                    <option value="1">Super Administartor</option>
                                                    <option value="2">Owner</option>
                                                    <option value="3">Seller</option>
                                                </select>
                                                <div class="error" id="errorcadre">
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <div class="row" style="margin-left: 1px;">
                                            <div class="col-md-4">
                                                <button type="submit" name="action_type" value="addstaff" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div>
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
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#profile').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function() {
    readURL(this);
});
</script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Download the latest jquery.validate minfied version -->
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

<script>
$().ready(function() {
    // Selecting the form and defining validation method
    $("#EditStaff").validate({

        // Passing the object with custom rules
        rules: {
            // login - is the name of an input in the form
            firstName: {
                required: true,

            },
            middleName: {
                required: true,

            },
            lastName: {
                required: true,

            },
            physicalAddress: {
                required: true,

            },

            dateofbirth: {
                required: true,


            },

            tell: {
                required: true,
                digits: true,

            },

            cadreID: {
                required: true,
                digits: true,

            },

            deptID: {
                required: true,
                digits: true,

            },

            employeeId: {
                required: true,

            },
            schoolAttended: {
                required: true,


            },

            degreeHeld: {
                required: true,


            },

            Licence: {
                required: true,

            },
            email: {
                required: true,
                email: true,

            }
        },
        // Setting error messages for the fields
        messages: {
            firstName: {
                required: "This Field is Required",

            },
            middleName: {
                required: "This Field is Required",

            },
            lastName: {
                required: "This Field is Required",

            },
            physicalAddress: {
                required: "This Field is Required",

            },
            dateofbirth: {
                required: "This Field is Required",

            },
            tell: {
                required: "This Field is Required",

            },
            cadreID: {
                required: "This Field is Required",

            },
            deptID: {
                required: "This Field is Required",


            },
            employeeId: {
                required: "This Field is Required",

            },
            schoolAttended: {
                required: "This Field is Required",


            },
            degreeHeld: {
                required: "This Field is Required",

            },
            email: {
                required: "This Field is Required",


            },
            Licence: {
                required: "This Field is Required",


            }
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>