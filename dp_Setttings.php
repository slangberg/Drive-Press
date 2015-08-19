<?php
class dp_Setttings extends dp_options_Handler{
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_dp_settings_pages' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
        parent::__construct();
    }

    public function add_dp_settings_pages()
    {
   
       add_options_page( 'Drivepress Settings', 'Drivepress Settings', 'manage_options', 'drive_press', array( $this, 'create_dp_admin_page' ));
    }

    public function create_dp_admin_page()
    {
       
        ?>
        <form action='options.php' method='post'>
        
            <h2>Drive Press Settings</h2>
            
            <?php settings_fields( 'dp_settings_page' );
            include( plugin_dir_path( __FILE__ ) . 'ui/setting-html.php');
            submit_button();?>
            <pre>
                <?php var_dump($this->options); ?>
            </pre>
        </form>
        <?php

    }

    /**
     * Register and add settings
     */
    public function page_init()
    {
        register_setting( 'dp_settings_page', 'dp_settings', array($this, 'dp_settings_save'));
    }


    public function dp_settings_save($input){
          $syncposts = array();
          if(isset($input['page_syncable'])){array_push($syncposts,$input['page_syncable']);}
          if(isset($input['post_syncable'])){array_push($syncposts,$input['post_syncable']);}
          $input['syncable_posts'] = $syncposts;
         return $input;
    }
}