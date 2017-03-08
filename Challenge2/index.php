<?php

class SingletonClass {

   private static  $testString  = 'test';
    

    private function __construct() {
    }

   static function getTestString() {

      return self::$testString;
    }

  }
 
class ClassUsingSingleton {
    private $testStringUsingSingleton;

    function __construct() {
    }

    function getSingletonTestString() {
     return $this->testStringUsingSingleton = SingletonClass::getTestString();
  
    }

  }
  


  $singletonOBJ = new ClassUsingSingleton();

  echo(strrev($singletonOBJ->getSingletonTestString()));
?>

