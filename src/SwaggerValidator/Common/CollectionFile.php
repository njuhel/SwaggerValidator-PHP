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

namespace SwaggerValidator\Common;

/**
 * Description of ReferenceCollection
 *
 * @author Nicolas JUHEL<swaggervalidator@nabbar.com>
 * @version 1.0.0
 */
class CollectionFile extends \SwaggerValidator\Common\Collection
{

    const ID_PREFIX = 'file:';

    /**
     *
     * @var \SwaggerValidator\Common\CollectionFile
     */
    private static $instance;

    /**
     *
     * @var array
     */
    private static $fileIdList = array();

    /**
     * Private construct for singleton
     */
    private function __construct()
    {

    }

    /**
     *
     * @return \SwaggerValidator\Common\CollectionFile
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * replace the singleton of this collection
     */
    public static function setInstance(\SwaggerValidator\Common\CollectionFile $instance)
    {
        self::$instance   = $instance;
        self::$fileIdList = array();
    }

    public static function prune()
    {
        self::$instance   = null;
        self::$fileIdList = array();
    }

    public function __isset($ref)
    {
        parent::__isset(self::getIdFromRef($ref));
    }

    public function __unset($ref)
    {
        parent::__unset(self::getIdFromRef($ref));
    }

    /**
     * Return the content of the reference as object or mixed data
     * @param string $fileLink
     * @return \SwaggerValidator\Common\ReferenceFile
     * @throws \SwaggerValidator\Exception
     */
    public function __get($fileLink)
    {
        if (empty($fileLink)) {
            \SwaggerValidator\Exception::throwNewException('Cannot find file link from ref : ' . $fileLink, __FILE__, __LINE__);
        }

        $id = self::getIdFromRef($fileLink);

        if (!is_object(parent::__get($id))) {
            $this->__set($fileLink);
        }

        \SwaggerValidator\Common\Context::logLoadFile(self::getRefFromId($id), __METHOD__, __LINE__);

        return parent::__get($id);
    }

    public function __set($ref, $value = null)
    {
        $id = self::getIdFromRef($ref);

        if ($id == $ref) {
            $ref = self::getRefFromId($id);
        }

        if (!is_object($value) || !($value instanceof \SwaggerValidator\Common\ReferenceFile)) {
            $value = new \SwaggerValidator\Common\ReferenceFile($ref);
        }

        if (is_object($value) && ($value instanceof \SwaggerValidator\Common\ReferenceFile)) {
            $value->extractAllReference();
            return parent::__set($id, $value);
        }

        \SwaggerValidator\Exception::throwNewException('Cannot register file from ref : ' . $ref, __FILE__, __LINE__);
    }

    public function jsonSerialize()
    {
        return null;
    }

    public function serialize()
    {
        return null;
    }

    public function unserialize($data)
    {
        return null;
    }

    /**
     * Return the content of the reference as object or mixed data
     * @param string $fileLink
     * @return \SwaggerValidator\Common\ReferenceFile
     * @throws \SwaggerValidator\Exception
     */
    public function get($fileLink)
    {
        return $this->__get($fileLink);
    }

    public function set($ref, $value = null)
    {
        return $this->__set($ref, $value);
    }

    public static function getReferenceFileLink($ref)
    {
        if (strpos($ref, '#') === false) {
            return $ref;
        }

        $fileLink = explode('#', $ref);
        array_pop($fileLink);
        return implode('#', $fileLink);
    }

    public static function getReferenceInnerPath($ref)
    {
        if (strpos($ref, '#') === false) {
            return;
        }

        $fileLink = explode('#', $ref);
        return array_pop($fileLink);
    }

    public static function getIdFromRef($fullRef)
    {
        if (substr($fullRef, 0, 3) === self::ID_PREFIX) {
            return $fullRef;
        }

        if (!is_array(self::$fileIdList)) {
            self::$fileIdList = array();
        }

        if (!array_key_exists($fullRef, self::$fileIdList)) {
            //self::$fileIdList[$fullRef] = uniqid(self::ID_PREFIX);
            self::$fileIdList[$fullRef] = self::ID_PREFIX . hash('sha256', $fullRef, false);
        }

        return self::$fileIdList[$fullRef];
    }

    public static function getRefFromId($id)
    {
        if (substr($id, 0, 3) !== self::ID_PREFIX) {
            return $id;
        }

        if (!is_array(self::$fileIdList)) {
            self::$fileIdList = array();
        }

        if (!in_array($id, self::$fileIdList)) {
            return null;
        }

        return array_search($id, self::$fileIdList);
    }

}