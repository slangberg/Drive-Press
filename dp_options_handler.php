<?php
class dp_options_Handler
{
	
	public $post_ID;
	public $options;
	public $page_settings;
	public $page_sync_status;
	public $all_options;
	function __construct()
	{
		$this->options = get_option( 'dp_settings' );
		$this->all_options = get_option( 'dp_settings' );
	}

	public function op_is_set($name){
		if(isset($this->all_options[$name])){
			$istrue = ($this->all_options[$name] == "set_on" ? true : false);
			return  $istrue;
		}
		else{
			return false;
		}
	}

	public function op_get($name){
		if(isset($this->all_options[$name])){return $this->all_options[$name];}
		else {return false;}
	}

	public function is_locked($post_id){
	 $islocked = $this->op_is_set('page_lock_settings');
	 return $islocked;
	}

	public function api_fail($fail_reason){
		update_post_meta($this->post_ID, '_dp_synced', array("synced" => "fail", "fail_reason"=>$fail_reason));
	}

	public function set_local($id){
		$this->post_ID = $id;
		$this->page_settings = get_post_meta($id,'_dp_page_settings', true);
		$this->page_sync_status = get_post_meta($id,'_dp_synced', true);
		$this->all_options = array();
		if($this->page_settings){$this->all_options = array_merge($this->all_options,$this->page_settings);}
		if($this->page_sync_status){$this->all_options = array_merge($this->all_options,$this->page_sync_status);}
	}
}
?>