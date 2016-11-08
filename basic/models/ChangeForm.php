<?php
	namespace app\models;
	use yii\base\Model;
	
	class ChangeForm extends Model{
		public $codeName;
		public $calculationType;
		public $dataLenght;
		public $DelimiterSelect;
		public $inputData;
		public $inputType;
		public $keyOperation;
		public $keySelectedLis;
		public $lenghtOfData;
		public $metaData;
		public $readColumnsHeaders;
		public $valueSelectedLis;
		public $test;
		
	public function rules()	{
		return [
			[['codeName','calculationType','dataLenght','DelimiterSelect',
			'inputData','inputType','keyOperation','keySelectedLis',
			'lenghtOfData','metaData','readColumnsHeaders','valueSelectedLis'], 'required'],
		];
	}	
}