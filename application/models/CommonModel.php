<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommonModel extends CI_Model{
	function __construct(){
        parent::__construct();
    }
    //method to insert into mentioned table
     function do_insert($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
   
   //get user details
    function getuserDetails($id=""){
        $query =$this->db->query("SELECT * FROM t_user_details u LEFT JOIN t_role_master r ON r.`Id`=u.`Role_Id` WHERE u.`Id`= '".$id."'")->row();
        return $query;
        
    }
    function getusers(){
       $query =$this->db->query(" SELECT u.`CID`,u.`Contact_Numer`,u.`Full_Name`,u.`User_Id` Email_Id,u.`Id` user_id,IF(u.`User_Status`='Y','Yes','No') Active_status FROM t_user_details u LEFT JOIN t_role_master r ON r.`Id`=u.`Role_Id` ")->result_array();
        return $query;
    }

    function getinvoicedetails($status="Yes"){
        $query =$this->db->query("SELECT u.`company_name`,u.`location`, u.`email`, u.`phone1`, u.`phone2`, u.`pobox`, u.`tpn` FROM t_company u WHERE u.`status` = '".$status."'")->row();
        return $query;
    }











    function mobprepaid($month=""){
        $query =$this->db->query(" SELECT m.`Prepaid_Total`,m.`Post_Total` FROM `t_subscriber_bmobile_main` m WHERE m.`Month`=".$month." ")->row();
        return $query;
    }

    function checkdataAndDelete($taable="",$year="",$month=""){
        $query="DELETE FROM ".$taable." WHERE `Year`='".$year."' AND `Month`='".$month."'";
        $this->db->query($query);
    }

    //generated file number
    function getReportDetails($id="",$type="",$months="",$year=""){
        if($type=="bmobile"){
            $query =$this->db->query("SELECT s.`Month`,s.`Year`,".$id." header FROM `t_month_master` m LEFT JOIN `t_subscriber_bmobile_main` s ON s.`Month`=m.`Id` WHERE s.`Year` ='".$year."'")->result_array();
        }
       //die($type);
        if($type=="t_revenue_mobile_main"){
            $query =$this->db->query("SELECT m.`Month`,m.`Year`,".$id." header FROM `t_revenue_mobile_main` m WHERE m.`Year` ='".$year."'")->result_array();
        }
         if($type=="t_revenue_fixed_line_main"){
           // die($id);
            $query =$this->db->query("SELECT m.`Month`,m.`Year`,".$id." header FROM `t_revenue_fixed_line_main` m ")->result_array();
        }
        
         if($type=="t_revenue_arpu_main"){
           // die($id);
            $query =$this->db->query("SELECT m.`Month`,m.`Year`,".$id." header FROM `t_revenue_arpu_main` m ")->result_array();
        }
        
        if($type=="t_revenue_isp_main"){
           // die($id);
            $query =$this->db->query("SELECT m.`Month`,".$id." header FROM `t_revenue_isp_main` m ")->result_array();
        }
        if($type=="t_revenue_other_main"){
           // die($id);
            $query =$this->db->query("SELECT m.`Month`,".$id." header FROM `t_revenue_other_main` m ")->result_array();
        }
        
        if($type=="fixline"){
             $query =$this->db->query("SELECT m.`Month`,".$id." header FROM `t_subscriber_fixed_line_main` m WHERE m.`Year`=".$year)->result_array();
        }
        if($type=="datauser"){
             $query =$this->db->query("SELECT d.`2_G_User`,d.`3_G_User`,d.`4_G_User` FROM `t_subscriber_mobile_data_user_main` d WHERE d.`Year`=".$id)->result_array();
        }
        if($type=="vas"){
             $query =$this->db->query("SELECT d.`B_Wallet_New`,d.`B_Wallet_Total`,d.`B_Wallet_Towa` FROM `t_subscriber_vas_main` d WHERE d.`Year`=".$months." AND d.Month=".$id)->result_array();
        }
        if($type=="isp"){
             $query =$this->db->query("SELECT d.`Broad_Band_count`,d.`Contact_Center_Count`,d.`Data_Center_Count`,d.`ERP_Service_Count`,d.`Fleet_Management_Count`,d.`Lease_Line_Count`,d.`LTE_Broad_Band_count` FROM `t_subscriber_isp_main` d WHERE d.`Year`=".$id)->result_array();
        }
        if($type=="revenue-financial"){
            if($id=="mobile"){
                $query =$this->db->query("SELECT d.`Broad_Band_count`,d.`Contact_Center_Count`,d.`Data_Center_Count`,d.`ERP_Service_Count`,d.`Fleet_Management_Count`,d.`Lease_Line_Count`,d.`LTE_Broad_Band_count` FROM `t_subscriber_isp_main` d WHERE d.`Year`=".$id)->result_array();
            }
        }
        //die($query);
        return $query;
    }

    //comparegraph
    function getCompareDetails($year="",$type=""){
        if($type=="comparebmobile"){
            $query =$this->db->query("SELECT s.`Month`,s.`Year`,s.`Prepaid_Active` FROM `t_month_master` m LEFT JOIN `t_subscriber_bmobile_main` s ON s.`Month`=m.`Id` WHERE s.`Year` ='".$year."'")->result_array();
        }
         if($type=="comparepmobile"){
            $query =$this->db->query("SELECT s.`Month`,s.`Year`,s.`Post_Active` FROM `t_month_master` m LEFT JOIN `t_subscriber_bmobile_main` s ON s.`Month`=m.`Id` WHERE s.`Year` ='".$year."'")->result_array();
        }
        if($type=="compareta"){
            $query =$this->db->query("SELECT s.`Month`,s.`Year`,s.`Total_Active` FROM `t_month_master` m LEFT JOIN `t_subscriber_bmobile_main` s ON s.`Month`=m.`Id` WHERE s.`Year` ='".$year."'")->result_array();
        }
        if($type=="comparetd"){
            $query =$this->db->query("SELECT s.`Month`,s.`Year`,s.`Disconnected` FROM `t_month_master` m LEFT JOIN `t_subscriber_bmobile_main` s ON s.`Month`=m.`Id` WHERE s.`Year` ='".$year."'")->result_array();
        }

        return $query;

    }
    function getfixedlineDetails($year=""){
         $query =$this->db->query( "SELECT f.`Dzongkhag`, f.`Jan`, f.`Feb`,f.`March`,f.`Aprl`,f.`May`,f.`Jun`,f.`July`,f.`Aug`,f.`Sep`,f.`Oct`,f.`Nov`,f.`Dec` FROM `t_subscriber_fl_excel` f WHERE f.`Year` ='".$year."'")->
            result_array();
        return $query;
    }
    function getfixedlinetotal($year=""){
         $query =$this->db->query( "SELECT f.`year`,f.`Subscriber` FROM `t_subscriber_fixed_line_main` f WHERE f.`Year` ='".$year."'")->
            result_array();
        return $query;
    }
    function getfinancialtarget($year="",$type=""){
        if($type=="companytarget"){
            $query =$this->db->query("SELECT f.`Month`,f.`Revenue`, f.`Arpu_post`, f.`Arpu_pre`,f.`Active_user`,f.`Vivophone`,f.`m_revenue` FROM `t_target` f WHERE f.`Year` = '".$year."'")->result_array();
        }
        if($type=="monthlytarget"){
            $query =$this->db->query("SELECT s.`Month`,s.`Grand_Total` FROM `t_revenue_overall_main` s  WHERE s.`Year` ='".$year."'")->result_array();
        }
        return $query;
    }   

    function getSubscriber_bmobileDetails(){
        $query=$this->db->query("SELECT f.`Month`, f.`Prepaid_Active`, f.`Prepaid_Passive`,f.`Prepaid_Total`,f.`Post_Active`, f.`Post_Passive`, f.`Post_Total`,f.`Total_Active`,
            f.`Total_Registered`,f.`Disconnected`,f.`Churn_Rate`,f.`HLR`, f.`HLR_Attachment` FROM `t_subscriber_bmobile_main` f WHERE f.`Year` = '".$year."'")->result_array();
        return $query;
    }
    function getmonths(){
        $query =$this->db->query("SELECT * FROM `t_month_master` ")->result_array();
        return $query;
    }
    //method to get users
    /******************************************************************
    function getverifier($pe=""){
        $query =$this->db->query(" SELECT s.Id,s.`Full_Name`,s.`Email_Id`,s.`Role_Id` FROM `staff_tbl` s WHERE s.`Company_Id`='".$this->session->userdata('companyId')."' AND s.Id <> '".$this->session->userdata('Id')."'")->result_array();
        return $query;
       
    }
    function getAllApplicationSubmitted($type=""){
        if($type=="group"){
         $query =$this->db->query("SELECT s.`Full_Name`,d.`Designaiton`,ap.`Application_Number`,ap.`Message`,ap.`Subject`,ap.`Application_Date` FROM `application_assign_tbl` a LEFT JOIN `application_tbl` ap ON a.`Application_Number`=ap.`Application_Number` LEFT JOIN `staff_tbl` s ON s.`Id`=ap.`Submitted_Id` LEFT JOIN `designation_tbl` d ON d.`Id`=s.`Designation_Id` WHERE ap.`Status_Id` IN (1,2) AND a.`User_Id` IN ('".$this->session->userdata('Id')."')")->result_array();
        }
        else if($type=="my"){
             $query =$this->db->query("SELECT s.`Full_Name`,d.`Designaiton`,ap.`Application_Number`,ap.`Message`,ap.`Subject`,ap.`Application_Date` FROM `application_assign_tbl` a LEFT JOIN `application_tbl` ap ON a.`Application_Number`=ap.`Application_Number` LEFT JOIN `staff_tbl` s ON s.`Id`=ap.`Submitted_Id` LEFT JOIN `designation_tbl` d ON d.`Id`=s.`Designation_Id` WHERE ap.`Status_Id` =4 AND a.`User_Id` IN ('".$this->session->userdata('Id')."')")->result_array();
        }
        else if($type=="myApproved"){
             $query =$this->db->query("SELECT s.`Full_Name`,d.`Designaiton`,ap.`Application_Number`,ap.`Message`,ap.`Subject`,ap.`Application_Date` FROM `application_assign_tbl` a LEFT JOIN `application_tbl` ap ON a.`Application_Number`=ap.`Application_Number` LEFT JOIN `staff_tbl` s ON s.`Id`=ap.`Submitted_Id` LEFT JOIN `designation_tbl` d ON d.`Id`=s.`Designation_Id` WHERE ap.`Status_Id` =6 AND ap.`Submitted_Id` IN ('".$this->session->userdata('Id')."')")->result_array();
        }
        else{
            $query =$this->db->query("SELECT s.`Full_Name`,d.`Designaiton`,ap.`Application_Number`,ap.`Message`,ap.`Subject`,ap.`Application_Date` FROM `application_assign_tbl` a LEFT JOIN `application_tbl` ap ON a.`Application_Number`=ap.`Application_Number` LEFT JOIN `staff_tbl` s ON s.`Id`=ap.`Submitted_Id` LEFT JOIN `designation_tbl` d ON d.`Id`=s.`Designation_Id` WHERE ap.`Status_Id` =5 AND ap.`Submitted_Id` IN ('".$this->session->userdata('Id')."') GROUP BY ap.`Application_Number` ")->result_array();
        }
        return $query;
        
    }
    function getApplicaionDetails($type="",$appNo=""){
        if($type=="claim"){
            $data['Status_Id']=4;
            $data['Last_Action_By']=$this->session->userdata('Id');            
            $this->db->where('Application_Number', $appNo);
            $this->db->update('application_tbl', $data);

            $data1['Status_Id']=4;
            $array=array('Application_Number'=> $appNo,'User_Id'=>$this->session->userdata('Id'));
            $this->db->where($array);
            $this->db->update('application_assign_tbl', $data1);
        }
        if($type=="rejected"){
            $query =$this->db->query("SELECT a.`Subject`,a.`Application_Number`,a.`Application_Date`,a.`Message`,s.`Full_Name`,s.`Email_Id`,s.`Designation_Id`,ass.`Remarks`,ass.`Action_Date`,ass.`User_Id` User_IdTochagsfa FROM `application_tbl` a LEFT JOIN `application_assign_tbl` ap ON ap.`Application_Number`=a.`Application_Number` LEFT JOIN staff_tbl s ON s.`Id`=a.`Submitted_Id` LEFT JOIN `application_assign_tbl` ass ON ass.`User_Id`=a.`Last_Action_By` WHERE a.`Application_Number`='".$appNo."' AND a.`Status_Id`=5 AND ass.`Remarks` IS NOT NULL GROUP BY ass.`User_Id` ")->row();
        }
        else if($type=="finalapproved"){
           $query =$this->db->query("SELECT a.Id,a.`Subject`,a.`Application_Number`,a.`Application_Date`,a.`Message`,s.`Full_Name`,s.`Email_Id`,s.`Designation_Id`,ass.`Remarks`,ass.`Action_Date`,ass.`User_Id` User_IdTochagsfa FROM `application_tbl` a LEFT JOIN `application_assign_tbl` ap ON ap.`Application_Number`=a.`Application_Number` LEFT JOIN staff_tbl s ON s.`Id`=a.`Submitted_Id` LEFT JOIN `application_assign_tbl` ass ON ass.`User_Id`=a.`Last_Action_By` WHERE a.`Application_Number`='".$appNo."' AND a.`Status_Id`=6 AND ass.`Remarks` IS NOT NULL GROUP BY ass.`User_Id` ")->row();
        }
        else if($type=="finalReport"){
            $query =$this->db->query("SELECT a.`Subject`,a.`Application_Number`,a.`Application_Date`,a.`Message`,s.`Full_Name`,s.`Email_Id`,s.`Designation_Id`,d.`Designaiton` FROM `approved_application_tbl` a LEFT JOIN staff_tbl s ON s.`Id`=a.`Submitted_Id` LEFT JOIN `designation_tbl` d ON d.`Id`=s.`Designation_Id` WHERE a.`Id`='".$appNo."' ")->row();
        }
        else{
            $query =$this->db->query("SELECT a.`Subject`,a.`Application_Number`,a.`Application_Date`,a.`Message`,s.`Full_Name`,s.`Email_Id`,s.`Designation_Id`,ap.`Remarks`,ap.`Action_Date`,a.`Status_Id` FROM `application_tbl` a LEFT JOIN `application_assign_tbl` ap ON ap.`Application_Number`=a.`Application_Number` LEFT JOIN staff_tbl s ON s.`Id`=a.`Submitted_Id` WHERE a.`Application_Number`='".$appNo."'")->row();
        }
        
         return $query;

    }
    function release($appNo=""){
        if($this->session->userdata('Role_Id')!="2"){
            $data['Status_Id']=1;
        }else{
           $data['Status_Id']=2; 
        }
        $this->db->where('Application_Number', $appNo);
        $this->db->update('application_tbl', $data);
    }
    function getApplicaionDetailsINFinalTbl($appNo=""){
         $query="INSERT INTO approved_application_tbl (Application_Date,Application_Number,Approved_Date,Last_Action_By,Message,Status_Id,SUBJECT,Submitted_Id) SELECT Application_Date,Application_Number,CURRENT_DATE,Last_Action_By,Message,Status_Id,SUBJECT,Submitted_Id FROM application_tbl WHERE  Application_Number='".$appNo."'";
            $this->db->query($query);
        
    }
    function getappdetailsforreport($ppNo=""){
        $query =$this->db->query("SELECT f.`Id`,f.`Subject`,f.`Application_Number`,f.`Message`,s.`Full_Name`,d.`Designaiton`,f.`Application_Date` FROM `approved_application_tbl` f LEFT JOIN `staff_tbl` s ON f.`Submitted_Id`=s.`Id` LEFT JOIN `designation_tbl` d ON s.`Designation_Id`=d.`Id` WHERE f.`Submitted_Id`='".$ppNo."'")->result_array();
        return $query; 
    }
    function insertBatch($table="",$data=""){
        $this->db->insert_batch($table,$data);

    }
    function getcount($id=""){
        $query =$this->db->query(" SELECT COUNT(*) lcoaunt FROM  `t_subscriber_leaseline_isp_excel` a WHERE a.`PRG_Name`='ISP Lease Line'")->row();
        return $query;
        
    }****************/
   function gettotalDetails($type=""){
        if($type=="Total_Active_User"){
            $query =$this->db->query(" SELECT b.`Total_Active` FROM `t_subscriber_bmobile_main` b ")->row();
       
        }
        if($type=="fixedLine"){
            $query =$this->db->query("SELECT m.`Subscriber` FROM `t_subscriber_fixed_line_main` m ")->row();
       
        }
        if($type=="isp"){
            $query =$this->db->query("SELECT i.`Broad_Band_count`,i.`Lease_Line_Count` FROM `t_subscriber_isp_main` i ")->row();       
        }
        
     return $query;
   }
   function getrevenueexcel($type="")
   {
   $query=$this->db->query("SELECT s.`Month`,s.`Service_Revenue_Id`,s.`Jan`,s.`Feb`,s.`Mar`,s.`Apr`,s.`May`,s.`Jun`,s.`July`,s.`Aug`,s.`Sep`,s.`Oct`,s.`Nov`,s.`Dec` FROM `t_revenue_financial_excel` s WHERE s.`Year`='".$year."'")->result_array();
    return $query;

   }
}