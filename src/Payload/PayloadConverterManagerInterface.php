<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Payload;

interface PayloadConverterManagerInterface
{
    /**
     * @param \SpomkyLabs\Jose\Payload\PayloadConverterInterface $converter
     *
     * @return self
     */
    public function addConverter(PayloadConverterInterface $converter);

    /**
     * @param array $header
     * @param mixed $payload
     *
     * @return string
     */
    public function convertPayloadToString(array &$header, $payload);

    /**
     * @param array  $header
     * @param string $content
     *
     * @return mixed
     */
    public function convertStringToPayload(array $header, $content);
}
