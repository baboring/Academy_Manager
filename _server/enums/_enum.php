<?php
/* -------------------------------------------------------------
 purpos : Define varialbe and constant
 author : Benjamin
 date : Nov 11, 2016
 desc : 
------------------------------------------------------------- */

// basic abstract class
abstract class Enum
{

    const NONE = null;

    final private function __construct()  {
        throw new NotSupportedException(); // 
    }

    final private function __clone()  {
        throw new NotSupportedException();
    }

    final public static function toArray()  {
        return (new ReflectionClass(static::class))->getConstants();
    }

    final public static function isValid($value)  {
        return in_array($value, static::toArray());
    }

}

?>