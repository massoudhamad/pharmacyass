<?php

ini_set ( 'display_errors', 1 );
error_reporting ( E_ALL | E_STRICT );

try {

    include 'DB.php';
    $db = new DBHelper();

    $ip = 'http://102.223.7.28/';

    $cadre_url = ( $ip.'data/get_allergy_type.php' ) or die( 'failed' );
    $cadre_array = $db->api($cadre_url);
    if ( !empty( $cadre_array ) ) {
        foreach ( $cadre_array as $cadre ) {

            $userData = array(
                'allergy_type'=> $cadre->allergy_type,
            );
            if ($db->isFieldExist('allergy_type', 'allergy_typeID',$cadre->allergy_typeID)) {
                continue;
            } else {
            $insert = $db->insert( 'allergy_type', $userData );
            }

        }
    }


    $paymenttype = ( $ip.'data/get_insurer_type_api.php' ) or die( 'failed' );
    $paymenttype_array = $db->api($paymenttype);
    if ( !empty( $paymenttype_array ) ) {
        foreach ( $paymenttype_array as $payment ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'paymentTypeCode'=>$payment->paymentTypeCode,
                'paymentTypeName'=>$payment->paymentTypeName,

            );
            if ($db->isFieldExist('paymenttype', 'paymentTypeCode', $payment->paymentTypeCode)) {
                continue;
            } else {
             $insert = $db->insert( 'paymenttype', $userData );
            }
        }
    }


    $companyApi = ( $ip.'data/get_insuarenceCompany_api.php' ) or die( 'failed' );
    $paymenttype_array = $db->api($companyApi);

    if ( !empty( $paymenttype_array ) ) {
        foreach ( $paymenttype_array as $payment ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'insurerID'=>$payment->insurerID,
                'insurerName'=>$payment->insurerName,
                'insurerAddress'=>$payment->insurerAddress,
                'insurerTelophone'=>$payment->insurerTelophone,
                //'IsInsurance'=>$payment[2],

            );
            if ($db->isFieldExist('insurer_company', 'insurerID', $payment->insurerID)) {
                continue;
            } else {
             $insert = $db->insert( 'insurer_company', $userData );
            }
        }
    }

    $category_json = ( $ip.'data/get_category_json_api.php' ) or die( 'failed' );
    $category_json_array = $db->api($category_json);
    if ( !empty( $category_json_array ) ) {
        foreach ( $category_json_array as $category ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'categoryCode'=>$category->categoryCode,
                'categoryName'=>$category->categoryName,
                'categoryDesc'=>$category->categoryDesc,
                'isTest'=>$category->isTest,

            );
            if ($db->isFieldExist('servicecategory', 'categoryCode', $category->categoryCode)) {
                continue;
            } else {
            $insert = $db->insert( 'servicecategory', $userData );
            }
        }
    }

    $subcategory_json = ( $ip.'data/get_subcategory_json_api.php' ) or die( 'failed' );
    $subcategory_json_array = $db->api($subcategory_json);
    if ( !empty( $subcategory_json_array ) ) {
        foreach ( $subcategory_json_array as $subcategory ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'subcategoryCode'=> $subcategory->subcategoryCode,
                'categoryCode'=> $subcategory->categoryCode,
                'subCategory'=> $subcategory->subCategory,
                'description'=> $subcategory->description,

            );
            if ($db->isFieldExist('servicesubcategory', 'subcategoryCode',  $subcategory->subcategoryCode)) {
                continue;
            } else {
            $insert = $db->insert( 'servicesubcategory', $userData );
            }

        }
    }

    $zone_url = ( $ip.'data/get_zone_api.php' ) or die( 'failed' );
    $zone_array = $db->api($zone_url);
    if ( !empty( $zone_array ) ) {
        foreach ( $zone_array as $zone ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'zoneCode'=>$zone->zoneCode,
                'zoneName'=>$zone->zoneName,

            );
            if ($db->isFieldExist('zone', 'zoneCode',$zone->zoneCode)) {
                continue;
            } else {
            $insert = $db->insert( 'zone', $userData );
            }
        }
    }

    $region_url = ( $ip.'data/get_region_api.php' ) or die( 'failed' );
    $region_array = $db->api($region_url);
    if ( !empty( $region_array ) ) {
        foreach ( $region_array as $region ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'regionCode'=> $region->regionCode,
                'zoneCode'=> $region->zoneCode,
                'regionName'=> $region->regionName,

            );
            if ($db->isFieldExist('region', 'regionCode',$region->regionCode)) {
                continue;
            } else {
            $insert = $db->insert( 'region', $userData );
            }

        }
    }

    $hospitallevel_url = ( $ip.'data/get_hospitallevel_api.php' ) or die( 'failed' );
    $hospitallevel_array = $db->api($hospitallevel_url);

    if ( !empty( $hospitallevel_array ) ) {
        foreach ( $hospitallevel_array as $hospitallevel ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'hospitalLevelID'=> $hospitallevel->HospitallevelID,
                'hospitalLevelName'=> $hospitallevel->hospitalLevelName,
                'hospitalLevelCode'=> $hospitallevel->hospitalLevelCode,
                'description'=> $hospitallevel->description,

            );
            if ($db->isFieldExist('hospitallevel', 'hospitalLevelID',$hospitallevel->HospitallevelID)) {
                continue;
            } else {
            $insert = $db->insert( 'hospitallevel', $userData );
            }

        }
    }

    $allergies_url = ( $ip.'data/get_allergies_api.php' ) or die( 'failed' );
   $allergies_array = $db->api($allergies_url);

    if ( !empty( $allergies_array ) ) {
        foreach ( $allergies_array as $allergies ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'allergyID'=> $allergies->allergyID,
                'allergyName'=> $allergies->allergyName,
                'allergy_typeID'=> $allergies->allergy_typeID,

            );
            if ($db->isFieldExist('allergy', 'allergyID',$allergies->allergyID)) {
                continue;
            } else {
            $insert = $db->insert( 'allergy', $userData );
            }

        }
    }

    $allergy_reaction_url = ( $ip.'data/get_allergies_reaction_api.php' ) or die( 'failed' );
    $allergy_reaction_array = $db->api($allergy_reaction_url);

    if ( !empty( $allergy_reaction_array ) ) {
        foreach ( $allergy_reaction_array as $allergy_reaction ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'allergy_reaction'=> $allergy_reaction->allergy_reaction,
                'allergy_reactionID'=> $allergy_reaction->allergy_reactionID,
            );
            if ($db->isFieldExist('allergy_reaction', 'allergy_reactionID',$allergy_reaction->allergy_reactionID)) {
                continue;
            } else {
            $insert = $db->insert( 'allergy_reaction', $userData );
            }
        }
    }

    $servic_json = ( $ip.'data/get_district_apii.php' ) or die( 'failed' );
    $service_json_array = $db->api($servic_json);

    if ( !empty( $service_json_array ) ) {
        foreach ( $service_json_array as $service ) {
                ini_set( 'max_execution_time', 300 );
            $userData = array(
                'districtCode'=> $service->districtCode,
                'districtName'=> $service->districtName,
                'regionCode'=> $service->regionCode,

            );
            if ($db->isFieldExist('district', 'districtCode',$service->districtCode)) {
                continue;
            } else {
            $insert = $db->insert( 'district', $userData );
            }
        }
    }

    $shehia_url = ( $ip.'data/get_shehia_apii.php' ) or die( 'failed' );
    $shehia_array = $db->api($shehia_url);

    if ( !empty( $shehia_array ) ) {
        foreach ( $shehia_array as $shehia ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'shehiaCode'=> $shehia->shehiaCode,
                'shehiaName'=> $shehia->shehiaName,
                'districtCode'=> $shehia->districtCode,
            );
            if ($db->isFieldExist('shehia', 'shehiaCode',$shehia->shehiaCode)) {
                continue;
            } else {
            $insert = $db->insert( 'shehia', $userData );
            }

        }
    }

    $cadres_url = ( $ip.'data/get_cadre_api.php' ) or die( 'failed' );
    $cadres_array = $db->api($cadres_url);
    if ( !empty( $cadres_array ) ) {
        foreach ( $cadres_array as $cadre ) {

            $userData = array(
                'cadreID'=> $cadre->cadreID,
                'cardename'=> $cadre->cardename,
                'cardediscription'=> $cadre->cardediscription,
            );
            if ($db->isFieldExist('cadre', 'cadreID',$cadre->cadreID)) {
                continue;
            } else {
            $insert = $db->insert( 'cadre', $userData );
            }

        }
    }


   

    $opdrelease_url = ( $ip.'data/get_releaseStatus_api.php' ) or die( 'failed' );
    $opd_array = $db->api($opdrelease_url);
    if ( !empty( $opd_array ) ) {
        foreach ( $opd_array as $cadre ) {
            $userData = array(
                'name'=> $cadre->name,
                'description'=> $cadre->description,

            );
            if ($db->isFieldExist('opdreleasestatus', 'OPDreleaseStatusID',$cadre->OPDreleaseStatusID)) {
                continue;
            } else {
            $insert = $db->insert( 'opdreleasestatus', $userData );
            }

        }
    }



        $department_url = ( $ip.'data/get_department_api.php' ) or die( 'failed' );
        $department_array = $db->api($department_url);
        if ( !empty( $department_array ) ) {
            foreach ( $department_array as $department ) {
                ini_set( 'max_execution_time', 300 );
                $userData = array(
                    'deptID'=> $department->deptID,
                    'deptCode'=> $department->deptCode,
                    'deptname'=> $department->deptname,
                    'category'=> $department->category,
                    'description'=> $department->description,
                    
                );
                if ($db->isFieldExist('department', 'deptCode',$department->deptCode)) {
                    continue;
                } else {
                    $insert = $db->insert( 'department', $userData );
                }
            }
        }
    
        $clinic_url = ( $ip.'data/get_clinics_api.php' ) or die( 'failed' );
        $clinic_array = $db->api($clinic_url);
        if ( !empty( $clinic_array ) ) {
            foreach ( $clinic_array as $clinic ) {
                ini_set( 'max_execution_time', 300 );
                $userData = array(
                    'clinicCode'=> $clinic->clinicCode,
                    'clinicName'=> $clinic->clinicName,
                    'clinicShortCode'=> $clinic->clinicShortCode,
                    'clinicDescription'=> $clinic->clinicDescription,
                    'clinicStatus'=> $clinic->clinicStatus,
                    'deptCode'=> $clinic->deptCode
                    
                );
                if ($db->isFieldExist('clinic', 'clinicCode',$clinic->clinicCode)) {
                    continue;
                } else {
                    $insert = $db->insert( 'clinic', $userData );
                }
    
            }
        }

        $service_cost_url = ( $ip.'data/get_service_cost.php' ) or die( 'failed' );
        $service_cost_array = $db->api($service_cost_url);
        if ( !empty( $service_cost_array ) ) {
            foreach ( $service_cost_array as $service_cost ) {
                ini_set( 'max_execution_time', 300 );
                $service_costData = array(
                    'serviceCode'=> $service_cost->serviceCode,
                    'paymenttypeCode'=> $service_cost->paymenttypeCode,
                    'price'=> $service_cost->actualCost,
                    
                    
                );
                if ($db->isFieldExistMult('service_cost', array('serviceCode'=> $service_cost->serviceCode,'paymenttypeCode'=> $service_cost->paymenttypeCode,'price'=> $service_cost->actualCost))) {
                    continue;
                } else {
                    $insert = $db->insert( 'service_cost', $service_costData );
                }
    
            }
        }

    $diseases_url = ( $ip.'data/get_icdapi.php' ) or die( 'failed' );
    $diseases_array = $db->api($diseases_url);
    if ( !empty( $diseases_array ) ) {
        foreach ( $diseases_array as $diseases ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'ICDCode'=> $diseases->ICDCode,
                'icdName'=> $diseases->diseasesName,
                'icdDescription'=> $diseases->icdDescription,
            );
            if ($db->isFieldExist('icdcode', 'ICDCode',$diseases->ICDCode)) {
                continue;
            } else {
            $insert = $db->insert( 'icdcode', $userData );
            }

        }
        
    }


    $drugs_url = ( $ip.'data/get_drugs_api.php' ) or die( 'failed' );
    $drugs_array = $db->api($drugs_url);
    if ( !empty( $drugs_array ) ) {
        foreach ( $drugs_array as $diseases ) {
            ini_set( 'max_execution_time', 300 );
            $userData = array(
                'drugCode' =>  $diseases->drugCode,
                'drugName' => $diseases->drugName,
                'isMedicine' => $diseases->isMedicine
            );
            if ($db->isFieldExist('drugs', 'drugCode',$diseases->drugCode)) {
                continue;
            } else {
            $insert = $db->insert( 'drugs', $userData );
            }

        }
        
    }


    $defaultClinics_url = ( $ip.'data/getDefaultClinics_api.php' ) or die( 'failed' );
    $defaultClinics_array = $db->api($defaultClinics_url);
    if ( !empty( $defaultClinics_array ) ) {
        foreach ( $defaultClinics_array as $clinic ) {
            $userData = array(
                'clinicCode' =>  $clinic->clinicCode,
                'clinicName' => $clinic->clinicName,
                'clinicShortCode' => $clinic->clinicShortCode,
                'hospitalCode' => $_SESSION['hospitalCode'],
                
            );
            if ($db->isFieldExist('hospital_clinic', 'clinicCode',$clinic->clinicCode)) {
                continue;
            } else {
            $insert = $db->insert( 'hospital_clinic', $userData );
            }

        }
        
    }


    $hospitallevelrank = $db->getData("hospital","hospitallevelrank","hospitalCode",$_SESSION['hospitalCode']);

    $service_jsons = ($ip."data/get_service_api.php?hospitallevelrank=".$hospitallevelrank ) or die( 'failed' );
    //echo $service_jsons;
     
    $services_json_array = $db->api($service_jsons);
    //print_r($services_json_array);
    
    if ( !empty( $services_json_array ) ) {
        // echo 'new';
        set_time_limit(60);
        foreach ( $services_json_array as $service ) {
            // ini_set( 'max_execution_time', 560 );
            $userData = array(
                'subCategoryCode'=> $service->subCategoryCode,
                'serviceCode'=> $service->serviceCode,
                'serviceName'=> $service->serviceName,
                'Descriptions'=> $service->Descriptions,
                'facilityrank'=> $service->facilityrank,
                'isPriced'=> $service->isPriced,
                'isProcedure'=> $service->isProcedure,
                'clinicCode' =>  $service->clinicCode,
                
            );
            if ($db->isFieldExist('service', 'serviceCode',$service->serviceCode)) {
                $UpdateData = array(
                'act'=>1,
                );
                continue;
            } else {
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
    }else{
            echo 'empty';
        }

} catch ( PDOException $ex ) {
    echo $ex;
    //header( 'Location:index3.php?sp=manageHospital&msg=error' );
}