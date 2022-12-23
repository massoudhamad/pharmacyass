<?php
ini_set ('display_errors', 1);
error_reporting (E_ALL | E_STRICT);
$db = new DBHelper();
$hospitalCode=$db->getData("users",'hospitalCode','userID',$userID);
?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#schemeID").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue==2){
                $(".2").not("." + optionValue).hide();
                $("." + optionValue).show();
                $(".4").hide();
            }
            else if(optionValue==4)
            {
                $(".4").not("." + optionValue).hide();
                $("." + optionValue).show();
                $(".2").hide();
            }
            else{
                $(".2").hide();
                $(".4").hide();
            }
        });
    }).change();
});
</script>

<div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="company">
                                                                    Health Scheme:
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <select name="schemeID" id="schemeID"  class="form-control" required>
                                                                    <?php
                                                                    $healthScheme = $db->getRows('healthscheme',array('order_by'=>'healthScheme DESC'));
                                                                    if(!empty($healthScheme)){
                                                                        echo "<option value=''>Select Here</option>";
                                                                        $count = 0; foreach($healthScheme as $hscheme){ $count++;
                                                                            $healthSchemeID=$hscheme['healthSchemeID'];
                                                                            $healthScheme=$hscheme['healthScheme'];
                                                                            ?>
                                                                            <option value="<?php echo $healthSchemeID;?>"><?php echo $healthScheme;?></option>
                                                                        <?php }}?>
 -->
                                                                <!-- <option value="government">Government Scheme</option>
                                                                    <option value="cash">Others(Cash)</option>
                                                                    <option value="credits">Credits</option>
                                                                <option value="others">Insurance</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                
                                                <div class="2">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="amount">
                                                                     Insaurance Company:
                                                                </label>
                                                                <select name="insurerID" id=""  class="form-control">
                                                                    <?php
                                                                    $insurerCompany = $db->getRows('insurer_company',array('where'=>array('insurerTypeID'=>1),'order_by'=>'insurerName ASC'));
                                                                    if(!empty($insurerCompany)){
                                                                        echo "<option value=''>Select Here</option>";
                                                                        $count = 0; foreach($insurerCompany as $icompany){ $count++;
                                                                        $insurerID=$icompany['insurerID'];
                                                                        $insurerName=$icompany['insurerName'];
                                                                    ?>
                                                                    <option value="<?php echo $insurerID;?>"><?php echo $insurerName;?></option>
                                                                    <?php }}?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="MiddleName">Membership Number</label>
                                                             <input type="text" name="membershipNumber"  class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="MiddleName">Card Holder Name</label>
                                                             <input type="text" name="cardHolderName"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="MiddleName">Card Holder Number</label>
                                                             <input type="text" name="cardHolderNumber"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="4">  
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="FirstName">Credits Company/Personal</label>
                                                            <select name="insurerID" id=""  class="form-control">
                                                                <?php
                                                                $insurerCompany = $db->getRows('insurer_company',array('where'=>array('insurerTypeID'=>2),'order_by'=>'insurerName ASC'));
                                                                if(!empty($insurerCompany)){
                                                                    echo "<option value=''>Select Here</option>";
                                                                    $count = 0; foreach($insurerCompany as $icompany){ $count++;
                                                                        $insurerID=$icompany['insurerID'];
                                                                        $insurerName=$icompany['insurerName'];
                                                                        ?>
                                                                        <option value="<?php echo $insurerID;?>"><?php echo $insurerName;?></option>
                                                                    <?php }}?>
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="MiddleName">Membership Number</label>
                                                             <input type="text" name="membershipNumber"  class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="MiddleName">Card Holder Name</label>
                                                             <input type="text" name="cardHolderName"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label for="MiddleName">Card Holder Number</label>
                                                             <input type="text" name="cardHolderNumber"  class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                
                                                    
                                        