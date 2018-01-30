<?php

namespace LEANGA;


class Handler_HTTP
{
	protected $post;
	protected $get;
	protected $put;
	protected $delete;
	protected $headers;
	protected $method;
	
	
	
    public function __construct()
    {
        $this->parseRequest();
    }
 
    
	private function parseRequest(){
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->headers = apache_request_headers();
		switch($this->method){
			case 'DELETE':
				//parse_str(file_get_contents('php://input'), $this->delete);
				$this->parseCustom($this->delete);
				break;
			case 'GET':
				$this->get = $_GET;
				break;
			case 'PUT':
				$this->parseCustom($this->put);
				break;
			case 'POST';
				$this->post = $_POST;
				break;
		}
	}
	
	private function parseCustom(&$target){
		$putdata = fopen("php://input", "r");
		$raw_data = '';
		while ($chunk = fread($putdata, 1024))
			$raw_data .= $chunk;
		fclose($putdata);
		$boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));
		
		if(empty($boundary)){
			parse_str($raw_data,$data);
			$target = $data;
			return;
		}
		
		$parts = array_slice(explode($boundary, $raw_data), 1);
		$data = array();
		
		foreach ($parts as $part) {
			if ($part == "--\r\n") break;
			
			$part = ltrim($part, "\r\n");
			list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);
			
			$raw_headers = explode("\r\n", $raw_headers);
			$headers = array();
			foreach ($raw_headers as $header) {
				list($name, $value) = explode(':', $header);
				$headers[strtolower($name)] = ltrim($value, ' ');
			}
			
			if (isset($headers['content-disposition'])) {
				$filename = null;
				$tmp_name = null;
				preg_match(
					'/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/',
					$headers['content-disposition'],
					$matches
				);
				list(, $type, $name) = $matches;
				if( isset($matches[4]) )
				{
					if( isset( $_FILES[ $matches[ 2 ] ] ) )
					{
						continue;
					}
					$filename = $matches[4];
					$filename_parts = pathinfo( $filename );
					$tmp_name = tempnam( ini_get('upload_tmp_dir'), $filename_parts['filename']);
					$_FILES[ $matches[ 2 ] ] = array(
						'error'=>0,
						'name'=>$filename,
						'tmp_name'=>$tmp_name,
						'size'=>strlen( $body ),
						'type'=>$value
					);
					file_put_contents($tmp_name, $body);
				}
				else
				{
					$data[$name] = substr($body, 0, strlen($body) - 2);
				}
			}
		}
		$target = $data;
		
	}
	
	public function getMethod(){
		return $this->method;
	}
	
	public function getHeaders(){
		return $this->headers;
	}
	
	public function getDelete(){
		return $this->delete;
	}
	
	public function getGet(){
		return $this->get;
	}
	
	public function getPost(){
		return $this->post;
	}
	
	public function getPut(){
		return $this->put;
	}
	
	
}
?>