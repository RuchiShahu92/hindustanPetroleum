<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Vender (UserController)
 * Vender Class to control all Vender related operations.
 * @author : Ruchi shahu 
 * @version : 1.1
 * @since : 15 Sept 2020
 */
class Vender extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = TITLE.' : Dashboard';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function venderListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        { 
            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $param['returnType'] = 'count';
            $count = $this->common_model->getRows('vender',$param);
			
			$returns = $this->paginationCompress ( "venderListing/", $count, 5 );
			$param_type  = array(
					 'conditions' => array('status' => 1),
					 'like'  =>  array('name' => $searchText,'email' => $searchText,'phone_no' => $searchText),
					 'start' =>  $returns["segment"],
					 'limit' => $returns["page"],
					 );	
            $data['userRecords'] = $this->common_model->getRows('vender', $param_type);
            
            $this->global['pageTitle'] = TITLE.' : User Listing';
            
            $this->loadViews("vender/venders", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNewVender()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
             
            $this->global['pageTitle'] = TITLE.' : Add New Vender'; 
            $this->loadViews("vender/addEdit", $this->global );
        }
    }

    
    /**
     * This function is used to add new user to the system
     */
    function addData()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
		 
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('address','Email','trim|required');
            $this->form_validation->set_rules('pincode','Password','required|numeric|max_length[6]'); 
            $this->form_validation->set_rules('email','Role','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('phone_no','Phone No Number','required|min_length[10]|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewVender();
            }
            else
            {
                $name 		= ucwords(strtolower($this->input->post('name')));
                $address 	= $this->input->post('address');
                $pincode 	= $this->input->post('pincode');
                $email 		= $this->input->post('email');
                $phone_no	= $this->input->post('phone_no');
                
                $userInfo = array('name'=>$name, 'address'=>$address, 'pincode'=>$pincode, 'email'=> $email,
                                    'phone_no'=>$phone_no,  'created_date' => date('Y-m-d H:i:s'));
                
                 
                $result = $this->common_model->add_data('vender',$userInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Vender created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Vender creation failed');
                }
                
                redirect('venderListing');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function edit($userId = NULL)
    {
        if($this->isAdmin() == TRUE  )
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $param = array('conditions' => array('id' => $userId), 
							'returnType' => 'single');
            $data['editRecord'] = $this->common_model->getRows('vender',$param);
            
            $this->global['pageTitle'] = TITLE.' : Edit Vender';
            
            $this->loadViews("vender/addEdit", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function updateData()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('id');
            
            $this->form_validation->set_rules('name','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('address','Email','trim|required');
            $this->form_validation->set_rules('pincode','Password','required|numeric|max_length[6]'); 
            $this->form_validation->set_rules('email','Role','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('phone_no','Phone No Number','required|min_length[10]|xss_clean');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->edit($userId);
            }
            else
            { 
                $userInfo 	= array(); 
                $name 		= ucwords(strtolower($this->input->post('name')));
                $address 	= $this->input->post('address');
                $pincode 	= $this->input->post('pincode');
                $email 		= $this->input->post('email');
                $phone_no	= $this->input->post('phone_no');
                
                $userInfo = array('name'=>$name, 'address'=>$address, 'pincode'=>$pincode, 'email'=> $email,
                                    'phone_no'=>$phone_no);
                
                $result = $this->common_model->update_data('vender',$userInfo,array('id' => $userId));;
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Vender updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('venderListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteVender()
    {
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $id = $this->input->post('id');
             
            
            $result = $this->common_model->update_data('vender',array('status' => 0),array('id' => $id));
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
     
    function pageNotFound()
    {
        $this->global['pageTitle'] = TITLE.' : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>