<?php 
defined('ABSPATH') or die("No script kiddies please!");

class dp_Post_Api_Data extends dp_options_Handler{
	private $apiurl = "http://samlangberg.com/apitest/test.php";
	public function __construct($options) {
		add_action('transition_post_status',  array( $this, 'call_Dp_Api' ), 10, 3 );
		parent::__construct();
	}
	
	function call_Dp_Api( $new_status, $old_status, $post ) {
		$this->set_local($post->ID);
		update_post_meta($post->ID, '_dp_status', array("new" => $new_status, "old"=>$old_status));
   switch ($new_status) {
   	case "inherit":
   		$route = "/addfile";
   		break;
    case "publish":
      $route = "/addfile";
      break;
    case "trash":
      $route = "/removefile";
      break;
    case "auto-draft":
      update_post_meta($post->ID, '_dp_synced', array("synced" => "fail", "fail_reason"=>"Post Not Published"));
      break;
		}

	  if($new_status != "auto-draft"){
	  	$this->save_Page_Settings($post->ID);
			if($this->op_is_set('sync_to_drive')){
				if($new_status == "trash" && !$this->op_is_set('match_file_state')){
					 update_post_meta($post->ID, '_dp_synced', array("synced" => "fail", "fail_reason"=>"Post Is In Trash and State Is Locked"));
				}
	    	else{
	    		$this->send_Data_To_Api($post,$route);
	    	}
	 		}
	 		else{
	 			 update_post_meta($post->ID, '_dp_synced', array("synced" => "fail", "fail_reason"=>"Post Sync Off"));
	 		}
	 	}
	}


	public function save_Page_Settings( $post_id ) {
    $is_valid_nonce = (isset( $_POST[ 'dp_indicator_nonce' ] ) && wp_verify_nonce( $_POST[ 'dp_indicator_nonce' ], 'drivepress_indicator')) ? 'true' : 'false';
 		
    if (!$is_valid_nonce ) {
        return;
    }

    $sync_drive = (isset($_POST[ 'sync_to_drive' ])) ? 'set_on' : 'set_off';
    $match_drive_state = (isset($_POST[ 'match_file_state' ])) ? 'set_on' : 'set_off';

    if(!$this->op_is_set('page_lock_settings')){
    	update_post_meta($post_id , '_dp_page_settings', array('sync_to_drive'=>$sync_drive, "match_file_state"=> $match_drive_state));
  	}

  	$this->set_local($post_id);
  }
	
	public function send_Data_To_Api($post,$route) {
		$ID = $post->ID;
		$sourceurl = get_site_url();
		$response = wp_remote_post($this->apiurl, array('id' => $ID,'sourceurl' => $sourceurl,));
		//$response = wp_remote_post($this->apiurl, array('sourceurl' => $sourceurl,));
		$api_status = json_decode($response['body'], true);
		
		if (is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   update_post_meta($ID, '_dp_synced', array("synced" => "fail", "fail_reason"=>$error_message));
		} 
		if($api_status['dp_sync_status'] == 'fail'){
		   update_post_meta($ID, '_dp_synced', array("synced" => "fail", "fail_reason"=>$api_status['dp_sync_fail_code']));
		}

    else{
    	 update_post_meta($ID, '_dp_synced', array("synced" => "true","file_url"=>$api_status['file_url']));
    }
	}
}//end of class
?>