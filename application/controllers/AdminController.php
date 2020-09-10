<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {
    public function _construct(){
        parent::_construct();
      
    }
    public function index(){
    }
    function loadaccounts($page=""){
        $this->load->view('admin/accounts/'.$page);
     }
     function Estimate($page=""){
        $this->load->view('admin/sales/'.$page);
     }
     function Invoice($page="",$id=""){
     	$page_data['invoicedetails'] =$this->CommonModel->getinvoicedetails($id);
        $this->load->view('admin/invoice/'.$page);
     }
     function systemsetting($page=""){
        $this->load->view('admin/'.$page);
     }
}