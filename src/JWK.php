<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose;

use Jose\JWK as Base;

/**
 * Class JWK.
 */
class JWK extends Base
{
    /**
     * @var array
     */
    protected $values = [];

    /**
     * @param array $values
     */
    public function __construct(array $values = [])
    {
        $this->setValues($values);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->getValues();
    }

    /**
     * @param string $key
     *
     * @return mixed|null
     */
    public function getValue($key)
    {
        return array_key_exists($key, $this->getValues()) ? $this->values[$key] : null;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return self
     */
    public function setValue($key, $value)
    {
        $this->values[$key] = $value;

        return $this;
    }

    /**
     * @param array $values
     *
     * @return self
     */
    public function setValues(array $values)
    {
        $this->values = $values;

        return $this;
    }
}
