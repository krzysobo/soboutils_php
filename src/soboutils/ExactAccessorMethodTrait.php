<?php

namespace Soboutils;

require_once "Exceptions.php";

/**
 * this is the accessor trait providing a virtual getter and setter for each property
 * of an object (a class instance).
 * It is an _EXACT_ accessor, which means that the property MUST follow the same
 * case and format, as the accessor does.
 * For example, if there is a property named $userName, its accessors must be named
 *    setUserName() and getUserName(). This trait will NOT try to match camelCase with
 * snake_case or anything like that.
 *    snak
 */
trait ExactAccessorMethodTrait
{

    public function __call($funcname, $args)
    {
        $this_class = get_class($this);

        if ((! str_starts_with($funcname, 'get')) && (! str_starts_with($funcname, 'set'))) {
            throw new \BadMethodCallException("Method $funcname doesn't exist on $this_class");
        }

        if (strlen($funcname) < 4) {
            throw new \BadMethodCallException("setter name must contain a name of a property existing in its class.");
        }

        $property = lcfirst(substr($funcname, 3));

        if (! property_exists($this, $property)) {
            throw new PropertyNotFoundException("Property $property doesn't exist on $this_class.");
        }

        if (str_starts_with($funcname, 'set')) {
            if (! isset($args) || empty($args)) {
                throw new \BadMethodCallException("Setter requires a parameter.");
            }
            $this->{$property} = $args[0];
        }

        if (str_starts_with($funcname, 'get')) {
            if (isset($args) && ! empty($args)) {
                throw new \BadMethodCallException("getter doesn't allow parameters.");
            }

            return $this->{$property};
        }
    }
}
