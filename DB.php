<?php
session_start();
/*
 * conn Class
 * This class is used for database related (connect, insert, update, and delete) operations
 * with PHP Data Objects (PDO)
 * @author    Massoud Hamad
 * @url       http://www.hmytechnoloFies.com
 */
require_once('dbconfig.php');
//require_once('session.php');
define('SALT_LENGTH', 9);
date_default_timezone_set("Africa/Dar_es_Salaam");
class DBHelper{

    private $conn;
    public function __construct(){
        
       $database = new Database();
        $conn = $database->dbConnection();
        $this->conn = $conn;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    

    public function PwdHash($pwd, $salt = null)
    {
        if ($salt === null)
        {
            $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
        }
        else 
        {
            $salt = substr($salt, 0, SALT_LENGTH);
        }
        return $salt . sha1($pwd . $salt);
    }

    /*
     * Returns rows from the database based on the conditions
     * @param string name of the table
     * @param array select, where, order_by, limit and return_type conditions
     */
    public function getRows($table,$conditions = array()){
        $sql = 'SELECT';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        
        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by']; 
        }
        
        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit']; 
        }
        
        $query = $this->conn->prepare($sql);
        $query->execute();
        
        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        }else{
            if($query->rowCount() > 0){
                $data = $query->fetchAll();
            }
        }
        return !empty($data)?$data:false;
    }
    
    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function insert($table,$data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
           if(!array_key_exists('createdDate',$data)){
                $data['createdDate'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modifiedDate',$data)){
                $data['modifiedDate'] = date("Y-m-d H:i:s");
            }

             if(!array_key_exists('createdBy',$data)){
                $data['createdBy'] = $_SESSION['user_session'];
            }
            
            

            $columnString = implode(',', array_keys($data));
            $valueString = ":".implode(',:', array_keys($data));
            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
            $query = $this->conn->prepare($sql);
            foreach($data as $key=>$val){
                 $query->bindValue(':'.$key, $val);
            }
            $insert = $query->execute();
            return $insert?$this->conn->lastInsertId():true;
            
        }else{
            return false;
        }
    }

    public function insert2($table,$data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
           if(!array_key_exists('createdDate',$data)){
                $data['createdDate'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('modifiedDate',$data)){
                $data['modifiedDate'] = date("Y-m-d H:i:s");
            }

            $columnString = implode(',', array_keys($data));
            $valueString = ":".implode(',:', array_keys($data));
            $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
            $query = $this->conn->prepare($sql);
            foreach($data as $key=>$val){
                 $query->bindValue(':'.$key, $val);
            }
            $insert = $query->execute();
            return $insert?$this->conn->lastInsertId():true;
            
        }else{
            return false;
        }
    }
    
    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($table,$data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if(!array_key_exists('modifiedDate',$data)){
                $data['modifiedDate'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('createdBy',$data)){
                $data['createdBy'] = $_SESSION['user_session'];
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $query = $this->conn->prepare($sql);
            $update = $query->execute();
            return $update?$query->rowCount():false;
        }else{
            return false;
        }
    }
    public function update2($table,$data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if(!array_key_exists('modifiedDate',$data)){
                $data['modifiedDate'] = date("Y-m-d H:i:s");
            }
            
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $query = $this->conn->prepare($sql);
            $update = $query->execute();
            return $update?$query->rowCount():false;
        }else{
            return false;
        }
    }


    public function updateStaffInfo($table,$data,$conditions){

        $imgFile = $_FILES['profile']['name'];
        $tmp_dir = $_FILES['profile']['tmp_name'];
        $imgSize = $_FILES['profile']['size'];
        $upload_dir = 'profile/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $userpic = $_FILES['profile']['name'];//rand(1000,1000000).".".$imgExt;
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  

        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if(!array_key_exists('modifiedDate',$data)){
                $data['modifiedDate'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('createdBy',$data)){
                $data['createdBy'] = $_SESSION['user_session'];
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $query = $this->conn->prepare($sql);
            $update = $query->execute();
            return $update?$query->rowCount():false;
        }else{
            return false;
        }
    }
   
    
    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($table,$conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "DELETE FROM ".$table.$whereSql;
        $delete = $this->conn->exec($sql);
        return $delete?$delete:false;
    }



    public function doLogin($email,$upass)
    {
       try
       {
         $stmt = $this->conn->prepare( 'SELECT * FROM users  WHERE email=:email' );
            $stmt->execute( array( ':email' => $email ) );
            $userRow = $stmt->fetch( PDO::FETCH_ASSOC );
            if ( $stmt->rowCount() > 0 ) {
                if ( $userRow['status'] == 1 ) {
                    if($userRow['password']===$this->PwdHash($upass, substr($userRow['password'],0,9)))
                    {
                        $_SESSION['user_session'] = $userRow['userID'];
                        $_SESSION['status']=$userRow['login'];
                        $_SESSION['role']=$userRow['roleCode'];
                        $_SESSION['firstname']=$userRow['firstName'];
                        $_SESSION['middlename']=$userRow['middleName'];
                        $_SESSION['lastname']=$userRow['lastName'];
                        
                        return true;
                    }else{
                return false;
             }
          } else {
                    return false;
          }
          }else{
              return false;

          }
          }
       
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
         return true;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function doLogout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }

    //get Single Record
    public function getData($table,$attrName,$id,$id2)
    {
        try{
        $query = $this->getRows($table,array('where'=>array($id=>$id2),' order_by'=>$attrName.'  ASC'));
        if(!empty($query))
        {
            foreach ($query as  $q) {
                $attrName=$q[$attrName];
                
            }
            return $attrName;
        }
        }
        catch(PDOException $exception)
		{
                    echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    
    //get Single Record
    public function getAttribute($table,$attrName)
    {
        try{
            $query = $this->getRows($table,array('order_by'=>$attrName.'  ASC'));
            if(!empty($query))
            {
                foreach ($query as  $q) {
                    $attrName=$q[$attrName];
                    
                }
                return $attrName;
            }
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    
    public function isFieldExist($table,$field,$field2)
    {
        try
        {
            $query=$this->getRows($table,array('where'=>array($field=>$field2),'order_by'=>$field.' ASC'));
            if(!empty($query))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    public function ageCalculator($dob)
    {
        $dob = strtotime($dob);
        $current_time = time();
        
        $age_years = date('Y',$current_time) - date('Y',$dob);
        $age_months = date('m',$current_time) - date('m',$dob);
        $age_days = date('d',$current_time) - date('d',$dob);
        
        if ($age_days=0) {
            $days_in_month = date('t',$current_time);
            $age_months--;
            $age_days= $days_in_month+$age_days;
        }
        
        if ($age_months<0) {
            $age_years--;
            $age_months = 12+$age_months;
        }
        if($age_years<=5)
        {
            if($age_years>0)
            {
                if($age_months==0)
                {
                    $age=$age_years." year";
                }
                else
                {
                    $age=$age_years."(".$age_months."/12)";
                }
            }
            else
            {
                $age=$age_months." months";
            }
        }
        else
        {
            $age=$age_years." years";
        }
        return $age; 
       /* if(!empty($dob))
        {
            $birthdate=new DateTime($dob);
            $today=new DateTime('today');
            $age=$birthdate->diff($today)->y;
            return $age;
        }
        else
        {
            return 0;
        }
        */
    }
    public function age($age){
        $years = date('Y')-$age;
        return $years; 

    }


    public function getDay($date)
    {
       

        $timestamp = strtotime($date);
        $day = date('1', $timestamp);
        //var_dump($day);
        
      
        return $day; 
       /* if(!empty($dob))
        {
            $birthdate=new DateTime($dob);
            $today=new DateTime('today');
            $age=$birthdate->diff($today)->y;
            return $age;
        }
        else
        {
            return 0;
        }
        */
    }

    public function getVisit($patientNo)
    {
        try
        {
            $query = $this->conn->prepare("SELECT visitStatus from patientvisit where patientNo=:pNo order by visitDate ASC");
            $query->execute(array(':pNo'=>$patientNo));
            while($row=$query->fetch(PDO::FETCH_ASSOC))
            {
                $visitStatus=$row['visitStatus'];
            }
            return $visitStatus;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    public function getPatient($hospitalCode)
    {
        try
        {
            $query=$this->conn->prepare("SELECT DISTINCT(patientNo),visitNo,createdDate  from patienttest where hospitalCode=:hCode and visitStatus=:st");
            $query->execute(array(':hCode'=>$hospitalCode,':st'=>1));
            $data=array();
            while($row=$query->fetch(PDO::FETCH_ASSOC))
            {
                $data[]=$row;
            }
            return $data;
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }

    public function getstaffCadre()
    {
        try
        {
            $query=$this->conn->prepare("SELECT firstname,middlename,lastname,cadre.cadreID,cardename,staffId,employeeId  from cadre,staff where cadre.cadreID=staff.cadreID and cardename = 'Doctor';
            ");
            $query->execute();
            $data=array();
            while($row=$query->fetch(PDO::FETCH_ASSOC))
            {
                $data[]=$row;
            }
            return $data;
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }


    
    public function getPatientTest($hospitalCode)
    {
        try
        {
            $query=$this->conn->prepare("SELECT DISTINCT(patientNo),visitNo,createdDate  from patienttest where hospitalCode=:hCode and visitStatus=:st and testStatus=:ts");
            $query->execute(array(':hCode'=>$hospitalCode,':st'=>1,':ts'=>0));
            $data=array();
            while($row=$query->fetch(PDO::FETCH_ASSOC))
            {
                $data[]=$row;
            }
            return $data;
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }
    
    
    public function getClinincPatient($hospitalCode,$categoryID,$visitStatus)
    {
        try
        {
            $query=$this->conn->prepare("SELECT DISTINCT
    (p.patientNo), p.visitNo,serviceName
FROM
    patientvisit p,
    patient_service ps,
    service s,
    servicecategory sc,
    servicesubcategory ss
WHERE
    p.patientNo = ps.patientNo
        AND p.visitNo = ps.visitNo
        AND sc.categoryID = ss.categoryID
        AND ss.subCategoryID = s.subCategoryID
        AND s.serviceID = ps.servicesID
        AND sc.categoryID = :catID
        AND ps.hospitalCode = :hCode
        AND p.visitStatus = :st");
            $query->execute(array(':catID'=>$categoryID,':hCode'=>$hospitalCode,':st'=>$visitStatus));
            $data=array();
            while($row=$query->fetch(PDO::FETCH_ASSOC))
            {
                $data[]=$row;
            }
            return $data;
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }
    
    public function getService($categoryID,$hospitalCode)
    {
        try
        {
            $query=$this->conn->prepare("SELECT so.serviceCode, s.serviceCode,s.subCategoryCode,serviceName,so.cash,so.credits,so.insurance,so.costsharing,so.fasttrack,hospitalCode from service s, servicesubcategory sc, servicecategory c ,serviceOffered so where sc.subCategoryCode=s.subCategoryCode AND c.categoryCode=sc.categoryCode AND c.categoryCode=:pro and s.serviceCode = so.serviceCode AND hospitalCode=:hospitalcode");
            $query->execute(array(':pro'=>$categoryID,':hospitalcode'=>$hospitalCode ));
            $data=array();
            while($row=$query->fetch(PDO::FETCH_ASSOC))
            {
                $data[]=$row;
            }
            return $data;
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }

     public function getDocName($doctor)
    {
        try
        {
            $query=$this->conn->prepare("SELECT firstname,middlename,lastname,employeeId  from staff where employeeId = :employeeId");
            $row =$query->execute(array(':employeeId'=>$doctor));
            if($row>0){
                $result = $query->fetch(PDO::FETCH_ASSOC);
                $fullname = $result['firstname']." ". $result['middlename']." ". $result['lastname'];
           
            return $fullname;
            }
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }


    public function my_simple_crypt($string, $action = 'e' )
    {
        // you may change these values to your own
        $secret_key = 'emrhmytechnologies@1234567890';
        $secret_iv = 'hmytechnologiesemr@0987654321';

        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

        if( $action == 'e' ) {
            $output = base64_encode(openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }

        return $output;
    }


    public function searchPatient($search_text)
    {
        try {
            $query = $this->conn->prepare("SELECT
            patientNo,firstName, middleName,lastName,sex,dob,address,telNumber,paymenttypeCode
            FROM patient
            WHERE (patientNo LIKE :search OR firstName LIKE :search OR lastName LIKE :search OR 
            sex LIKE :search OR telNumber LIKE :search OR concat(firstName, ' ',middleName) LIKE :search 
            )");
            $query->execute(array(':search' => '%' . $search_text . '%'));
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $exception) {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function searchPatientAutocomplete($search_text)
    {
        try {
            $query = $this->conn->prepare("SELECT distinct
            patient.patientNo,firstName, middleName,lastName,sex,dob,address,telNumber,paymenttypeCode,patientvisit.patientNo,visitStatus
            FROM patient,patientvisit
            WHERE patient.patientNo = patientvisit.patientNo and (patient.patientNo LIKE :search OR firstName LIKE :search OR lastName LIKE :search OR 
            sex LIKE :search OR telNumber LIKE :search OR concat(firstName, ' ',middleName) LIKE :search)");
            $query->execute(array(':search' => '%' . $search_text . '%'));
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row['firstName']." ". $row['middleName'];
                //$data[] = $row['firstName'];
            }
            return $data;
        } catch (PDOException $exception) {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getServicePrice($paymenttypeCode,$serviceCode)
    {
        try
        {
            $query = $this->conn->prepare("SELECT * from service_cost where serviceCode='$serviceCode' and paymenttypeCode = '$paymenttypeCode'");
            $query->execute();
            $row=$query->fetch(PDO::FETCH_ASSOC);
            // if($healthSchemeID==3)
            //     $priceService=$row['cash'];
            // else if($healthSchemeID==4)
            //     $priceService=$row['credits'];
            // else if($healthSchemeID==2)
            //     $priceService=$row['insurance'];
            // else if($healthSchemeID==5)
            //     $priceService=$row['fasttrack'];
            // else
            //     $priceService=$row['costsharing'];

            return $row['price'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getCategoryID($servicesID)
    {
        try
        {
            $query = $this->conn->prepare("SELECT c.categoryID from servicecategory c,servicesubcategory sc,service s where c.categoryID=sc.categoryID and sc.subCategoryID=s.subCategoryID and s.serviceID=:servID");
            $query->execute(array(':servID'=>$servicesID));
            $row=$query->fetch(PDO::FETCH_ASSOC);
            $categoryID=$row['categoryID'];
            return $categoryID;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getPatientService($patientNo,$visitNo)

    {
        try
        {
            $query = $this->conn->prepare("SELECT serviceCode,patientServiceID,paymenttypeCode,price,paymentID,saleStatus,receiptInvoice,saleDate,userID from patient_service where patientNo=:patNo and visitNo=:visNo");
            $query->execute(array(':patNo'=>$patientNo,':visNo'=>$visitNo));
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getAppointmentPatientService($patientNo,$visitNo)

    {
        try
        {
            $query = $this->conn->prepare("SELECT serviceCode,patientServiceID,paymenttypeCode,price,paymentID,saleStatus,receiptInvoice,saleDate,userID from patient_service where patientNo=:patNo and visitNo=:visNo");
            $query->execute(array(':patNo'=>$patientNo,':visNo'=>$visitNo));
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    

    public function isFieldExistMult($table,$conditions = array())
    {
        try
        {
            $query=$this->getRows($table,array('where'=>$conditions));
            if(!empty($query))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }



    public function getVisitStatus($patientNo)
    {
        try
        {
            $query = $this->conn->prepare("SELECT max(visitStatus) from patientvisit where patientNo=:pNo order by visitDate ASC");
            $query->execute(array(':pNo'=>$patientNo));
            $row=$query->fetch(PDO::FETCH_ASSOC);
            $visitStatus=$row['visitStatus'];
            return $visitStatus;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getPInfo($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patient,patientvisit  where patient.patientNo=patientvisit.patientNo and patient.patientNo='$patientNo'");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    public function getPatientInfo()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct p.patientNo,p.firstName,p.middleName,p.lastName,p.paymenttypeCode,p.telNumber,p.address,p.sex,ps.patientNo,ps.visitNo,p.dob from patient as p,patientvisit as ps where p.patientNo = ps.patientNo group by paymenttypeCode, p.patientNo,p.firstName,p.middleName,p.lastName");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getUser()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from users as u,roles as r where u.roleID = r.roleID");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    public function shehiaName()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from shehia");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function hospital()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from hospital");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getPatientEdit()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patient as p,healthscheme as h, shehia as s where p.healthSchemeID = h.healthSchemeID and p.shehiaCode = s.shehiaCode ");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getCurrentVisit($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patient as p,available_payment_types as h,patientvisit as v where p.paymenttypeCode=h.paymenttypeCode and v.patientNo = p.patientNo  and visitStatus=0 and visitDate = '$today'");
            $sql->execute(array());
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getCurrentVisits($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patient as p,paymenttype as h,patientvisit as v where
 p.paymenttypeCode=h.paymenttypeCode
 and v.patientNo = p.patientNo  and visitStatus=0 and visitDate = '$today'");
            $sql->execute(array());
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientMedication($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patient_medication  where   reportingDate =:td");
            $sql->execute(array(':td'=>$today));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getAllegy()
    {
        try
        {
            //$sql = $this->conn->prepare("SELECT * from allergy");
            $sql = $this->conn->prepare("SELECT * from allergy as a, allergy_type as t where a.allergy_typeID =t.allergy_typeID ");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getAllegy_type()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from allergy_type");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    public function getPatientTriage()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct patient.patientNo,firstName,middleName,lastName,dob,sex,address,patient_service.visitNo,triage.visitNo,serviceCode,triageCurrentStatus 
            from patient,triage,patient_service,patientvisit where triage.patientNo = patient.patientNo and patient.patientNo = patientvisit.patientNo and
              patient_service.visitNo = triage.visitNo AND patientTriageStatus!=2 AND triageStatus=1 and visitStatus = 0");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientDoctor()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct patient.patientNo,patientvisit.visitNo,checkin,visitDate,firstName,middleName,lastName,score,sex,dob,address,
            telNumber,doctorServiceStatus,visitStatus,patient_service.userID,patientTriageStatus from patient,patientvisit,triage,patient_service where 
            patient.patientNo = patient_service.patientNo and triage.visitNo = patientvisit.visitNo and patient.patientNo = patientvisit.patientNo and  
            visitStatus = 0 and checkin = 0 and onBooking = 0 and patientTriageStatus=2   group by visitNo order by score DESC");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getPatientDoctorWithoutTriage()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct patient.patientNo,patientvisit.visitNo,checkin,visitDate,firstName,middleName,lastName,score,sex,dob,address,
            doctorServiceStatus,telNumber,visitStatus,patient_service.userID,patientTriageStatus from patient,patientvisit,triage,patient_service where 
            patient.patientNo = patient_service.patientNo and triage.visitNo = patientvisit.visitNo and patient.patientNo = patientvisit.patientNo and  
            visitStatus = 0 and checkin = 0 and onBooking = 0 and triageStatus=0   group by visitNo order by score DESC");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getPatientDoctorChecked($userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct patient.patientNo,patientvisit.visitNo,checkin,visitDate,firstName,middleName,lastName,score,sex,dob,address,
            doctorServiceStatus,telNumber,visitStatus,patient_service.userID from patient,patientvisit,triage,patient_service where  
             patient.patientNo = patient_service.patientNo and patient.patientNo = patientvisit.patientNo and  
             triage.visitNo = patientvisit.visitNo and patient_service.userID = '$userID' and  visitStatus = 0 and 
             checkin = 1 and onBooking = 0 and patientTriageStatus=2  group by visitNo order by score DESC");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientDoctorCheckedWithoutTriage($userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct patient.patientNo,patientvisit.visitNo,checkin,visitDate,firstName,middleName,lastName,score,sex,dob,address,
            doctorServiceStatus,telNumber,visitStatus,patient_service.userID from patient,patientvisit,triage,patient_service where   
            patient.patientNo = patient_service.patientNo and patient.patientNo = patientvisit.patientNo and  triage.visitNo = patientvisit.visitNo and
             patient_service.userID = '$userID' and  visitStatus = 0 and checkin = 1 and onBooking = 0 and patientTriageStatus=0  group by visitNo order by score DESC");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function getPatientDoctorAppointment()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct patient.patientNo,patientvisit.visitNo,firstName,middleName,lastName,sex,dob,address,
            telNumber,visitStatus from patient,patientvisit,triage where patient.patientNo = patientvisit.patientNo and 
            triage.patientNo = patient.patientNo and visitStatus = 0 and onBooking = 1");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getDoctorInfon($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patient as p,triage as t where t.patientNo = p.patientNo  AND p.patientNo = :pNo");
            $sql->execute(array(":pNo"=>$patientNo));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getTotalPatient()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(patientNo) as total from patient");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getSchedule()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT (patientNo) as total from patient");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getTotalVisit($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(patientNo) as total from patientvisit where visitDate=:td");
            $sql->execute(array(":td"=>$today));
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getTotalDoctors()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(users.userID) as total from users,user_roles where users.userID =  user_roles.userID and  roleCode='2'");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getTotalOtherStaffs()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(users.userID) as total from users,user_roles where users.userID =  user_roles.userID and  roleCode !='99'");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientServiceAtDoctor($patientNo,$visitNo,$paymenttype)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patient,patienttest as pt,service,service_cost where  service_cost.serviceCode = service.serviceCode and 
            pt.servicesCode = service.serviceCode and   patient.patientNo = pt.patientNo and  patient.patientNo=:patNo and visitNo =:visNo and  
            service_cost.paymenttypeCode = '$paymenttype' ");
            $sql->execute(array(':patNo'=>$patientNo,':visNo'=>$visitNo));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientServiceAtProcedure($patientNo,$vt,$paymenttypeCode)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * FROM patientprocedure,service_cost where patientprocedure.serviceCode = service_cost.serviceCode and   
            patientprocedure.patientNo='$patientNo' and visitNo ='$vt' and paymenttypeCode = '$paymenttypeCode'");
            $sql->execute(array(':patNo'=>$patientNo,':visNo'=>$vt));
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getPatientServiceAtProcedures($patientNo,$vt)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * FROM patientprocedure,service_cost where patientprocedure.serviceCode = service_cost.serviceCode and   
            patientprocedure.patientNo='$patientNo' and visitNo ='$vt'");
            $sql->execute(array(':patNo'=>$patientNo,':visNo'=>$vt));
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    

    public function reverse_birthday($years){
        return date('Y-m-d', strtotime($years . ' years ago'));
    }
   
    public function getOrderTest()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from servicecategory where isTest = 1 ");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getOrderProcedures()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from servicecategory where categoryCode = 'Q0FUMDcg' ");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getOrderTest2($categoryCode,$paymenttypeCode)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from servicesubcategory,servicecategory,service_cost,service where  
            servicecategory.categoryCode = servicesubcategory.categoryCode and service.subCategoryCode = servicesubcategory.subcategoryCode 
            and service.serviceCode = service_cost.serviceCode  and  servicecategory.categoryCode = '$categoryCode' and service_cost.paymenttypeCode = '$paymenttypeCode' ");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getOrderProcedure($categoryCode,$paymenttypeCode)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from servicesubcategory,servicecategory,service_cost,service where 
            servicecategory.categoryCode = servicesubcategory.categoryCode and service.subCategoryCode = servicesubcategory.subcategoryCode and 
            service.serviceCode = service_cost.serviceCode  and  servicecategory.categoryCode = '$categoryCode' and service_cost.paymenttypeCode = '$paymenttypeCode'  ");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getDayName()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT DAYNAME(date) from schedule");
            $row = $sql->execute();
            if($row>0){
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                return $result;
            }
          
                
          
            
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getStaffs()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT staff.staffId,staff.employeeId,staff.firstname,staff.middlename,staff.lastname,staff.dateofbirth,staff.physicalAddress,
            staff.tell,staff.cadreID,staff.deptId,staff.schoolAttended,staff.licence,staff.degreeHeld,staff.email,staff.facebook,
            cadre.cadreID,cadre.cardename,department.deptID,department.deptname from staff,cadre,department where 
                    staff.cadreID=cadre.cadreID and 
                     staff.deptID=department.deptID");
                      $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    
    public function getAppoitment()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT appoitment.patientNo,appoitment.appointmentID,clinicCode,clininCode,clinicName,
            appoitment.firstName,appoitment.middleName,appoitment.lastName,serviceCode,appoitment.employeeId,
            time,appoitment.tell,aptDate,staff.firstname,staff.middlename,staff.lastname
                from appoitment,staff,clinic where  
                    appoitment.employeeId=staff.employeeId and clinic.clinicCode=appoitment.clininCode  ");
                      $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getAppoitmentReschedule($doctor)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT appoitment.patientNo,appoitment.appointmentID,clinicCode,clininCode,clinicName,appoitment.firstName,appoitment.middleName,appoitment.lastName,serviceCode,
            appoitment.employeeId,time,appoitment.tell,aptDate,staff.firstname,staff.middlename,staff.lastname
                from appoitment,staff,clinic where 
                    appoitment.employeeId=staff.employeeId and clinic.clinicCode=appoitment.clininCode and appoitment.employeeId='$doctor' ");
                   $row =   $sql->execute();
            if($row >0){
                return $sql->fetchAll();
            }
           
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getAppoitmentEdit($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT appoitment.patientNo,appoitment.appointmentID,clinicCode,clininCode,clinicName,
            appoitment.firstName,appoitment.middleName,appoitment.lastName,serviceCode,appoitment.employeeId,time,appoitment.tell,
            aptDate,staff.firstname,staff.middlename,staff.lastname
                from appoitment,staff,clinic where 
                    appoitment.employeeId=staff.employeeId and clinic.clinicCode=appoitment.clininCode and patientNo = '$patientNo' ");
                      $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getDoc($doctor)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT firstname,middlename,lastname,employeeId  from staff where employeeId = '$doctor'");
                      $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    


    public function UploadProfile($table,$data)
    {

        $imgFile = $_FILES['profile']['name'];
        $tmp_dir = $_FILES['profile']['tmp_name'];
        $imgSize = $_FILES['profile']['size'];
        $upload_dir = 'profile/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $userpic = rand(1000,1000000).".".$imgExt;
   //$_FILES['profile']['name'];//
    
   // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$userpic);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
   }
  
  
  
  // if no error occured, continue ....
if(!isset($errMSG))
  {
    if(!empty($data) && is_array($data)){
        $columns = '';
        $values  = '';
        $i = 0;
       if(!array_key_exists('createdDate',$data)){
            $data['createdDate'] = date("Y-m-d H:i:s");
        }
        if(!array_key_exists('modifiedDate',$data)){
            $data['modifiedDate'] = date("Y-m-d H:i:s");
        }

         if(!array_key_exists('createdBy',$data)){
            $data['createdBy'] = $_SESSION['user_session'];
        }
        
        

        $columnString = implode(',', array_keys($data));
        $valueString = ":".implode(',:', array_keys($data));
        $sql = "INSERT INTO ".$table." (".$columnString.") VALUES (".$valueString.")";
        $query = $this->conn->prepare($sql);
        foreach($data as $key=>$val){
             $query->bindValue(':'.$key, $val);
        }
        $insert = $query->execute();
        return $insert?$this->conn->lastInsertId():true;
       
    }else{
        return false;
    }

  }
}


public function getScheduleDocName()
    {
        try
        {
            $query=$this->conn->prepare("SELECT distinct firstname,middlename,lastname,schedule.employeeId,cardename,cadre.cadreID,staff.cadreID   from staff,schedule,cadre where schedule.employeeId = staff.employeeId and cardename='Doctor'");
            $row =$query->execute();
            if($row>0){
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                
            return $result;
            }
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }


    function SplitTime($StartTime, $EndTime, $Duration="60")
    {
        
        try
        {
        $ReturnArray = array ();// Define output
        $StartTime    = strtotime ($StartTime); //Get Timestamp
        $EndTime      = strtotime ($EndTime); //Get Timestamp
    
        $AddMins  = $Duration * 30;
    
        while ($StartTime <= $EndTime) //Run loop
        {
            $ReturnArray[] = date ("G:i", $StartTime);
            $StartTime += $AddMins; //Endtime check
        }
        return $ReturnArray;
        } catch (PDOException $ex) {
        echo "Getting Data Error: ".$ex->getMessage();
        }
    }


    public function getDates($employeeId,$date)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT from_,to_ from schedule where employeeId=:employeeId and date=:date");
            $sql->execute(array(':employeeId'=>$employeeId,':date'=>$date));
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
            echo $ex;
        }
    }


    public function CheckSchedule($date,$employeId)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT *from appoitment where aptDate=:aptDate and employeeId=:employeeId");
            $row = $sql->execute(array(':aptDate'=>$date,':employeeId'=>$employeId));
            $row=$sql->fetchAll();
            return $row;
            // if($row>0){
            //    return $row;
            // }else{
                
            
          
                
          
            
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
           
        }
    }


    public function getPatientAppointmentInfo($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT appoitment.patientNo,clinicCode,clininCode,clinicName,patient.paymenttypeCode,appoitment.firstName,appoitment.middleName,appoitment.lastName,
            patient.firstName,patient.middleName,patient.lastName,patient.dob,patient.patientNo,bloodGroup,address,staff.employeeId,staff.firstname,staff.middlename,staff.lastname
            serviceID,appoitment.employeeId,time,appoitment.tell,aptDate from appoitment,patient,clinic,staff,available_payment_types where 
                    appoitment.patientNo=patient.patientNo and staff.employeeId =appoitment.employeeId And patient.patientNo =:patientNo");
                      $sql->execute(array(':patientNo'=>$patientNo));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getAppTime($employeeId,$date)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT time from appoitment where employeeId=:employeeId and aptDate=:date");
            $sql->execute(array(':employeeId'=>$employeeId,':date'=>$date));
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
            echo $ex;
        }
    }

    public function getTodayAppointments($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT distinct appoitment.patientNo,appoitment.appointmentID,appoitment.firstName,appoitment.middleName,appoitment.lastName,serviceCode,appoitment.employeeId,time,appoitment.tell,aptDate,staff.firstname,staff.middlename,staff.lastname from appoitment,staff where 
                    appoitment.employeeId=staff.employeeId  and aptDate='$today'");
            $result = $sql->execute();
            if($result>0){
                $row=$sql->fetchAll(PDO::FETCH_ASSOC);

                return $row;

            }
            
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
   
    public function getRegularConsultation($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT appoitment.patientNo,appoitment.appointmentID,clinicCode,clininCode,clinicName,appoitment.firstName,appoitment.middleName,appoitment.lastName,serviceID,appoitment.employeeId,time,appoitment.tell,aptDate,staff.firstname,staff.middlename,staff.lastname
                from appoitment,staff,clinic,patientvisit where 
                    appoitment.employeeId=staff.employeeId and clinic.clinicCode=appoitment.clininCode and  appoitment.patientNo=patientvisit.patientNo and visitType = 'Consultance' and visitDate = :td");
                      $sql->execute(array(':td'=>$today));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function AppointmentConsultation($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT appoitment.patientNo,appoitment.appointmentID,clinicCode,clininCode,clinicName,appoitment.firstName,appoitment.middleName,appoitment.lastName,serviceID,appoitment.employeeId,time,appoitment.tell,aptDate,staff.firstname,staff.middlename,staff.lastname
                from appoitment,staff,clinic,patientvisit where 
                    appoitment.employeeId=staff.employeeId and clinic.clinicCode=appoitment.clininCode and  appoitment.patientNo=patientvisit.patientNo and visitType = 'Appoinment' and visitDate = :td");
                      $sql->execute(array(':td'=>$today));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function getTriageVisit($visitNo,$patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from triage,patientvisit where triage.visitNo = patientvisit.visitNo and triage.visitNo  = :visitNo and triage.patientNo  = :patientNo" );
                      $sql->execute(array(':visitNo'=>$visitNo,':patientNo'=>$patientNo));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

        public function GetInternalDespency($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT Distinct patient_medication.patientNo,patient.paymenttypeCode,
            patient_medication.visitNo,patientvisit.visitNo,
            patient.firstName,patient.middleName,patient.lastName,dob,telNumber,address
             from patient_medication,patient,patientvisit where patientvisit.visitNo = patient_medication.visitNo and 
                    patient.patientNo=patient_medication.patientNo and  reportingDate = :td and patientvisit.visitStatus = 0");
                      $sql->execute(array(':td'=>$today));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientMedicine($patientNo,$today,$visitNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT patient_medicationID,drugID,dose,patientNo,reportingDate,dispensing_status from patient_medication where   
            patientNo = :patientNo and visitNo = :visitNo and reportingDate = :td");
                      $sql->execute(array(':patientNo'=>$patientNo,':td'=>$today,':visitNo'=>$visitNo));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getDirectDispencingInfo()
    {
        try
        {
            $query=$this->conn->prepare("SELECT drugID,prediscribed_quantity,quantity_type  from patient_dispencing;");
            $query->execute();
            $data=array();
            while($row=$query->fetch(PDO::FETCH_ASSOC))
            {
                $data[]=$row;
            }
            return $data;
            
        } catch (PDOException $ex) {
            echo "Getting Data Error: ".$ex->getMessage();
        }
    }

    public function getLastId()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT max(despencingID) as Id from despencing");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['Id'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getLastDate($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT  * from patientvisit where patientNo = '$patientNo'and patientvisitID=(max)");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getMedicalHistory($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT  distinct patient_service.visitNo,patientvisit.patientNo,userID,patientvisit.visitDate from service,patient_service, patientvisit where  patientvisit.patientNo=patient_service.patientNo and service.serviceCode = patient_service.serviceCode and  patientvisit.patientNo= :patientNo group by visitNo  "); 
            $sql->execute(array(':patientNo'=>$patientNo));
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getLastInfo($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from patientvisit where patientNo ='$patientNo'
             and visitDate =(select max(visitDate) from patientvisit where patientNo ='$patientNo')");
;
             $sql->execute(array(':patientNo'=>$patientNo));
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientTestInfo()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT  * from service,servicesubcategory ,servicecategory,patient,patienttest,
            patientvisit where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode 
            and servicesubcategory.subcategoryCode=service.subCategoryCode and patientvisit.visitNo= patienttest.visitNo 
            and servicecategory.categoryCode=servicesubcategory.categoryCode and servicecategory.categoryCode='CAT03'  
            and patientvisit.visitStatus=0");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientTestInfo2($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory , patient,patienttest where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and servicesubcategory. subCategoryCode=service.subCategoryCode and servicecategory.categoryCode=servicesubcategory.categoryCode  and patient.patientNo='$patientNo'");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientTestInfos($patientNo,$visitNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory , patient,patienttest where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and servicesubcategory. subCategoryCode=service.subCategoryCode and servicecategory.categoryCode=servicesubcategory.categoryCode  and patient.patientNo='$patientNo' AND patienttest.visitNo = '$visitNo'");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientLabTestInfos($patientNo,$visitNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory , patient,patienttest where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and servicesubcategory. subCategoryCode=service.subCategoryCode
             and servicecategory.categoryCode=servicesubcategory.categoryCode  and patient.patientNo='$patientNo' AND patienttest.visitNo = '$visitNo' and servicecategory.categoryCode = 'CAT03'");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientRadiologyTestInfos($patientNo,$visitNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory , patient,patienttest where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and servicesubcategory. subCategoryCode=service.subCategoryCode
             and servicecategory.categoryCode=servicesubcategory.categoryCode  and patient.patientNo='$patientNo' AND patienttest.visitNo = '$visitNo' and servicecategory.categoryCode = 'Q0FUMDQ='");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getPatientTestInfo22($patientNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory , patient,patienttest where patient.patientNo= patienttest.patientNo and service.serviceID=patienttest.servicesCode and servicesubcategory. subCategoryCode=service.subCategoryCode and servicecategory.categoryCode=servicesubcategory.categoryCode and servicecategory.categoryCode=1  and patient.patientNo='$patientNo'");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientRadiologyInfo()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory,patient,patienttest,patientvisit 
            where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and 
            servicesubcategory.subcategoryCode=service.subCategoryCode and patientvisit.visitNo= patienttest.visitNo 
            and servicecategory.categoryCode=servicesubcategory.categoryCode and servicecategory.categoryCode='Q0FUMDQ=' 
            and checkin=1 and patientvisit.visitStatus=0 group by patientvisit.visitNo");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientRadiologyInfo1()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory,patient,patienttest,patientvisit where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and servicesubcategory.subcategoryCode=service.subCategoryCode and patientvisit.visitNo= patienttest.visitNo and servicecategory.categoryCode=servicesubcategory.categoryCode and servicecategory.categoryCode='Q0FUMDQ=' and patientvisit.visitStatus=0");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

        public function getPatientRadiologyInfowithID($userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT * from service,servicesubcategory ,servicecategory,patient,patienttest,patientvisit,patient_service where 
            patientvisit.visitNo = patient_service.visitNo and  patient.patientNo= patienttest.patientNo and 
            service.serviceCode=patienttest.servicesCode and servicesubcategory.subcategoryCode=service.subCategoryCode 
            and patientvisit.visitNo= patienttest.visitNo and servicecategory.categoryCode=servicesubcategory.categoryCode 
            and servicecategory.categoryCode='Q0FUMDQ='  and patientvisit.visitStatus=0 and userID = '$userID' 
            group by patient.patientNo ,patientvisit.visitNo");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getPatientRadiologyInfo2($patientNo,$visitNo)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT DISTINCT(servicesCode), cs.subCategoryCode,c.categoryCode, servicesCode, testNo,patient.patientNo,patienttest.patientNo, visitNo,testStatus, reportingDate, firstName, middleName, lastName from service,servicesubcategory cs,servicecategory c, patient,patienttest where patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and cs.subCategoryCode=service.subCategoryCode and c.categoryCode=cs.categoryCode and c.categoryCode='Q0FUMDQ=' and patient.patientNo='$patientNo' and visitNo = '$visitNo'");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getPatientAdmittedInfo()
    {
        try
        {
            $sql = $this->conn->prepare(" SELECT DISTINCT patient.patientNo,patientrelease.patientNo, firstName,middleName,lastName,
            dob,address,ward.wardCode,patientrelease.wardCode,opdreleasestatus.opdreleasestatusID,patientreleaseID,
            patientrelease.opdreleasestatusID,Admitted,patientrelease.visitNo from
             ward, patientrelease ,opdreleasestatus, patient where ward.wardCode=patientrelease.wardCode 
             and patient.patientNo=patientrelease.patientNo and opdreleasestatus.opdreleasestatusID=patientrelease.opdreleasestatusID
              and opdreleasestatus.opdreleasestatusID=2");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getDiagnosisReport($month)
    {
        try
        {
            // $sql = $this->conn->prepare("SELECT DISTINCT icdcode ,YEAR(CURDATE()) - YEAR(dob) AS AGE,ageAtVisit,dob,Count(if(patientDiseaseCase =0,1,NULL ))as repeate,Count(if(patientDiseaseCase =1,1,NULL))as new,visitdate from patientdiagnosis,patientvisit,patient where patient.patientNo =patientdiagnosis.patientNo and  patientdiagnosis.visitNo = patientvisit.visitNo  group by icdcode,visitdate,dob,ageAtVisit;"); 
             $sql = $this->conn->prepare(" select icdcode,sum(case when patientDiseaseCase = 0 and ageAtVisit < 5 and month(visitDate)='$month' then  1 else 0 end) as new_underfive,sum(case when patientDiseaseCase = 1 and ageAtVisit < 5  and month(visitDate)='$month' then  1 else 0 end) as repeate_underfive, 
             sum(case when patientDiseaseCase = 0 and ageAtVisit >= 5 and month(visitDate)='$month' then  1 else 0 end) as new_overfive,sum(case when patientDiseaseCase = 1 and ageAtVisit >= 5 and month(visitDate)='$month' then  1 else 0 end) as repeate_overfive
               from patient,patientvisit,patientdiagnosis  where patient.patientNo =patientdiagnosis.patientNo and  patientdiagnosis.visitNo = patientvisit.visitNo  group by icdcode"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


   


    public function getYear($year)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT YEAR($year) AS Year;"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }

    

   
    
    
}


public function ageCalculator1($dob)
{
    $dob = strtotime($dob);
    $current_time = time();
    
    $age_years = date('Y',$current_time) - date('Y',$dob);
    $age_months = date('m',$current_time) - date('m',$dob);
    $age_days = date('d',$current_time) - date('d',$dob);
    
    if ($age_days=0) {
        $days_in_month = date('t',$current_time);
        $age_months--;
        $age_days= $days_in_month+$age_days;
    }
    
    if ($age_months<0) {
        $age_years--;
        $age_months = 12+$age_months;
    }
    if($age_years<=5)
    {
        if($age_years>0)
        {
            if($age_months==0)
            {
                $age=$age_years;
            }
            else
            {
                $age=$age_years;
                // ."(".$age_months."/12)"
            }
        }
        else
        {
            $age=$age_months." months";
        }
    }
    else
    {
        $age=$age_years;
    }
    return $age; 
   /* if(!empty($dob))
    {
        $birthdate=new DateTime($dob);
        $today=new DateTime('today');
        $age=$birthdate->diff($today)->y;
        return $age;
    }
    else
    {
        return 0;
    }
    */
}



public function getPatientvisitTime()
    {
        try
        {
            $sql = $this->conn->prepare("select distinct  monthname(visitDate) as month,Month(visitDate) as montno,YEAR(visitDate)as year from patientvisit where month(visitDate) < month(now());");
            $sql->execute();
            
            return $sql->fetchAll();
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getDiagnosisTotal($month)
    {
        try
        {
            // $sql = $this->conn->prepare("SELECT DISTINCT icdcode ,YEAR(CURDATE()) - YEAR(dob) AS AGE,ageAtVisit,dob,Count(if(patientDiseaseCase =0,1,NULL ))as repeate,Count(if(patientDiseaseCase =1,1,NULL))as new,visitdate from patientdiagnosis,patientvisit,patient where patient.patientNo =patientdiagnosis.patientNo and  patientdiagnosis.visitNo = patientvisit.visitNo  group by icdcode,visitdate,dob,ageAtVisit;"); 
             $sql = $this->conn->prepare(" select sum(case when patientDiseaseCase = 0 and ageAtVisit < 5 and month(visitDate)='$month' then  1 else 0 end) as new_underfive,sum(case when patientDiseaseCase = 1 and ageAtVisit < 5  and month(visitDate)='$month' then  1 else 0 end) as repeate_underfive, 
             sum(case when patientDiseaseCase = 0 and ageAtVisit >= 5 and month(visitDate)='$month' then  1 else 0 end) as new_overfive,sum(case when patientDiseaseCase = 1 and ageAtVisit >= 5 and month(visitDate)='$month' then  1 else 0 end) as repeate_overfive
               from patient,patientvisit,patientdiagnosis  where patient.patientNo =patientdiagnosis.patientNo and  patientdiagnosis.visitNo = patientvisit.visitNo"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }



    public function getDiagnosisWithGender($month)
    {
        try
        {
            // $sql = $this->conn->prepare("SELECT DISTINCT icdcode ,YEAR(CURDATE()) - YEAR(dob) AS AGE,ageAtVisit,dob,Count(if(patientDiseaseCase =0,1,NULL ))as repeate,Count(if(patientDiseaseCase =1,1,NULL))as new,visitdate from patientdiagnosis,patientvisit,patient where patient.patientNo =patientdiagnosis.patientNo and  patientdiagnosis.visitNo = patientvisit.visitNo  group by icdcode,visitdate,dob,ageAtVisit;"); 
             $sql = $this->conn->prepare("  select icdcode, sum(case when patientDiseaseCase = 0 and ageAtVisit < 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as RE_underfiveMale,sum(case when patientDiseaseCase = 0 and ageAtVisit < 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as RE_underfiveFemale,
             sum(case when patientDiseaseCase = 1 and ageAtVisit < 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as NEW_underfiveMale,sum(case when patientDiseaseCase = 1 and ageAtVisit < 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as NEW_underfiveFemale,
             sum(case when patientDiseaseCase = 0 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as RE_OVERfiveMale,sum(case when patientDiseaseCase = 0 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as RE_OVERfiveFemale,
             sum(case when patientDiseaseCase = 1 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as NEW_OVERfiveMale,sum(case when patientDiseaseCase = 1 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as NEW_OVERfiveFemale
              from patient,patientvisit,patientdiagnosis  where patient.patientNo =patientdiagnosis.patientNo and  patientdiagnosis.visitNo = patientvisit.visitNo group by icdcode;"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getDiagnosisTotalWithGender($month)
    {
        try
        {
            // $sql = $this->conn->prepare("SELECT DISTINCT icdcode ,YEAR(CURDATE()) - YEAR(dob) AS AGE,ageAtVisit,dob,Count(if(patientDiseaseCase =0,1,NULL ))as repeate,Count(if(patientDiseaseCase =1,1,NULL))as new,visitdate from patientdiagnosis,patientvisit,patient where patient.patientNo =patientdiagnosis.patientNo and  patientdiagnosis.visitNo = patientvisit.visitNo  group by icdcode,visitdate,dob,ageAtVisit;"); 
             $sql = $this->conn->prepare("select  sum(case when patientDiseaseCase = 0 and ageAtVisit < 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as RE_underfiveMale,sum(case when patientDiseaseCase = 0 and ageAtVisit < 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as RE_underfiveFemale,
             sum(case when patientDiseaseCase = 1 and ageAtVisit < 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as NEW_underfiveMale,sum(case when patientDiseaseCase = 1 and ageAtVisit < 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as NEW_underfiveFemale,
             sum(case when patientDiseaseCase = 0 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as RE_OVERfiveMale,sum(case when patientDiseaseCase = 0 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as RE_OVERfiveFemale,
             sum(case when patientDiseaseCase = 1 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as NEW_OVERfiveMale,sum(case when patientDiseaseCase = 1 and ageAtVisit >= 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as NEW_OVERfiveFemale
              from patient,patientvisit,patientdiagnosis  where patient.patientNo = patientdiagnosis.patientNo and patientvisit.visitNo =   patientdiagnosis.visitNo"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getLabReport($month)
    {
        try
        {
            
             $sql = $this->conn->prepare(" SELECT serviceName,sum(case when ageAtVisit < 5 and month(visitDate)='$month' then  1 else 0 end) as underfiveno,sum(case when ageAtVisit >= 5 and month(visitDate)='$month' then  1 else 0 end) as Overfiveno
              from service,servicesubcategory ,servicecategory ,patientvisit, patient,patienttest where patient.patientNo = patientvisit.patientNo and patient.patientNo= patienttest.patientNo and service.serviceID=patienttest.servicesID and
               servicesubcategory. subCategoryID=service.subCategoryID and servicecategory.categoryID=servicesubcategory.categoryID
              and servicecategory.categoryID=1 group by serviceName;"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }



    public function getLabReportWithGender($month)
    {
        try
        {
            
             $sql = $this->conn->prepare(" SELECT serviceName, sum(case when ageAtVisit < 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as underfivenoMale,sum(case when ageAtVisit < 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as underfivenofe,sum(case when ageAtVisit >= 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as overfivenoMale,sum(case when ageAtVisit >= 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as Overfivenofe
              from service,servicesubcategory ,servicecategory ,patientvisit, patient,patienttest where patient.patientNo = patientvisit.patientNo and patient.patientNo= patienttest.patientNo and service.serviceCode=patienttest.servicesCode and
               servicesubcategory. subCategoryCode=service.subCategoryCode and servicecategory.categoryCode=servicesubcategory.categoryCode
               group by serviceName;"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getRadiologyReport($month)
    {
        try
        {
            
             $sql = $this->conn->prepare(" SELECT serviceName,sum(case when ageAtVisit < 5 and month(visitDate)='$month' then  1 else 0 end) as underfiveno,sum(case when ageAtVisit >= 5 and month(visitDate)='$month' then  1 else 0 end) as Overfiveno
              from service,servicesubcategory ,servicecategory ,patientvisit, patient,patienttest where patient.patientNo = patientvisit.patientNo and patient.patientNo= patienttest.patientNo and service.serviceID=patienttest.servicesID and
               servicesubcategory. subCategoryID=service.subCategoryID and servicecategory.categoryID=servicesubcategory.categoryID
              and servicecategory.categoryID=2 group by serviceName;"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getRadiologyReportWithGender($month)
    {
        try
        {
            
             $sql = $this->conn->prepare(" SELECT serviceName, sum(case when ageAtVisit < 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as underfivenomale,sum(case when ageAtVisit < 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as underfivenofemale,sum(case when ageAtVisit >= 5 and month(visitDate)='$month' and sex='M' then  1 else 0 end) as overfivenomale,sum(case when ageAtVisit >= 5 and month(visitDate)='$month' and sex='F' then  1 else 0 end) as overfivenofemale
              from service,servicesubcategory ,servicecategory ,patientvisit, patient,patienttest where patient.patientNo = patientvisit.patientNo and patient.patientNo= patienttest.patientNo and service.serviceID=patienttest.servicesID and
               servicesubcategory. subCategoryID=service.subCategoryID and servicecategory.categoryID=servicesubcategory.categoryID
              and servicecategory.categoryID=2 group by serviceName;"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


public function getRoles()
    {
        try
        {
            
             $sql = $this->conn->prepare(" SELECT * from roles where roleName !='Super Administrator'"); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


public function patientLabTest($patientNo,$testNo)
    {
        try
        {
            
             $sql = $this->conn->prepare(" SELECT serviceID,labResult,labTest.testNo,docResult,patienttest.patientNo,patienttest.testNo,hospitalCode from patienttest,labtest where patienttest.testNo =labtest.testNo "); 
            $sql->execute();
            $row=$sql->fetchAll();
            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getTotalCategory()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(categoryID) as total from servicecategory");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getTotalSubCategory()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(subcategoryID) as total from servicesubcategory");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    public function getTotalService()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(serviceID) as total from service");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function getTotalRegion()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(regionCode) as total from region");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getTotalDistrict()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(districtID) as total from district");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getTotalShehia()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(shehiaID) as total from shehia");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getTotalZone()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(zoneID) as total from zone");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getLasthospitalID()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT max(id) as Id from hospital");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['Id'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function encrypt($sData){
        $encrypt_method = base64_encode($sData);
        return $encrypt_method;
    }
    public function decrypt($sData){
        $dencrypt_method = base64_decode($sData);
        return $dencrypt_method;
    }



     public function CheckAvailablePayments()
     {
        try
        {
            $sql = $this->conn->prepare("SELECT paymenttypeCode from available_payment_types");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['paymenttypeCode'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getGovisit($categoryCode,$paymenttypeCode)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT *  from service_cost,servicesubcategory,service,servicecategory where servicesubcategory.categoryCode = servicecategory.categoryCode and servicesubcategory.subCategoryCode = service.subCategoryCode and service.serviceCode = service_cost.serviceCode   and servicecategory.categoryCode = '$categoryCode' and service_cost.paymenttypeCode='$paymenttypeCode' ");
            $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getavailable_payment_types($serviceCode)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT *  from service_cost where serviceCode = '$serviceCode'  ");
            $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getavailable_payment_typesS()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT *  from available_payment_types  ");
            $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getavailable_payment_typesss()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT *  from paymenttype  ");
            $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getAvailableServive()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT *  from serviceoffered where isActive = 1 ");
            $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function checkAvailable($paymenttypecode)
    {
       try
       {
          $stmt = $this->conn->prepare("SELECT * from available_payment_types where paymenttypeCode='$paymenttypecode'");
          $stmt->execute();
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
                return true;
             }
             else
             {
                return false;
             }
          }
       
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }


   public function checkAvailableServices($serviceCode)
    {
       try
       {
          $stmt = $this->conn->prepare("SELECT * from serviceoffered where serviceCode='$serviceCode'");
          $stmt->execute();
          $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
                return true;
             }
             else
             {
                return false;
             }
          }
       
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

    public function getRole()
    {
       try
       {
         $sql = $this->conn->prepare("SELECT * from roles where roleCode != 'UjA4'");
         $sql->execute();
        $row=$sql->fetchAll();

            return $row;
        
          
       
       }catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

    public function getAPI($URL)
    {
       try{
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PORT, 80);
        $body = curl_exec($ch);
        $error = curl_error($ch);
        $URL_array = json_decode($body);
        return $URL_array;
        
       
       }catch(PDOException $e){
           echo $e->getMessage();
       }
    }


    public function api($url)
        {   
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_PORT, 80 );
        $api_body = curl_exec( $ch );
        $error = curl_error( $ch );
        $result = json_decode( $api_body );
        return $result;

        }

    public function getMontlyAppointment($month)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(patientNo) as total ,DATE_FORMAT(aptDate,'%m') as monthy  FROM  appoitment where  DATE_FORMAT(aptDate,'%m') =:td");
            $sql->execute(array(":td"=>$month));
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getPaymentTypePrice($serviceCode,$paymenttypeCode)
    {
        try
        {
            $sql = $this->conn->prepare("select price from service_cost where serviceCode = '$serviceCode' and paymenttypeCode = '$paymenttypeCode' 
");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['price'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function getPatientMontlyAppointment($month,$userID)
    {
        try
        {
            $sql = $this->conn->prepare("select count(patient_service.patientNo) as total ,DATE_FORMAT(visitDate,'%m') as monthy,userID,patientvisit.patientNo,visitDate  FROM  patientvisit,patient_service where patient_service.visitNo = patientvisit.visitNo and  DATE_FORMAT(visitDate,'%m') =:td and userID = '$userID' and visitStatus=1");
            $sql->execute(array(":td"=>$month));
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getLabPatientMontlyAppointment($month,$userID)
    {
        try
        {
            $sql = $this->conn->prepare("select count(patient_service.patientNo) as total ,DATE_FORMAT(visitDate,'%m') as monthy,userID,patientvisit.patientNo,visitDate  FROM  patientvisit,patient_service,patienttest where patienttest.visitNo = patientvisit.visitNo and  patient_service.visitNo = patientvisit.visitNo and  DATE_FORMAT(visitDate,'%m') =:td and userID = '$userID' and patienttest.visitStatus=1");
            $sql->execute(array(":td"=>$month));
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function getRadiologyPatientMontlyAppointment($month,$userID)
    {
        try
        {
            $sql = $this->conn->prepare("select count(patient_service.patientNo) as total ,DATE_FORMAT(visitDate,'%m') as monthy,userID,patientvisit.patientNo,visitDate  FROM  patientvisit,patient_service,patienttest where patienttest.visitNo = patientvisit.visitNo and  patient_service.visitNo = patientvisit.visitNo and  DATE_FORMAT(visitDate,'%m') =:td and userID = '$userID' and patienttest.visitStatus=1");
            $sql->execute(array(":td"=>$month));
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


     public function getWeeklyAppointment()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) AS total FROM  appoitment where  WEEKOFYEAR(aptDate) = WEEKOFYEAR(NOW())");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function getPatientWeeklyAppointment($userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) AS total FROM  patientvisit,patient_service where patientvisit.visitNo = patient_service.visitNo and   WEEKOFYEAR(visitDate) = WEEKOFYEAR(NOW()) and userID = '$userID' and visitStatus=1");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function getLabPatientWeeklyAppointment($userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) AS total FROM  patientvisit,patient_service where patientvisit.visitNo = patient_service.visitNo and   WEEKOFYEAR(visitDate) = WEEKOFYEAR(NOW()) and userID = '$userID' and visitStatus=1");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function getRadiologyPatientWeeklyAppointment($userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) AS total FROM  patientvisit,patient_service where patientvisit.visitNo = patient_service.visitNo and   WEEKOFYEAR(visitDate) = WEEKOFYEAR(NOW()) and userID = '$userID' and visitStatus=1");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getMontlyAppointmentOnQue()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) as total FROM  appoitment where appStatus = 0");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getAttended($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) as total FROM  appoitment where appStatus = 0 and aptDate = '$today'");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function PatientOnQue($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT count(*) as total FROM  patientvisit,patient_service,triage where triage.visitNo = patientvisit.visitNo and  patientvisit.visitNo = patient_service.visitNo   and checkin=0 and  visitStatus = 0 and visitDate = '$today' and  patientTriageStatus=1 or triage.visitNo = patientvisit.visitNo and  patientvisit.visitNo = patient_service.visitNo   and checkin=0 and  visitStatus = 0 and visitDate = '$today' and triageStatus=0 and  patientTriageStatus=0 ");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

      public function LabPatientOnQue($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT count(*) as total FROM  patientvisit,patient_service where patientvisit.visitNo = patient_service.visitNo   and checkin=0 and  visitStatus = 0 and visitDate = '$today'");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function RadiologyPatientOnQue($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT count(*) as total FROM  patientvisit,patient_service,patienttest where patient_service.visitNo = patienttest.visitNo and  patientvisit.visitNo = patient_service.visitNo   and checkin=0 and  patientvisit.visitStatus = 0 and visitDate = '$today' ");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function TodayAttended($today)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) as total FROM  appoitment where  aptDate = '$today'");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function patientTodayAttended($today,$userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) as total FROM  patientvisit,patient_service where   patientvisit.visitNo = patient_service.visitNo and   visitDate = '$today' and userID = '$userID' AND patientvisit.visitStatus=1");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }


    public function LabpatientTodayAttended($today,$userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) as total FROM  patientvisit,patient_service where  patientvisit.visitNo = patient_service.visitNo and   visitDate = '$today' and userID = '$userID' AND visitStatus=1");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function RadiologypatientTodayAttended($today,$userID)
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) as total FROM  patientvisit,patient_service,patienttest where patienttest.visitNo = patientvisit.visitNo and   patientvisit.visitNo = patient_service.visitNo and   visitDate = '$today' and userID = '$userID' AND patientvisit.visitStatus=1");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    

     public function getCurrentDoctor($userID)
    {
       try
       {
         $sql = $this->conn->prepare("SELECT * from users,staff where users.email = staff.email  and userID = '$userID'");
         $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        
          
       
       }catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function getCurrentAppointments($empID,$today)
    {
       try
       {
         $sql = $this->conn->prepare("SELECT * from appoitment,patientvisit where appoitment.patientNo = patientvisit.patientNo and  employeeId  = '$empID' and aptDate = '$today' and onBooking = 1 and visitStatus = 0");
         $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        
          
       
       }catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

    public function getserviceRows()
    {
       try
       {
         $sql = $this->conn->prepare("SELECT * FROM servicecategory where categoryID = 1");
         $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        
          
       
       }catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }


   public function getStaffAppointment($patientNo,$today)
    {
       try
       {
         $sql = $this->conn->prepare("SELECT * FROM appoitment,staff where appoitment.employeeId = staff.employeeId and patientNo = '$patientNo' and aptDate = '$today'");
         $sql->execute();
            $row=$sql->fetchAll();

            return $row;
        
          
       
       }catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

    public function getCountCategory()
    {
        try
        {
            $sql = $this->conn->prepare("SELECT COUNT(*) AS total FROM  servicecategory");
            $sql->execute();
            $row=$sql->fetch(PDO::FETCH_ASSOC);

            return $row['total'];
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

     public function returnUrl()
    {
        try
        {
            //$url="http://ehr-api.zenjtech.com/data";
            $url="http://localhost/gvt-ehr-server/data";

            return $url;
        }
        catch(PDOException $exception)
        {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

    public function getStaffAppointments()
    {
       try
       {
         $sql = $this->conn->prepare("SELECT * FROM patient");
         $sql->execute();
         $data=array();
         while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
             $data[]=$row;
         }
         return $data;
        
          
       
       }catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function checkClinicalhistory($patientNo,$visitNo)
   {
      try
      {
        $sql = $this->conn->prepare("select clinicalHistory from consultation where patientNo = '$patientNo' and visitNo = '$visitNo'");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }


  public function checkLabImage($patientNo,$visitNo,$testNo)
   {
      try
      {
        $sql = $this->conn->prepare("select fileurl from patienttest where patientNo = '$patientNo' and visitNo = '$visitNo'and testNo = '$testNo'");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }

  public function countCurrentAppointments($empID,$today)
    {
       try
       {
         $sql = $this->conn->prepare("SELECT * from appoitment,patientvisit where appoitment.patientNo = patientvisit.patientNo and  employeeId  = '$empID' and aptDate = '$today' and onBooking = 1 and visitStatus = 0");
         $sql->execute();
            $row=$sql->rowCount();

            return $row;
        
          
       
       }catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }

   public function checkDoctorDetails($patientNo,$visitNo,$servicesCode)
   {
      try
      {
        $sql = $this->conn->prepare("select doctorDetails from patienttest where patientNo = '$patientNo' and visitNo = '$visitNo' and servicesCode='$servicesCode'");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }

  public function getClientRoles()
   {
      try
      {
        $sql = $this->conn->prepare("select * from roles where roleCode != 'UjA4'");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }

  public function getLabtestResult($patientNo,$visitNo)
   {
      try
      {
        $sql = $this->conn->prepare("SELECT * from patienttest where patientNo = '$patientNo' and visitNo = '$visitNo' and result IS NOT NULL ");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }

function check_diff_multi($array1, $array2){
    $result = array();

    foreach($array1 as $key => $val) {
        if(is_array($val) && isset($array2[$key])) {
            $tmp = $this->check_diff_multi($val, $array2[$key]);
            if($tmp) {
                $result[$key] = $tmp;
            }
        }
        elseif(!isset($array2[$key])) {
            $result[$key] = null;
        }
        elseif($val !== $array2[$key]) {
            $result[$key] = $array2[$key];
        }

        if(isset($array2[$key])) {
            unset($array2[$key]);
        }
    }

    $result = array_merge($result, $array2);

    return $result;
}


function arrayDiffAssocMultidimensional(array $array1, array $array2): array
    {
        $difference = [];
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!array_key_exists($key, $array2)) {
                    $difference[$key] = $value;
                } elseif (!is_array($array2[$key])) {
                    $difference[$key] = $value;
                } else {
                    $multidimensionalDiff = $this->arrayDiffAssocMultidimensional($value, $array2[$key]);
                    if (count($multidimensionalDiff) > 0) {
                        $difference[$key] = $multidimensionalDiff;
                    }
                }
            } else {
                if (!array_key_exists($key, $array2) || $array2[$key] !== $value) {
                    $difference[$key] = $value;
                }
            }
        }
        return $difference;
    }



    public function getServiceConsultation(){
      try{
        $sql = $this->conn->prepare("SELECT distinct(serviceCode),deptCode from service,hospital_clinic where  service.clinicCode = hospital_clinic.clinicCode GROUP BY serviceCode");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }


  public function getAvailableServiceConsultation($paymenttypeCode){
      try{
        $sql = $this->conn->prepare("SELECT * FROM serviceoffered,service,servicecategory,servicesubcategory,hospital_clinic,service_cost where servicecategory.categoryCode = servicesubcategory.categoryCode 
and servicesubcategory.subcategoryCode = service.subCategoryCode and serviceoffered.serviceCode = service.serviceCode 
AND service.clinicCode = hospital_clinic.clinicCode and service_cost.serviceCode = service.serviceCode and  servicecategory.categoryCode = 'CAT01' and paymenttypeCode = '$paymenttypeCode' ");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }

  public function getProcedures(){
      try{
        $sql = $this->conn->prepare("select * from service,hospital_clinic,service_cost where service.serviceCode = service_cost.serviceCode and   service.clinicCode = hospital_clinic.clinicCode and  isProcedure = '1'");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }

  public function getAllClinics(){
      try{
        $sql = $this->conn->prepare("select * from clinic where  clinicCode != 'C044' and clinicCode != 'C045' and clinicCode != 'C046' and clinicCode != 'C047' and clinicCode != 'C048'");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }


   public function getUsers($id){
      try{
        $sql = $this->conn->prepare("select * from users,roles,user_roles where  users.userID = user_roles.userID and user_roles.roleCode = roles.roleCode and users.userID = '$id'");
        $sql->execute();
        $data=array();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $data[]=$row;
        }
        return $data;
       
         
      
      }catch(PDOException $e)
      {
          echo $e->getMessage();
      }
  }


  public function getRecievedItems(){
    try{
      $sql = $this->conn->prepare("select * from store,recieved_items where  recieved_items.item_id = store.item_id");
      $sql->execute();
      $data=array();
      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
          $data[]=$row;
      }
      return $data;
     
       
    
    }catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

public function getExpiredItems($today){
    try{
      $sql = $this->conn->prepare("select * from store where  expire_date < '$today'");
      $sql->execute();
      $data=array();
      while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
          $data[]=$row;
      }
      return $data;
     
       
    
    }catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

  public function searchMedicineAutocomplete($search_text)
    {
        try {
            $query = $this->conn->prepare("SELECT * from store where item_name LIKE :search");
            $query->execute(array(':search' => '%' . $search_text . '%'));
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row['item_name'];
                //$data[] = $row['firstName'];
            }
            return $data;
        } catch (PDOException $exception) {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }

        public function searchItems($search_text)
    {
        try {
            $query = $this->conn->prepare("SELECT * from store,recieved_items where recieved_items.item_id = store.item_id and  item_name LIKE :search");
            $query->execute(array(':search' => '%' . $search_text . '%'));
            $data = array();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        } catch (PDOException $exception) {
            echo "Getting Data error: " . $exception->getMessage();
        }
    }
    



}