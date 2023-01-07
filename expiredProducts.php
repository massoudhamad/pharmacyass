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
                <h2> <i class="la la-user-plus font-large-2 success"></i>List of Items Expired in Store</h2>
            </div>
        </div>
    </div>
    <div class="content-body">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <!-- <div class="pull-right" style="margin-right:40px">
                            <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#add_new_supplier_modal" style="color:white;"><i class="la la-plus font-small-2"></i>Register Item</a>
                        </div> -->

                    </div>
                    <div class="table-responsive">
                        <table id="patientdata" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th style="width:150px;">Item Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Expired Date</th>
                                    <th>Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $db = new DBHelper();
                                $todat = date("Y-m-d");
                                $staff = $db->getExpiredItems($today);

                                // $staff = $db->getRows('store', array('order_by' => 'item_id ASC'));
                                ?>
                                <?php if (!empty($staff)) {

                                    $x = 0;
                                    foreach ($staff as $st) {
                                        $x++;
                                        $item_id = $st['item_id'];
                                        $item_name = $st['item_name'];
                                        $item_quantity = $st['store_quantity'];
                                        $item_description = $st['item_description'];
                                        $expire_date = $st['expire_date'];

                                        $status = $st['status'];


                                ?>
                                        <tr>
                                            <td><?php echo $x; ?></td>
                                            <td><?php echo $item_name; ?></td>
                                            <td><?php echo $item_description; ?></td>
                                            <td><?php if($item_quantity != ''){echo $item_quantity;}else{echo '-';} ?></td>
                                            <td><?php echo $expire_date; ?></td>
                                            <td><?php if ($expire_date < $today) {
                                                    echo 'Expired';
                                                } else {
                                                    'Not Expired';
                                                } ?></td>
                                            <!-- <td>
                                                <a type="button" class="btn  btn-info btn-sm" title="Update Staff Information" href="index3.php?sp=edit_staff&id=<?php echo $db->my_simple_crypt($staffId, 'e') ?>"><i class="ft-edit"></i></a>
                                                <?php
                                                if ($status == 1) { ?>
                                                    <a type="button" class="btn  btn-danger btn-sm" title="Update Staff Information" href="index3.php?sp=edit_staff&id=<?php echo $db->my_simple_crypt($staffId, 'e') ?>"><i class="ft-shield"></i></a>
                                                <?php

                                                } else { ?>
                                                    <a type="button" class="btn  btn-success btn-sm" title="Update Staff Information" href="index3.php?sp=edit_staff&id=<?php echo $db->my_simple_crypt($staffId, 'e') ?>"><i class="ft-shield"></i></a>

                                                <?php

                                                }
                                                ?>
                                            </td> -->
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
                <h4 class="modal-title" id="myModalLabel">Add New Item </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="Post" action="action_store.php" id='cadree'>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Item Name: </label>
                                <input type="text" id="lname" name="item_name" placeholder="Eg.Panadol" class="form-control" tabindex="3" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="Cadre">Item Description: </label>
                                <textarea type="text" id="lname" name="item_description" placeholder="Eg.This is Panadol description Here" class="form-control" tabindex="3"></textarea>
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