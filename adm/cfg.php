<?php
	if(!defined('xmq'))
		exit;
	
	function xmq_cfg(){
		global $wpdb;
		global $xmq_conf;
		global $xmq_default;
				
		if($_POST['cmd_xmq_cfg_upd']){
			if(isset($_POST['chk_xmq_qte_atv']))
				update_option('xmq_qte_atv', $_POST['chk_xmq_qte_atv']);
			else
				update_option('xmq_qte_atv', array());
			if(xmq_frm_pst('txa_xmq_qte_ext'))
				update_option('xmq_qte_ext', explode("\n", xmq_frm_pst('txa_xmq_qte_ext')));
			else
				update_option('xmq_qte_ext', array());

			update_option('xmq_shw_crd', intval($_POST['chk_xmq_shw_crd']));

			echo '<div id="message" class="updated fade"><p>'.__('Configuration Updated', 'xmq').'</p></div>';
		}	
?>
		<style type="text/css">
			table, td{font-family:Arial;font-size:12px}
			tr{height:22px}
			ul li{line-height:2px}	
			.clear{clear:both}		
		</style>
		<script type="text/javascript">
			function show_spoiler(obj){
				var inner = obj.parentNode.getElementsByTagName("div")[0];
				if (inner.style.display == "none")
					inner.style.display = "";
				else
					inner.style.display = "none";
			}
			function show_more(obj_nm){
				var obj = document.getElementById(obj_nm);
				if (obj.style.display == "none")
					obj.style.display = "";
				else
					obj.style.display = "none";
			}
			function check_all(idf, chk){
				jQuery(idf).each(function(){
					this.checked = chk;
				});
			}
    	</script>
		<div class="wrap">
			<h2><?php echo __('Xhanch - My Quote - Configuration', 'xmq'); ?></h2>	
			<br/>

			<iframe src="http://ads.xhanch.com/" style="width:468px;height:60px;
			float:left;border:1px solid #cacaca" scrolling="no" allowTransparency="true"></iframe>	

            <div style="float:right;width:400px">
				<div style="float:right;line-height:21px">
					<b><?php echo __('Do you like this Xhanch - My Quote? ', 'xmt'); ?></b> <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fxhanch.com%2Fwp-plugin-my-quote%2F&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px; margin:0 0 0 10px; float:right;padding:1px" allowTransparency="true"></iframe>           
				</div>
				<div class="clear"></div>
				<div style="float:right;line-height:21px">
					<b><?php echo __('Do you like our service and support? ', 'xmt'); ?></b> <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FXhanch-Studio%2F146245898739871&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:21px; margin:0 0 0 10px; float:right;padding:1px" allowTransparency="true"></iframe>   
				</div>
				<div class="clear"></div>
			</div>
            <div class="clear"></div>
			<br/>
                
            <form action="" method="post">
				<table cellpadding="0" cellspacing="0">
					<tr style="height:1px">
						<td width="150px"></td>
						<td width="200px"></td>
						<td width="10px"></td>
						<td width="150px"></td>
						<td width="200px"></td>
					</tr>
					<tr>
						<td colspan="5"><?php echo __('Active quote collections:', 'xmq'); ?></td>
					</tr>
					<tr>
						<td colspan="5">
							<div style="max-height:100px;overflow:auto;padding:3px 5px 11px 5px;border:1px solid #cacaca">
								<table cellpadding="0" cellspacing="0">
									<?php 
										$col_lst = xmq_qte_col_lst(false); 
										$qte_atv = get_option('xmq_qte_atv', array());
										foreach($col_lst as $col){
									?>
										<tr>
											<td width="22px"><input type="checkbox" class="chk_xmq_qte_atv" name="chk_xmq_qte_atv[]" value="<?php echo $col; ?>" <?php echo (in_array($col, $qte_atv)?'checked="checked"':''); ?>/></td>
											<td><?php echo ucwords(str_replace('-', ' ', substr($col, 0, strlen($col) - 8))); ?></td>
										</tr>
									<?php } ?>
								</table>
							</div>
							<a href="javascript:check_all('.chk_xmq_qte_atv', true)">Check All</a> |
							<a href="javascript:check_all('.chk_xmq_qte_atv', false)">Uncheck All</a>
						</td>
					</tr>
					<tr>
						<td colspan="5"><br/><?php echo __('Custom quotes (one quote per line):', 'xmq'); ?></td>
					</tr>
					<tr>
						<td colspan="5"><textarea id="txa_xmq_qte_ext" name="txa_xmq_qte_ext" style="width:100%;height:100px"><?php echo htmlspecialchars(implode("\n", get_option('xmq_qte_ext', array()))); ?></textarea></td>
					</tr>
				</table><br/><br/>

				<input type="checkbox" id="chk_xmq_shw_crd" name="chk_xmq_shw_crd" value="1" <?php echo (get_option('xmq_shw_crd')?'checked="checked"':''); ?>/>
				<b><?php echo __('Show credit link ("Powered by"), I will <a href="http://xhanch.com/xhanch-donate" target="_blank">donate</a> later.', 'xmt'); ?></b>
				<br/>
                
                <p class="submit">
                    <input type="submit" name="cmd_xmq_cfg_upd" value="<?php echo __('Update Configuration', 'xmq'); ?>"/>
                </p>
            </form>	
				
			<br/><br/>
			<a name="guide"></a>
			<b><big><?php echo __('Support This Plugin Development', 'xmq'); ?></big></b><br/>
			<br/>
			<?php echo __('Do you like this plugin? Do you think this plugin very helpful?', 'xmq'); ?><br/>
			<?php echo __('Why don\'t you support this plugin developement by donating any amount you are willing to give?', 'xmq'); ?><br/>
			<br/>
			<?php echo __('If you wish to support the developer and make a donation, please click the following button. Thanks!', 'xmq'); ?><br/>
			<a href="http://xhanch.com/xhanch-donate" target="_blank"><img src="http://xhanch.com/image/paypal/btn_donate.gif" alt="<?php echo __('Donate', 'xmq'); ?>"></a></p>

			<br/><br/>
			<a name="guide"></a>
			<b><big><?php echo __('Complete Info and Share Room', 'xmq'); ?></big></b><br/>		
			<br/>	
			<div class="spoiler">
				<input type="button" onclick="show_spoiler(this);" value="<?php echo __('Complete information regarding Xhanch - My Quote (Share Room)', 'xmq'); ?>"/>
				<div class="inner" style="display:none;">
					<br/>
					<iframe src="http://xhanch.com/wp-plugin-my-quote/" style="width:700px;height:500px"></iframe>
				</div>
			</div>	
			<br/>
			<b>Useful links:</b><br/>
			- <a href="http://forum.xhanch.com/index.php/board,21.0.html" target="_blank">Update/change logs of this plugin </a><br/>
			- <a href="http://forum.xhanch.com/index.php/board,29.0.html" target="_blank">Ask and share about how to customize this plugin. You may also ask questions about plugin configurations</a><br/>
			- <a href="http://forum.xhanch.com/index.php/board,33.0.html" target="_blank">Have a thought to improve this plugin? Suggest it here</a><br/>
			- <a href="http://forum.xhanch.com/index.php/board,37.0.html" target="_blank">Found a bug/error? Kindly report it here</a><br/>
			- <a href="http://forum.xhanch.com/index.php/board,25.0.html" target="_blank">Share your experience of using this plugin. You may show off your websites that use this plugin here by providing the URL of yor website</a><br/>
			<br/>		
			<br/>
		</div>
<?php
	}
	
	xmq_cfg();
?>