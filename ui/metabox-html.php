<div class="dp_meta_row">
  <span id="dp_status_icon" class="dp_icon <?php echo $ui['class'];?>"><?php echo $ui['link_status'];?></span>
</div>
<div class="dp_meta_row">
<?php echo $ui['ui_message'];?>
</div>
<div class="dp_meta_row">
  <label for="sync_to_drive" id="dp_sync_to_drive" class="dp_icon <?php $this->islocked(); ?>">
      <input type="checkbox" name="sync_to_drive" <?php checked($this->op_get('sync_to_drive'), "set_on" ); disabled($this->op_is_set('page_lock_settings'), true);?> />
       <?php _e( 'Sync To Drive', 'dl-textdomain' );?>
  </label> 
</div>
<div class="dp_meta_row">
  <label for="match_file_state" id="dp_match_state" class="dp_icon <?php $this->islocked(); ?>">
      <input type="checkbox" name="match_file_state" <?php checked($this->op_get('match_file_state'), "set_on" ); disabled($this->op_is_set('page_lock_settings'), true);?> />
      <?php _e( 'Match File State', 'dl-textdomain' )?>
  </label> 
  <pre>
  	<?php 
      var_dump(get_post_meta($post->ID,'_dp_status', true)); 
    ?>
  </pre>
</div>