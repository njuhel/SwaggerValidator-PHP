<?php

/*
 * Copyright 2016 Nicolas JUHEL <swaggervalidator@nabbar.com>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace SwaggerValidator\DataType;

/**
 * Description of TypeCombined
 *
 * @author Nicolas JUHEL<swaggervalidator@nabbar.com>
 * @version 1.0.0
 */
class TypeCombined extends \SwaggerValidator\Common\CollectionSwagger
{

    public function __construct()
    {

    }

    public function jsonUnSerialize(\SwaggerValidator\Common\Context $context, $jsonData)
    {
        if (!is_object($jsonData) || !($jsonData instanceof \stdClass)) {
            $this->buildException('Mismatching type of JSON Data received', $context);
        }

        if (count(get_object_vars($jsonData)) > 1) {
            $this->buildException('Mismatching type of JSON Data received', $context);
        }

        $keyAnyOf = \SwaggerValidator\Common\FactorySwagger::KEY_ANYOF;
        $keyAllOf = \SwaggerValidator\Common\FactorySwagger::KEY_ALLOF;
        $keyOneOf = \SwaggerValidator\Common\FactorySwagger::KEY_ONEOF;
        $keyNot   = \SwaggerValidator\Common\FactorySwagger::KEY_NOT;

        if (property_exists($jsonData, $keyAnyOf)) {
            $key = $keyAnyOf;
        }
        if (property_exists($jsonData, $keyAllOf)) {
            $key = $keyAllOf;
        }
        if (property_exists($jsonData, $keyOneOf)) {
            $key = $keyOneOf;
        }
        if (property_exists($jsonData, $keyNot)) {
            $key = $keyNot;
        }

        if (empty($key)) {
            $this->buildException('Mismatching type of JSON Data received', $context);
        }

        $result = array();

        foreach ($jsonData->$key as $index => $value) {
            $value          = $this->extractNonRecursiveReference($context, $value);
            $result[$index] = \SwaggerValidator\Common\FactorySwagger::getInstance()->jsonUnSerialize($context->setDataPath($key), $this->getCleanClass(__CLASS__), \SwaggerValidator\Common\FactorySwagger::KEY_SCHEMA, $value);
        }

        $this->$key = $result;

        \SwaggerValidator\Common\Context::logDecode($context->getDataPath(), get_class($this), __METHOD__, __LINE__);
    }

    public function validate(\SwaggerValidator\Common\Context $context, $valueParams = null)
    {
        $keyAnyOf = \SwaggerValidator\Common\FactorySwagger::KEY_ANYOF;
        $keyAllOf = \SwaggerValidator\Common\FactorySwagger::KEY_ALLOF;
        $keyOneOf = \SwaggerValidator\Common\FactorySwagger::KEY_ONEOF;
        $keyNot   = \SwaggerValidator\Common\FactorySwagger::KEY_NOT;

        if (isset($this->$keyNot)) {
            if (empty($this->$keyNot)) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, $keyNot . ' Combined Object Type cannot be empty !');
            }

            return !($this->$keyNot->validate($context, $valueParams));
        }

        if (isset($this->$keyAnyOf)) {
            if (empty($this->$keyAnyOf) || !is_array($this->$keyAnyOf)) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, $keyAnyOf . ' Combined Object Type cannot be empty !');
            }

            return $this->validateAnyOf($context, $valueParams);
        }

        if (isset($this->$keyAllOf)) {
            if (empty($this->$keyAllOf) || !is_array($this->$keyAllOf)) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, $keyAllOf . ' Combined Object Type cannot be empty !');
            }

            return $this->validateAllOf($context, $valueParams);
        }

        if (isset($this->$keyOneOf)) {
            if (empty($this->$keyOneOf) || !is_array($this->$keyOneOf)) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, $keyOneOf . ' Combined Object Type cannot be empty !');
            }

            return $this->validateOneOf($context, $valueParams);
        }

        return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, 'Combined Object Type is not well defined !');
    }

    protected function validateAnyOf(\SwaggerValidator\Common\Context $context, $valueParams = null)
    {
        $keyAnyOf = \SwaggerValidator\Common\FactorySwagger::KEY_ANYOF;

        foreach ($this->$keyAnyOf as $key => $object) {

            if (!is_object($object) || !method_exists($object, 'validate')) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, 'Object not well formed in ' . $keyAnyOf . ' object !');
            }

            if ($object->validate($context->setDataPath($key)->setCombined(true), $valueParams)) {
                \SwaggerValidator\Common\Context::logValidate($context->getDataPath(), get_class($this), __METHOD__, __LINE__);
                return true;
            }
        }

        return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_PATTERN, 'Value is not matching any ' . $keyAnyOf . ' defnied type !');
    }

    protected function validateAllOf(\SwaggerValidator\Common\Context $context, $valueParams = null)
    {
        $keyAllOf = \SwaggerValidator\Common\FactorySwagger::KEY_ALLOF;

        foreach ($this->$keyAllOf as $key => $object) {

            if (!is_object($object) || !method_exists($object, 'validate')) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, 'Object not well formed in ' . $keyAllOf . ' object !');
            }

            if (!$object->validate($context->setDataPath($key), $valueParams)) {
                return false;
            }
        }

        \SwaggerValidator\Common\Context::logValidate($context->getDataPath(), get_class($this), __METHOD__, __LINE__);
        return true;
    }

    protected function validateOneOf(\SwaggerValidator\Common\Context $context, $valueParams = null)
    {
        $keyOneOf = \SwaggerValidator\Common\FactorySwagger::KEY_ONEOF;
        $check    = false;
        $result   = false;

        foreach ($this->$keyAllOf as $key => $object) {

            if (!is_object($object) || !method_exists($object, 'validate')) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, 'Object not well formed in ' . $keyOneOf . ' object !');
            }

            $result = $object->validate($context->setDataPath($key)->setCombined(true), $valueParams);

            if ($result === true && $check === true) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_PATTERN, 'Value is matching at least 2 of the ' . $keyOneOf . ' defnied type !');
            }
            elseif ($result === true) {
                $check = true;
            }
        }

        \SwaggerValidator\Common\Context::logValidate($context->getDataPath(), get_class($this), __METHOD__, __LINE__);
        return $result || $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_PATTERN, 'Value is not matching one of the ' . $keyOneOf . ' defnied type !');
    }

    public function getModel(\SwaggerValidator\Common\Context $context)
    {
        $result   = new \stdClass();
        $keyAnyOf = \SwaggerValidator\Common\FactorySwagger::KEY_ANYOF;
        $keyAllOf = \SwaggerValidator\Common\FactorySwagger::KEY_ALLOF;
        $keyOneOf = \SwaggerValidator\Common\FactorySwagger::KEY_ONEOF;
        $keyNot   = \SwaggerValidator\Common\FactorySwagger::KEY_NOT;


        if (isset($this->$keyNot)) {
            return '';
        }

        if (isset($this->$keyAnyOf)) {
            if (empty($this->$keyAnyOf) || !is_array($this->$keyAnyOf)) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, $keyAnyOf . ' Combined Object Type cannot be empty !');
            }

            $object = $this->$keyAnyOf;
            $object = array(array_shift($object));
        }

        if (isset($this->$keyAllOf)) {
            if (empty($this->$keyAllOf) || !is_array($this->$keyAllOf)) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, $keyAllOf . ' Combined Object Type cannot be empty !');
            }

            $object = $this->$keyAllOf;
        }

        if (isset($this->$keyOneOf)) {
            if (empty($this->$keyOneOf) || !is_array($this->$keyOneOf)) {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, $keyOneOf . ' Combined Object Type cannot be empty !');
            }

            $object = $this->$keyOneOf;
            $object = array(array_shift($object));
        }

        foreach ($object as $key => $value) {

            $part = $value->getModel($context->setDataPath($key));

            if (is_object($part) && !is_object($result)) {
                $result = $part;
            }
            elseif (is_object($part) && is_object($result)) {
                foreach (get_object_vars($part) as $partKey => $partValue) {
                    $result->$partKey = $partValue;
                }
            }
            elseif (is_array($part) && !is_array($result)) {
                $result = $part;
            }
            elseif (is_array($part) && is_array($result)) {
                $result = $result + $part;
            }
            else {
                return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, 'Cannot build model for key "' . $key . '" in Combined Object !');
            }
        }

        \SwaggerValidator\Common\Context::logModel($context->getDataPath(), __METHOD__, __LINE__);
        return $result;
    }

}