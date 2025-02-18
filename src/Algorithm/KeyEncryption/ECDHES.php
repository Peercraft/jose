<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2015 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace SpomkyLabs\Jose\Algorithm\KeyEncryption;

use Base64Url\Base64Url;
use Jose\JWKInterface;
use Jose\Operation\KeyAgreementInterface;
use Mdanter\Ecc\EccFactory;
use Mdanter\Ecc\Message\MessageFactory;
use SpomkyLabs\Jose\JWK;
use SpomkyLabs\Jose\Util\ConcatKDF;

/**
 * Class ECDHES.
 */
class ECDHES implements KeyAgreementInterface
{
    /**
     * @var \Mdanter\Ecc\Math\MathAdapterInterface
     */
    private $adapter;

    /**
     *
     */
    public function __construct()
    {
        $this->adapter = EccFactory::getAdapter();
    }

    /**
     * {@inheritdoc}
     */
    public function getAgreementKey($encryption_key_length, JWKInterface $private_key, JWKInterface $public_key = null, array $complete_header = [], array &$additional_header_values = [])
    {
        $this->checkKey($private_key, true);
        if (null === $public_key) {
            $public_key = $this->getPublicKey($complete_header);
        } else {
            $this->checkKey($public_key, false);
            $additional_header_values = array_merge($additional_header_values, [
                'epk' => [
                    'kty' => $private_key->getKeyType(),
                    'crv' => $private_key->getValue('crv'),
                    'x'   => $private_key->getValue('x'),
                    'y'   => $private_key->getValue('y'),
                ],
            ]);
        }
        if ($private_key->getValue('crv') !== $public_key->getValue('crv')) {
            throw new \InvalidArgumentException('Curves are different');
        }

        $agreed_key = $this->calculateAgreementKey($private_key, $public_key);

        $apu = array_key_exists('apu', $complete_header) ? $complete_header['apu'] : '';
        $apv = array_key_exists('apv', $complete_header) ? $complete_header['apv'] : '';

        return ConcatKDF::generate($this->convertDecToBin($agreed_key), $complete_header['enc'], $encryption_key_length, $apu, $apv);
    }

    /**
     * @param JWKInterface $private_key
     * @param JWKInterface $public_key
     *
     * @throws \InvalidArgumentException
     *
     * @return int|string|void
     */
    public function calculateAgreementKey(JWKInterface $private_key, JWKInterface $public_key)
    {
        $p = $this->getGenerator($private_key);

        $rec_x = $this->convertBase64ToDec($public_key->getValue('x'));
        $rec_y = $this->convertBase64ToDec($public_key->getValue('y'));
        $sen_d = $this->convertBase64ToDec($private_key->getValue('d'));

        $private_key = $p->getPrivateKeyFrom($sen_d);

        $public_key = $p->getPublicKeyFrom($rec_x, $rec_y);

        $message = new MessageFactory($this->adapter);
        $exchange = $private_key->createExchange($message, $public_key);

        return $exchange->calculateSharedKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAlgorithmName()
    {
        return 'ECDH-ES';
    }

    /**
     * @param array $complete_header
     *
     * @return \Jose\JWKInterface
     */
    private function getPublicKey(array $complete_header)
    {
        if (!array_key_exists('epk', $complete_header)) {
            throw new \InvalidArgumentException('"epk" parameter missing');
        }
        if (!is_array($complete_header['epk'])) {
            throw new \InvalidArgumentException('"epk" parameter is not an array of parameter');
        }
        $public_key = new JWK();
        $public_key->setValues($complete_header['epk']);
        $this->checkKey($public_key, false);

        return $public_key;
    }

    /**
     * @param JWKInterface $key
     * @param bool         $is_private
     */
    private function checkKey(JWKInterface $key, $is_private)
    {
        if ('EC' !== $key->getKeyType()) {
            throw new \InvalidArgumentException("The key type must be 'EC'");
        }
        if (null === $key->getValue('d') && true === $is_private) {
            throw new \InvalidArgumentException('The key must be private');
        }
    }

    /**
     * @param JWKInterface $key
     *
     * @throws \InvalidArgumentException
     *
     * @return \Mdanter\Ecc\Primitives\GeneratorPoint
     */
    private function getGenerator(JWKInterface $key)
    {
        $crv = $key->getValue('crv');

        switch ($crv) {
            case 'P-256':
                return EccFactory::getNistCurves()->generator256();
            case 'P-384':
                return EccFactory::getNistCurves()->generator384();
            case 'P-521':
                return EccFactory::getNistCurves()->generator521();
            default:
                throw new \InvalidArgumentException("Curve $crv is not supported");
        }
    }

    /**
     * @param $value
     *
     * @return int|string
     */
    private function convertHexToDec($value)
    {
        return $this->adapter->hexDec($value);
    }

    /**
     * @param $value
     *
     * @return int|string
     */
    private function convertBase64ToDec($value)
    {
        $value = unpack('H*', Base64Url::decode($value));

        return $this->convertHexToDec($value[1]);
    }

    /**
     * @param $value
     *
     * @return string
     */
    private function convertDecToBin($value)
    {
        $adapter = EccFactory::getAdapter();

        return hex2bin($adapter->decHex($value));
    }
}
