<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Order (UserController)
 * CompanyDetail Class to control all Order related operations.
 * @author : Ruchi shahu 
 * @version : 1.1
 * @since : 15 Sept 2020
 */
class Order extends BaseController
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
    function orderListing()
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
            $count = $this->common_model->get_all_orders($param);;
			
			$returns = $this->paginationCompress ( "companyListing/", $count, 5 );
			$param_type  = array(
					 'like'  =>  array('company_detail.company_name' => $searchText ),
					 'start' =>  $returns["segment"],
					 'limit' => $returns["page"],
					 );	
            $data['orderRecords'] = $this->common_model->get_all_orders($param_type);
            
            $this->global['pageTitle'] = TITLE.' : Company Listing';
            
            $this->loadViews("order/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNewOrder()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
		/* 	$param = array('status' => 1);
            $data['vender_list'] = $this->common_model->getRows('vender',$param); 
			$params = array('status' => 1,
							'fields' => array('id','company_name'));
            $data['company_list'] = $this->common_model->getRows('company_detail',$params);  */
            $this->global['pageTitle'] = TITLE.' : Add New Company '; 
            $this->loadViews("order/addEdit", $this->global );
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
            
            $this->form_validation->set_rules('company_id','Company Name','trim|required|xss_clean');
            $this->form_validation->set_rules('vender_id','Vender','trim|required');
            $this->form_validation->set_rules('product_name[]','Product Name','required'); 
            $this->form_validation->set_rules('product_qty[]','Product Qty','trim|numeric|required');
            $this->form_validation->set_rules('product_price[]','Product Price','required|numeric|xss_clean'); 
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNewOrder();
            }
            else
            {
                $company_id    = $this->input->post('company_id');
                $vender_id 	   = $this->input->post('vender_id');
                $product_name  = $this->input->post('product_name'); 
                $product_qty   = $this->input->post('product_qty'); 
                $product_price = $this->input->post('product_price'); 
                $discount      = $this->input->post('discount'); 
                $igst          = $this->input->post('igst'); 
                $cgst          = $this->input->post('cgst'); 
                $sgst          = $this->input->post('sgst'); 

                 if(!empty($product_name) && count($product_name) > 0)  
                    { 
                        $data['company_id']  = $company_id;
                        $data['vender_id']   = $vender_id;
                        $data['discount']    = $discount;

                        $order_id = $this->common_model->add_data('orders',$data);
                         // Add product item
                        $data_update = array();
                        $gross_total = '';
                        for($i=0;$i<count($product_name); $i++)
                        { 
                            $insert[] = array(
                                            'product_name'   => $product_name[$i],
                                            'product_qty'   => $product_qty[$i],
                                            'product_price' => $product_price[$i],
                                            'order_id'    => $order_id,
                                             
                                        );
                            //$gross_total += $product_price[$i];

                             
                        }
                       /* $sub_total = ($gross_total - ($gross_total * $discount/100)) ; 
                        $igst = $sub_total + ($sub_total * $igst); 
                        $cgst = ($sub_total * $cgst ) / 100 ;
                        $sgst = ($sub_total * $sgst ) / 100 ;
                        $gst = !empty($igst) ? $igst : $cgst + $sgst;
                        $net_amount = $gst + $sub_total;*/
                     
                        $data_update['gross_total'] = $this->input->post('gross_total');
                        $data_update['discount']    = $discount;
                        $data_update['sub_total']  = $this->input->post('subtotal');
                        $data_update['cgst']        = $cgst;
                        $data_update['sgst']        = $sgst;
                        $data_update['igst']        = $igst;
                        $data_update['igst_amount'] = $this->input->post('igst_amount');
                        $data_update['sgst_amount'] = $this->input->post('sgst_amount');
                        $data_update['cgst_amount'] = $this->input->post('cgst_amount');
                        $data_update['net_amount '] = $this->input->post('net_amount');
                        $data_update['date']        = date('Y-m-d');
                        $data_update['order_status '] = 'pending';
                    
                        $order_id = $this->common_model->update_data('orders',$data_update,array('id' => $order_id ));
                        
                        $result = $this->db->insert_batch('order_items',$insert);
                       
                    }

             
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Order created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Order creation failed');
                }
                
                redirect('orderListing');
            }
        }
    }

    function viewOrder($orderId = NULL){
        $param = array('conditions' => array('id' => $orderId), 
                            'returnType' => 'single');
            $data['orderView'] = $this->common_model->getRows('orders',$param);
 
        $param_type = array('conditions' => array('order_id' => $orderId), 
                        );
            $data['orderItemView'] = $this->common_model->getRows('order_items',$param_type);
            
            $this->global['pageTitle'] = TITLE.' : View Order';
            $this->loadViews("order/orderView", $this->global, $data, NULL);
    }
    
    function file_download()
    {
     ////

        ini_set('memory_limit', '256M');
        // load library
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        // retrieve data from model
        $orderId = $this->uri->segment(2);
         $param = array('conditions' => array('id' => $orderId), 
                            'returnType' => 'single');
            $data['orderView'] = $this->common_model->getRows('orders',$param);
 
        $param_type = array('conditions' => array('order_id' => $orderId), 
                        );
            $data['orderItemView'] = $this->common_model->getRows('order_items',$param_type);
            
        $data['title'] = "items";

        // boost the memory limit if it's low ;)
        $html = $this->load->view('order/orderPDF', $data, true);
        // render the view into HTML
        $pdf->WriteHTML($html);
        // write the HTML into the PDF
        $output = 'order' .$orderId_. date('Y_m_d_H_i_s') . '_.pdf';
        $pdf->Output("$output", 'D');
    }

     function status_change(){
        $order_id = $this->input->post('id');
        $order_status = $this->input->post('order_status');
        $data_update = array('id' => $order_id, 'order_status' => $order_status);

         $this->common_model->update_data('orders',$data_update,array('id' => $order_id ));
                       
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
                redirect('orderListing');
            }
            
            $param = array('conditions' => array('id' => $userId), 
							'returnType' => 'single');
            $data['editRecord'] = $this->common_model->getRows('company_detail',$param);
            
            $this->global['pageTitle'] = TITLE.' : Edit Company';
            
            $this->loadViews("order/addEdit", $this->global, $data, NULL);
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
                
                redirect('orderListing');
            }
        }
    }


  
     
    function pageNotFound()
    {
        $this->global['pageTitle'] = TITLE.' : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>