<?php

ini_set ( 'display_errors', 1 );
error_reporting ( E_ALL | E_STRICT );

try {

    include 'DB.php';
    $db = new DBHelper();
    $hospitallevelrank = $db->getData("hospital","hospitallevelrank","hospitalCode",$_SESSION['hospitalCode']);

    $paymenttype = ( 'http://localhost/aspire_emr_server/data/get_insurer_type_api.php' ) or die( 'failed' );
    //$paymenttype = ( 'http://hmis.skychuo.com/data/get_insurer_type_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $paymenttype );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $paymenttype_array = json_decode( $body );

    if ( !empty( $paymenttype_array ) ) {
        foreach ( $paymenttype_array as $payment ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'paymentTypeCode'=>$payment->paymentTypeCode,
                'paymentTypeName'=>$payment->paymentTypeName,
                //'IsInsurance'=>$payment[2],

            );
            $insert = $db->insert( 'paymenttype', $userData );
        }
    }

    $category_json = ( 'http://localhost/aspire_emr_server/data/get_category_json_api.php' ) or die( 'failed' );
    //$category_json = ( 'http://hmis.skychuo.com/data/get_category_json_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $category_json );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $category_json_array = json_decode( $body );

    if ( !empty( $category_json_array ) ) {
        foreach ( $category_json_array as $category ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'categoryCode'=>$category->categoryCode,
                'categoryName'=>$category->categoryName,
                'categoryDesc'=>$category->categoryDesc,
                'isTest'=>$category->isTest,

            );
            $insert = $db->insert( 'servicecategory', $userData );
        }
    }

    $subcategory_json = ( 'http://localhost/aspire_emr_server/data/get_subcategory_json_api.php' ) or die( 'failed' );
    //$subcategory_json = ( 'http://hmis.skychuo.com/data/get_subcategory_json_api.php' ) or die( 'failed' );
    
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $subcategory_json );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $subcategory_json_array = json_decode( $body );

    if ( !empty( $subcategory_json_array ) ) {
        foreach ( $subcategory_json_array as $subcategory ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'subcategoryCode'=> $subcategory->subcategoryCode,
                'categoryCode'=> $subcategory->categoryCode,
                'subCategory'=> $subcategory->subCategory,
                'description'=> $subcategory->description,

            );

            $insert = $db->insert( 'servicesubcategory', $userData );

        }
    }

    $zone_url = ( 'http://localhost/aspire_emr_server/data/get_zone_api.php' ) or die( 'failed' );
    //$zone_url = ( 'http://hmis.skychuo.com/data/get_zone_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $zone_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $zone_array = json_decode( $body );

    if ( !empty( $zone_array ) ) {
        foreach ( $zone_array as $zone ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'zoneCode'=>$zone->zoneCode,
                'zoneName'=>$zone->zoneName,

            );
            $insert = $db->insert( 'zone', $userData );
        }
    }

    $region_url = ( 'http://localhost/aspire_emr_server/data/get_region_api.php' ) or die( 'failed' );
    //$region_url = ( 'http://hmis.skychuo.com/data/get_region_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $region_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $region_array = json_decode( $body );

    if ( !empty( $region_array ) ) {
        foreach ( $region_array as $region ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'regionCode'=> $region->regionCode,
                'zoneCode'=> $region->zoneCode,
                'regionName'=> $region->regionName,

            );

            $insert = $db->insert( 'region', $userData );

        }
    }

   $hospitallevel_url = ( 'http://localhost/aspire_emr_server/data/get_hospitallevel_api.php' ) or die( 'failed' );
    //$hospitallevel_url = ( 'http://hmis.skychuo.com/data/get_hospitallevel_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $hospitallevel_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $hospitallevel_array = json_decode( $body );

    if ( !empty( $hospitallevel_array ) ) {
        foreach ( $hospitallevel_array as $hospitallevel ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'hospitalLevelID'=> $hospitallevel->HospitallevelID,
                'hospitalLevelName'=> $hospitallevel->hospitalLevelName,
                'hospitalLevelCode'=> $hospitallevel->hospitalLevelCode,
                'description'=> $hospitallevel->description,

            );

            $insert = $db->insert( 'hospitallevel', $userData );

        }
    }

    $allergies_url = ( 'http://localhost/aspire_emr_server/data/get_allergies_api.php' ) or die( 'failed' );
    //$allergies_url = ( 'http://hmis.skychuo.com/data/get_allergies_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $allergies_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $allergies_array = json_decode( $body );

    if ( !empty( $allergies_array ) ) {
        foreach ( $allergies_array as $allergies ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'allergyID'=> $allergies->allergyID,
                'allergyName'=> $allergies->allergyName,
                'allergy_typeID'=> $allergies->allergy_typeID,

            );

            $insert = $db->insert( 'allergy', $userData );

        }
    }

    $allergy_reaction_url = ( 'http://localhost/aspire_emr_server/data/get_allergies_reaction_api.php' ) or die( 'failed' );
    //$allergy_reaction_url = ( 'http://hmis.skychuo.com/data/get_allergies_reaction_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $allergy_reaction_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $allergy_reaction_array = json_decode( $body );

    if ( !empty( $allergy_reaction_array ) ) {
        foreach ( $allergy_reaction_array as $allergy_reaction ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'allergy_reaction'=> $allergy_reaction->allergy_reaction,
                'allergy_reactionID'=> $allergy_reaction->allergy_reactionID,
                // 'allergyReaction'=> $allergy_reaction[2],
                // 'allergy_typeID'=> $allergy_reaction[3],

            );

            $insert = $db->insert( 'allergy_reaction', $userData );

        }
    }

    $service_json = ( 'http://localhost/aspire_emr_server/data/get_district_apii.php' ) or die( 'failed' );
    //$service_json = ( 'http://hmis.skychuo.com/data/get_district_apii.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $service_json );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $service_json_array = json_decode( $body );

    if ( !empty( $service_json_array ) ) {
        foreach ( $service_json_array as $service ) {

            $userData = array(
                'districtCode'=> $service->districtCode,
                'districtName'=> $service->districtName,
                'regionCode'=> $service->regionCode,

            );

            $insert = $db->insert( 'district', $userData );
        }
    }

    $shehia_url = ( 'http://localhost/aspire_emr_server/data/get_shehia_apii.php' ) or die( 'failed' );
    //$shehia_url = ( 'http://hmis.skychuo.com/data/get_shehia_apii.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $shehia_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $shehia_array = json_decode( $body );

    if ( !empty( $shehia_array ) ) {
        foreach ( $shehia_array as $shehia ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'shehiaCode'=> $shehia->shehiaCode,
                'shehiaName'=> $shehia->shehiaName,
                'districtCode'=> $shehia->districtCode,
            );

            $insert = $db->insert( 'shehia', $userData );

        }
    }

    $cadre_url = ( 'http://localhost/aspire_emr_server/data/get_cadre_api.php' ) or die( 'failed' );
    //$cadre_url = ( 'http://hmis.skychuo.com/data/get_cadre_api.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $cadre_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $cadre_array = json_decode( $body );

    if ( !empty( $cadre_array ) ) {
        foreach ( $cadre_array as $cadre ) {

            $userData = array(
                'cadreID'=> $cadre->cadreID,
                'cardename'=> $cadre->cardename,
                'cardediscription'=> $cadre->cardediscription,
            );

            $insert = $db->insert( 'cadre', $userData );

        }
    }



        $department_url = ( 'http://localhost/aspire_emr_server/data/get_department_api.php' ) or die( 'failed' );
        //$department_url = ( 'http://hmis.skychuo.com/data/get_department_api.php' ) or die( 'failed' );
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $department_url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_PORT, 80 );
        $body = curl_exec( $ch );
        $error = curl_error( $ch );
        $department_array = json_decode( $body );
    
        if ( !empty( $department_array ) ) {
            foreach ( $department_array as $department ) {
                ini_set( 'max_execution_time', 300 );
                $userData = array(
                    'deptID'=> $department->deptID,
                    'depatCode'=> $department->deptCode,
                    'deptname'=> $department->deptname,
                    'category'=> $department->category,
                    'description'=> $department->description,
                    
                );
    
                $insert = $db->insert( 'department', $userData );
    
            }
        }
    
        $clinic_url = ( 'http://localhost/aspire_emr_server/data/get_clinics_api.php' ) or die( 'failed' );
        //$clinic_url = ( 'http://hmis.skychuo.com/data/get_clinics_api.php' ) or die( 'failed' );
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $clinic_url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_PORT, 80 );
        $body = curl_exec( $ch );
        $error = curl_error( $ch );
        $clinic_array = json_decode( $body );
    
        if ( !empty( $clinic_array ) ) {
            foreach ( $clinic_array as $clinic ) {
                ini_set( 'max_execution_time', 300 );
                $userData = array(
                    'clinicCode'=> $clinic->clinicCode,
                    'clinicShortCode'=> $clinic->clinicShortCode,
                    'clinicName'=> $clinic->clinicName,
                    'clinicDescription'=> $clinic->clinicDescription,
                    'clinicStatus'=> $clinic->clinicStatus,
                    
                );
    
                $insert = $db->insert( 'clinic', $userData );
    
            }
        }

    $diseases_url = ( 'http://localhost/aspire_emr_server/data/get_icdapi.php' ) or die( 'failed' );
    //$diseases_url = ( 'http://hmis.skychuo.com/data/get_icdapi.php' ) or die( 'failed' );
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $diseases_url );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $diseases_array = json_decode( $body );

    if ( !empty( $diseases_array ) ) {
        foreach ( $diseases_array as $diseases ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'ICDCode'=> $diseases->ICDCode,
                'icdName'=> $diseases->diseasesName,
                'icdDescription'=> $diseases->icdDescription,
            );

            $insert = $db->insert( 'icdcode', $userData );

        }
    }

    $service_json = ( 'http://localhost/aspire_emr_server/data/get_service_api.php?hospitallevelrank='.$hospitallevelrank) or die( 'failed' );
    //$service_json = ( 'http://hmis.skychuo.com/data/get_service_api.php?hospitallevelrank='.$hospitallevelrank ) or die( 'failed' );
     
    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $service_json );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $ch, CURLOPT_PORT, 80 );
    $body = curl_exec( $ch );
    $error = curl_error( $ch );
    $service_json_array = json_decode( $body );
    //print_r($service_json_array);
    
    if ( !empty( $service_json_array ) ) {
        foreach ( $service_json_array as $service ) {
            ini_set( 'max_execution_time', 360 );
            $userData = array(
                'subcategoryCode'=> $service->subCategoryCode,
                'serviceCode'=> $service->serviceCode,
                'serviceName'=> $service->serviceName,
                'Descriptions'=> $service->Descriptions,
                'hospitallevelrank'=> $service->facilityrank,
                
            );

            $insert = $db->insert( 'service', $userData );
            $UpdateData = array(
                'act'=>1,
            );
            $condition = array( 'userID' =>$_SESSION['user_session'] );
            $insert = $db->update( 'users', $UpdateData, $condition );
            $boolStatus = true;
            $_SESSION['msg'] = 'Services Have been Downloaded successfully';
            header( 'Location:activate_service.php' );

        }
    }

} catch ( PDOException $ex ) {
    echo $ex;
    //header( 'Location:index3.php?sp=manageHospital&msg=error' );
}