<?php
	/*
		Plugin Name: Xhanch - My Quote
		Plugin URI: http://xhanch.com/wp-plugin-my-quote/
		Description: Random Quote plugin for wordpress
		Author: Susanto BSc (Xhanch Studio)
		Author URI: http://xhanch.com
		Version: 1.4.7
	*/

	function xhanch_my_quote_install () {
		require_once(dirname(__FILE__).'/installer.php');
	}
	register_activation_hook(__FILE__,'xhanch_my_quote_install');
		
	require_once(dirname(__FILE__).'/xhanch_my_quote.function.php');	

	//Widget
	
	function widget_xhanch_my_quote($args) {
		extract($args);/*
for($i=0;$i<10;$i++)
	echo xhanch_my_quote_get_quote().'<br/>';*/
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
				<td><input type="text" id="xhanch_my_quote_title" name="xhanch_my_quote_title" value="<?php echo $title; ?>" style="width:200px"/></td>
			</tr>
			<tr>
				<td><label for="xhanch_my_quote_credit">Display Credit</label></td>
				<td><input type="checkbox" id="xhanch_my_quote_credit" name="xhanch_my_quote_credit" value="1" <?php echo ($credit?'checked="checked"':''); ?>/></td>
			</tr>
		</table>
        <div style="float:right;line-height:21px">
            <b><?php echo __('Do you like this plugin?', 'xmt'); ?></b> <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fxhanch.com%2Fwp-plugin-my-quote%2F&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:1px solid #999; overflow:hidden; width:100px; height:21px; margin:0 0 0 10px; float:right" allowTransparency="true"></iframe>           
        </div>
        <div class="clear"></div>	
        <div style="float:right;line-height:21px">
            <b><?php echo __('Do you like our service and support?', 'xmt'); ?></b> <iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Fpages%2FXhanch-Studio%2F146245898739871&amp;layout=button_count&amp;show_faces=false&amp;width=450&amp;action=like&amp;font=arial&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:1px solid #999; overflow:hidden; width:100px; height:21px; margin:0 0 0 10px; float:right" allowTransparency="true"></iframe>           
        </div>
        <div style="clear:both"></div>
		<input type="hidden" id="xhanch_my_quote_submit" name="xhanch_my_quote_submit" value="1" />
<?php
	}

	function widget_xhanch_my_quote_init(){
		register_sidebar_widget('Xhanch - My Quote', 'widget_xhanch_my_quote');
		register_widget_control('Xhanch - My Quote', 'xhanch_my_quote_control', 400, 200 );     
	}
	add_action("plugins_loaded", "widget_xhanch_my_quote_init");
?>