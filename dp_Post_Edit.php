<?php 
defined('ABSPATH') or die("No script kiddies please!");

class dp_Post_Edit extends dp_options_Handler{
	public function __construct($options) {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_plugin_styles' ));
		parent::__construct();
	}

 public function register_plugin_styles() {
		wp_enqueue_style( 'dp-styles', plugin_dir_url( __FILE__ ) . 'css/dp_stylesheet.css' );
		wp_enqueue_style( 'dp-styles' );
	}



	public function add_meta_box( $post_type ) {
      if ( in_array( $post_type, $this->op_get('syncable_posts'))) {
							add_meta_box(
								'drivepress_indicator'
								,__( 'Drive Press', 'dl-textdomain' )
								,array( $this, 'render_meta_box_content' )
								,$post_type
								,'side'
								,'high'
							);
      }	
	}

	 private function status_ui_gen($post){
	 	if($this->op_get('synced') != "fail"){
	 		$status_ui['class'] = "linked";
	 		$status_ui['link_status'] = "Page Synced To Drive";
	 		$status_ui['ui_message'] = "<a id='dp_doclink' class='dp_icon' href='".$this->op_get('file_url')."'>Google Doc Link</a>";
	 		//if(isset($sync_status["test_msg"]){ $status_ui['test_msg'] = $sync_status["test_msg"];}
	 	}	
	 	else{
	 		$status_ui['class'] = "not_linked";
	 		$status_ui['link_status'] = "Page Not Synced To Drive";
	 		$status_ui['ui_message'] = "<span id='dp_error' class='dp_icon'>".$this->op_get('fail_reason')."</span>";
	 		//if(isset($sync_status["test_msg"]){ $status_ui['test_msg'] = $sync_status["test_msg"];}
	 	}
	 	return $status_ui;
	 }

	 private function islocked(){
	 		 if($this->op_is_set('page_lock_settings')){echo "locked";}
	}

	public function render_meta_box_content( $post ) {
		$this->set_local($post->ID);
		wp_nonce_field( 'drivepress_indicator', 'dp_indicator_nonce' );
		$ui = $this->status_ui_gen($post);
		$page_settings = get_post_meta($post->ID,'_dp_page_settings', true);
		include( plugin_dir_path( __FILE__ ) . 'ui/metabox-html.php');
	}
}

?>