<?php
class Curl
{
        public $response_code;
        public function createCurl($url, $data, $connTimeout = 0, $curlTimeout = 4, $result)
        {

                $ch = curl_init();

                $options = array(
                        CURLOPT_URL => $url,
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HEADER => false,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_AUTOREFERER => true,
                        CURLOPT_CONNECTTIMEOUT => 5,
                        CURLOPT_TIMEOUT => 5,
                        CURLOPT_MAXREDIRS => 10,
                );

                curl_setopt_array($ch, $options);
                $response = curl_exec($ch);
                
                 $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
              
                curl_close($ch);
                //echo "<pre>" . htmlspecialchars($response) . "</pre>";
                if ($httpCode === 200 || $httpCode === 201) {
            
                $this->response_code=$httpCode;
                //print_r($response);
                        return $response;

                } else {
                        return "Return old code is {$httpCode} \n"
                                . curl_error($ch);
                }


        }


        

}
?>