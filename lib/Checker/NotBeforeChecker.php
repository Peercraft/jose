<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Checker;

use Jose\JWTInterface;

class NotBeforeChecker implements CheckerInterface
{
    protected $leeway;

    public function __construct($leeway = 30)
    {
        $this->leeway = $leeway;
    }

    /**
     * {@inheritdoc}
     */
    public function checkJWT(JWTInterface $jwt)
    {
        $nbf = $jwt->getNotBefore();
        if (!is_null($nbf) && time() < $nbf-$this->leeway) {
            throw new \Exception('Can not use this JWT yet.');
        }

        return $this;
    }
}
