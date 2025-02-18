<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Algorithm\ContentEncryption;

/**
 * Class A192GCM.
 */
class A192GCM extends AESGCM
{
    /**
     * {@inheritdoc}
     */
    protected function getKeySize()
    {
        return 192;
    }

    /**
     * {@inheritdoc}
     */
    public function getAlgorithmName()
    {
        return 'A192GCM';
    }
}
