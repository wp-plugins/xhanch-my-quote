<?php
	/*
		Plugin Name: Xhanch - My Quote
		Plugin URI: http://xhanch.com/wp-plugin-my-quote/
		Description: Random Quote plugin for wordpress
		Author: Susanto BSc (Xhanch Studio)
		Author URI: http://xhanch.com
		Version: 1.1.7
	*/

	function xhanch_my_quote_install () {
		require_once(dirname(__FILE__).'/installer.php');
	}
	register_activation_hook(__FILE__,'xhanch_my_quote_install');
		
	require_once(dirname(__FILE__).'/xhanch_my_quote.function.php');	

	//Widget
	
	function widget_xhanch_my_quote($args) {
		extract($args);

		$quote = xhanch_my_quote_get_quote();
		if(trim($quote) == '') 
			return;		
		echo $before_widget;
?>
		<?php 
			if (get_option("xhanch_my_quote_title")!='')
				echo $before_title.get_option("xhanch_my_quote_title").$after_title;				
		?>
		<div id="xhanch_xhanch_my_quote">			
			<?php echo $quote; ?>
			<?php if (get_option("xhanch_my_quote_credit")){ ?>
				<div style="text-align:right"><a href="http://xhanch.com/wp-plugin-my-quote/" rel="section" title="Xhanch - My Quote - A free WordPress plugin to display a random quote" style="text-decoration:none;font-size:10px">My Quote</a>, <a href="http://xhanch.com/" rel="section" title="Developed by Xhanch Studio" style="text-decoration:none;font-size:10px">by Xhanch</a></div>
			<?php }?>
		</div>
<?php		
		echo $after_widget;
	}

	function xhanch_my_quote_control(){	
		$title = get_option('xhanch_my_quote_title');
		$credit = get_option('xhanch_my_quote_credit');

		if ($_POST['xhanch_my_quote_submit']){
			update_option("xhanch_my_quote_title", htmlspecialchars($_POST['xhanch_my_quote_title']));
			update_option("xhanch_my_quote_credit", intval($_POST['xhanch_my_quote_credit']));
		}
?>
		<table>
			<tr>
				<td width="150"><label for="xhanch_my_quote_title">Title</label></td>
				<td><input type="text" id="xhanch_my_quote_title" name="xhanch_my_quote_title" value="<?php echo $title; ?>" /></td>
			</tr>
			<tr>
				<td><label for="xhanch_my_quote_credit">Display Credit</label></td>
				<td><input type="checkbox" id="xhanch_my_quote_credit" name="xhanch_my_quote_credit" value="1" <?php echo ($credit?'checked="checked"':''); ?>/></td>
			</tr>
		</table>
		<input type="hidden" id="xhanch_my_quote_submit" name="xhanch_my_quote_submit" value="1" />
<?php
	}

	function widget_xhanch_my_quote_init(){
		register_sidebar_widget('Xhanch - My Quote', 'widget_xhanch_my_quote');
		register_widget_control('Xhanch - My Quote', 'xhanch_my_quote_control', 300, 200 );     
	}
	add_action("plugins_loaded", "widget_xhanch_my_quote_init");
?>