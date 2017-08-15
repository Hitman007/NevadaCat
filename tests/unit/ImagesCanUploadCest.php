<?php

class ImagesCanUploadCest(UnitTester $I){
	
	public TEST_doProcessAttachedImage(){
		
		$AddCatFormFieldProcessor = new NevadaCat\AddCatFormFieldProcessor;
		$AddCatFormFieldProcessor->doProcessAttachedImage();
	}
	
}