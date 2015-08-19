<?php
 $response =array("dp_sync_status"=>"sucess","file_url"=>"http://www.googele.com");
 //$response = array("dp_sync_status"=>"fail","dp_sync_fail_code"=>"No ID");
 $data = json_encode($response);
 echo $data;
?>