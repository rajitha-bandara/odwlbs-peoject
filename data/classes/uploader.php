<?php

class Uploader
{
	private $destinationPath;
	private $errorMessage;
	private $extensions;
	private $maxSize;
	private $uploadName;
	private $seqnence;
	private $renamedState = 0;

	public function setDir($path)
	{
		$this->destinationPath = $path;
	}

	public function setMaxSize($sizeMB)
	{
		$this->maxSize = $sizeMB * (1024*1024);
	}

	public function setExtensions($options)
	{
		$this->extensions = $options;
	}

	public function getExtension($string)
	{
		$ext = "";
		try
		{
			$parts = explode(".",$string);
			$ext = strtolower($parts[count($parts)-1]);
		}
		catch(Exception $c)
		{
			$ext = "";
		}
		return $ext;
	}

	public function setMessage($message)
	{
		$this->errorMessage = $message;
	}

	public function getMessage()
	{
		return $this->errorMessage;
	}

	public function getUploadName()
	{
		return $this->uploadName;
	}

	public function setSequence($seq)
	{
		$this->imageSeq = $seq;
	}

	public function getRandom()
	{
		return strtotime(date('Y-m-d H:iConfused')).rand(1111,9999).rand(11,99).rand(111,999);
	}

	public function getRenamedState()
	{
		return $this->renamedState;
	}

	public function renameFile($state,$newName)
	{
		$this->renamedState = $state;
		$this->uploadName = $newName;
	}

	public function deleteUploaded()
	{
		unlink($this->destinationPath.$this->uploadName);
	}

	public function uploadFile($fileBrowse)
	{
		$result = false;
		$size = $_FILES[$fileBrowse]["size"];
		$name = $_FILES[$fileBrowse]["name"];
		$ext = $this->getExtension($name);
		if(!is_dir($this->destinationPath))
		{
			$this->setMessage("Destination folder is not a directory ");
		}
		else if(!is_writable($this->destinationPath))
		{
			$this->setMessage("Destination is not writable !");
		}
		else if(empty($name))
		{
			$this->setMessage("File not selected ");
		}
		else if($size>$this->maxSize)
		{
			$this->setMessage("Too large file !");
		}
		else if(in_array($ext,$this->extensions))
		{
			switch ($this->getRenamedState())
			{
				case 0: //Keep original file name
					$this->uploadName= $name;
					break;
				case 1: //Rename file with randomly-generated name
					$this->uploadName = $this->imageSeq."-".substr(md5(rand(1111,9999)),0,8).$this->getRandom().rand(1111,1000).rand(99,9999).".".$ext;
					break;
				case 2: //Rename file with given name when calling renameFile() function
					$this->uploadName.= ".".$ext;
					break;
				default:
					$this->uploadName= $name;
			}


			if(move_uploaded_file($_FILES[$fileBrowse]["tmp_name"],$this->destinationPath.$this->uploadName))
			{
				$result = true;
			}
			else
			{
				$this->setMessage("Upload failed");
			}
		}
		else
		{
			$this->setMessage("Invalid file format!");
		}
		return $result;
	}

}

?>
