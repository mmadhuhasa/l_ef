<?php

namespace App\Designpatterns;

use App\Designpatterns\Singleton;

class SingletonChild extends Singleton {
    
}

$obj = Singleton::getInstance();
var_dump($obj === Singleton::getInstance());	     // bool(true)

$anotherObj = SingletonChild::getInstance();
var_dump($anotherObj === Singleton::getInstance());      // bool(false)

var_dump($anotherObj === SingletonChild::getInstance()); // bool(true)