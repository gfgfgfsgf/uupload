<?php
header('Content-Type: application/json');
if(isset($_GET['link']) and !empty($_GET['link'])){
	$cu = curl_init();
	curl_setopt($cu,CURLOPT_URL,'http://uupload.ir/upload.php?url=1');
	curl_setopt($cu,CURLOPT_POST,true);
	curl_setopt($cu,CURLOPT_POSTFIELDS,['userfile[]'=>$_GET['link'],'submit'=>'شروع آپلود','ittl'=>0]);
	curl_setopt($cu,CURLOPT_COOKIEFILE,'Coo.txt');
	curl_setopt($cu,CURLOPT_COOKIEJAR,'Coo.txt');
	curl_setopt($cu,CURLOPT_RETURNTRANSFER,true);
	preg_match_all('<input readonly class="input_field" onclick="(.*?)" type="text" style="width: 100%" name="option" value="(.*?)" />',curl_exec($cu),$link);
	curl_close($cu);
	if($link[2][0] != null){
		$results = array('ok'=>true,'Link'=>$link[2][0]);
		echo json_encode($results,JSON_PRETTY_PRINT);
	}else{
		$results = array('ok'=>false,'message'=>'Unauthorized extension');
		echo json_encode($results,JSON_PRETTY_PRINT);
	}
}else{
	$results = array('ok'=>false,'message'=>'Check Parameters');
	echo json_encode($results,JSON_PRETTY_PRINT);
}