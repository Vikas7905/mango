<?php
class CurlHome
{
        public $response_code;
        public function createCurl($url, $data,  $result, $curlTimeout = 4,$connTimeout = 0)
        {
      //echo $url;
                $ch = curl_init();
                if ($data != null) {
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
                } else {
                        $options = array(
                                CURLOPT_URL => $url,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_HEADER => false,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_AUTOREFERER => true,
                                CURLOPT_CONNECTTIMEOUT => 5,
                                CURLOPT_TIMEOUT => 5,
                                CURLOPT_MAXREDIRS => 10,
                        );
                }

                curl_setopt_array($ch, $options);
                $response = curl_exec($ch);
              // print_r($response);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                 // echo "<pre>" . htmlspecialchars($response) . "</pre>";
                if ($httpCode == 200 || $httpCode == 201) {
                        //echo "<pre>" . htmlspecialchars($response) . "</pre>";
                        $this->response_code = $httpCode;
                        return $response;

                } else {
                        return "Return code is {$httpCode} \n"
                                . curl_error($ch);
                }


        }

//         public function createCurlTest($url, $data,  $result, $curlTimeout = 4,$connTimeout = 0)
//         {
//       //echo $url;
//                 $ch = curl_init();
//                 if ($data != null) {
//                         $options = array(
//                                 CURLOPT_URL => $url,
//                                 CURLOPT_POSTFIELDS => $data,
//                                 CURLOPT_RETURNTRANSFER => true,
//                                 CURLOPT_HEADER => false,
//                                 CURLOPT_FOLLOWLOCATION => true,
//                                 CURLOPT_ENCODING => "",
//                                 CURLOPT_AUTOREFERER => true,
//                                 CURLOPT_CONNECTTIMEOUT => 5,
//                                 CURLOPT_TIMEOUT => 5,
//                                 CURLOPT_MAXREDIRS => 10,
//                         );
//                 } else {
//                         $options = array(
//                                 CURLOPT_URL => $url,
//                                 CURLOPT_RETURNTRANSFER => true,
//                                 CURLOPT_HEADER => false,
//                                 CURLOPT_FOLLOWLOCATION => true,
//                                 CURLOPT_ENCODING => "",
//                                 CURLOPT_AUTOREFERER => true,
//                                 CURLOPT_CONNECTTIMEOUT => 5,
//                                 CURLOPT_TIMEOUT => 5,
//                                 CURLOPT_MAXREDIRS => 10,
//                         );
//                 }

//                 curl_setopt_array($ch, $options);
//                 $response = curl_exec($ch);
//                print_r($response);
//                 $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//                 curl_close($ch);
//                  // echo "<pre>" . htmlspecialchars($response) . "</pre>";
//                 if ($httpCode == 200 || $httpCode == 201) {
//                         //echo "<pre>" . htmlspecialchars($response) . "</pre>";
//                         $this->response_code = $httpCode;
//                         return $response;

//                 } else {
//                         return "Return code is {$httpCode} \n"
//                                 . curl_error($ch);
//                 }


//         }

}
?>