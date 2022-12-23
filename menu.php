<?php
$userID = $_SESSION['user_session'];
$roleCode = $_SESSION['role'];
$today = date("Y-m-d");
?>
<div class="main-menu-content">
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

        <?php
        if ($roleCode == 1) { ?>
            <li class=" nav-item"><a href="index3.php" style="margin-top:30px;"><i class="la la-home"></i><span class="menu-title" data-i18n="">Home</span></a>
            </li>

            <li class=" nav-item"><a href="index3.php?sp=staff"><i class="la la-user"></i><span class="menu-title">Staff Registration</span></a>
            </li>

            <li class=" nav-item"><a href="index3.php?sp=despencing"><i class="la la-user"></i><span class="menu-title">Dispency</span></a>
            </li>
            <li class=" nav-item"><a href="#"><i class="la la-cogs"></i><span class="menu-title" data-i18n="nav.templates.main">Store Management</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="index3.php?sp=incoming_purchase"><i></i><span>Incoming Purchase</span></a></li>
                    <li><a class="menu-item" href="index3.php?sp=healthfacility"><i></i><span>Product Pricing</span></a></li>
                    <!-- <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Reorder Level</span></a>
                    </li> -->
                    <!-- <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Set Reorder Level</span></a>
                    </li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Iterm Approach Reorder Level</span></a>
                    </li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Iterm Under Reorder Level</span></a>
                    </li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Iterm Under Reorder Level</span></a>
                    </li> -->
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="la la-cogs"></i><span class="menu-title" data-i18n="nav.templates.main">Configurations</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="index3.php?sp=clinic"><i></i><span>Pharmacy Profile</span></a></li>
                    <li><a class="menu-item" href="index3.php?sp=suppliers"><i></i><span>Supplier</span></a></li>
                    <li><a class="menu-item" href="index3.php?sp=manufacturers"><i></i><span>Manufacturers</span></a></li>

                    <!-- <li><a class="menu-item" href="index3.php?sp=healthfacility"><i></i><span>Product Pricing</span></a></li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Reorder Level</span></a>
                    </li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Set Reorder Level</span></a>
                    </li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Iterm Approach Reorder Level</span></a>
                    </li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Iterm Under Reorder Level</span></a>
                    </li>
                    <li><a class="menu-item" href="index3.php?sp=select_service"><i></i><span>Iterm Under Reorder Level</span></a>
                    </li> -->
                </ul>
            </li>
            <li class=" nav-item"><a href="index3.php?sp=users"><i class="la la-user"></i><span class="menu-title">User Management</span></a>
            </li>


        <?php
        } else { ?>

            <li class=" nav-item"><a href="index3.php" style="margin-top:30px;"><i class="la la-home"></i><span class="menu-title" data-i18n="">Home</span></a>
            </li>

            <li class=" nav-item"><a href="index3.php?sp=despencing"><i class="la la-user"></i><span class="menu-title">Dispency</span></a>

            

           

    </ul>

    </li>
<?php

        }
?>

</ul>

</div>