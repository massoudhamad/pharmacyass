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
<script type="text/javascript" src="js/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div class="card-body">
        <div class="card">
             <div  class="card-header">
                 <h2> <i class="la la-phone font-large-2 warning"></i>  Book Appointment</h2>
            </div>
        </div>
        <div class="col-md-12">
        <div class="card-header">
        <div class="content-header-left col-md-12 col-12 mb-2">
               
            <form name="" method="POST" action="" id='searchpp'>
            <div class="row">
                <div class="col-lg-5">
                <div class="autocomplete" style="width:360px;">
                    <label><br></label><input type="text" name="searchQuery" class="form-control"  id="search" placeholder="Search Registered Patient to Book an Appointment" autocomplete="off">
                    </div> 
                </div>
                <div class="col-lg-0">
                    <label><br></label>
                    <input type="submit" name="doSearch" value="Search Patient" class="btn btn-info form-control" style="color:white;">

                    
                </div>
                <div class="col-lg-3">
                <section id="add-patient">
                    <div class="pull-right" style="margin-left:1100px;">
                         <a href="index3.php?sp=add_booked_patient" class="btn btn-info" style="color:white;margin-top:30px;width:200px;" id="search"><i class="la la-plus font-small-2"></i> Register New Patient</a>
                    </div>
                  </section>
                   
                </div>

                <div class="col-lg-2">
               
                   
                </div>
                
               
            </div>
            </form>
        </div>

        <!--search result-->
        <!-- <div class="row">
            <div class="col-md-12">
                <br>
            </div>
        </div> -->
        
        <div class="card" style="margin-top:40px;">
        <div class="">
            <div class="col-lg-12">
               <!-- <form name="" method="post" action="" id='searchpp'> -->
                <?php
                $db=new DBhelper();
                if(isset($_POST['doSearch'])=="Search Patient")
                {
                    $searchText=$_POST['searchQuery'];
                    $search=$db->searchPatient($searchText);
                    if(!empty($search))
                        ?>
                        <h3 style="margin-top:20px;margin-bottom:20px;">Search Result</h3>
                        <div class="table table-responsive">
                        <table id="example" class="table table-striped table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Patient No.</th>
                                <th>Full Name</th>
                                <th>Sex</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Health Scheme</th>
                                <th>Book Appointment</th>
                                <!-- <th>Print</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                    $count = 0;
                    foreach($search as $patient)
                    {
                        $patientNo=$patient['patientNo'];
                        $fname=$patient['firstName'];
                        $mname=$patient['middleName'];
                        $lname=$patient['lastName'];
                        $dob=$patient['dob'];
                        $sex=$patient['sex'];
                        $address=$patient['address'];
                        $telNumber=$patient['telNumber'];
                        $healthSchemeID=$patient['paymenttypeCode'];
                        $name="$fname $mname $lname";
                        $healthScheme=$db->getData("paymenttype","paymentTypeName","paymenttypeCode",$healthSchemeID);

                        $age= $db->ageCalculator($dob);


                       
                            $visitsButton = '<div class="btn-group">
           <a href="index3.php?&sp=appointment&patientNo=' . $patientNo . '"><i class="la la-phone" title="Go to Appointment"></i></a>
           </div>';
                        }

        //     

                        $action="$visitsButton";


                        echo "<tr>
                    <td>$patientNo</td>
                    <td>$name</td>
                    <td>$sex</td>
                    <td>$age</td>
                    <td>$address</td>
                    <td>$telNumber</td>
                    <td>$healthScheme</td>
                    <td>$action</td>
                   
                    </tr>";
                    }
                    ?>
                    </tbody>
                    </table>
                    </div>
                    
                    <!-- <?php
               // }
                ?> -->
                </div>
            </div>
                  <!-- </form> -->
        <!--end of search result-->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
  <!-- Download the latest jquery.validate minfied version -->
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>

 
 
  <?php 
  $_POST["searchQuery"] = "";
  $patients = $db->searchPatientAutocomplete($_POST["searchQuery"]);
        $patients = json_encode( $patients );
 //}
 ?>
<script>
 var data = <?php echo $patients; ?>

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
      if (!val) { return false;}
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
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
} 



autocomplete(document.getElementById("search"), data);
  
  </SCRIPT>
<script>
  // Waiting until DOM is ready
$().ready(function() {
    // Selecting the form and defining validation method
    $("#searchpp").validate({
        
        // Passing the object with custom rules
        rules : {
            // login - is the name of an input in the form
            searchQuery : {
                required : true,
                // Setting email pattern for email input
               
            },
        },
        // Setting error messages for the fields
        messages: {
            searchQuery: {
                required: "Please provide patient Name",
               
            },
        },
        // Setting submit handler for the form
        submitHandler: function(form) {
            form.submit();
        }
    });
});



</script>   









