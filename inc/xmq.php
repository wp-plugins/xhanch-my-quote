<?php
	function xmq_qte_col_lst($flt_atv = false){	
		if($flt_atv)
			$qte_atv = get_option('xmq_qte_atv', array());
		
		$pth = xmq_bse_dir.'/col/';
		$dir = dir($pth);
		$col = array();
		while($col_fle = $dir->read()){
			if(substr($col_fle, -7) == 'col.php'){
				if($flt_atv && in_array($col_fle, $qte_atv))
					$col[] = $col_fle;	
				elseif(!$flt_atv)
					$col[] = $col_fle;
			}
		}
		$dir->close();
		return $col;
	}

	function xmq_qte_get(){
		$sel_qte = '';

		$col_lst = xmq_qte_col_lst(true); 
		$qte_ext = get_option('xmq_qte_ext', array());

		if(count($qte_ext) > 0)
			$col_lst[] = '-custom-';

		$sel_col_id = array_rand($col_lst);
		$sel_col = $col_lst[$sel_col_id];
		
		$col = array();
		if($sel_col == '-custom-')
			$col = $qte_ext;
		else
			@include(xmq_bse_dir.'/col/'.$sel_col);
		
		if(count($col)){
			$sel_qte_id = array_rand($col);
			$sel_qte = $col[$sel_qte_id];		
		}
		return $sel_qte;
	}
?>