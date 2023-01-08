<style type="text/css">
    #registerStaff label.error {
        color: red;
        font-weight: bold;
    }

    .main {
        width: 600px;
        margin: 0 auto;
    }
</style>
<?php $db = new DBHelper(); ?>
</script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>
<?php

session_start();
if ($_SESSION['exist']) { ?>
    <script>
        alertify.set('notifier', 'position', 'bottom-right');
        alertify.warning("User Already Exist");
    </script>
<?php
} elseif ($_SESSION['error']) { ?>
    <script>
        alertify.set('notifier', 'position', 'bottom-right');
        alertify.error("Something Went Wrong");
    </script>
<?php
}
unset($_SESSION['exist']);
unset($_SESSION['error']);
?>

<div class="card-content">
    <div class="card-body">
        <div class="card-header">
            <h2>Register Incoming Perchase</h2>
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
                                    <form class="form form-horizontal row-separator" enctype="multipart/form-data" action="action_recieve_items.php" method="POST" id='registerStaff'>
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="la la-user"></i> Item Informations</h4>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="firstName">Item Name:<span class="danger">*</span></label>
                                                    <select name="item_id" class="form-control">
                                                        <option value="">Select Here</option>
                                                        <?php
                                                        $db = new DBHelper();
                                                        $staff = $db->getRows('store', array('order_by' => 'item_id ASC'));
                                                        ?>
                                                        <?php if (!empty($staff))
                                                            foreach ($staff as $st) { { ?>
                                                                <option value="<?php echo $st['item_id'] ?>"><?php echo $st['item_name'] ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>

                                                    </select>
                                                    <div class="error" id="errorfirstname"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-control">Manufacturer</label>
                                                    <select name="manufacturer_id" class="form-control">
                                                        <option value="">Select Here</option>
                                                        <?php
                                                        $db = new DBHelper();
                                                        $staff = $db->getRows('manufacturer', array('order_by' => 'manufacturer_id ASC'));
                                                        ?>
                                                        <?php if (!empty($staff))
                                                            foreach ($staff as $st) { { ?>
                                                                <option value="<?php echo $st['manufacturer_id'] ?>"><?php echo $st['manufacturer_name'] ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>

                                                    </select>
                                                    <div class="error" id="errormiddlename"></div>

                                                </div>
                                                <div class="col-md-4">
                                                    <label for="lastname">Supplier: <span class="text-danger">*</span></label>
                                                    <select name="supplier_id" class="form-control">
                                                        <option value="">Select Here</option>
                                                        <?php
                                                        $db = new DBHelper();
                                                        $staff = $db->getRows('suppliers', array('order_by' => 'supplier_id ASC'));
                                                        ?>
                                                        <?php if (!empty($staff))
                                                            foreach ($staff as $st) { { ?>
                                                                <option value="<?php echo $st['supplier_id'] ?>"><?php echo $st['name'] ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>

                                                    </select>
                                                    <div class="error" id="errorlastname"></div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="label-control">Manufactured Date:<span class="danger">*</span></label>
                                                    <input type="date" class="form-control" id="physicalAddress" name="manu_date">
                                                    <div class="error" id="errorphysicalAddress"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-control">Expire Date;<span class="danger">*</span></label>
                                                    <input type="date" class="form-control" id="dob" name="expire_date">
                                                    <div class="error" id="dob"></div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="label-control" for="Contact Number">Item Type:<span class="danger">*</span></label>
                                                    <select name="item_type" class="form-control" id="medical_cat">
                                                        <option value="">Select Here</option>
                                                        <option value="Medical Item">Medical Item</option>
                                                        <option value="Non Medical Item">Non Medical Item</option>
                                                        <option value="Others">Others</option>

                                                    </select>
                                                    <div class="error" id="errorcont"></div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <!-- <div class="col-md-4" id="medy_category" style="display: none;" >
                                                    <label for="Cadree">Medical Item Category:<span class="danger">*</span></label>

                                                    <select name="medi_type" class="form-control">
                                                        <option value="">Select Here</option>
                                                        <?php
                                                        $db = new DBHelper();
                                                        $staff = $db->getRows('product_type', array('order_by' => 'product_type_id ASC'));
                                                        ?>
                                                        <?php if (!empty($staff))
                                                            foreach ($staff as $st) { { ?>
                                                                <option value="<?php echo $st['product_type_id'] ?>"><?php echo $st['product_type_name'] ?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?>

                                                    </select>
                                                    <div class="error" id="errorcadre">
                                                    </div>
                                                </div> -->
                                                <div class="col-md-4">
                                                    <label for="Cadree">Quantity:<span class="danger">*</span></label>
                                                    <input type="text" class="form-control" id="cont" name="quantity">
                                                    <div class="error" id="errorcont"></div>
                                                    <div class="error" id="errorcadre">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="Cadree">Cost:<span class="danger">*</span></label>
                                                    <input type="text" class="form-control" id="cont" name="price">
                                                    <div class="error" id="errorcont"></div>
                                                    <div class="error" id="errorcadre">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row" style="margin-left: 1px;">
                                            <div class="col-md-4">
                                                <button type="submit" name="action_type" value="add" class="btn btn-primary">Submit</button>
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


            <script type="text/javascript">
                function Validation() {
                    var firstname = document.getElementById('firstname').value;
                    var middlename = document.getElementById('middlename').value;
                    var lastname = document.getElementById('lastname').value;
                    var physicalAddress = document.getElementById('physicalAddress').value;
                    var dob = document.getElementById('dob').value;
                    var cont = document.getElementById('cont').value;
                    var cadre = document.getElementById('cadre').value;
                    var dept = document.getElementById('dept').value;
                    var sca = document.getElementById('sca').value;
                    var Dh = document.getElementById('Dh').value;
                    var licence = document.getElementById('licence').value;
                    var email = document.getElementById('email').value;
                    var fb = document.getElementById('fb').value;

                    var errorFirstname = document.getElementById('errorfirstname');
                    var errormiddlename = document.getElementById('errormiddlename');
                    var errorlastname = document.getElementById('errorlastname');
                    var errorphysicalAddress = document.getElementById('physicalAddress');
                    var errordob = document.getElementById('errordob');
                    var errorcont = document.getElementById('errorcont');
                    var errorcadre = document.getElementById('errorcadre');
                    var errordept = document.getElementById('errordept');
                    var errorsca = document.getElementById('errorsca');
                    var errorDh = document.getElementById('errorDh');
                    var errorlicence = document.getElementById('errorlicence');
                    var erroremail = document.getElementById('erroremail');
                    var errorfb = document.getElementById('errorfb');
                    if (firstname == "") {
                        errorFirstname.innerHTML = 'This field is required';
                        errorFirstname.style.color = 'red';
                        return false;



                    } else if (middlename == "") {
                        errormiddlename.innerHTML = 'This field is required';
                        errormiddlename.style.color = 'red';
                        return false;

                    } else if (lastname == "") {
                        errorlastname.innerHTML = 'This field is required';
                        errorlastname.style.color = 'red';
                        return false;

                    } else if (physicalAddress == "") {
                        errorphysicalAddress.innerHTML = 'This field is required';
                        errorphysicalAddress.style.color = 'red';
                        return false;

                    } else if (dob == "") {
                        errordob.innerHTML = 'This field is required';
                        errordob.style.color = 'red';
                        return false;

                    }
                    if (cont == "") {
                        errorcont.innerHTML = 'This field is required';
                        errorcont.style.color = 'red';
                        return false;
                        //      }else if(cont){
                        //         errorcont.innerHTML = 'Only Numbers allowed';
                        //         errorcont.style.color = 'red'; 
                        //    return false; 
                    } else if (cadre == "") {
                        errorcadre.innerHTML = 'This field is required';
                        errorcadre.style.color = 'red';
                        return false;

                    } else if (dept == "") {
                        errordept.innerHTML = 'This field is required';
                        errordept.style.color = 'red';
                        return false;

                    } else if (sca == "") {
                        errorsca.innerHTML = 'This field is required';
                        errorsca.style.color = 'red';
                        return false;

                    } else if (Dh == "") {
                        errorDh.innerHTML = 'This field is required';
                        errorDh.style.color = 'red';
                        return false;

                    } else if (email == "") {
                        erroremail.innerHTML = 'This field is required';
                        erroremail.style.color = 'red';
                        return false;

                    } else if (licence == "") {
                        errorlicence.innerHTML = 'This field is required';
                        errorlicence.style.color = 'red';
                        return false;

                    } else if (fb == "") {
                        errorfb.innerHTML = 'This field is required';
                        errorfb.style.color = 'red';
                        return false;

                    }
                }
            </script>
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
                    $("#registerStaff").validate({

                        // Passing the object with custom rules
                        rules: {
                            // login - is the name of an input in the form
                            firstName: {
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
                            email: {
                                required: true,
                                email: true


                            }
                        },
                        // Setting error messages for the fields
                        messages: {
                            firstName: {
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

                            }
                        },
                        // Setting submit handler for the form
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>
            <script>
                $("#medical_cat").change(function() {
                    var data = $(this).val()
                    // alert(data);
                    if (data == 'Medical Item') {
                        $("#medy_category").show();
                    } else {
                        $("#medy_category").hide();

                        $("#doctorsAvailable").hide();
                    }


                });
            </script>