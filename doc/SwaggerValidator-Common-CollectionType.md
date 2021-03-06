SwaggerValidator\Common\CollectionType
===============

Description of CollectionType




* Class name: CollectionType
* Namespace: SwaggerValidator\Common
* Parent class: [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)



Constants
----------


### IOHelper

    const IOHelper = '\\SwaggerValidator\\CustomIOHelper'





### Exception

    const Exception = '\\SwaggerValidator\\Exception'





### Swagger

    const Swagger = '\\SwaggerValidator\\Object\\Swagger'





### Contact

    const Contact = '\\SwaggerValidator\\Object\\Contact'





### Definitions

    const Definitions = '\\SwaggerValidator\\Object\\Definitions'





### ExternalDocs

    const ExternalDocs = '\\SwaggerValidator\\Object\\ExternalDocs'





### HeaderItem

    const HeaderItem = '\\SwaggerValidator\\Object\\HeaderItem'





### Headers

    const Headers = '\\SwaggerValidator\\Object\\Headers'





### Info

    const Info = '\\SwaggerValidator\\Object\\Info'





### Reference

    const Reference = '\\SwaggerValidator\\Object\\Reference'





### License

    const License = '\\SwaggerValidator\\Object\\License'





### Operation

    const Operation = '\\SwaggerValidator\\Object\\Operation'





### ParameterBody

    const ParameterBody = '\\SwaggerValidator\\Object\\ParameterBody'





### Parameters

    const Parameters = '\\SwaggerValidator\\Object\\Parameters'





### PathItem

    const PathItem = '\\SwaggerValidator\\Object\\PathItem'





### Paths

    const Paths = '\\SwaggerValidator\\Object\\Paths'





### ResponseItem

    const ResponseItem = '\\SwaggerValidator\\Object\\ResponseItem'





### Responses

    const Responses = '\\SwaggerValidator\\Object\\Responses'





### Security

    const Security = '\\SwaggerValidator\\Object\\Security'





### SecurityItem

    const SecurityItem = '\\SwaggerValidator\\Object\\SecurityItem'





### SecurityDefinitions

    const SecurityDefinitions = '\\SwaggerValidator\\Object\\SecurityDefinitions'





### SecurityRequirement

    const SecurityRequirement = '\\SwaggerValidator\\Object\\SecurityRequirement'





### TypeArray

    const TypeArray = '\\SwaggerValidator\\DataType\\TypeArray'





### TypeArrayItems

    const TypeArrayItems = '\\SwaggerValidator\\DataType\\TypeArrayItems'





### TypeBoolean

    const TypeBoolean = '\\SwaggerValidator\\DataType\\TypeBoolean'





### TypeCombined

    const TypeCombined = '\\SwaggerValidator\\DataType\\TypeCombined'





### TypeFile

    const TypeFile = '\\SwaggerValidator\\DataType\\TypeFile'





### TypeInteger

    const TypeInteger = '\\SwaggerValidator\\DataType\\TypeInteger'





### TypeNumber

    const TypeNumber = '\\SwaggerValidator\\DataType\\TypeNumber'





### TypeObject

    const TypeObject = '\\SwaggerValidator\\DataType\\TypeObject'





### TypeObjectProperties

    const TypeObjectProperties = '\\SwaggerValidator\\DataType\\TypeObject'





### TypeString

    const TypeString = '\\SwaggerValidator\\DataType\\TypeString'





### ApiKeySecurity

    const ApiKeySecurity = '\\SwaggerValidator\\Security\\ApiKeySecurity'





### BasicAuthenticationSecurity

    const BasicAuthenticationSecurity = '\\SwaggerValidator\\Security\\BasicAuthenticationSecurity'





### OAuth2AccessCodeSecurity

    const OAuth2AccessCodeSecurity = '\\SwaggerValidator\\Security\\OAuth2AccessCodeSecurity'





### OAuth2ApplicationSecurity

    const OAuth2ApplicationSecurity = '\\SwaggerValidator\\Security\\OAuth2ApplicationSecurity'





### OAuth2ImplicitSecurity

    const OAuth2ImplicitSecurity = '\\SwaggerValidator\\Security\\OAuth2ImplicitSecurity'





### OAuth2PasswordSecurity

    const OAuth2PasswordSecurity = '\\SwaggerValidator\\Security\\OAuth2PasswordSecurity'





### OAuth2PasswordSecurityScopes

    const OAuth2PasswordSecurityScopes = '\\SwaggerValidator\\Security\\OAuth2PasswordSecurityScopes'





Properties
----------


### $instance

    private \SwaggerValidator\Common\CollectionType $instance





* Visibility: **private**
* This property is **static**.


### $collection

    private array $collection = array()





* Visibility: **private**


### $originTypeArray

    protected boolean $originTypeArray = false





* Visibility: **protected**


Methods
-------


### __construct

    mixed SwaggerValidator\Common\CollectionType::__construct()

Private construct for singleton



* Visibility: **private**




### getInstance

    \SwaggerValidator\Common\CollectionType SwaggerValidator\Common\CollectionType::getInstance()

get the singleton of this collection



* Visibility: **public**
* This method is **static**.




### setInstance

    mixed SwaggerValidator\Common\CollectionType::setInstance(\SwaggerValidator\Common\CollectionType $instance)

replace the singleton of this collection



* Visibility: **public**
* This method is **static**.


#### Arguments
* $instance **[SwaggerValidator\Common\CollectionType](SwaggerValidator-Common-CollectionType.md)**



### pruneInstance

    mixed SwaggerValidator\Common\CollectionType::pruneInstance()

prune the singleton of this collection



* Visibility: **public**
* This method is **static**.




### __get

    mixed SwaggerValidator\Common\Collection::__get($key)





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**



### __set

    mixed SwaggerValidator\Common\Collection::__set($key, $value)





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**
* $value **mixed**



### __isset

    mixed SwaggerValidator\Common\Collection::__isset($key)

Property Overloading



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**



### __storeData

    mixed SwaggerValidator\Common\Collection::__storeData($key, $value)

Var Export Method



* Visibility: **protected**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**
* $value **mixed**



### __set_state

    mixed SwaggerValidator\Common\Collection::__set_state(array $properties)





* Visibility: **public**
* This method is **static**.
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $properties **array**



### jsonSerialize

    mixed SwaggerValidator\Common\Collection::jsonSerialize()





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### serialize

    mixed SwaggerValidator\Common\Collection::serialize()





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### unserialize

    mixed SwaggerValidator\Common\Collection::unserialize($data)





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $data **mixed**



### get

    callable SwaggerValidator\Common\CollectionType::get(string $type)

Return the callable string for the given type



* Visibility: **public**


#### Arguments
* $type **string**



### registerCallable

    mixed SwaggerValidator\Common\CollectionType::registerCallable(\SwaggerValidator\Common\Context $context, string $type, callable $callable)

Replace the default callable string by the given for the type in parameters



* Visibility: **public**


#### Arguments
* $context **[SwaggerValidator\Common\Context](SwaggerValidator-Common-Context.md)**
* $type **string**
* $callable **callable**



### normalizeType

    mixed SwaggerValidator\Common\CollectionType::normalizeType($type)





* Visibility: **public**


#### Arguments
* $type **mixed**



### __unset

    mixed SwaggerValidator\Common\Collection::__unset($key)





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**



### offsetSet

    mixed SwaggerValidator\Common\Collection::offsetSet($key, $value)

Array Access



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**
* $value **mixed**



### offsetExists

    mixed SwaggerValidator\Common\Collection::offsetExists($key)





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**



### offsetUnset

    mixed SwaggerValidator\Common\Collection::offsetUnset($key)





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**



### offsetGet

    mixed SwaggerValidator\Common\Collection::offsetGet($key)





* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **mixed**



### getIterator

    mixed SwaggerValidator\Common\Collection::getIterator()

IteratorAggregate



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### count

    mixed SwaggerValidator\Common\Collection::count()

Countable



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### setJSONIsArray

    mixed SwaggerValidator\Common\Collection::setJSONIsArray()





* Visibility: **protected**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### all

    array SwaggerValidator\Common\Collection::all()

Fetch set data



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### keys

    array SwaggerValidator\Common\Collection::keys()

Fetch set data keys



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### has

    boolean SwaggerValidator\Common\Collection::has(string $key)

Does this set contain a key?



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **string** - &lt;p&gt;The data key&lt;/p&gt;



### remove

    mixed SwaggerValidator\Common\Collection::remove(string $key)

Remove value with key from this set



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $key **string** - &lt;p&gt;The data key&lt;/p&gt;



### clear

    mixed SwaggerValidator\Common\Collection::clear()

Clear all values



* Visibility: **public**
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)




### jsonEncode

    mixed SwaggerValidator\Common\Collection::jsonEncode($mixed)





* Visibility: **public**
* This method is **static**.
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $mixed **mixed**



### jsonEncodePretty

    mixed SwaggerValidator\Common\Collection::jsonEncodePretty($mixed)





* Visibility: **public**
* This method is **static**.
* This method is defined by [SwaggerValidator\Common\Collection](SwaggerValidator-Common-Collection.md)


#### Arguments
* $mixed **mixed**


