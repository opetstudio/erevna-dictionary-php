<?php
  namespace ErevnaDictionaryPhp\Main;
  class Main{
    public function __construct ()
    {
      //  echo "construct invoked";
    }
    public static function main(){
      $self = new Main();
      // get the HTTP method, path and body of the request
      $method = $_SERVER['REQUEST_METHOD'];
      $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
      $input = json_decode(file_get_contents('php://input'),true);
      //
      // // retrieve the table and key from the path
      $table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
      $key = array_shift($request)+0;
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
      $myObj = new \stdClass();
      $myObj->status = true;
      $myObj->table = $table;
      $myObj->verifycode = 452367;

      $myJSON = json_encode($myObj);

      echo $myJSON;

      // echo $self->createUniqCode();
    }
    public function createUniqCode(){
      return "123456789";
    }
  }
?>