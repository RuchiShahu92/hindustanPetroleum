<?php
class Common_model extends CI_Model{

	public function add_data($table,$data){
		$this->db->insert($table, $data);
		$last_id = $this->db->insert_id();
		return $last_id;
	}
	
	public function update_data($table,$data,$where){
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}
	
	public function delete_data($table,$where){
		$this->db->where($where);
		$this->db->delete($table);
		return true;
	}

	public function get_all_data($table){
		$query = $this->db->get($table);
		return $result = $query->result_array();
	}

	public function get_data_by_id($where,$table,$fields='',$order_by='',$dir="asc"){
		$this->db->select($fields);
		$this->db->where($where);
		if(($order_by)){
			$this->db->order_by($order_by, $dir);
		}
		$query = $this->db->get($table);
		$result = $query->result_array();
		return $result;
	}
	public function get_field_by_id($table,$field,$where){
		$this->db->select($field);
		$this->db->where($where);
		$query = $this->db->get($table);
		$result = $query->row_array()[$field];
		return $result;
	}

	 
	public function get_specific_fileds_by($where,$table){
		$this->db->select('id,res_name,res_alias,images,service_type,city,area,landmark,approx_delivery_time,approx_cost,pure_veg');
		$this->db->where($where);
		$query = $this->db->get($table);
		$result = $query->result_array();
		return $result;
	}
	function get_Data_Count(){
        return $this->db->count_all('kitchens');

    }
   
	function getRows($table,$params = array()){
	
		if(array_key_exists("fields",$params)){
			$this->db->select($params['fields']);
		}else{
			$this->db->select('*');
		}
		$this->db->from($table);
		
		//fetch data by conditions
		if(array_key_exists("conditions",$params)){
			foreach($params['conditions'] as $key => $value){
				$this->db->where($key,$value);
			}
		}
		if(array_key_exists("conditions_not_in",$params)){
			$this->db->where_not_in($params['conditions_not_in']['fields'],$params['conditions_not_in']['value']);
		}
 
       //fetch data by conditions
		if(array_key_exists("where",$params)){ 
				$this->db->where( $params['where']);  
		}
		//fetch data by like
		if(array_key_exists("like",$params)){
			foreach($params['like'] as $key => $value){
				$this->db->like($key,$value);
			}
		}
		
		if(array_key_exists("order_by",$params)){
			$this->db->order_by($params['order_by']);
		}
		if(array_key_exists("id",$params)){
			$this->db->where('id',$params['id']);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
			//set start and limit
			if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit'],$params['start']);
			}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit']);
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results();    
			}elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->row_array():false;
			}else{
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->result_array():false;
			}
		}

		//return fetched data
		return $result;
	}

	/////////SELECT HTML/////////////
	public function select_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '',$condition_type='single',$required = '')
	{
		$return = '';
		$other  = '';
		$multi  = 'no';
		$phrase = 'Choose a ' . $name;
		if ($class == 'demo-cs-multiselect') {
			$other = 'multiple';
			$name  = $name . '[]';
			if ($type == 'edit') {
				$e_match = json_decode($e_match);
				if ($e_match == NULL) {
					$e_match = array();
				}
				$multi = 'yes';
			}
		}
		$return = '<select name="' . $name . '" id="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" data-hide-disabled="true" '.$required.'>';
		if (!is_array($from)) {
			if ($condition == '') {
				$all = $this->db->get($from)->result_array();
			} else if ($condition !== '') {
				if($condition_type=='single'){
					$all = $this->db->get_where($from, array(
						$condition => $c_match
					))->result_array();
				}else if($condition_type=='multi'){
					$this->db->where_in($condition,$c_match);
					$all = $this->db->get($from)->result_array();
				}
			}

			$return .= '<option value="">Choose one</option>';

			foreach ($all as $row):
				if ($type == 'add') {
					$return .= '<option value="' . $row[$from . '_id'] . '">' . $row[$field] . '</option>';
				} else if ($type == 'edit') {
					$return .= '<option value="' . $row[$from . '_id'] . '" ';
					if ($multi == 'no') {
						if ($row[$from . '_id'] == $e_match) {
							$return .= 'selected=."selected"';
						}
					} else if ($multi == 'yes') {
						if (in_array($row[$from . '_id'], $e_match)) {
							$return .= 'selected=."selected"';
						}
					}
					$return .= '>' . $row[$field] . '</option>';
				}
			endforeach;
		} else {
			$all = $from;
			$return .= '<option value="">Choose one</option>';
			foreach ($all as $row):
				if ($type == 'add') {
					$return .= '<option value="' . $row . '">';
					if ($condition == '') {
						$return .= ucfirst(str_replace('_', ' ', $row));
					} else {
						$return .= $this->Common_model->get_type_name_by_id($condition, $row, $c_match);
					}
					$return .= '</option>';
				} else if ($type == 'edit') {
					$return .= '<option value="' . $row . '" ';
					if ($row == $e_match) {
						$return .= 'selected=."selected"';
					}
					$return .= '>';

					if ($condition == '') {
						$return .= ucfirst(str_replace('_', ' ', $row));
					} else {
						$return .= $this->Common_model->get_type_name_by_id($condition, $row, $c_match);
					}

					$return .= '</option>';
				}
			endforeach;
		}
		$return .= '</select>';
		return $return;
	}
	 
	 
   public function count_rows_where($table,$field='',$where=''){
		$this->db->select($field);
		$this->db->where($where);
		$query = $this->db->get($table);
		$result = $query->num_rows();
		return $result;
	}

 	public function get_all_orders($params){

		$this->db->select('*');
		$this->db->join('vender', 'vender.id = orders.vender_id');
		$this->db->join('company_detail', 'company_detail.id = orders.company_id');
		$query = $this->db->get('orders');
		//fetch data by like
		if(array_key_exists("like",$params)){
			foreach($params['like'] as $key => $value){
				$this->db->like($key,$value);
			}
		}

		//set start and limit
			if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit'],$params['start']);
			}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit']);
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results();    
			}elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
				//$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->row_array():false;
			}else{
				//$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->result_array():false;
			}
				 
		return $result;

	}
	 
}

?>