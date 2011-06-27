<?php
	if(!defined('xmq'))
		header('location:/');

	class xmq_wgt_qte extends WP_Widget{

		function xmq_wgt_qte(){
			$wgt_opt = array('classname' => 'xmq_wgt mng_sch', 'description' => 'Show a quote');
			$ctr_opt = array('width' => 300, 'height' => 200);
			$this->WP_Widget(false, 'XMQ: Quote', $wgt_opt, $ctr_opt);
		}

		function widget($arg, $cfg){
			extract($arg);
			$qte = xmq_qte_get();
			if(trim($qte) == '') 
				return;		

			echo $before_widget;
			if($cfg['ttl'] != '')
				echo $before_title.$cfg['ttl'].$after_title;				
?>
			<div id="xmq_wgt_qte_<?php echo $this->number; ?>">			
				<?php echo $qte; ?>
				<?php if (get_option("xmq_shw_crd")){ ?>
					<div style="text-align:right"><a href="http://xhanch.com/wp-plugin-my-quote/" rel="section" title="Xhanch - My Quote - A free WordPress plugin to display a random quote" style="text-decoration:none;font-size:10px" target="_blank">My Quote</a>, <a href="http://xhanch.com/" rel="section" title="Developed by Xhanch Studio" style="text-decoration:none;font-size:10px" target="_blank">by Xhanch</a></div>
				<?php }?>
			</div>
<?php		
			echo $after_widget;
		}

		function update($new_cfg, $old_cfg) {
			$cfg = $old_cfg;
			$cfg['ttl'] = $new_cfg['ttl'];
			return $cfg;
		}

		function form($cfg){
?>
			<table style="width:350px">
				<tr>
					<td width="150"><label for="<?php echo $this->get_field_id('ttl'); ?>"><?php echo 'Title'; ?></label></td>
					<td><input type="text" id="<?php echo $this->get_field_id('ttl'); ?>" name="<?php echo $this->get_field_name('ttl'); ?>" value="<?php echo xmq_esc($cfg['ttl']); ?>"/></td>
				</tr>
			</table>
<?php 
		}
	}

	add_action('widgets_init', create_function('', 'return register_widget("xmq_wgt_qte");'));
?>