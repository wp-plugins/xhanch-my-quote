<?php
	/*
		Plugin Name: Xhanch - My Quote
		Plugin URI: http://xhanch.com/wp-plugin-my-quote/
		Description: Random Quote plugin for wordpress
		Author: Susanto BSc (Xhanch Studio)
		Author URI: http://xhanch.com
		Version: 1.4.9
	*/
	
	define('xmq', true);
	define('xmq_bse_dir', dirname(__FILE__));

	xmq_inc('inc');	
	
	function xmq_itl(){
		$upd_res = false;
		require_once(xmq_bse_dir.'/itl.php');	
		return $upd_res;
	}
	$upd_res = xmq_itl();
	if(!$upd_res){
		define('xmt_itl_wrn_msg', $wpdb->last_query);
		function xmq_itl_wrn(){
			global $wpdb;
			echo '
				<div id="xmq-itl-wrn" class="updated fade"><p>					
					Oops, there has been a problem when upgrading/installing <b>Xhanch - My Quote</b><br/>
					Cannot execute this query:<br/>
					'.xmq_itl_wrn_msg.'					
				</p></div>
			';
		}
		add_action('admin_notices', 'xmq_itl_wrn');		
	}

	xmq_inc('wgt');	
			
	if(is_admin()){
		function xmq_admin_menu() {	
			if(!defined('xhanch_root')){
				add_menu_page(
					'Xhanch', 
					'Xhanch', 
					8, 
					'xhanch-my-quote/adm/xhc.php', 
					'',
					xmq_get_dir('url').'/img/ico.jpg'
				);
				define('xhanch_root', 'xhanch-my-quote/adm/xhc.php');
			}
			add_submenu_page(
				xhanch_root, 
				__('My Quote', 'xmq'), 
				__('My Quote', 'xmq'), 
				8, 
				'xhanch-my-quote/adm/cfg.php', 
				''
			);
		}
		add_action('admin_menu', 'xmq_admin_menu');
	}
	
	function xmq_inc($rel_pth){	
		$pth = xmq_bse_dir.'/'.$rel_pth;		
		$dir = dir($pth);	
		while($fle = $dir->read()){
			if($fle == '.' || $fle == '..')
				continue;
			$tgt = $pth.'/'.$fle;			
			if(is_dir($tgt))
				 xmq_inc($rel_pth.'/'.$fle);
			elseif(substr($tgt,-4) == '.php'){				
				require_once $tgt;	
			}
		}
		$dir->close();
	}
?>