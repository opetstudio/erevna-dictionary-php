<?php
  namespace ErevnaDictionaryPhp\Index;
  require __DIR__ . './../vendor/autoload.php';
  require_once("Main.php");

  use ErevnaDictionaryPhp\Main\Main;
  // use ErevnaDictionaryPhp\Main\Main as Another;
  // include("Main.php");
  // echo "tes";
  // $_ENV["env"]="production";
  $env = getenv("PHP_ENV");
  // $environment = json_decode(file_get_contents("env.json"), true);
  // echo "env==>>".$env;
  // echo $environment->app;
  // print_r($environment);
  $config = new \stdClass();
  if($env=="production"){
    // echo "production";
    $config = json_decode(file_get_contents("env.json"));
  } else {
    // echo "development";
    $config = json_decode(file_get_contents("env.development.json"));
  }
  // echo $string->env;
  // print_r($string->app);

  Main::main($config);
  // Another::main();
  // $Main = new Another();
  // echo $Main->createUniqCode();
  // Main::main();
// echo "tesssss";
// error_log("Oracle database not available!0", 0);
// error_log("Oracle database not available!1", 1);
// error_log("Oracle database not available!2", 2);
// error_log("Oracle database not available!3", 3);
// error_log("Oracle database not available!4", 4);
// debug_print_backtrace();
?>
