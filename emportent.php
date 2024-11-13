//emportent code




function import($Q=null){ 
	if($Q){ 
		$A='/Aliens/module/'.app['module'].'/'.$Q.'/index.php'; 
		$B=app['dir'].'/module/'.app['module'].'/'.$Q.'/index.php'; 		
		if(file_exists($B)){ require_once $B; }
		else{ require_once $A; }		
	}
}

function Menu($Q=null){ if($Q){ $Q=app['dir'].'/module/'.app['module'].'/'.$Q.'/menu.php'; require_once $Q; } }

function Template($Q=null){ if($Q){$T=str_replace(' ','/',$Q); $T=app['dir'].'/theme/User/INR/html/body/console/bd/template/'.$T.'.php'; require $T;} }
 




 
function Component($UID=null, $Array=null, $Return=false){ 
// Input : UID == Component UID, Array == Parameters, Return == true or false to return or print
// Output : if Return == true, return data. else data will be printed.
 	
	$Component=app['dir'].'/theme/User/INR/html/body/console/bd/component/'.$UID.'.php'; 
	ob_start(); require $Component; $Component = ob_get_clean();  
	
	if($Return){ return $Screen; } else{ echo $Component; }
	
} 



 
function Componentt($UID=null, $Array=null, $Return=false){ 
// Input : UID == Component UID, Array == Parameters, Return == true or false to return or print
// Output : if Return == true, return data. else data will be printed.	
	
	$Module = explode('_',$UID); $Module=$Module[0];
	$Component=app['dir'].'/module/'.app['module'].'/'.$Module.'/component/'.$UID.'.php';
	ob_start(); require $Component; $Component = ob_get_clean();
	if($Return){ return $Screen; } else{ echo $Component; }
	
} 





function Interval($Time = null) {
	$Output = [];
	
	
	
	$echo = 'all';
	$Output['all']['created_min'] = '1996-09-04 00:00:00';
	$Output['all']['created_max'] = GMT();				
	$Output['all']['uid'] = 'All:0';
	
	
	
	$echo = 'day_this';
	$today = gmdate('Y-m-d');
	$Output['day_this']['created_min'] = $today . ' 00:00:00';
	$Output['day_this']['created_max'] = $today . ' 23:59:59';				
	$Output['day_this']['uid'] = 'Day:'.gmdate('Ymd');
				
                

	$echo = 'day_last';
	$Output['day_last']['created_min'] = gmdate('Y-m-d 00:00:00', strtotime('-1 day'));
	$Output['day_last']['created_max'] = gmdate('Y-m-d 23:59:59', strtotime('-1 day'));
	$Output['day_last']['uid'] = 'Day:'.gmdate('Ymd', strtotime('-1 day'));
                

	$echo = 'week_this';
	$startOfWeek = (new DateTime())->modify('last Sunday')->format('Y-m-d 00:00:00');
	$endOfWeek = (new DateTime())->modify('next Saturday')->format('Y-m-d 23:59:59');
	if(gmdate('w') == 0){ 
		$echo = "If today is Sunday";
		$startOfWeek = $today . ' 00:00:00';
	}
	if(gmdate('w') == 6){ 
		$echo = "If today is Saturday";
		$endOfWeek = $today . ' 23:59:59';
	}
	$Output['week_this']['created_min'] = $startOfWeek;
	$Output['week_this']['created_max'] = $endOfWeek;				
	$Output['week_this']['uid'] = 'Week:'.gmdate('Y') . 'W' . gmdate('W');
 
	
	$echo = 'month_this';
	$Output['month_this']['created_min'] = gmdate('Y-m-01 00:00:00'); $echo = "First day of the month";
	$Output['month_this']['created_max'] = gmdate('Y-m-t 23:59:59'); $echo = "Last day of the month";				
	$Output['month_this']['uid'] = 'Month:'.gmdate('Ym');
                


	$echo = 'year_this';
	$Output['year_this']['created_min'] = gmdate('Y-01-01 00:00:00'); $echo = "First day of the year";
	$Output['year_this']['created_max'] = gmdate('Y-12-31 23:59:59'); $echo = "Last day of the year";
	$Output['year_this']['uid'] = 'Year:'.gmdate('Y');
 
    return $Output;
}
