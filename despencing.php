<link rel="stylesheet" href="sweet/dist/sweetalert.css">
<script src="sweet/dist/sweetalert.min.js"></script>
<?php

$db = new DBHelper();
$today = date("Y-m-d");
$month = date("m");
$userID = $_SESSION['user_session'];
$roleCode = $_SESSION['role'];

?>
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
<style>
  #searchpp label.error {
    color: red;
    font-weight: bold;
  }

  .main {
    width: 600px;
    margin: 0 auto;
  }

  * {
    box-sizing: border-box;
  }

  body {
    font: 16px Arial;
  }

  .autocomplete {
    position: relative;
    display: inline-block;
  }

  input {
    border: 1px solid transparent;
    background-color: #f1f1f1;
    padding: 10px;
    font-size: 16px;
  }

  input[type=text] {
    background-color: #f1f1f1;
    width: 100%;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    top: 100%;
    left: 0;
    right: 0;
  }

  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff;
    border-bottom: 1px solid #d4d4d4;
  }

  .autocomplete-items div:hover {
    background-color: #e9e9e9;
  }

  .autocomplete-active {
    background-color: DodgerBlue !important;
    color: #ffffff;
  }
</style>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="alertifyjs/alertify.js"></script>
<script src="alertifyjs/alertify.min.js"></script>
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

<script src="Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<div class="content-wrapper">
  <div class="content-header row mb-1">
    <div class="col-12">
      <div class="card-header">
        <h2> <i class="la la-dashboard font-large-2 success"></i> Despencing</h2>
      </div>
    </div>
  </div>
  <div class="content-body">
    <!-- Hospital Info cards -->


    <!-- Appointment Bar Line Chart -->
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <form method="POST" action="" id='searchpp'>
                <div class="row">
                  <div class="col-md-6">
                    <div class="autocomplete">
                      <label><br></label><input type="text" name="searchQuery" id="search" class="form-control" placeholder="Search Product" autocomplete="off" style="width: 450px;" />
                      <div id="autocomplete"></div>
                    </div>
                  </div>
                  <div class="col-md-3 pull-left">
                    <label><br></label>
                    <input type="submit" name="doSearch" value="Search Patient" class="btn btn-info form-control" style="color:white;">

                  </div>
                </div>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Appointment Bar Line Chart Ends -->

  </div>
  <div class="card" style="margin-top:40px;">
    <div class="">
      <div class="col-lg-12">
        <?php
        $db = new DBhelper();
        if (isset($_POST['doSearch']) == "Search Patient") {
          $searchText = $_POST['searchQuery'];
          $search = $db->searchItems($searchText);
          // var_dump(($search));
          if (!empty($search)) {
        ?>
            <h3 style="margin-top:20px;margin-bottom:20px;">Search Result</h3>
            <table id="patientdata" class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th>S/n No.</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Expire Date</th>
                  <th>status</th>
                  <th>Action</th>
                  <!-- <th>Address</th>
                                <th>Phone Number</th>
                                <th>Health Scheme</th>
                                <th>Add Visit</th> -->

                </tr>
              </thead>
              <tbody>
                <?php
                $count = 0;
                foreach ($search as $patient) {
                  $item_id = $patient['item_id'];
                  $item_name = $patient['item_name'];
                  $Quantity = $patient['quantity'];
                  $expire_date = $patient['expire_date'];
                  $status = $patient['status'];
                  // $dob=$patient['dob'];
                  // $sex=$patient['sex'];
                  // $address=$patient['address'];
                  // $telNumber=$patient['telNumber'];
                  // $healthSchemeID=$patient['paymenttypeCode'];
                  // $name="$fname $mname $lname";
                  // $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$healthSchemeID);
                }
                ?>


                <tr>
                  <td><?php echo $count + 1 ?></td>
                  <td><?php echo $item_name ?></td>
                  <td><?php echo $Quantity ?></td>
                  <td><?php echo $expire_date ?></td>
                  <td><?php echo $item_name ?></td>
                  <td>
                    <a class="btn btn-info round btn-sm" data-toggle="modal" data-target="#despencing_modal_modal<?php echo $item_id; ?>" style="color:white;"><i class="la la-plus font-small-2"></i>Discpence</a>
                  </td>

                </tr>
                <div class="modal animated zoomInRight text-left" id="despencing_modal_modal<?php echo $item_id; ?>" tabindex="-1" aria-hidden="true">
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
              <?php

            } else { ?>
                <h3 style="margin-top:20px;margin-bottom:20px;">Search Result</h3>
                <?php
                echo '<tr><td colspan="5">No Patient(s) found......</td></tr>'; ?>
              <?php } ?>

              </tbody>
            </table>

          <?php
        }
          ?>
      </div>
    </div>

    <!--end of search result-->
  </div>
</div>
</div>
</div>






<!-- end doctor-->

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php
$_POST["searchQuery"] = "";
$patients = $db->searchMedicineAutocomplete($_POST["searchQuery"]);
$item = json_encode($patients);
//}
?>
<script>
  var data = <?php echo $item; ?>

  console.log(data)

  //var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) {
        return false;
      }
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
            /*insert the value for the autocomplete text field:*/
            inp.value = this.getElementsByTagName("input")[0].value;
            /*close the list of autocompleted values,
            (or any other open lists of autocompleted values:*/
            closeAllLists();
          });
          a.appendChild(b);
        }
      }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
    });

    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }

    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function(e) {
      closeAllLists(e.target);
    });
  }
  autocomplete(document.getElementById("search"), data);
</SCRIPT>
</script>
</body>

</html>