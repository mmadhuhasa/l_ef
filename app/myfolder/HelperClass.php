<?php

namespace App\myfolder;

use App\models\WatchHoursModel;
use App\models\FlightPlanDetailsModel;
use App\models\Station_Addresses_model;
use App\models\CallSignMailsModel;
use App\models\AerodromeMailsModel;
use App\models\SupportMailsModel;

class HelperClass {
    public $key;
    public function __construct() {
	$this->key = env('APP_KEY');
    }

    public static function encrypt($plainText) {
	$key = env('APP_KEY');
	$secretKey = self::hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
	$plainPad = self::pkcs5_pad($plainText, $blockSize);
	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
	    $encryptedText = mcrypt_generic($openMode, $plainPad);
	    mcrypt_generic_deinit($openMode);
	}
	return bin2hex($encryptedText);
    }

    public static function decrypt($encryptedText) {
	$key =  env('APP_KEY');
	$secretKey = self::hextobin(md5($key));
	$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	$encryptedText = self::hextobin($encryptedText);
	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
	mcrypt_generic_init($openMode, $secretKey, $initVector);
	$decryptedText = mdecrypt_generic($openMode, $encryptedText);
	$decryptedText = rtrim($decryptedText, "\0");
	mcrypt_generic_deinit($openMode);
	return $decryptedText;
    }

    //*********** Padding Function *********************
    public static function pkcs5_pad($plainText, $blockSize) {
	$pad = $blockSize - (strlen($plainText) % $blockSize);
	return $plainText . str_repeat(chr($pad), $pad);
    }

    //********** Hexadecimal to Binary function for php 4.0 version ********

    public static function hextobin($hexString) {
	$length = strlen($hexString);
	$binString = "";
	$count = 0;
	while ($count < $length) {
	    $subString = substr($hexString, $count, 2);
	    $packedString = pack("H*", $subString);
	    if ($count == 0) {
		$binString = $packedString;
	    } else {
		$binString.=$packedString;
	    }

	    $count+=2;
	}
	return $binString;
    }
    
    public static function convertToHoursMins($time, $total_fth) {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        $hours = $hours + $total_fth;
        return sprintf('%02d:%02d', $hours, $minutes);
    }
    public static function figure_words($number)
    {
    	  if($number==0)
    	  return "Rupees  Zero";	
    	   $no = round($number);
    	   $point = round($number - $no, 2) * 100;
    	   $hundred = null;
    	   $digits_1 = strlen($no);
    	   $i = 0;
    	   $str = array();
    	   $words = array('0' => '', '1' => 'one', '2' => 'two',
    	    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    	    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    	    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    	    '13' => 'thirteen', '14' => 'fourteen',
    	    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    	    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    	    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    	    '60' => 'sixty', '70' => 'seventy',
    	    '80' => 'eighty', '90' => 'ninety');
    	   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    	   while ($i < $digits_1) {
    	     $divider = ($i == 2) ? 10 : 100;
    	     $number = floor($no % $divider);
    	     $no = floor($no / $divider);
    	     $i += ($divider == 10) ? 1 : 2;
    	     if ($number) {
    	        // $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
    	        $plural = (($counter = count($str)) && $number > 1) ? '' : null;
    	        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
    	        $str [] = ($number < 21) ? $words[$number] .
    	            " " . $digits[$counter] . $plural . " " . $hundred
    	            :
    	            $words[floor($number / 10) * 10]
    	            . " " . $words[$number % 10] . " "
    	            . $digits[$counter] . $plural . " " . $hundred;
    	     } else $str[] = null;
    	   }
    	   $str = array_reverse($str);
    	   $result = implode('', $str);
    	   $points = ($point) ?
    	    "." . $words[$point / 10] . " " . 
    	          $words[$point = $point % 10] : '';
           return "Rupees  ".$result;
     }  
}
