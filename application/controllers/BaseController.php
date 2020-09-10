<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BaseController extends CI_Controller {
    public function _construct(){
        parent::_construct();
    }
	public function index(){
		$this->load->view('web/index');
	}
	function loadpage($param1="",$param2=""){
        $this->load->view('web/login');
        
    }

    function loginuser(){
        if($this->input->post('EmailId')!="" &&  $this->input->post('password')!=""){
            $query = $this->db->get_where('t_user_details', array(
            'User_Id' => $this->input->post('EmailId'), 'Password' => $this->input->post('password')));
            if ($query->num_rows() > 0){
                $row = $query->row_array(); 
                if($row['User_Status']=="N"){
                     $page_data['message']='Your user is deactivated. Please contact system administrator.';
                     $this->load->view('web/include/acknowledgement', $page_data); 
                }
                else{
                    
                    $this->session->set_userdata('User_table_id', $row['Id']);
                    $this->session->set_userdata('Role_Id', $row['Role_Id']);
                    $this->session->set_userdata('Full_Name', $row['Full_Name']);
                    $this->session->set_userdata('User_Id', $row['User_Id']);
                    $this->session->set_userdata('Contact_No', $row['Contact_Number']);
                    redirect(base_url() . 'index.php?baseController/dashboard', 'refresh');
                }                
            } 
            else{
                $page_data['message']='Invalid email and password';
                $this->load->view('web/include/acknowledgement', $page_data); 
            }
        } 
        else{
            $page_data['message']='Email and password is required';
                $this->load->view('web/include/acknowledgement', $page_data); 
        }

    }
    function dashboard(){
        
            $this->load->view('admin/dashboard');
        }
    function logout($param=''){  
        $this->session->unset_userdata(0);
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url().'index.php?baseController/', 'refresh');
    }
}
