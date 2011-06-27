<?php
	function xmq_frm_get($str){
		if(!isset($_GET[$str]))
			return false;
		return xmq_read_var(urldecode($_GET[$str]));
	}

	function xmq_get_var($str){
		$res = $str;
		$res = str_replace('\\\'','\'',$res);
		$res = str_replace('\\\\','\\',$res);
		$res = str_replace('\\"','"',$res);
		return $res;
	}

	function xmq_frm_pst($str, $parse = true){
		if(!isset($_POST[$str]))
			return false;
		if($parse)
			return xmq_get_var($_POST[$str]);
		return $_POST[$str];
	}

	function xmq_get_dir($typ){
		if ( !defined('WP_CONTENT_URL') )
			define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content');
		if ( !defined('WP_CONTENT_DIR') )
			define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
		if ($typ=='pth') { return WP_CONTENT_DIR.'/plugins/'.plugin_basename(xmq_bse_dir); }
		else { return WP_CONTENT_URL.'/plugins/'.plugin_basename(xmq_bse_dir); }
	}

	function xmq_esc($str){
		return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
	}
?>