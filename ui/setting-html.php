<table class="form-table dp_settings_table">
  <tr>
      <th class="row-title">Syncable Post Types</th>
  </tr>
  <tr valign="top">
      <td>
          <label>Pages</label><input type="checkbox" name='dp_settings[page_syncable]' <?php checked($this->op_get('page_syncable'),"page"); ?> value="page" />
          <label>Posts</label><input type="checkbox" name='dp_settings[post_syncable]' <?php checked($this->op_get('post_syncable'),"post"); ?> value="post"/>
      </td>
  </tr>
</table>
<table class="form-table dp_settings_table">
  <tr>
      <th class="row-title">Page Settings</th>
      <th>On or Off</th>
  </tr>
  <tr valign="top">
      <td scope="row"><label for="tablecell">Auto Sync All Pages</label></td>
      <td>
          <label>On</label><input type="radio" name='dp_settings[page_gloabl_sync]' <?php checked($this->op_get('page_gloabl_sync'),"set_on"); ?> value="set_on" />
          <label>Off</label><input type="radio" name='dp_settings[page_gloabl_sync]' <?php checked($this->op_get('page_gloabl_sync'),"set_off"); ?> value="set_off"/>
      </td>
  </tr>
  <tr valign="top">
      <td scope="row"><label for="tablecell">Match File States All Pages</label></td>
      <td>
          <label>On</label><input type="radio" name='dp_settings[page_match_state]' <?php checked($this->op_get('page_match_state'),"set_on"); ?> value="set_on" />
          <label>Off</label><input type="radio" name='dp_settings[page_match_state]' <?php checked($this->op_get('page_match_state'),"set_off"); ?> value="set_off"/>
      </td>
  </tr>
  <tr valign="top">
      <td scope="row"><label for="tablecell">Lock Indvidual Page Settings</label></td>
      <td>
          <label>On</label><input type="radio" name='dp_settings[page_lock_settings]' <?php checked($this->op_get('page_lock_settings'),"set_on"); ?> value="set_on" />
          <label>Off</label><input type="radio" name='dp_settings[page_lock_settings]' <?php checked($this->op_get('page_lock_settings'),"set_off"); ?> value="set_off"/>
      </td>
  </tr>
  <tr valign="top">
      <td scope="row"><label for="tablecell">Overwrite Exsiting Page Settings</label></td>
      <td>
          <label>On</label><input type="radio" name='dp_settings[page_overwrite_existing]' <?php checked($this->op_get('page_overwrite_existing'),"set_on"); ?> value="set_on" />
          <label>Off</label><input type="radio" name='dp_settings[page_overwrite_existing]' <?php checked($this->op_get('page_overwrite_existing'),"set_off"); ?> value="set_off"/>
      </td>
  </tr>
</table>

