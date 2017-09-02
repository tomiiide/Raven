<?php

/**
 * @author: tomiiide
 * Software Developer
 * @email: ayotomiiide@gmail.com
 * @Date: 8/24/2017
 * @Time: 8:34 PM
 */
class Raven
{
    private $conn;
    public $url;
    public $request_type;
    public $post_data;


        public function __construct(){
           $this->conn = curl_init();
            $fp = fopen(dirname(__FILE__).'/errorlog.txt', 'w');
           curl_setopt_array($this->conn,array(
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_AUTOREFERER => true,
               CURLOPT_VERBOSE => true,
               CURLOPT_STDERR => $fp
           ));
           $this->type();
        }

        public function type($type = 'get'){
            switch($type) {
                case 'get':
                    break;
                case 'post':
                    $this->request_type = 'post';
                    curl_setopt($this->conn,CURLOPT_POST,1);
                    break;
            }
            return $this;
        }

        public function url($url){
            $this->url = $url;
            curl_setopt($this->conn,CURLOPT_URL,$url);
            return $this;
        }

        public function data(array $data){
            if(!$this->url) {
                throw new Exception('Please set url before adding data');
                return false;
            }

            switch ($this->request_type){
                case 'get':
                    $this->url .= '?';
                    foreach ($data as $key => $value){
                        $this->url .= $key.'='.$value.'&';
                    }
                    break;
                case 'post':
                    curl_setopt($this->conn,CURLOPT_POSTFIELDS,json_encode($data));
                    break;
            }
            return $this;
        }

        public function header(array $data){
            curl_setopt($this->conn,CURLOPT_HTTPHEADER,$data);
            return $this;
        }

        public function fly(){
            if($this->url)
               $data =  curl_exec($this->conn);
            if(!$data)
                $data = curl_error($this->conn);

//            var_dump(curl_getinfo($this->conn));
            return $data;
        }

        public function close(){
            curl_close($this->conn);
        }
}