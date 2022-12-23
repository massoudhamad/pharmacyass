<style type="text/css">

  #changePassword label.error {
    color: red;
    font-weight: bold;
}
.main {
    width: 600px;
    margin: 0 auto;
}
</style>
    <!-- BEGIN: Content-->
    <br><br>
     <div class="container">
        <div class="content-header row mb-1">
            <div class="col-12">
                   <div  class="card-header">
                        <h2> <i class="la la-lock font-large-2 info"></i>Change Password</h2>
                    </div>
                </div>
            </div>
            <div class="content-body">
                        <div class="col-lg-12 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Reset Your Password</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form-horizontal" action="action_change_password.php" method="Post" id="changePassword">
                                            <fieldset class="form-group position-relative  has-icon-left">
                                                <input type="password" id="pwd_old" class="form-control" name="pwd_old" placeholder="Enter Current Password" required>
                                                <div class="form-control-position">
                                                    <i class="ft-lock"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type='password' id="password" class="form-control" name="pwd_new" placeholder=" Enter New Password" required>
                                                <div class="form-control-position">
                                                    <i class="ft-unlock"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type='password' id="confirm_password" class="form-control" name="pwd_new_confirm" placeholder="Confirm New Password" required>
                                                <div class="form-control-position">
                                                    <i class="ft-unlock"></i>
                                                </div>
                                            </fieldset>
                                            
                                            <!-- <button type="button"  name="doUpdate" value="Update" class="btn btn-outline-info btn-lg btn-block"><i class="ft-unlock"></i> Recover Password</button> -->
                                            <div class = "row">
                                            <fieldset class="form-group">
                                                <input type="hidden" name="userID" value="<?php echo $_SESSION['user_session'];?>">
                                                <input type="submit" name="doUpdate" value="Save" class="btn btn-outline-info btn-lg btn-block " style="float:right">
                                                
                                                <div class="form-control-position">
                                                    <i class="ft-unlock info"></i>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
    <!-- END: Content-->
    <script>
        $().ready(function() {
    // Selecting the form and defining validation method
    $("#changePassword").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            pwd_old : {
                required : true,
               
            },
            pwd_new : {
                required : true,
                
            },
            pwd_new_confirm : {
                required : true,
                equalTo : "#pwd_new"
                
            }
        
        },
        // Setting error messages for the fields
        messages: {
            pwd_old: {
                required: "This Field is Required",
               
            },
            pwd_new:{
                required: "This Field is Required",

            },
            pwd_new_confirm:{
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


