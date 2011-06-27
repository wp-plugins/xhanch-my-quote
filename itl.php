<?php
	if(!defined('xmq'))
		exit;

	global $wpdb;

	$upd = false;	

	$ver = get_option("xmq_vsn");
	if($ver == ''){
		add_option("xmq_shw_crd", 1);
		add_option("xmq_qte_ext", array());		
		add_option("xmq_qte_atv", xmq_qte_col_lst());

		$upd = true;

		$ver = '1.0.0';
		update_option('xmq_vsn', $ver);
	}

	if($upd)
		update_option("xmq_shw_crd", 1);	

	$upd_res = true;
?>