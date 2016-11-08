<?php 
namespace app\models;

class CreateCode {
	public function createCode($pattern,$chForm)
	{
		switch ($pattern) {
	    case "maxmin":
	        return CreateCode::createMaxmin($pattern,$chForm);
	        break;
	    case "counting_counters":
	        return CreateCode::createCounting_counters($pattern,$chForm);
	        break;

	    case "numerical_sum":
	        return CreateCode::createNumerical_sum($pattern,$chForm);
	        break;

	    case "averaging":
	        return CreateCode::createAveraging($pattern,$chForm);
	        break;

	    case "filtering":
	        return CreateCode::createFiltering($pattern,$chForm);
	        break;

	    case "top_ten":
	        return CreateCode::createTop_ten($pattern,$chForm);
	        break;

	    case "inverted_index":
	        return CreateCode::createInverted_index($pattern,$chForm);
	        break;

	    case "distinct":
	        return CreateCode::createDistinct($pattern,$chForm);
	        break;

	    default:
	        return "nothing to do!";
		}
	}

	public function createMaxmin($pattern,$chForm)
	{		
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		//Map code generation
		//replace DelimiterSelect
		$mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);

		// create last output of map code
		$keyValue = CreateCode::printKeyValue($chForm->metaData,$chForm->keySelectedLis,$chForm->valueSelectedLis);
		//replace keyvalue
		$mapCode = str_replace('@keyValue', $keyValue, $mapCode);

		// remove
		if($chForm->dataLenght === "datasamelenght"){
			$mapCode = preg_replace("/if([^]]*)continue/", '', $mapCode);	
		}
		else
			$mapCode = str_replace('@lenghtOfData', $chForm->lenghtOfData, $mapCode);

		//reduce code generation
		if ($chForm->calculationType === "Max Calculation"){
			$reduceCode = str_replace('@calculationType', '>', $reduceCode);
		}
		else{
			$reduceCode = str_replace('@calculationType', '<', $reduceCode);
			$reduceCode = str_replace('max', 'min', $reduceCode);
		}
		if($chForm->keyOperation == ''){
			$reduceCode = preg_replace("/beginif([^]]*)endif/", '', $reduceCode);
		}
		else{
			$reduceCode = str_replace('@keyOperation', CreateCode::printArray($chForm->keyOperation) , $reduceCode);
			$reduceCode = str_replace('beginif', 'if' , $reduceCode);
			$reduceCode = str_replace('endif', "\t"  , $reduceCode);
		}
		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}

	public function createCounting_counters($pattern,$chForm)
	{
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		//Map code generation
		//replace DelimiterSelect
		$mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);

		// create last output of map code
		$keyValue = CreateCode::printKeyValue($chForm->metaData,$chForm->keySelectedLis,$chForm->valueSelectedLis);
		//replace keyvalue
		$mapCode = str_replace('@keyValue', $keyValue, $mapCode);

		// remove
		if($chForm->dataLenght === "datasamelenght"){
			$mapCode = preg_replace("/if([^]]*)continue/", '', $mapCode);	
		}
		else
			$mapCode = str_replace('@lenghtOfData', $chForm->lenghtOfData, $mapCode);

		if($chForm->keyOperation == ''){
			$reduceCode = preg_replace("/beginif([^]]*)endif/", '', $reduceCode);
		}

		else{
			$reduceCode = str_replace('@keyOperation', CreateCode::printArray($chForm->keyOperation) , $reduceCode);
			$reduceCode = str_replace('beginif', 'if' , $reduceCode);
			$reduceCode = str_replace('endif', "\t"  , $reduceCode);
		}

		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}

	public function createNumerical_sum($pattern,$chForm)
	{
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		// //Map code generation
		// //replace DelimiterSelect
		// $mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);

		// // create last output of map code
		// $keyValue = CreateCode::printKeyValue($chForm->metaData,$chForm->keySelectedLis,$chForm->valueSelectedLis);
		// //replace keyvalue
		// $mapCode = str_replace('@keyValue', $keyValue, $mapCode);

		// // remove
		// if($chForm->dataLenght === "datasamelenght"){
		// 	$mapCode = preg_replace("/if([^]]*)continue/", '', $mapCode);	
		// }
		// else
		// 	$mapCode = str_replace('@lenghtOfData', $chForm->lenghtOfData, $mapCode);

		// if($chForm->keyOperation == ''){
		// 	$reduceCode = preg_replace("/beginif([^]]*)endif/", '', $reduceCode);
		// }

		// else{
		// 	$reduceCode = str_replace('@keyOperation', CreateCode::printArray($chForm->keyOperation) , $reduceCode);
		// 	$reduceCode = str_replace('beginif', 'if' , $reduceCode);
		// 	$reduceCode = str_replace('endif', "\t"  , $reduceCode);
		// }

		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}

	public function createAveraging($pattern,$chForm)
	{
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		//Map code generation
		//replace DelimiterSelect
		$mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);

		// create last output of map code
		$keyValue = CreateCode::printKeyValue($chForm->metaData,$chForm->keySelectedLis,$chForm->valueSelectedLis);
		//replace keyvalue
		$mapCode = str_replace('@keyValue', $keyValue, $mapCode);

		// remove
		if($chForm->dataLenght === "datasamelenght"){
			$mapCode = preg_replace("/if([^]]*)continue/", '', $mapCode);	
		}
		else
			$mapCode = str_replace('@lenghtOfData', $chForm->lenghtOfData, $mapCode);

		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}

	public function createFiltering($pattern,$chForm)
	{
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		$mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);
		$conditions = CreateCode::printConditions($chForm->keyOperation,$chForm->keySelectedLis,$chForm->valueSelectedLis);
		//replace keyvalue
		$mapCode = str_replace('@conditions', $conditions, $mapCode);

		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}

	public function createTop_ten($pattern,$chForm)
	{
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		$mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);

		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}

	public function createInverted_index($pattern,$chForm)
	{
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		$mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);

		$key = $chForm->keySelectedLis;
		$metaData = explode(',',$chForm->metaData);
		$index=0;
		for($x = 0; $x < count($metaData); $x++) {
		    if($metaData[$x]===$key){
		    	$index=$x;
		    }
		}
		$mapCode = str_replace('@index', $index, $mapCode);


		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}

	public function createDistinct($pattern,$chForm)
	{
		$MapreduceTemplate = MapreduceTemplate::find()->where(['pattern_id' => $pattern])->one();
		$mapCode = $MapreduceTemplate->map_code;
		$reduceCode = $MapreduceTemplate->reduce_code;

		$mapCode = str_replace('@DelimiterSelect', $chForm->DelimiterSelect, $mapCode);
		$key = $chForm->keySelectedLis;
		$metaData = explode(',',$chForm->metaData);
		$index=0;
		for($x = 0; $x < count($metaData); $x++) {
		    if($metaData[$x]===$key){
		    	$index=$x;
		    }
		}
		$mapCode = str_replace('@index', $index, $mapCode);

		return [
			'map_code'		=>	$mapCode,
			'reduce_code'	=>	$reduceCode
		];
	}
	

	private function printKeyValue($metaData,$keySelectedLis,$valueSelectedLis)
	{
		$metaData = explode(',',$metaData);
		$keySelectedLis = explode(',',$keySelectedLis);
		$valueSelectedLis = explode(',',$valueSelectedLis);

		$keyList = array();
		foreach ($keySelectedLis as $value) {
			$keyList[] = array_search($value, $metaData);
		}

		$valueList = array();
		foreach ($valueSelectedLis as $value) {
			$valueList[] = array_search($value, $metaData);
		}

		$keyValue = array_merge($keyList,$valueList);

		$head='';
		$foot='';
		foreach ($keyValue as $value) {
			$head .='%s\t';
			$foot .="words[".$value."], ";
		}
		return "'".substr($head,0,-2)."' % (".substr($foot,0,-2).")";
	}

	private function printArray($list)
	{
		$list = explode(',',$list);
		$arr='';
		foreach ($list as $value) {
			$arr .= "'".trim($value)."', ";
		}
		return "[".substr($arr, 0,-2)."]";
	}

	private function printConditions($keyOperation,$keySelectedLis,$valueSelectedLis)
	{
		$conditions = '';

		$logic = explode(',',$keyOperation);
		$key = explode(',',$keySelectedLis);
		$value = explode(',',$valueSelectedLis);

		for($x = 0; $x < count($logic); $x++) {
		    if($logic[$x]!='none'){
		    	$conditions.='words['.$x.'] '.$value[$x].' ';
		    }
		    if($x+1<count($logic) && $logic[$x+1]!='none'){
		    	$conditions.=' '.$logic[$x+1].' ';
		    }
		}
		return $conditions;
	}
}