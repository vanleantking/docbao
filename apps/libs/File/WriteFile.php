<?php
namespace File;
class WriteFile {
	protected $file;
	protected $path;
	protected $len;
	public function __construct($path) {
		$this->path = $path;
	}

	public function writeFile($content) {
		$this->file = fopen($this->path, "w");
	 	$pieces = str_split($content, 1024 * 4);
	    foreach ($pieces as $piece) {
	        fwrite($this->file, $piece, strlen($piece));
	    }

	    fclose($this->file);
	}

}
?>