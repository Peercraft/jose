<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Test\Stub;

use SpomkyLabs\Jose\Checker\IssuerChecker as Base;

/**
 */
class IssuerChecker extends Base
{
    /**
     * {@inheritdoc}
     */
    protected function isIssuerValid($issuer)
    {
        return in_array($issuer, ['ISS1', 'ISS2']);
    }
}
