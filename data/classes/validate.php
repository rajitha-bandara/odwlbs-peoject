<?php
class Validate
{
	 /* Checks if string is a URL
	 @param string $url
	 @return bool */
	public function isURL($url = "")
	 {
		if($url==NULL) return false;
	
		$protocol = '(http://|https://)';
		$allowed = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)';
	
		$regex = "^". $protocol . // must include the protocol
		'(' . $allowed . '{1,63}\.)+'. // 1 or several sub domains with a max of 63 chars
		'[a-z]' . '{2,6}'; // followed by a TLD
		if(eregi($regex, $url)==true) 
			return true;
		else
			 return false;
	}
	
	/*
	 * If an email is Valid it returns the parameter
	 * other wise it will return false
	 * $email is the email address
	 */
	public function isEmail($email) 
	{
	
		//email is not case sensitive make it lower case
		$email =  strtolower($email);
	
		//check if email seems valid
		if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) 
		{
			return true;
		}
	
		return false;
	
	}
	
	/*
	 * Checks if there are 7 or 10 numbers, if so returns cleaned parameter(no formating just numbers)
	 * other wise it will return false
	 * $phone is the phone number
	 * $ext if set to true return an array with extension separated
	 */
	public function isPhone($phone, $ext = false) 
	{
	
		//remove everything but numbers
		$numbers = preg_replace("%[^0-9]%", "", $phone );
	
		//how many numbers are supplied
		$length = strlen($numbers);
	
		if ( $length == 10 || $length == 7 ) { //Everything is find and dandy
	
			$cleanPhone = $numbers;
	
			if ( $ext ) 
			{
				$clean['phone'] = $cleanPhone;
				return $clean;
			} else {
				return $cleanPhone;
			}
	
		} 
		elseif ( $length > 10 ) 
		{ //must be extension
	
			//checks if first number is 1 (this may be a bug for you)
			if ( substr($numbers,0,1 ) == 1 ) 
			{
				$clean['phone'] = substr($numbers,0,11);
				$clean['extension'] = substr($numbers,11);
			} else 
			{
				$clean['phone'] = substr($numbers,0,10);
				$clean['extension'] = substr($numbers,10);
			}
	
			if (!$ext) 
			{ //return string
	
				if (!empty($clean['extension'])) 
				{
					$clean = implode("x",$clean);
				} 
				else 
				{
					$clean = $clean['phone'];
				}
	
				return $clean;
	
	
			} 
			else 
			{ //return array
	
				return $clean;
			}
		}
	
		return false;
	
	}
	
	/*
	 * Checks for a 5 digit zip code
	 * Clears extra characters
	 * returns clean zip
	 */
	public function isZipCode($zip) 
	{
		//remove everything but numbers
		$numbers = preg_replace("[^0-9]", "", $zip );
	
		//how many numbers are supplied
		$length = strlen($numbers);
	
		if ($length != 5) 
		{
			return false;
		} 
		else 
		{
			return $numbers;
		}
	}
	
	public function isLatitude($lat)
	{
		//check if email seems valid
		if (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}/", $lat))
		{
			return true;
		}
		
		return false;
	}
	
	public function isLongitude($long)
	{
		//check if email seems valid
		if (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}/", $long))
		{
			return true;
		}
	
		return false;
	}
	
}
$gvalObj = new Validate();