<style>
    .main {
        width: 600px;
        margin: 0 auto;
    }

    .alertify-notifier .ajs-message.ajs-error {
        color: white;
    }

    .alertify-notifier .ajs-message.ajs-success {
        color: white;
    }
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#patientdata").DataTable({
            dom: 'Blfrtip',
            paging: true,
            buttons: [{
                    extend: 'excel',
                    title: 'List of all Staff',
                    footer: false,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7]
                    }
                }, ,
                {
                    extend: 'pdfHtml5',
                    title: 'List of all Staff',
                    footer: true,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5, 6, 7]
                    },

                }

            ],
            order: []
        });
    });
</script>
</script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>
<?php

session_start();
if ($_SESSION['msg']) { ?>
    <script>
        alertify.set('notifier', 'position', 'bottom-right');
        alertify.success("Staff Registered Successfully");
    </script>
<?php
}
unset($_SESSION['msg']);
?>


<div class="content-wrapper">
    <div class="content-header row mb-1">
        <div class="col-12">
            <div class="card-header">
                <h2> <i class="la la-user-plus font-large-2 success"></i>List of Registered Manufacturers</h2>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="pull-right" style="margin-right:40px">
                            <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_supplier_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Supplier</a>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="patientdata" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width:150px;">Supplier</th>
                                    <th>Address</th>
                                    <th>Eamil</th>
                                    <th>Contact Person</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db = new DBHelper();
                                $staff = $db->getRows('manufacturer', array('order_by' => 'manufacturer_id ASC'));
                                ?>
                                <?php if (!empty($staff)) {

                                    $x = 0;
                                    foreach ($staff as $st) {
                                        $x++;
                                        $manufacturer_name = $st['manufacturer_name'];
                                        $contact_person = $st['contact_person'];
                                        $email = $st['man_email'];
                                        $man_website = $st['man_website'];
                                        $status = $st['status'];
                                        $address = $st['address_man'];
                                        $phone = $st['man_phone_no'];
                                        $manufacturer_id = $st['manufacturer_id'];
                                        


                                ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $name;?></td>
                                            <td><?php echo $address; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><?php echo $contact_person; ?></td>
                                            <td><?php echo $phone; ?></td>
                                            <td>
                                                <a type="button" class="btn  btn-info btn-sm" title="Update Staff Information" href="index3.php?sp=edit_staff&id=<?php echo $db->my_simple_crypt($staffId, 'e') ?>"><i class="ft-edit"></i></a>
                                            </td>
                                        </tr>
                                <?php }
                                }
                                ?>

                            </tbody>

                        </table>



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="add_new_supplier_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add New Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="Post" action="action_manufacturer.php" id='cadree'>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Manufacturer Name: </label>
                                <input type="text" id="lname" name="manufacturer_name" placeholder="Eg.Makame" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Contat Person: </label>
                                <input type="text" id="lname" name="mname" placeholder="Eg.Issa" class="form-control" tabindex="3" />
                            </div>
                        </div> -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre"> Manufacture Address: </label>
                                <input type="text" id="lname" name="address_man" placeholder="Eg.Makame" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Manufacture Email: </label>
                                <input type="text" id="lname" name="man_email" placeholder="Eg.0776543211" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Manufacture Phone Number: </label>
                                <input type="text" id="lname" name="man_phone_no" placeholder="Eg.someone@gmail.com" class="form-control" tabindex="3" />
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