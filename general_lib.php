<?php
	//START constantes --------
	
	const MYPATH="http://localhost/php/php-lib";
	const ROOTPOINTER=(MYPATH."/");
	const TESTCHANGES=TRUE;
	//const MYPATH="https://domain.com";
	//const ROOTPOINTER="/";
	//const TESTCHANGES=FALSE;
	
	const THEMECOLOR="FFF2E7";//without #
	const COMPANY="Company";//without #
	
	const ENCOD="UTF-8";
	
	const DB_MAIN="dbname8376";
	const DB_CHARSET="utf8mb4";
	const DB_COLLATE="utf8mb4_unicode_ci";
	
	//END constantes --------
	//START on load --------
	
	if(TESTCHANGES){
		ini_set("display_errors", 1);
		ini_set("display_startup_errors", 1);
		error_reporting(E_ALL);
	}
	
	cacheSession();
	
	//END on load --------
	//START clases --------
	
	class Session{
		private $state=FALSE;
		private static $instance;
		
		private function __construct(){}
		
		public static function getInstance(){
			if(!isset(self::$instance)){
				self::$instance=new self;
			}
			
			if(self::$instance->state==FALSE){
				self::$instance->state=session_start();
			}
			
			return self::$instance;
		}
		
		public function __set($name, $value){
			$_SESSION[$name]=$value;
		}
		
		public function __get($name){
			$rtn="";
			
			if(isset($_SESSION[$name])){
				$rtn=$_SESSION[$name];
			}
			
			return $rtn;
		}
		
		public function __isset($name){
			return isset($_SESSION[$name]);
		}
		
		public function __unset($name){
			unset($_SESSION[$name]);
		}
		
		public function destroy(){
			if($this->state==TRUE){
				$this->state=!session_destroy();
				unset($_SESSION);
				
				return !$this->state;
			}
			
			return FALSE;
		}
	}
	
	//END clases --------
	//START basico --------
	
	function cacheSession(){
		static $session;
		
		if(!isset($session)){
			$session=Session::getInstance();
		}
		
		return $session;
	}
	
	//missing tests
	function getActualUrl($httpType=""){
		if($httpType==="http"){
			$useHttps=FALSE;
		}else if($httpType==="https"){
			$useHttps=TRUE;
		}else{
			$useHttps=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==="on");
		}
		
		$reqUri=$_SERVER['REQUEST_URI'];
		$reqUri=($reqUri!=="/" ? $reqUri : "");
		
		$rtn=($useHttps ? "https" : "http")."://".$_SERVER['HTTP_HOST']."".$reqUri;
		
		return $rtn;
	}
	
	function tryKey($params, $paramKey, $dafaultVal){
		return (isset($params[$paramKey]) ? $params[$paramKey] : $dafaultVal);
	}
	
	//missing tests
	function isAdmin(){
		return (cacheSession()->isAdmin==="1");
	}
	
	//missing tests
	function redirectAndDie($filenameWithExt, $strParams){
		header("Location: ".$filenameWithExt."".$strParams);
		die();
	}
	
	//missing tests
	function ifNotAdminRedirect(){
		if(!isAdmin()){
			redirectAndDie("index.php", "");
		}
	}
	
	//missing tests
	function isDoNotTrackEnabled(){
		return (tryKey($_SERVER, "HTTP_DNT", 0)==1);
	}
	
	function isPermittedImgExt($str){
		$lcDotExt=strtolower(getFromEnd($str, 4));
		
		return ($lcDotExt===(".jpg") || $lcDotExt===(".png") || $lcDotExt===(".gif"));//missing .jpeg
	}
	
	function toNum($val){
		return (int)(trim($val)==="" ? 0 : preg_replace("/[^0-9\-\.]|\.(?=.*\.)/", "", $val));
	}
	
	function toFloat($val){
		$val=preg_replace("/[^0-9\-\.]|\.(?=.*\.)/", "", $val);
		
		return floatval(getFromStart($val, 1)==="." ? ("0".$val) : $val);
	}
	
	function twoDecimals($val){
		return number_format((float)("".$val), 2, ".", "");
	}
	
	function toNumAtLeast($val, $min){
		return max(toNum($min), toNum($val));
	}
	
	function toNumAtMost($val, $max){
		return min(toNum($max), toNum($val));
	}
	
	function toRangeMinMax($val, $min, $max){
		return toNumAtLeast(toNumAtMost($val, $max), $min);
	}
	
	function arrIndexOf($elm, $arr){
		$i=array_search($elm, $arr);
		
		return ($i===FALSE ? -1 : toNum($i));
	}
	
	function delFromStrArr($str, $exludedKey){
		$arr=explode(",", $str);
		$arrWithout=[];
		$exludedKey=trim($exludedKey);
		
		foreach($arr as $elm){
			$elm=trim($elm);
			
			if($elm!==$exludedKey){
				$arrWithout[]=$elm;
			}
		}
		
		return implode(",", $arrWithout);
	}
	
	function appendStrArr($strList, $element){
		return ($strList.($strList!=="" ? "," : "").$element);
	}
	
	function prependStrArr($strList, $element){
		return ($element.($strList!=="" ? "," : "").$strList);
	}
	
	function delFromEnd($str, $num){
		return mb_substr($str, 0, (-1*$num), ENCOD);
	}
	
	function delFromStart($str, $num){
		return mb_substr($str, $num, NULL, ENCOD);
	}
	
	function getFromEnd($str, $num){
		return delFromStart($str, (-1*$num));
	}
	
	function getFromStart($str, $num){
		return delFromEnd($str, (-1*$num));
	}
	
	function newArrWithElmAt($len, $indx, $str){
		$rtn=array_fill(0, $len, "");
		$rtn[toRangeMinMax($indx, 0, ($len-1))]=$str;
		
		return $rtn;
	}
	
	function arrCheckedOption($len, $chkdIndx){
		return newArrWithElmAt($len, $chkdIndx, " checked");
	}
	
	function arrSelectedOption($len, $selIndx){
		return newArrWithElmAt($len, $selIndx, " selected='selected'");
	}
	
	function checkedIf($isChecked){
		return ($isChecked ? " checked" : "");
	}
	
	function selectedIf($isSelected){
		return ($isSelected ? " selected='selected'" : "");
	}
	
	function escapeQuotes($val){
		return preg_replace("/\"/", "&#34;", preg_replace("/\'/", "&#39;", $val));
	}
	
	function eQ($val){//alias: escapeQuotes()
		return escapeQuotes($val);
	}
	
	function firstUp($str){
		return mb_strtoupper(getFromStart($str, 1), ENCOD).delFromStart($str, 1);
	}
	
	function specialUppercase($str){
		$arr=explode(" ", trim(preg_replace("/\s+/", " ", $str)));
		
		for($i=0, $len=count($arr); $i<$len; $i++){
			$temp=mb_strtolower($arr[$i], ENCOD);
			
			if($temp==="de" || $temp==="del"){
				$arr[$i]=$temp;
			}else if($i!==0 && $arr[$i-1]==="de" && ($temp==="la" || $temp==="las" || $temp==="los")){//"de" ya esta en lowerc
				$arr[$i]=$temp;
			}else if(preg_match("/^m{0,4}(cm|cd|d?c{0,3})(xc|xl|l?x{0,3})(ix|iv|v?i{0,3})$/", $temp)){
				$arr[$i]=strtoupper($temp);//~ NO ocupa mb encoding
			}else{
				$arr[$i]=firstUp($temp);
			}
		}
		
		return firstUp(implode(" ", $arr));
	}
	
	function buildStrFromArgs($args, $leftSide, $rightSide, $beforeIfImploded, $afterIfImploded, $separator){
		$arr=[];
		
		foreach($args as $val){
			if($val!==""){
				$arr[]=($leftSide."".$val."".$rightSide);
			}
		}
		
		//example: buildStrFromArgs(array("a", "b"), "(", ")", "[", "]", "|") = "[(a)|(b)]"
		return (count($arr)>0 ? ($beforeIfImploded.implode($separator, $arr).$afterIfImploded) : "");
	}
	
	//missing tests
	function sendEmail($to_emails_arr, $subject, $message, $allowedTags="<br>"){
		$rtn=FALSE;
		
		if(count($to_emails_arr)>0){
			$to=implode(", ", $to_emails_arr);
			
			$str=trim($message);
			
			$str=implode("", explode("\\", $str));
			$str=stripslashes($str);
			
			$str=strip_tags(nl2br(escapeQuotes($str)), $allowedTags);
			$str=str_replace("&#39;", "\"", $str);
			
			$message=trim($str);
			
			$headers="MIME-Version: 1.0\r\n";
			$headers.="Content-type: text/html; charset=iso-8859-1\r\n";
			
			$was_sent=mail($to, $subject, $message, $headers);
			
			$rtn=($was_sent===FALSE ? FALSE : TRUE);/*NO usar rtn=was_sent*/
		}
		
		return $rtn;
	}
	
	//missing tests
	function timestampToDate($timestamp=0){
		return date("j F Y - h:i A", $timestamp);
	}
	
	function unitComparer($id, $funcVal, $expectedVal, $testN){
		return ($funcVal===$expectedVal ? "" : ("<p><strong>".$testN."[".$id."]:</strong> (".$funcVal.") !== (".$expectedVal.")</p>"));
	}
	
	//END basico --------
?>
