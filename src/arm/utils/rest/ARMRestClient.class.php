<?php
/**
 * Class ARMRestClient
 * Wraps HTTP calls using cURL, aimed for accessing and testing RESTful webservice. 
 * By Diogo Souza da Silva <manifesto@manifesto.blog.br>
 * 
 * @author		: Alan Lucian - modificação para aceitar adição de header
 */
class ARMRestClient {

     private $curl ;
     private $url ;
     private $response ="";
     private $headers = array();

     private $method="GET";
     private $params=null;
     private $contentType = null;
     private $file =null;
	 
	 private $send_header_data = array();

     /**
      * Private Constructor, sets default options
      */
     private function __construct() {
         $this->curl = curl_init();
         curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,	true);
         curl_setopt($this->curl, CURLOPT_AUTOREFERER,		true); // This make sure will follow redirects
         curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION,	true); // This too
         curl_setopt($this->curl, CURLOPT_HEADER,			true); // THis verbose option for extracting the headers
     }


	public function addSendHeaderData($param, $value=NULL){
		// var_dump( "ADD>>>" , $param);
		if($param == NULL)
			return $this;
		
		if(is_array($param)){
			foreach($param as $p){
				if(!is_array($p)){
					$this->send_header_data[] = $p;
				}else{
					// var_dump($p);die;
					$this->send_header_data[] = "{$p[0]}: {$p[1]}";
				}
			}			
		}else{
			if ( $value ){
				$this->send_header_data[] = "$param: $value";
			}else{
				$this->send_header_data[] = $param;
			}
		}
		
		return $this;
		
	}
	
	public function getSendHeaderData(){
		return $this->send_header_data;
	}

     /**
      * Execute the call to the webservice
      * @return ARMRestClient
      */ 
     public function execute() {
     	
         if($this->method === "POST") {
             curl_setopt($this->curl,CURLOPT_POST,true);
             curl_setopt($this->curl,CURLOPT_POSTFIELDS,$this->params);
         } else if($this->method == "GET"){
             curl_setopt($this->curl,CURLOPT_HTTPGET,true);
             $this->treatURL();
         } else if($this->method === "PUT") {
             curl_setopt($this->curl,CURLOPT_PUT,true);
             $this->treatURL();
             $this->file = tmpFile();
             fwrite($this->file,$this->params);
             fseek($this->file,0);
             curl_setopt($this->curl,CURLOPT_INFILE,$this->file);
             curl_setopt($this->curl,CURLOPT_INFILESIZE,strlen($this->params));
         } else {
             curl_setopt($this->curl,CURLOPT_CUSTOMREQUEST,$this->method);
         }
         //if($this->contentType != null) {
         // var_dump($this->getSendHeaderData(),';;;');
         curl_setopt($this->curl,CURLOPT_HTTPHEADER, $this->getSendHeaderData() ); //array("Content-Type: ".$this->contentType));
         //}
         curl_setopt($this->curl,CURLOPT_URL,$this->url);
         $r = curl_exec($this->curl);
         $this->treatResponse($r); // Extract the headers and response
         return $this ;
     }

     /**
      * Treats URL
      */
     private function treatURL(){
         if(is_array($this->params) && count($this->params) >= 1) { // Transform parameters in key/value pars in URL
             if(!strpos($this->url,'?'))
                 $this->url .= '?' ;
             foreach($this->params as $k=>$v) {
                 $this->url .= "&".urlencode($k)."=".urlencode($v);
             }
         }
        return $this->url;
     }

     /*
      * Treats the Response for extracting the Headers and Response
      */ 
     private function treatResponse($r) {
        if($r == null or strlen($r) < 1) {
            return;
        }
        $parts  = explode("\n\r",$r); // HTTP packets define that Headers end in a blank line (\n\r) where starts the body
        while(preg_match('@HTTP/1.[0-1] 100 Continue@',$parts[0]) or preg_match("@Moved@",$parts[0])) {
            // Continue header must be bypass
            for($i=1;$i<count($parts);$i++) {
                $parts[$i - 1] = trim($parts[$i]);
            }
            unset($parts[count($parts) - 1]);
        }
        preg_match("@Content-Type: ([a-zA-Z0-9-]+/?[a-zA-Z0-9-]*)@",$parts[0],$reg);// This extract the content type
        $this->headers['content-type'] = $reg[1];
        preg_match("@HTTP/1.[0-1] ([0-9]{3}) ([a-zA-Z ]+)@",$parts[0],$reg); // This extracts the response header Code and Message
        $this->headers['code'] = $reg[1];
        $this->headers['message'] = $reg[2];
        $this->response = "";
        for($i=1;$i<count($parts);$i++) {//This make sure that exploded response get back togheter
            if($i > 1) {
                $this->response .= "\n\r";
            }
            $this->response .= $parts[$i];
        }
     }

     /*
      * @return array
      */
     public function getHeaders() {
        return $this->headers;
     }

     /*
      * @return string
      */ 
     public function getResponse() {
         return $this->response ;
     }

     /*
      * HTTP response code (404,401,200,etc)
      * @return int
      */
     public function getResponseCode() {
         return (int) $this->headers['code'];
     }
     
     /*
      * HTTP response message (Not Found, Continue, etc )
      * @return string
      */
     public function getResponseMessage() {
         return $this->headers['message'];
     }

     /*
      * Content-Type (text/plain, application/xml, etc)
      * @return string
      */
     public function getResponseContentType() {
         return $this->headers['content-type'];
     }

     /**
      * This sets that will not follow redirects
      * @return ARMRestClient
      */
     public function setNoFollow() {
         curl_setopt($this->curl,CURLOPT_AUTOREFERER,false);
         curl_setopt($this->curl,CURLOPT_FOLLOWLOCATION,false);
         return $this;
     }

     /**
      * This closes the connection and release resources
      * @return ARMRestClient
      */
     public function close() {
         curl_close($this->curl);
         $this->curl = null ;
         if($this->file !=null) {
             fclose($this->file);
         }
         return $this ;
     }

     /**
      * Sets the URL to be Called
      * @return ARMRestClient
      */
     public function setUrl($url) {
         $this->url = $url; 
         return $this;
     }

     /**
      * Set the Content-Type of the request to be send
      * Format like "application/xml" or "text/plain" or other
      * @param string $contentType
      * @return ARMRestClient
      */
     public function setContentType($contentType) {
         $this->contentType = $contentType;
         $this->addHeaderData("Content-Type", $this->contentType);
         return $this;
     }

     /**
      * Set the Credentials for BASIC Authentication
      * @param string $user
      * @param string $pass
      * @return ARMRestClient
      */
     public function setCredentials($user,$pass) {
         if($user != null) {
             curl_setopt($this->curl,CURLOPT_HTTPAUTH,	CURLAUTH_BASIC);
             curl_setopt($this->curl,CURLOPT_USERPWD,	"{$user}:{$pass}");
         }
         return $this;
     }

     /**
      * Set the Request HTTP Method
      * For now, only accepts GET and POST
      * @param string $method
      * @return ARMRestClient
      */
     public function setMethod($method) {
         $this->method=$method;
         return $this;
     }

     /**
      * Set Parameters to be send on the request
      * It can be both a key/value par array (as in array("key"=>"value"))
      * or a string containing the body of the request, like a XML, JSON or other
      * Proper content-type should be set for the body if not a array
      * @param mixed $params
      * @return ARMRestClient
      */
     public function setParameters($params) {
         $this->params=$params;
         return $this;
     }

     /**
      * Creates the RESTClient
      * @param string $url=null [optional]
      * @return ARMRestClient
      */
     public static function createClient($url=null) {
         $client = new ARMRestClient ;
         if($url != null) {
             $client->setUrl($url);
         }
         return $client;
     }

     /**
      * Convenience method wrapping a commom POST call
      * @param string $url
      * @param mixed params
      * @param string $user=null [optional]
      * @param string $password=null [optional]
      * @param string $contentType="multpary/form-data" [optional] commom post (multipart/form-data) as default
      * @return ARMRestClient
      */
     public static function post($url,$params=null,$user=null,$pwd=null,$contentType="multipart/form-data", $headData=null) {
         return self::call("POST",$url,$params,$user,$pwd,$contentType, $headData);
     }

     /**
      * Convenience method wrapping a commom PUT call
      * @param string $url
      * @param string $body 
      * @param string $user=null [optional]
      * @param string $password=null [optional]
      * @param string $contentType=null [optional] 
      * @return ARMRestClient
      */
     public static function put($url,$body,$user=null,$pwd=null,$contentType=null, $headData=null) {
         return self::call("PUT",$url,$body,$user,$pwd,$contentType, $headData);
     }

     /**
      * Convenience method wrapping a commom GET call
      * @param string $url
      * @param array params
      * @param string $user=null [optional]
      * @param string $password=null [optional]
      * @return ARMRestClient
      */
     public static function get($url, array $params=null, $user=null, $pwd=null, $contentType=null, $headData=null) {
         return self::call("GET", $url, $params, $user, $pwd, $contentType, $headData);
     }

     /**
      * Convenience method wrapping a commom delete call
      * @param string $url
      * @param array params
      * @param string $user=null [optional]
      * @param string $password=null [optional]
      * @return ARMRestClient
      */
     public static function delete($url,array $params=null,$user=null,$pwd=null , $contentType=null, $headData=null) {
     	
         return self::call("DELETE",$url,$params,$user,$pwd, $contentType, $headData);
     }

     /**
      * Convenience method wrapping a commom custom call
      * @param string $method
      * @param string $url
      * @param string $body 
      * @param string $user=null [optional]
      * @param string $password=null [optional]
      * @param string $contentType=null [optional] 
      * @return ARMRestClient
      */
     public static function call($method, $url, $body, $user=null, $pwd=null, $contentType=null, $headData=null) {
         return self::createClient($url)
             ->setParameters($body)
             ->setMethod($method)
             ->setCredentials($user,$pwd)
             ->addSendHeaderData("Content-Type",$contentType) // // ->setContentType($contentType)
			 ->addSendHeaderData($headData)
             ->execute()
             ->close();
     }
}

?> 