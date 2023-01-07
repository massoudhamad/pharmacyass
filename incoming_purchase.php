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
                <h2> <i class="la la-user-plus font-large-2 success"></i>List of Registered Medicines</h2>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="pull-right" style="margin-right:40px">
                            <a href="index3.php?sp=receive_items" class="btn btn-info round btn-sm" style="color:white;"><i class="la la-plus font-small-2"></i>Register Product</a>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="patientdata" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width:150px;">Product Name</th>
                                    <th>Quantity</th>
                                    <th>Manufactured By</th>
                                    <th>Manufactured Date</th>
                                    <th>Expire Date</th>
                                    <!-- <th>Status</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db = new DBHelper();
                                $staff = $db->getRecievedItems();
                                // var_dump($staff)
                                ?>
                                <?php if (!empty($staff)) {

                                    $x = 0;
                                    foreach ($staff as $st) {
                                        $x++;
                                        
                                        $item_id = $st['item_id'];
                                        $recieved_items_id = $st['recieved_items_id'];
                                        $item_name = $st['item_name'];
                                        $quantity = $st['quantity'];
                                        $expire_date = $st['expire_date'];
                                        $manufacturer_id = $st['manufacturer_id'];
                                        $status = $st['status'];
                                        $manufactured_date = $st['manufactured_date'];
                                        $phone = $st['man_phone_no'];
                                        $manufacturer_id = $st['manufacturer_id'];



                                ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $item_name; ?></td>
                                            <td><?php echo $quantity; ?></td>
                                            <td><?php echo $db->getData('manufacturer', 'manufacturer_name', 'manufacturer_id', $manufacturer_id); ?></td>
                                            <td><?php echo $manufactured_date; ?></td>
                                            <td><?php echo $expire_date; ?></td>
                                            <!-- <td><?php echo $phone; ?></td> -->
                                            <td>
                                                <a type="button" class="btn  btn-info btn-sm" title="Update Staff Information" href="index3.php?sp=edit_receive_items&id=<?php echo $db->my_simple_crypt($recieved_items_id, 'e') ?>"><i class="ft-edit"></i></a>
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

<!-- <div class="modal fade" id="add_new_supplier_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add Incoming Purchase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="Post" action="action_users.php" id='cadree'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Supplier Name: </label>
                                <input type="text" id="lname" name="fname" placeholder="Eg.Makame" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Item Type: </label>
                                <input type="text" id="lname" name="mname" placeholder="Eg.Issa" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Item Type: </label>
                                <input type="text" id="lname" name="mname" placeholder="Eg.Issa" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">manufacturer: </label>
                                <input type="text" id="lname" name="mname" placeholder="Eg.Issa" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre"> Supplier Address: </label>
                                <input type="text" id="lname" name="lname" placeholder="Eg.Makame" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Supplier Email: </label>
                                <input type="text" id="lname" name="phone" placeholder="Eg.0776543211" class="form-control" tabindex="3" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Cadre">Supplier Phone Number: </label>
                                <input type="text" id="lname" name="email" placeholder="Eg.someone@gmail.com" class="form-control" tabindex="3" />
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
</div> -->