<?php
  namespace ErevnaDictionaryPhp\Main;

  use GuzzleHttp\Client;
  use GuzzleHttp\Exception\RequestException;
  use GuzzleHttp\Psr7;

  class Main{
    protected $config;
    public function __construct ($conf)
    {
      $this->config = $conf;
      //  echo "construct invoked";
    }
    public static function main($config){

      $self = new Main($config);
      // get the HTTP method, path and body of the request
      // $method = $_SERVER['REQUEST_METHOD'];
      // $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
      // $input = json_decode(file_get_contents('php://input'),true);
      //
      // // retrieve the table and key from the path
      // $table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
      // $key = array_shift($request)+0;
      //
      // // escape the columns and values from the input object
      // $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));
      // $values = array_map(function ($value) use ($link) {
      //   if ($value===null) return null;
      //   return mysqli_real_escape_string($link,(string)$value);
      // },array_values($input));

      // // die if SQL statement failed
      // if (!$result) {
      //   http_response_code(404);
      //   die(mysqli_error());
      // }

      //input
      $text = $_GET["text"];
      $keyfrom = $_GET["keyfrom"];
      $trxunixtime = $_GET["trxunixtime"];
      $country = $_GET["country"];

      // try {
      //
      //     $client = new Client([
      //   // Base URI is used with relative requests
      //         'base_uri' => 'http://google.com',
      //         // You can set any number of default request options.
      //         'timeout'  => 2.0,
      //     ]);
      //   //   // Send a request to https://foo.com/api/test
      //     $response = $client->request('GET', 'test');
      //   //   // Send a request to https://foo.com/root
      //   //   // $response = $client->request('GET', '/root');
      // }
      // catch(GuzzleHttp\Exception\ClientExceptio $e) {
      //   //echo 'Message: ' .$e->getMessage();
      // }

      //process
      $status = true;
      $opt = new \stdClass();
      $opt->country = $country;
      $opt->keyfrom = $keyfrom;
      $opt->text = $text;
      $source = $self->getMeaningOfText($opt);
      if($source != null) {
        $meaning = $source->meaning;
        $foreignkey = $source->foreignkey; //foreignkey
      } else {
        $meaning = "";
        $foreignkey = "";
      }

      //output
      $myObj = new \stdClass();
      $myObj->status = $status;
      $myObj->text = $text;
      $myObj->meaning = $meaning;
      $myObj->foreignkey = $foreignkey;
      $myObj->trxunixtime = $trxunixtime;
      $myObj->country = $country;

      $myJSON = json_encode($myObj);
      echo $myJSON;
      // echo $self->createUniqCode();
    }
    public function getMeaningOfText($opt){
      $country = $opt->country;
      $text = $opt->text;
      $keyfrom = $opt->keyfrom;
      //git list data dictionary dari elasticsearch
      //hit api erevna-es-interface-js
      $client = new Client();
      $host = $this->config->es_interface_host;
      // echo $host;
      try {
          $endpoin = 'http://'.$host.'/'.$keyfrom.'/fetchOneById/'.$country.'/'.$text;
          // echo $endpoin;
          $response = $client->request('GET', $endpoin);
          $code = $response->getStatusCode(); // 200
          $reason = $response->getReasonPhrase(); // OK
          $body = $response->getBody();
          // Implicitly cast the body to a string and echo it
          $json = json_decode($body);
          // echo $body;
          if($json->status==1){
            return $json->resultSearch->_source;
            // return $json->resultSearch->_source->meaning;
            // echo "status success";
          } else {
            // echo "status gagal";
            return null;
          }
          // echo $json->resultSearch->_index;
          // Explicitly cast the body to a string
          // $stringBody = (string) $body;
          // Read 10 bytes from the body
          // $tenBytes = $body->read(10);
          // Read the remaining contents of the body as a string
          // $remainingBytes = $body->getContents();
      } catch (RequestException $e) {
          // echo $e->getRequest()
          // echo Psr7\str($e->getRequest());
          if ($e->hasResponse()) {
              // echo Psr7\str($e->getResponse());
          }
      }

      return null;
    }
  }
?>
