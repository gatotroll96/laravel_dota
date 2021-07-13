<?php
	/**
	 * 
	 */
	namespace App\Helper;

	class Helper
	{
		
		// set format cho time
        public static function dateFormat($format, $value){
        	if(!empty($value)){
        		$result = date($format, strtotime($value));
        	}
        	return $result;
        }


        // cắt chuỗi sao cho chữ cuối cùng vẫn đủ
        public static function createDescription($str , $condition, $pos){
             $lengthStr     = strlen($str);
            if($lengthStr > $condition){
                $posStr     = strpos($str, " ", $pos);
                $result = substr($str, 0 , $posStr).'...';            
            }else{
                $result = $str;
            }            
            return $result;
        }

        
        /*chuyển str thành k dấu */
        public static function changeName($value){

        	// xóa khoảng trắng
            $value = trim($value);
        	$value = preg_replace('#(\s)+#', ' ', $value);

        	// thay thế các khoảng trắng bằng -
        	$value = trim($value);
            $value = str_replace(' ', '-', $value);
            $value = preg_replace('#(-)+#', '-', $value);

            //chuyển thành chữ thường và xóa các ký tự đặc biệt
            $value      = strtolower($value);
            
            $characterA = '#(a|à|ả|ã|á|ạ|ă|ằ|ẳ|ẵ|ắ|ặ|â|ầ|ẩ|ẫ|ấ|ậ)#imsU';
            $replaceA   = 'a';
            $value = preg_replace($characterA, $replaceA, $value);
            
            $characterD = '#(đ|Đ)#imsU';
            $replaceD   = 'd';
            $value = preg_replace($characterD, $replaceD, $value);
            
            $characterE = '#(è|ẻ|ẽ|é|ẹ|ê|ề|ể|ễ|ế|ệ)#imsU';
            $replaceE   = 'e';
            $value = preg_replace($characterE, $replaceE, $value);
            
            $characterI = '#(ì|ỉ|ĩ|í|ị)#imsU';
            $replaceI   = 'i';
            $value = preg_replace($characterI, $replaceI, $value);
            
            $charaterO = '#(ò|ỏ|õ|ó|ọ|ô|ồ|ổ|ỗ|ố|ộ|ơ|ờ|ở|ỡ|ớ|ợ)#imsU';
            $replaceCharaterO = 'o';
            $value = preg_replace($charaterO,$replaceCharaterO,$value);
            
            $charaterU = '#(ù|ủ|ũ|ú|ụ|ư|ừ|ử|ữ|ứ|ự)#imsU';
            $replaceCharaterU = 'u';
            $value = preg_replace($charaterU,$replaceCharaterU,$value);
            
            $charaterY = '#(ỳ|ỷ|ỹ|ý)#imsU';
            $replaceCharaterY = 'y';
            $value = preg_replace($charaterY,$replaceCharaterY,$value);
            
            $charaterSpecial = '#(,|$)#imsU';
            $replaceSpecial = '';
            $value = preg_replace($charaterSpecial,$replaceSpecial,$value);
            
            
            return $value;
        }   
       	/*hết hàm helper chuyển str thành k dấu */







	}
?>