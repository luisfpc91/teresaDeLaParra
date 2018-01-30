<?php

    namespace LEANGA;
    
    class Handler_FileUpload
	{
        
        public function __construct()
		{
            
		}
        
        
        public function deleteFile($path){
            unlink(__DIR__."/../files/".$path);
        }
        
        
        public function saveFile($key){
            if(array_key_exists($key,$_FILES)){
                
                $file = $_FILES[$key];
                
                try {
                   if (!isset($file['error']) || is_array($file['error'])){
                       return false;
                   }
                   switch($file['error']){
                       case UPLOAD_ERR_OK:
                           break;
                       default:
                           return false;
                   }
                   
                   
                   $name=time()."_".$file['name'];
                   if(!move_uploaded_file($file['tmp_name'], __DIR__."/../files/".$name)){
                       return false;
                   }
                   
                   return $name;       
               }catch (RuntimeException $e) {
                   return false;
               }
               
            }
        }
        
    }

?>