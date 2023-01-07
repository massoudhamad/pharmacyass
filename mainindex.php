<?php
//session_start();
switch ((isset($_GET['sp']) ? $_GET['sp'] : '')) {
    case 'add_patient':
        include('add_patient.php');
        break;

    case 'view-patient':
        include('view_patient.php');
        break;

    case 'patient-list':
        include('patients_list.php');
        break;

    case 'viewAllPatient':
        include('viewAllUser.php');
        break;
    case 'change_password':
        include('password.php');
        break;
    case 'location':
        include('location.php');
        break;

    case 'profile':
        include('patient-profile.php');
        break;
    case 'edit_patient':
        include('edit_patient.php');
        break;

    case 'print':
        include('printcertificate.php');
        break;
    case 'edit_patient':
        include('edit_patient.php');
        break;

    case 'registerstaff':
        include('registerstaff.php');
        break;
    case 'staff':
        include('staff.php');
        break;
    case 'edit_staff':
        include('edit_staff.php');
        break;
    case 'internalDespency':
        include('internalDespency.php');
        break;
    case 'DirectDespency':
        include('direct_dispency.php');
        break;
    case 'PatientDespency':
        include('patient_dispency.php');
        break;
    case 'direct_dispency_form':
        include('direct_dispencing_form.php');
        break;
    case 'users':
        include('users.php');
        break;
    case 'manufacturers':
        include('manufacturers.php');
        break;
    case 'suppliers':
        include('suppliers.php');
        break;
    case 'incoming_purchase':
        include('incoming_purchase.php');
        break;
    case 'despencing':
        include('despencing.php');
        break;
    case 'product_types':
        include('product_types.php');
        break;
    case 'store':
        include('store.php');
        break;
    case 'receive_items':
        include('recieve_items.php');
        break;
    case 'edit_receive_items':
        include('edit_recieve_items.php');
        break;



        //Default Page
    default:
        include('default.php');
}
