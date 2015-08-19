<?php

class get_Api_Data
{
	public function __construct()
	{
		if (is_admin())
		{
			add_action('wp_ajax_nopriv_get-api-data', array(&$this, 'get_Api_Data'));
			add_action('wp_ajax_get-api-data', array(&$this, 'get_Api_Data'));
		}
		add_action('wp', array(&$this, 'init'));
	}

	public function init()
	{
		if (is_admin())
		{
			global $post;

			wp_register_script('ui-handler', plugin_dir_url(__FILE__) . 'ui_handler.js', array('jquery'));
			wp_localize_script('ui-handler', 'ajax_data', array(
				 'ajaxurl'		=> admin_url('admin-ajax.php'),
				 'nonce'		=> wp_create_nonce('process-order-nonce'),
				 'synced' => false);
		}
	}


	public function get_Api_Data()
	{
		if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_REQUEST['nonce'], 'process-order-nonce'))
			die('Invalid Nonce');
		else
		{
			header("Content-Type: application/json");
			echo json_encode(array(
				'success' => true));
			exit;
		}
		//end else
	}
}
$CORE = new get_Api_Data();

?>