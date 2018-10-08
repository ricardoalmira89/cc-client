<?php

namespace Ciencuadras\Util;

/**
 * Helper de validacion
 * @package Ciencuadras\Util
 */
class AlmValidator
{

    public static function validate($data, $validations = [], $trows = true){
        if (count($validations) == 0)
            return true;

        $errors = [];

        foreach ($validations as $field => $validation){
            $filters = static::getFilters($validation);

            if (count($filters) == 0)
                throw new ValidatorException("Se debe especificar al menos un filtro para la validacion");

            foreach ($filters as $filter){
                $guessed = static::guessFilter($filter);

                if ($guessed == Validator::REQUIRED){
                    $validation = Validator::requiredFilter($data, $field);

                    if (!$validation)
                        $errors[] = sprintf('El campo %s es requerido', $field);
                }

                if ($guessed == Validator::NUMERIC){
                    $validation = Validator::numericFilter($data, $field);
                    if (!$validation)
                        $errors[] = sprintf('El campo %s debe ser numerico', $field);
                }

                if ($guessed == Validator::MINIMUM_VALUE){
                    $validation = Validator::minFilter($data, $field, $filter);
                    if (!$validation)
                        $errors[] = sprintf('El campo %s no esta en el rango especificado %s', $field, $filter);
                }
            }


        }

        if (count($errors) > 0){

            if ($trows)
                throw new \ErrorException(AlmString::arrayToText($errors));

            return false;

        }

        return true;
    }

    private static function getFilters($validation){
        return AlmString::commaSplit($validation, '|');
    }

    private static function guessFilter($filter){

        $params = AlmString::commaSplit($filter, ':');
        $filter = $params[0];

        if ($filter == 'req')
            return Validator::REQUIRED;

        if ($filter == 'num')
            return Validator::NUMERIC;

        if ($filter == 'min'){
            return Validator::MINIMUM_VALUE;
        }

        return null;
    }


}

class Validator {
    const REQUIRED = 'req';
    const NUMERIC = 'num';
    const MINIMUM_VALUE = 'min';
    const MAXIMUM_VALUE = 'max';


    public static function requiredFilter($data, $key){
        return AlmArray::get($data, $key) != null;
    }

    public static function numericFilter($data, $key){
        $value = AlmArray::get($data, $key);

        if ($value)
            return is_numeric($value);

        return true;
    }

    public static function minFilter($data, $key, $filter){
        $value = AlmArray::get($data, $key);

        $min = preg_replace('/min\:/', '', $filter);

        if (is_numeric($min)){
            if ($value){
                $value = (integer)$value;
                return $value >= $min;
            }
        } else throw new ValidatorException("Filtro Invalido min");

        return true;
    }
}

class ValidatorException extends \Exception{

}