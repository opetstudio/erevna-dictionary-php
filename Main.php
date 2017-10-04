<?php
  class Main{
    public function __construct ()
    {
       echo "construct invoked";
    }
    public static function main(){
      $self = new Main();
      echo "main invoked";
    }
  }

  Main::main();
?>
