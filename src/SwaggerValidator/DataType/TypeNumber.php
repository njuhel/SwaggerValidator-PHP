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
 * Description of Number
 *
 * @author Nicolas JUHEL<swaggervalidator@nabbar.com>
 * @version 1.0.0
 */
class TypeNumber extends \SwaggerValidator\DataType\TypeCommon
{

    public function __construct()
    {
        parent::registerMandatoryKey('type');
    }

    public function validate(\SwaggerValidator\Common\Context $context)
    {
        if (!isset($this->type)) {
            return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, null, __METHOD__, __LINE__);
        }

        if (!isset($this->minimum) || $this->minimum < 1) {
            if ((!isset($this->exclusiveMinimum) || $this->exclusiveMinimum !== true) && $context->isDataEmpty()) {
                return true;
            }
        }

        if ($this->type != \SwaggerValidator\Common\FactorySwagger::TYPE_NUMBER) {
            return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_SWAGGER_ERROR, null, __METHOD__, __LINE__);
        }

        if (!$this->type($context, $context->getDataValue())) {
            return $context->setDataCheck('type')->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_DATATYPE, null, __METHOD__, __LINE__);
        }

        if (!$this->minimum($context, $context->getDataValue())) {
            return $context->setDataCheck('minimum')->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_DATASIZE, null, __METHOD__, __LINE__);
        }

        if (!$this->maximum($context, $context->getDataValue())) {
            return $context->setDataCheck('maximum')->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_DATASIZE, null, __METHOD__, __LINE__);
        }

        if (!$this->pattern($context, $context->getDataValue())) {
            return $context->setDataCheck('pattern')->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_PATTERN, null, __METHOD__, __LINE__);
        }

        if (!$this->format($context, $context->getDataValue())) {
            return false;
        }

        if (!$this->enum($context, $context->getDataValue())) {
            return $context->setDataCheck('enum')->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_DATAVALUE, null, __METHOD__, __LINE__);
        }

        // completer les test integer
        \SwaggerValidator\Common\Context::logValidate($context->getDataPath(), get_class($this), __METHOD__, __LINE__);
        return true;
    }

    protected function type(\SwaggerValidator\Common\Context $context, $valueParams)
    {
        if (is_numeric($valueParams)) {
            return true;
        }
        elseif (preg_match('/^[\d.e+-]$/i', $valueParams)) {
            return true;
        }

        return false;
    }

    protected function format(\SwaggerValidator\Common\Context $context, $valueParams)
    {
        if (!isset($this->format)) {
            return true;
        }

        $exposant = explode('.', $valueParams);

        if (count($exposant) > 2) {
            return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_DATATYPE, 'Valueparams is not a normal numeric pattern', __METHOD__, __LINE__);
        }
        elseif (count($exposant) == 2) {
            $exposant = $exposant[1];
        }
        else {
            $exposant = null;
        }


        if ($this->format == 'float' && is_float($valueParams) && strlen($exposant) <= 7) {
            # Float val = 7 signs after .
            return true;
        }

        if ($this->format == 'double' && is_float($valueParams) && strlen($exposant) <= 15) {
            # Float val = 15 signs after .
            return true;
        }

        return $context->setValidationError(\SwaggerValidator\Common\Context::VALIDATION_TYPE_DATATYPE, 'The format does not match with registred patterns', __METHOD__, __LINE__);
    }

    protected function getExampleFormat(\SwaggerValidator\Common\Context $context)
    {
        $pi = '3.141592653589793238462643383279';

        if ($this->format == 'float' && is_float($valueParams)) {
            # Float val = 7 signs after .
            \SwaggerValidator\Common\Context::logModel($context->getDataPath(), __METHOD__, __LINE__);
            return floatval(substr($pi, 0, 9));
        }

        if ($this->format == 'double' && is_double($valueParams)) {
            # Float val = 15 signs after .
            \SwaggerValidator\Common\Context::logModel($context->getDataPath(), __METHOD__, __LINE__);
            return floatval(substr($pi, 0, 17));
        }

        return $this->getExampleType($context);
    }

    protected function getExampleType(\SwaggerValidator\Common\Context $context)
    {
        \SwaggerValidator\Common\Context::logModel($context->getDataPath(), __METHOD__, __LINE__);
        return floatval('0.1234567890123456789');
    }

}
