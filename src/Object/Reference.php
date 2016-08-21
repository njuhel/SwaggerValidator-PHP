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

namespace SwaggerValidator\Object;

/**
 * Description of Reference
 *
 * @author Nicolas JUHEL<swaggervalidator@nabbar.com>
 * @version 1.0.0
 */
class Reference extends \SwaggerValidator\Common\CollectionSwagger
{

    private $referenceId;
    private $reference;
    private $jsonData;

    public function __construct()
    {

    }

    public function jsonSerialize()
    {
        $keyRef = \SwaggerValidator\Common\FactorySwagger::KEY_REFERENCE;

        $result          = new \stdClass();
        $result->$keyRef = '#/' . \SwaggerValidator\Common\FactorySwagger::KEY_DEFINITIONS . '/' . str_replace(':', '', $this->referenceId);

        return $result;
    }

    public function serialize()
    {
        return serialize(array(
            'ref' => $this->reference,
            'id'  => $this->referenceId
        ));
    }

    public function unserialize($data)
    {
        if (!is_array($data)) {
            $data = unserialize($data);
        }

        $this->reference   = $data['ref'];
        $this->referenceId = $data['id'];
    }

    public function jsonUnSerialize(\SwaggerValidator\Common\Context $context, $jsonData)
    {
        $keyRef = \SwaggerValidator\Common\FactorySwagger::KEY_REFERENCE;

        $this->reference   = $jsonData->$keyRef;
        $this->referenceId = \SwaggerValidator\Common\CollectionReference::getIdFromRef($this->reference);

        if ($this->reference == $this->referenceId) {
            $this->reference = null;
        }

        $object         = \SwaggerValidator\Common\CollectionReference::getInstance()->get($this->referenceId);
        $this->jsonData = $object->getJson($context);

        \SwaggerValidator\Common\Context::logDecode($context->getDataPath(), get_class($this), __METHOD__, __LINE__);
    }

    public function validate(\SwaggerValidator\Common\Context $context)
    {
        $object = \SwaggerValidator\Common\CollectionReference::getInstance()->get($this->referenceId);
        return $object->getObject($context->setExternalRef($this->referenceId))->validate($context->setExternalRef($this->referenceId));
    }

    public function getModel(\SwaggerValidator\Common\Context $context)
    {
        if ($context->checkExternalRef($this->referenceId)) {
            return new \stdClass();
        }

        $object = \SwaggerValidator\Common\CollectionReference::getInstance()->get($this->referenceId);
        return $object->getObject($context->setExternalRef($this->referenceId))->getModel($context->setExternalRef($this->referenceId));
    }

}