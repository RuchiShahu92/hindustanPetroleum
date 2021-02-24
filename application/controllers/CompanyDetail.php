<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : CompanyDetail (UserController)
 * CompanyDetail Class to control all CompanyDetail related operations.
 * @author : Ruchi shahu 
 * @version : 1.1
 * @since : 15 Sept 2020
 */
class CompanyDetail extends BaseController
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
    function companyListing()
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
            $count = $this->common_model->getRows('company_detail',$param);
			
			$returns = $this->paginationCompress ( "companyListing/", $count, 5 );
			$param_type  = array(
					 'like'  =>  array('company_name' => $searchText ),
					 'start' =>  $returns["segment"],
					 'limit' => $returns["page"],
					 );	
            $data['userRecords'] = $this->common_model->getRows('company_detail', $param_type);
            
            $this->global['pageTitle'] = TITLE.' : Company Listing';
            
            $this->loadViews("company_detail/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNewCompany()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
             
            $this->global['pageTitle'] = TITLE.' : Add New Company ';

            $this->loadViews("company_detail/addEdit", $this->global );
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
            
            $this->form_validation->set_rules('company_name','Company Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('pincode','Pincode','required|numeric|max_length[6]'); 
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('phone_no','Phone Number','required|min_length[10]|xss_clean');
            $this->form_validation->set_rules('gst_no','GST No','required|xss_clean');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewCompany();
            }
            else
            {
                $name 		= ucwords(strtolower($this->input->post('company_name')));
                $address 	= $this->input->post('address');
                $pincode 	= $this->input->post('pincode');
                $email 		= $this->input->post('email');
                $phone_no	= $this->input->post('phone_no');
                $gst_no		= $this->input->post('gst_no'); 
				$bank_arr   = serialize($this->input->post('bank_arr'));
				$tax_arr    = serialize($this->input->post('tax_arr'));
                
                $Info = array('company_name	'=>$name, 'address'=>$address, 'pincode'=>$pincode, 'email'=> $email,
                                    'phone_no'=>$phone_no,  'gst_no' => $gst_no,'bank_details' => $bank_arr ,'tax_detail' => $tax_arr  );
                  
                $result = $this->common_model->add_data('company_detail',$Info);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Vender created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Vender creation failed');
                }
                
                redirect('companyListing');
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
                redirect('companyListing');
            }
            
            $param = array('conditions' => array('id' => $userId), 
							'returnType' => 'single');
            $data['editRecord'] = $this->common_model->getRows('company_detail',$param);
            
            $this->global['pageTitle'] = TITLE.' : Edit Company';
            
            $this->loadViews("company_detail/addEdit", $this->global, $data, NULL);
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
            
            $id = $this->input->post('id');
            
             $this->form_validation->set_rules('company_name','Company Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('address','Address','trim|required');
            $this->form_validation->set_rules('pincode','Pincode','required|numeric|max_length[6]'); 
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('phone_no','Phone Number','required|min_length[10]|xss_clean');
            $this->form_validation->set_rules('gst_no','GST No','required|xss_clean');
            
            
            if($this->form_validation->run() == FALSE)
            {
                $this->edit($id);
            }
            else
            { 
                $userInfo 	= array(); 
                 $name 		= ucwords(strtolower($this->input->post('company_name')));
                $address 	= $this->input->post('address');
                $pincode 	= $this->input->post('pincode');
                $email 		= $this->input->post('email');
                $phone_no	= $this->input->post('phone_no');
                $gst_no		= $this->input->post('gst_no'); 
				$bank_arr   = serialize($this->input->post('bank_arr'));
				$tax_arr    = serialize($this->input->post('tax_arr'));
                
                $Info = array('company_name	'=>$name, 'address'=>$address, 'pincode'=>$pincode, 'email'=> $email,
                                    'phone_no'=>$phone_no,  'gst_no' => $gst_no,'bank_details' => $bank_arr ,'tax_detail' => $tax_arr  );
                  
                
                $result = $this->common_model->update_data('company_detail',$Info,array('id' => $id));;
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Company updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Company updation failed');
                }
                
                redirect('companyListing');
            }
        }
    }


    /**
     * This function is used to delete the user using id
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
              
            $result = $this->common_model->delete_data('company_detail',array('id' => $id));
            
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