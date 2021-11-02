<?php
	require "lib.php";
	
	$prehtm="<h1>PHP version: ".phpversion()."</h1><hr>";
	
	$rslt="";
	
	$testN="~class~ cacheSession()";
	cacheSession()->testVal="2";
	$rslt.=unitComparer(1, (cacheSession()->testVal), "2", $testN);
	cacheSession()->testVal="3";
	$rslt.=unitComparer(2, (cacheSession()->testVal), "3", $testN);
	//~ NO usar cacheSession()->destroy();
	
	$testN="tryKey(params, paramKey, dafaultVal)";
	$testParams=[];
	$testParams['aba']="100";
	$testParams['ca']="0";
	$testParams['za']="1";
	$testParams['zca']="yes";
	$rslt.=unitComparer(1, tryKey($testParams, "zca", "nop"), "yes", $testN);
	$rslt.=unitComparer(2, tryKey($testParams, "misn", "nop"), "nop", $testN);
	$tParams2=[];
	$tParams2['aba']="100";
	$tParams2['ca']="0";
	$rslt.=unitComparer(3, tryKey($tParams2, "za", "0"), "0", $testN);
	$tParams2['za']="1";
	$rslt.=unitComparer(4, tryKey($tParams2, "za", "0"), "1", $testN);
	$tParams2['zca']="yes";
	
	$testN="isPermittedImgExt(str)";
	$rslt.=unitComparer(1, isPermittedImgExt("test.png"), TRUE, $testN);
	$rslt.=unitComparer(2, isPermittedImgExt("test.jpg"), TRUE, $testN);
	$rslt.=unitComparer(3, isPermittedImgExt("test.gif"), TRUE, $testN);
	$rslt.=unitComparer(4, isPermittedImgExt("test.pngg"), FALSE, $testN);
	$rslt.=unitComparer(5, isPermittedImgExt("test.jpgg"), FALSE, $testN);
	$rslt.=unitComparer(6, isPermittedImgExt("test.giff"), FALSE, $testN);
	$rslt.=unitComparer(7, isPermittedImgExt("test.exe"), FALSE, $testN);
	$rslt.=unitComparer(8, isPermittedImgExt("test.pdf"), FALSE, $testN);
	$rslt.=unitComparer(9, isPermittedImgExt("test.jpeg"), FALSE, $testN);//mm
	
	$testN="toNum(val)";
	$rslt.=unitComparer(1, ("".toNum("103,114,555.00")), "103114555", $testN);
	$rslt.=unitComparer(2, ("".toNum("103,114,555.0000")), "103114555", $testN);
	$rslt.=unitComparer(3, ("".toNum("103.114.555,00")), "103114", $testN);
	$rslt.=unitComparer(4, ("".toNum("103.114.555,0000")), "103114", $testN);
	$rslt.=unitComparer(5, ("".toNum("1.4.5,0000")), "14", $testN);
	$rslt.=unitComparer(6, ("".toNum("3,4,5.0000")), "345", $testN);
	$rslt.=unitComparer(7, ("".toNum("1,4,5.00")), "145", $testN);
	$rslt.=unitComparer(8, ("".toNum("3.1.5,00")), "31", $testN);
	$rslt.=unitComparer(9, ("".toNum("103,114,555.21")), "103114555", $testN);
	$rslt.=unitComparer(10, ("".toNum("103,114,555.1234")), "103114555", $testN);
	$rslt.=unitComparer(11, ("".toNum("103.114.555,21")), "103114", $testN);
	$rslt.=unitComparer(12, ("".toNum("103.114.555,1234")), "103114", $testN);
	$rslt.=unitComparer(13, ("".toNum("1.4.5,1234")), "14", $testN);
	$rslt.=unitComparer(14, ("".toNum("3,4,5.1234")), "345", $testN);
	$rslt.=unitComparer(15, ("".toNum("1,4,5.21")), "145", $testN);
	$rslt.=unitComparer(16, ("".toNum("3.1.5,21")), "31", $testN);
	$rslt.=unitComparer(17, ("".toNum("0123.00")), "123", $testN);
	$rslt.=unitComparer(18, ("".toNum("0123,00")), "12300", $testN);
	$rslt.=unitComparer(19, ("".toNum("0123.00")), "123", $testN);
	$rslt.=unitComparer(20, ("".toNum("0123.010")), "123", $testN);
	$rslt.=unitComparer(21, ("".toNum("0123.110")), "123", $testN);
	$rslt.=unitComparer(22, ("".toNum("00,110")), "110", $testN);
	$rslt.=unitComparer(23, ("".toNum("00.110")), "0", $testN);
	$rslt.=unitComparer(24, ("".toNum("1.110")), "1", $testN);
	$rslt.=unitComparer(25, ("".toNum("1,02")), "102", $testN);
	$rslt.=unitComparer(26, ("".toNum("1.")), "1", $testN);
	$rslt.=unitComparer(27, ("".toNum("1,")), "1", $testN);
	$rslt.=unitComparer(28, ("".toNum(",110")), "110", $testN);
	$rslt.=unitComparer(29, ("".toNum(".110")), "0", $testN);
	$rslt.=unitComparer(30, ("".toNum(".5.3.88")), "53", $testN);
	$rslt.=unitComparer(31, ("".toNum(".11.0.000.")), "110000", $testN);
	$rslt.=unitComparer(32, ("".toNum("11.0.000.00")), "110000", $testN);
	$rslt.=unitComparer(33, ("".toNum("11,0,000,00")), "11000000", $testN);
	$rslt.=unitComparer(34, ("".toNum(",5,3,88")), "5388", $testN);
	$rslt.=unitComparer(35, ("".toNum("á1.2")), "1", $testN);
	$rslt.=unitComparer(36, ("".toNum("Á1.2")), "1", $testN);
	$rslt.=unitComparer(37, ("".toNum("1.á2")), "1", $testN);
	$rslt.=unitComparer(38, ("".toNum("1.Á2")), "1", $testN);
	$rslt.=unitComparer(39, ("".toNum(" 1 2  á.á  3 3")), "12", $testN);
	$rslt.=unitComparer(40, ("".toNum(" 1 2  Á.Á  3 3")), "12", $testN);
	$rslt.=unitComparer(41, ("".toNum(" Á.Á  3 3000")), "0", $testN);
	$rslt.=unitComparer(42, ("".toNum(" Á.Á  3 3Á000")), "0", $testN);
	$rslt.=unitComparer(43, ("".toNum("")), "0", $testN);
	$rslt.=unitComparer(44, ("".toNum(" ")), "0", $testN);
	$rslt.=unitComparer(45, ("".(toNum("-12")+1)), "-11", $testN);
	$rslt.=unitComparer(46, ("".(toNum("-12.99")+1)), "-11", $testN);
	
	$testN="toFloat(val)";
	$rslt.=unitComparer(1, ("".toFloat("103,114,555.00")), "103114555", $testN);
	$rslt.=unitComparer(2, ("".toFloat("103,114,555.0000")), "103114555", $testN);
	$rslt.=unitComparer(3, ("".toFloat("103.114.555,00")), "103114.555", $testN);
	$rslt.=unitComparer(4, ("".toFloat("103.114.555,0000")), "103114.555", $testN);
	$rslt.=unitComparer(5, ("".toFloat("1.4.5,0000")), "14.5", $testN);
	$rslt.=unitComparer(6, ("".toFloat("3,4,5.0000")), "345", $testN);
	$rslt.=unitComparer(7, ("".toFloat("1,4,5.00")), "145", $testN);
	$rslt.=unitComparer(8, ("".toFloat("3.1.5,00")), "31.5", $testN);
	$rslt.=unitComparer(9, ("".toFloat("103,114,555.21")), "103114555.21", $testN);
	$rslt.=unitComparer(10, ("".toFloat("103,114,555.1234")), "103114555.1234", $testN);
	$rslt.=unitComparer(11, ("".toFloat("103.114.555,21")), "103114.55521", $testN);
	$rslt.=unitComparer(12, ("".toFloat("103.114.555,1234")), "103114.5551234", $testN);
	$rslt.=unitComparer(13, ("".toFloat("1.4.5,1234")), "14.51234", $testN);
	$rslt.=unitComparer(14, ("".toFloat("3,4,5.1234")), "345.1234", $testN);
	$rslt.=unitComparer(15, ("".toFloat("1,4,5.21")), "145.21", $testN);
	$rslt.=unitComparer(16, ("".toFloat("3.1.5,21")), "31.521", $testN);
	$rslt.=unitComparer(17, ("".toFloat("0123.00")), "123", $testN);
	$rslt.=unitComparer(18, ("".toFloat("0123,00")), "12300", $testN);
	$rslt.=unitComparer(19, ("".toFloat("0123.00")), "123", $testN);
	$rslt.=unitComparer(20, ("".toFloat("0123.010")), "123.01", $testN);
	$rslt.=unitComparer(21, ("".toFloat("0123.110")), "123.11", $testN);
	$rslt.=unitComparer(22, ("".toFloat("00,110")), "110", $testN);
	$rslt.=unitComparer(23, ("".toFloat("00.110")), "0.11", $testN);
	$rslt.=unitComparer(24, ("".toFloat("1.110")), "1.11", $testN);
	$rslt.=unitComparer(25, ("".toFloat("1,02")), "102", $testN);
	$rslt.=unitComparer(26, ("".toFloat("1.")), "1", $testN);
	$rslt.=unitComparer(27, ("".toFloat("1,")), "1", $testN);
	$rslt.=unitComparer(28, ("".toFloat(",110")), "110", $testN);
	$rslt.=unitComparer(29, ("".toFloat(".110")), "0.11", $testN);
	$rslt.=unitComparer(30, ("".toFloat("")), "0", $testN);
	$rslt.=unitComparer(31, ("".toFloat(" ")), "0", $testN);
	$rslt.=unitComparer(32, ("".toFloat(".11.0.000.")), "110000", $testN);
	$rslt.=unitComparer(33, ("".toFloat("11.0.000.00")), "110000", $testN);
	$rslt.=unitComparer(34, ("".toFloat("11,0,000,00")), "11000000", $testN);
	$rslt.=unitComparer(35, ("".toFloat(",5,3,88")), "5388", $testN);
	$rslt.=unitComparer(36, ("".toFloat("á1.2")), "1.2", $testN);
	$rslt.=unitComparer(37, ("".toFloat("Á1.2")), "1.2", $testN);
	$rslt.=unitComparer(38, ("".toFloat("1.á2")), "1.2", $testN);
	$rslt.=unitComparer(39, ("".toFloat("1.Á2")), "1.2", $testN);
	$rslt.=unitComparer(40, ("".toFloat(" 1 2  á.á  3 3")), "12.33", $testN);
	$rslt.=unitComparer(41, ("".toFloat(" 1 2  Á.Á  3 3")), "12.33", $testN);
	$rslt.=unitComparer(42, ("".toFloat(" Á.Á  3 3000")), "0.33", $testN);
	$rslt.=unitComparer(43, ("".toFloat(" Á.Á  3 3Á000")), "0.33", $testN);
	$rslt.=unitComparer(44, ("".toFloat("0.0")), "0", $testN);
	$rslt.=unitComparer(45, ("".toFloat(".000")), "0", $testN);
	$rslt.=unitComparer(46, ("".toFloat("0")), "0", $testN);
	$rslt.=unitComparer(47, ("".toFloat(".5.3.88")), "53.88", $testN);
	$rslt.=unitComparer(48, ("".(toFloat("-12.33")+0.1)), "-12.23", $testN);
	$rslt.=unitComparer(49, ("".(toFloat("-12.1")+0.1)), "-12", $testN);
	
	$testN="twoDecimals(val)";
	$rslt.=unitComparer(1, ("".twoDecimals("3")), "3.00", $testN);
	$rslt.=unitComparer(2, ("".twoDecimals("3.0")), "3.00", $testN);
	$rslt.=unitComparer(3, ("".twoDecimals("3.00")), "3.00", $testN);
	$rslt.=unitComparer(4, ("".twoDecimals("3.000")), "3.00", $testN);
	$rslt.=unitComparer(5, ("".twoDecimals("0")), "0.00", $testN);
	$rslt.=unitComparer(6, ("".twoDecimals("0.0")), "0.00", $testN);
	$rslt.=unitComparer(7, ("".twoDecimals("0.00")), "0.00", $testN);
	$rslt.=unitComparer(8, ("".twoDecimals("0.000")), "0.00", $testN);
	$rslt.=unitComparer(9, ("".twoDecimals("-12")), "-12.00", $testN);
	$rslt.=unitComparer(10, ("".twoDecimals("-12.0")), "-12.00", $testN);
	$rslt.=unitComparer(11, ("".twoDecimals("-12.00")), "-12.00", $testN);
	$rslt.=unitComparer(12, ("".twoDecimals("-12.000")), "-12.00", $testN);
	$rslt.=unitComparer(13, ("".twoDecimals("-12.1")), "-12.10", $testN);
	$rslt.=unitComparer(14, ("".twoDecimals("-12.10")), "-12.10", $testN);
	$rslt.=unitComparer(15, ("".twoDecimals("-12.100")), "-12.10", $testN);
	
	$testN="toNumAtLeast(val, min)";
	$rslt.=unitComparer(1, ("".toNumAtLeast("-1", "0")), "0", $testN);
	$rslt.=unitComparer(2, ("".toNumAtLeast("-1", "0.001")), "0", $testN);
	$rslt.=unitComparer(3, ("".toNumAtLeast("-1", "0.001")), "0", $testN);
	$rslt.=unitComparer(4, ("".toNumAtLeast("-1", "1.001")), "1", $testN);
	$rslt.=unitComparer(5, ("".toNumAtLeast("35", "65")), "65", $testN);
	$rslt.=unitComparer(6, ("".toNumAtLeast("65", "35")), "65", $testN);
	$rslt.=unitComparer(7, ("".toNumAtLeast("-99", "65")), "65", $testN);
	$rslt.=unitComparer(8, ("".toNumAtLeast("", "-1")), "0", $testN);
	$rslt.=unitComparer(9, ("".toNumAtLeast(" ", "-1")), "0", $testN);
	$rslt.=unitComparer(10, ("".toNumAtLeast(null, "-1")), "0", $testN);
	$rslt.=unitComparer(11, ("".toNumAtLeast(FALSE, "-1")), "0", $testN);
	$rslt.=unitComparer(12, ("".toNumAtLeast(TRUE, "-1")), "1", $testN);
	$rslt.=unitComparer(13, ("".toNumAtLeast("-3", "")), "0", $testN);
	$rslt.=unitComparer(14, ("".toNumAtLeast("-50", "-33")), "-33", $testN);
	
	$testN="toNumAtMost(val, max)";
	$rslt.=unitComparer(1, ("".toNumAtMost("1", "0")), "0", $testN);
	$rslt.=unitComparer(2, ("".toNumAtMost("1", "0.001")), "0", $testN);
	$rslt.=unitComparer(3, ("".toNumAtMost("1", "0.001")), "0", $testN);
	$rslt.=unitComparer(4, ("".toNumAtMost("1", "1.001")), "1", $testN);
	$rslt.=unitComparer(5, ("".toNumAtMost("65", "35")), "35", $testN);
	$rslt.=unitComparer(6, ("".toNumAtMost("35", "65")), "35", $testN);
	$rslt.=unitComparer(7, ("".toNumAtMost("65", "-99")), "-99", $testN);
	$rslt.=unitComparer(8, ("".toNumAtMost("", "1")), "0", $testN);
	$rslt.=unitComparer(9, ("".toNumAtMost(" ", "1")), "0", $testN);
	$rslt.=unitComparer(10, ("".toNumAtMost(null, "1")), "0", $testN);
	$rslt.=unitComparer(11, ("".toNumAtMost(FALSE, "1")), "0", $testN);
	$rslt.=unitComparer(12, ("".toNumAtMost(TRUE, "0")), "0", $testN);
	$rslt.=unitComparer(13, ("".toNumAtMost("-3", "")), "-3", $testN);
	$rslt.=unitComparer(14, ("".toNumAtMost("-33", "-50")), "-50", $testN);
	
	$testN="toRangeMinMax(val, min, max)";
	$rslt.=unitComparer(1, ("".toRangeMinMax("-33", "0", "10")), "0", $testN);
	$rslt.=unitComparer(2, ("".toRangeMinMax("5", "0", "10")), "5", $testN);
	$rslt.=unitComparer(3, ("".toRangeMinMax("33", "0", "10")), "10", $testN);
	$rslt.=unitComparer(4, ("".toRangeMinMax("5", "10", "0")), "10", $testN);//min>max
	$rslt.=unitComparer(5, ("".toRangeMinMax("-33", "10", "0")), "10", $testN);//min>max
	$rslt.=unitComparer(6, ("".toRangeMinMax("33", "10", "0")), "10", $testN);//min>max
	
	$testN="arrIndexOf(elm, arr)";
	$rslt.=unitComparer(1, ("".arrIndexOf("a", array("a", "b", "c", "a", "b", "c"))), "0", $testN);
	$rslt.=unitComparer(2, ("".arrIndexOf("b", array("a", "b", "c", "a", "b", "c"))), "1", $testN);
	$rslt.=unitComparer(3, ("".arrIndexOf("c", array("a", "b", "c", "a", "b", "c"))), "2", $testN);
	$rslt.=unitComparer(4, ("".arrIndexOf("x", array("a", "b", "c", "a", "b", "c"))), "-1", $testN);
	$rslt.=unitComparer(5, ("".arrIndexOf("aa", array("a", "aa", "Aa", "AA"))), "1", $testN);
	$rslt.=unitComparer(6, ("".arrIndexOf("Aa", array("a", "aa", "Aa", "AA"))), "2", $testN);
	$rslt.=unitComparer(7, ("".arrIndexOf("AA", array("a", "aa", "Aa", "AA"))), "3", $testN);
	$rslt.=unitComparer(8, ("".arrIndexOf("aA", array("a", "aa", "Aa", "AA"))), "-1", $testN);
	$rslt.=unitComparer(9, ("".arrIndexOf("aaa", array("a", "aa", "Aa", "AA"))), "-1", $testN);
	$rslt.=unitComparer(10, ("".arrIndexOf("Aaa", array("a", "aa", "Aa", "AA"))), "-1", $testN);
	
	$testN="delFromStrArr(str, exludedKey)";
	$rslt.=unitComparer(1, delFromStrArr("1,2,3,4,5", "1"), "2,3,4,5", $testN);
	$rslt.=unitComparer(2, delFromStrArr("1,2,3,4,5", "2"), "1,3,4,5", $testN);
	$rslt.=unitComparer(3, delFromStrArr("1,2,3,4,5", "3"), "1,2,4,5", $testN);
	$rslt.=unitComparer(4, delFromStrArr("1,2,3,4,5", "4"), "1,2,3,5", $testN);
	$rslt.=unitComparer(5, delFromStrArr("1,2,3,4,5", "5"), "1,2,3,4", $testN);
	$rslt.=unitComparer(6, delFromStrArr("1,2,2,4,5,2", "2"), "1,4,5", $testN);
	$rslt.=unitComparer(7, delFromStrArr("1,11,2,2,4,5,2,1", "1"), "11,2,2,4,5,2", $testN);
	$rslt.=unitComparer(8, delFromStrArr("ola,que,quea,ace", "quea"), "ola,que,ace", $testN);
	$rslt.=unitComparer(9, delFromStrArr("1,0,1,0", FALSE), "1,0,1,0", $testN);
	$rslt.=unitComparer(10, delFromStrArr("1,0,1,0", TRUE), "0,0", $testN);//mm
	$rslt.=unitComparer(11, delFromStrArr("1,2,88,4,5", "8"), "1,2,88,4,5", $testN);
	$rslt.=unitComparer(12, delFromStrArr(" 1 , 2 , 3,4 ,5,6, 7 ", "8"), "1,2,3,4,5,6,7", $testN);
	$rslt.=unitComparer(13, delFromStrArr(" 1 , 2 , 3,4 ,5,6, 7 ", "2"), "1,3,4,5,6,7", $testN);
	$rslt.=unitComparer(14, delFromStrArr(" 1 , 2 , 3,4 ,5,6, 7 ", " 2 "), "1,3,4,5,6,7", $testN);
	$rslt.=unitComparer(15, delFromStrArr(" a, es una ,b , c ", "b"), "a,es una,c", $testN);
	$rslt.=unitComparer(16, delFromStrArr("a, es una, b, c", "es una"), "a,b,c", $testN);
	
	//mm why no trim like delFromStrArr()?
	$testN="appendStrArr(strList, element)";
	$rslt.=unitComparer(1, appendStrArr("a,b,c", "z"), "a,b,c,z", $testN);
	$rslt.=unitComparer(2, appendStrArr("", "z"), "z", $testN);
	$rslt.=unitComparer(3, appendStrArr(" 1 , 2 , 3,4 ,5,6, 7 ", "8"), " 1 , 2 , 3,4 ,5,6, 7 ,8", $testN);
	$rslt.=unitComparer(4, appendStrArr(" 1 , 2 , 3,4 ,5,6, 7 ", " 8 "), " 1 , 2 , 3,4 ,5,6, 7 , 8 ", $testN);
	$rslt.=unitComparer(5, appendStrArr("x,y,z", ""), "x,y,z,", $testN);//mm
	
	//mm why no trim like delFromStrArr()?
	$testN="prependStrArr(strList, element)";
	$rslt.=unitComparer(1, prependStrArr("a,b,c", "z"), "z,a,b,c", $testN);
	$rslt.=unitComparer(2, prependStrArr("", "z"), "z", $testN);
	$rslt.=unitComparer(3, prependStrArr(" 1 , 2 , 3,4 ,5,6, 7 ", "8"), "8, 1 , 2 , 3,4 ,5,6, 7 ", $testN);
	$rslt.=unitComparer(4, prependStrArr(" 1 , 2 , 3,4 ,5,6, 7 ", " 8 "), " 8 , 1 , 2 , 3,4 ,5,6, 7 ", $testN);
	$rslt.=unitComparer(5, prependStrArr("x,y,z", ""), ",x,y,z", $testN);//mm
	
	$testN="[del/get]From[End/Start](str, num)";
	$rslt.=unitComparer(1, ("".delFromEnd("abce", 1)), "abc", $testN);
	$rslt.=unitComparer(2, ("".delFromEnd("abce", 3)), "a", $testN);
	$rslt.=unitComparer(3, ("".delFromEnd("abce", 4)), "", $testN);
	$rslt.=unitComparer(4, ("".delFromEnd("abce", 0)), "", $testN);//mm
	$rslt.=unitComparer(5, ("".delFromEnd("abce", 99)), "", $testN);
	$rslt.=unitComparer(6, ("".getFromStart("abce", 1)), "a", $testN);
	$rslt.=unitComparer(7, ("".getFromStart("abce", 3)), "abc", $testN);
	$rslt.=unitComparer(8, ("".getFromStart("abce", 4)), "abce", $testN);
	$rslt.=unitComparer(9, ("".getFromStart("abce", 0)), "", $testN);
	$rslt.=unitComparer(10, ("".getFromStart("abce", 99)), "abce", $testN);
	$rslt.=unitComparer(11, ("".getFromEnd("abce", 1)), "e", $testN);
	$rslt.=unitComparer(12, ("".getFromEnd("abce", 3)), "bce", $testN);
	$rslt.=unitComparer(13, ("".getFromEnd("abce", 4)), "abce", $testN);
	$rslt.=unitComparer(14, ("".getFromEnd("abce", 0)), "abce", $testN);//mm
	$rslt.=unitComparer(15, ("".getFromEnd("abce", 99)), "abce", $testN);
	$rslt.=unitComparer(16, ("".delFromStart("abce", 1)), "bce", $testN);
	$rslt.=unitComparer(17, ("".delFromStart("abce", 3)), "e", $testN);
	$rslt.=unitComparer(18, ("".delFromStart("abce", 4)), "", $testN);
	$rslt.=unitComparer(19, ("".delFromStart("abce", 0)), "abce", $testN);
	$rslt.=unitComparer(20, ("".delFromStart("abce", 99)), "", $testN);
	$rslt.=unitComparer(21, ("".delFromEnd("abce", -2)), getFromStart("abce", 2), $testN);//e(a)=s(-a)
	$rslt.=unitComparer(22, ("".delFromEnd("abce", 2)), getFromStart("abce", -2), $testN);//e(a)=s(-a)
	$rslt.=unitComparer(23, ("".getFromEnd("abce", -2)), delFromStart("abce", 2), $testN);//e(a)=s(-a)
	$rslt.=unitComparer(24, ("".getFromEnd("abce", 2)), delFromStart("abce", -2), $testN);//e(a)=s(-a)
	$rslt.=unitComparer(25, ("".delFromEnd("áéíóú", 2)), "áéí", $testN);
	$rslt.=unitComparer(26, ("".getFromStart("áéíóú", 3)), "áéí", $testN);
	$rslt.=unitComparer(27, ("".getFromEnd("áéíóú", 2)), "óú", $testN);
	$rslt.=unitComparer(28, ("".delFromStart("áéíóú", 3)), "óú", $testN);
	
	$testN="firstUp(str)";
	$rslt.=unitComparer(1, firstUp("ola"), "Ola", $testN);
	$rslt.=unitComparer(2, firstUp(""), "", $testN);
	$rslt.=unitComparer(3, firstUp(TRUE), "1", $testN);//mm
	$rslt.=unitComparer(4, firstUp(FALSE), "", $testN);//mm false no a 0?
	$rslt.=unitComparer(5, firstUp("hello world"), "Hello world", $testN);
	$rslt.=unitComparer(6, firstUp("ámbaréi"), "Ámbaréi", $testN);
	$rslt.=unitComparer(7, firstUp("aBCD"), "ABCD", $testN);
	$rslt.=unitComparer(8, firstUp("1yx"), "1yx", $testN);
	$rslt.=unitComparer(9, firstUp(" yx"), " yx", $testN);
	
	$testN="specialUppercase(str)";
	$rslt.=unitComparer(1, specialUppercase("hello world"), "Hello World", $testN);
	$rslt.=unitComparer(2, specialUppercase(" hello world"), "Hello World", $testN);
	$rslt.=unitComparer(3, specialUppercase("de manzana"), "De Manzana", $testN);
	$rslt.=unitComparer(4, specialUppercase("manzana de dulce"), "Manzana de Dulce", $testN);
	$rslt.=unitComparer(5, specialUppercase("manzana del pasado"), "Manzana del Pasado", $testN);
	$rslt.=unitComparer(6, specialUppercase("manzana las cajas"), "Manzana Las Cajas", $testN);
	$rslt.=unitComparer(7, specialUppercase("manzana los costales"), "Manzana Los Costales", $testN);
	$rslt.=unitComparer(8, specialUppercase("manzana la otra"), "Manzana La Otra", $testN);
	$rslt.=unitComparer(9, specialUppercase("manzana de las cajas"), "Manzana de las Cajas", $testN);
	$rslt.=unitComparer(10, specialUppercase("manzana de los costales"), "Manzana de los Costales", $testN);
	$rslt.=unitComparer(11, specialUppercase("manzana de la otra"), "Manzana de la Otra", $testN);
	$rslt.=unitComparer(12, specialUppercase("carlos iv xii iii ix"), "Carlos IV XII III IX", $testN);
	$rslt.=unitComparer(13, specialUppercase("ZIII MIII AIII XII VI BI"), "Ziii MIII Aiii XII VI Bi", $testN);
	$rslt.=unitComparer(14, specialUppercase("hELLO wORLD"), "Hello World", $testN);//mm
	
	$testN="newArrWithElmAt(n, indx, str)";
	$rslt.=unitComparer(1, ("[".implode(",", newArrWithElmAt(5, 0, "z"))."]"), "[z,,,,]", $testN);
	$rslt.=unitComparer(2, ("[".implode(",", newArrWithElmAt(5, 1, "z"))."]"), "[,z,,,]", $testN);
	$rslt.=unitComparer(3, ("[".implode(",", newArrWithElmAt(5, 2, "z"))."]"), "[,,z,,]", $testN);
	$rslt.=unitComparer(4, ("[".implode(",", newArrWithElmAt(5, 3, "z"))."]"), "[,,,z,]", $testN);
	$rslt.=unitComparer(5, ("[".implode(",", newArrWithElmAt(5, 4, "z"))."]"), "[,,,,z]", $testN);
	$rslt.=unitComparer(6, ("[".implode(",", newArrWithElmAt(5, -66, "q"))."]"), "[q,,,,]", $testN);
	$rslt.=unitComparer(7, ("[".implode(",", newArrWithElmAt(5, 66, "q"))."]"), "[,,,,q]", $testN);
	
	$testN="arrCheckedOption(...)";
	$rslt.=unitComparer(1, ("[".implode("|", arrCheckedOption(2, 0))."]"), "[ checked|]", $testN);
	$rslt.=unitComparer(2, ("[".implode("|", arrCheckedOption(2, 1))."]"), "[| checked]", $testN);
	
	$testN="arrSelectedOption(...)";
	$rslt.=unitComparer(1, ("[".implode("|", arrSelectedOption(2, 0))."]"), "[ selected='selected'|]", $testN);
	$rslt.=unitComparer(2, ("[".implode("|", arrSelectedOption(2, 1))."]"), "[| selected='selected']", $testN);
	
	$testN="checkedIf(bol) + selectedIf(bol)";
	$rslt.=unitComparer(1, ("[".implode(",", array(checkedIf(TRUE), checkedIf(FALSE), selectedIf(TRUE), selectedIf(FALSE)))."]"), "[ checked,, selected='selected',]", $testN);
	
	$testN="buildStrFromArgs(args, leftSide, rightSide, beforeIfImploded, afterIfImploded, implodWith)";
	$rslt.=unitComparer(1, buildStrFromArgs(array("a"), "(", ")", "[", "]", "|"), "[(a)]", $testN);
	$rslt.=unitComparer(2, buildStrFromArgs(array("a", "b"), "(", ")", "[", "]", "|"), "[(a)|(b)]", $testN);
	$rslt.=unitComparer(3, buildStrFromArgs(array(), "(", ")", "[", "]", "|"), "", $testN);
	$rslt.=unitComparer(4, buildStrFromArgs(array(""), "(", ")", "[", "]", "|"), "", $testN);
	$rslt.=unitComparer(5, buildStrFromArgs(array("x","","y"), "(", ")", "[", "]", "|"), "[(x)|(y)]", $testN);
	
	$testN="eQ(val) / escapeQuotes(val)";
	$rslt.=unitComparer(1, eQ('a"a'), 'a&#34;a', $testN);
	$rslt.=unitComparer(2, eQ('a\"a'), 'a\&#34;a', $testN);
	$rslt.=unitComparer(3, eQ("a'a"), "a&#39;a", $testN);
	$rslt.=unitComparer(4, eQ("a\'a"), "a\&#39;a", $testN);
	
	$prehtm.=($rslt==="" ? "<p>Todas las pruebas fueron exitosas.</p>" : $rslt);
	
	//~ vars_included:
	$htm=$prehtm;
	$tit="Title";
	$cssList=buildCssImports("global");
	$jsList=buildJsImports("jquery-3.3.1.min");
	$metaInfo=array(("Long desc."), ("Short desc."), array("keyword1", "keyword2", "keyword3"));
	//~ ------------------
?>
<!doctype html>
<html lang="es-MX">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo ($tit." - ".COMPANY);?></title>
		<meta name="title" content="<?php echo escapeQuotes($tit." - ".COMPANY);?>">
<?php
	if($metaInfo[0]==="" || $metaInfo[1]==="" || count($metaInfo[2])===0){
		echo "		<meta name=\"robots\" content=\"noindex\">\n";
	}else{
		$ogImage=MYPATH."/css/images/og_image_thumb.jpg";
		
		echo "		<meta name=\"description\" content=\"".escapeQuotes($metaInfo[0])."\">\n";
		echo "		<meta name=\"keywords\" content=\"".escapeQuotes(implode(", ", $metaInfo[2]))."\">\n";
		
		//og meta tags (Open Graph protocol)
		echo "		<meta property=\"og:url\" content=\"".escapeQuotes(getActualUrl("https"))."\">\n";
		echo "		<meta property=\"og:title\" content=\"".escapeQuotes($tit)."\">\n";
		echo "		<meta property=\"og:description\" content=\"".escapeQuotes($metaInfo[1])."\">\n";
		echo "		<meta property=\"og:type\" content=\"website\">\n";
		echo "		<meta property=\"og:image\" content=\"".escapeQuotes($ogImage)."\">\n";
		echo "		<meta property=\"og:image:width\" content=\"1200\">\n";
		echo "		<meta property=\"og:image:height\" content=\"630\">\n";
		echo "		<meta property=\"og:locale\" content=\"es_MX\">\n";
	}
?>
		<meta name="theme-color" content="<?php echo escapeQuotes("#".THEMECOLOR);?>">
<?php echo ($cssList."".$jsList);?>
		
		<script>
			$(function(){
				//...
			});
		</script>
	</head>
	<body>
		<?php echo $htm."\n";?>
	</body>
</html>
