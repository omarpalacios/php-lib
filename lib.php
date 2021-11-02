<?php
	require_once "general_lib.php";
	
	//START basico --------
	
	function getParams($reqParams, $opParams, $fromURL){
		$rtnParams=[];
		$legalParams=[];
		$fuente=($fromURL ? $_GET : $_POST);
		
		foreach($reqParams as $elm){
			$legalParams[]=array($elm, TRUE);
		}
		
		foreach($opParams as $elm){
			$legalParams[]=array($elm, FALSE);
		}
		
		foreach($legalParams as $elm){
			$name=$elm[0];
			$value=tryKey($fuente, $name, "");
			
			$value=implode("", explode("\\", $value));
			$value=stripslashes($value);
			
			$value=trim($value);
			
			if($value!==""){
				$rtnParams[$name]=$value;
			}
		}
		
		$rtnParams['errors']=FALSE;
		
		foreach($legalParams as $elm){
			if($elm[1]){
				if(!isset($rtnParams[$elm[0]])){
					$rtnParams['errors']=TRUE;
					break;
				}
			}
		}
		
		return $rtnParams;
	}
	
	function buildCssImports(){
		$args=func_get_args();
		$left="		<link rel=\"stylesheet\" href=\"".eQ(ROOTPOINTER."css/");
		$right=eQ(".css")."\">";
		
		return buildStrFromArgs($args, $left, $right, "", "\n", "\n");
	}
	
	function buildJsImports(){
		$args=func_get_args();
		$left="		<script src=\"".eQ(ROOTPOINTER."js/");
		$right=eQ(".js")."\"></script>";
		
		return buildStrFromArgs($args, $left, $right, "", "\n", "\n");
	}
	
	//END basico --------
?>
