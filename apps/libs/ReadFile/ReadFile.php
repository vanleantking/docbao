<?php
namespace ReadFile;
class ReadFile
{
    protected $file;
    public $buffer = array();
    public $filesize;
    public $str = '';
 
    public function __construct($filename, $mode = "r")
    {
        if (!file_exists($filename)) { 
            throw new Exception("File not found");
        } 
        $this->file = fopen($filename, $mode);
        
        if (false === $this->file) {
            throw new Exception("Fail on read file");
        }
        $this->filesize = filesize($filename);
        $this->buffer = array();
    }

    public function read() {
        $buffer_read = 8192;
        $size = $this->filesize;
        while ($size > 0) {
            $rlen = $buffer_read > $this->filesize ? $this->filesize : $buffer_read;
            $line = fread($this->file, $rlen);
            $this->getString($line);
            $size -= $rlen;
        }
        fclose($this->file);
        return count($this->buffer);
    }

    protected function getString($line) {
        $line = str_replace(['[', ']', '"'], '', $line);
        $this->str .= $line;               
    }

    public function toArray() {
        if($this->str != "") {
            $pieces = explode(', ', trim($this->str));
            foreach ($pieces as $piece) {
                $this->buffer[] = trim($piece);
            }
        }
        return $this->buffer;
    }

    protected function utf8ize( $mixed, $mode = 'UTF-8' ) {
        if (is_array($mixed)) {
            foreach ($mixed as $key => $value) {
                $mixed[$key] = $this->utf8ize($value);
            }
        } elseif (is_string($mixed)) {
            return mb_convert_encoding($mixed, $mode, $mode);
        }
        return $mixed;
    }
}
?>