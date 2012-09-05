<?php

class Browser
{
	private  $u_agent;
	private $bname;
	private $platform;
	private $version;

	public function __construct()
	{
		$this->u_agent = $_SERVER['HTTP_USER_AGENT'];
		$this->bname = 'Unknown';
		$this->platform = 'Unknown';
		$this->version= "";
	}
	public function getBrowser()
	{


		//First get the platform?
		if (preg_match('/linux/i', $this->u_agent)) {
			$this->platform = 'linux';
		}
		elseif (preg_match('/macintosh|mac os x/i', $this->u_agent)) {
			$this->platform = 'mac';
		}
		elseif (preg_match('/windows|win32/i', $this->u_agent)) {
			$this->platform = 'windows';
		}
		 
		// Next get the name of the useragent yes seperately and for good reason
		if(preg_match('/MSIE/i',$this->u_agent) && !preg_match('/Opera/i',$this->u_agent))
		{
			$this->bname = 'Internet Explorer';
			$this->ub = "MSIE";
		}
		elseif(preg_match('/Firefox/i',$this->u_agent))
		{
			$this->bname = 'Mozilla Firefox';
			$this->ub = "Firefox";
		}
		elseif(preg_match('/Chrome/i',$this->u_agent))
		{
			$this->bname = 'Google Chrome';
			$this->ub = "Chrome";
		}
		elseif(preg_match('/Safari/i',$this->u_agent))
		{
			$this->bname = 'Apple Safari';
			$this->ub = "Safari";
		}
		elseif(preg_match('/Opera/i',$this->u_agent))
		{
			$this->bname = 'Opera';
			$this->ub = "Opera";
		}
		elseif(preg_match('/Netscape/i',$this->u_agent))
		{
			$this->bname = 'Netscape';
			$this->ub = "Netscape";
		}
		 
		// finally get the correct version number
		$known = array('Version', $this->ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) .
		')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if (!preg_match_all($pattern, $this->u_agent, $matches)) {
			// we have no matching number just continue
		}
		 
		// see how many we have
		$i = count($matches['browser']);
		if ($i != 1) {
			//we will have two since we are not using 'other' argument yet
			//see if version is before or after the name
			if (strripos($this->u_agent,"Version") < strripos($this->u_agent,$this->ub)){
				$this->version= $matches['version'][0];
			}
			else {
				$this->version= $matches['version'][1];
			}
		}
		else {
			$this->version= $matches['version'][0];
		}
		 
		// check if we have a number
		if ($version==null || $version=="") {
			$version="?";
		}
		 
		return array(
				'userAgent' => $this->u_agent,
				'name'      => $this->bname,
				'version'   => $this->version,
				'platform'  => $this->platform,
				'pattern'    => $this->pattern
		);
	}

}

?>