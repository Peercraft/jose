The JWK object
==============

The JWK object represents a key. Depending on the key properties, it can be used to sign, verify a signature, encrypt or decrypt.

A JWK object is also serializable. You can call `json_encode($jwk)` to display the key as a string (e.g. `{'kty':'oct', 'k':'abcdef...'}`).

# Create a `JWK` object

To create a `JWK` object, simply instantiate the class and set values:

```php
use Jose\JWK;

$jwk = new JWK([
    'kid' => 'My First Key',
    'kty' => 'oct',
    'k'   => 'abcdef',
]);
```

or 

```php
use Jose\JWK;

$jwk = new JWK();
$jwk->setValues([
    'kid' => 'My First Key',
    'kty' => 'oct',
    'k' => 'abcdef',
]);
```

# Key values

Values depend on the key type. [Read this page](../Keys.md) to know supported key type.

## None key (`none`)

```php
$jwk = new JWK([
    'kty' => 'none',
]);
```

## Assymetric key (`oct`)

```php
$jwk = new JWK([
    'kty' => 'oct',
    'k'   => 'abcdef',
]);
```

The value of `k` is your binary key encoded in base 64 url safe:

```php
use Base64Url\Base64Url;

$jwk = new JWK([
    'kty' => 'oct',
    'k'   => Base64Url::encode($my_binary_string),
]);
```

## Direct key (`dir`)

```php
$jwk = new JWK([
    'kty' => 'dir',
    'dir'   => 'abcdef',
]);
```

The value of `dir` is your binary key encoded in base 64 url safe

## Symmetric key

### RSA key

`RSA` public and private keys are very similar. The difference is that a public key only contains `n` (modulus) and `e` (exponent) values.
A private key contains other values includes primes.

```php
// A public key
$jwk = new JWK([
    'kty' => 'RSA',
    'n'   => 'abcdef',
    'e'   => 'AQAB',
]);
```

```php
// A private key
$jwk = new JWK([
    'kty' => 'RSA',
    'n'   => 'abcdef',
    'e'   => 'AQAB',
    'd'   => 'ghijkl',
    'dp'   => '123456',
    'dq'   => '987654',
    'qi'   => 'ABCDEF',
]);
```

You can consider that a `RSA` key is private when it contains a `d` value.

### ECC key

As `RSA` keys, `EC` public and private keys are very similar. The difference is that a public key only contains `x` and `y` (coordinates) values.
A private key contains a `d` value.

```php
// A public key
$jwk = new JWK([
    'kty' => 'EC',
    'crv' => 'P-256',
    'x'   => 'abcdefghij',
    'y'   => '0123456789',
]);
```

```php
// A private key
$jwk = new JWK([
    'kty' => 'EC',
    'crv' => 'P-256',
    'x'   => 'abcdefghij',
    'y'   => '0123456789',
    'd'   => 'ABCDEFGHIJ',
]);
```

You can consider that an `EC` key is private when it contains a `d` value.

# Key conversion

If you have `RSA` or `EC` keys stored in a file (X509 certificate, PEM key or DER key), you can easily load your key and
extract values using the `Jose\Util\KeyConverter` object we provide.

```php
use Jose\Util\KeyConverter;

$values = KeyConverter::loadKeyFromCertificate('path/to/my/certificate');
$jwk = new JWK($values);
```

This tool provides the following static methods:

* `KeyConverter::loadKeyFromCertificate($file)`: load values from a X509 certificate
* `KeyConverter::loadKeyFromX509Resource($resource)`: load values from a X509 resource
* `KeyConverter::loadKeyFromFile($file, $password = null)`: load values from a key file (encrypted keys supported)
* `KeyConverter::loadKeyFromPEM($pem, $password = null)`: load values from a PEM string (encrypted PEM supported)
* `KeyConverter::loadKeyFromDER($der, $password = null)`: load values from a DER string (encrypted DER supported)

# Key use and allowed algorithm

You can indicate the scope of the key and the allowed algorithms for this key

## Key use

## Allowed algorithm

# Available methods

A `JWK` object implements the interface `Jose\JWKInterface` and provides the following methods:

* `getValues()`: all values
* `setValues(array $values)`: set values of the key 
* `getValue($key)`:  the value with key `$key`. Returns null if the value does not exist.
* `setValue($key, $value)`: set the value `$value` at key `$key`
* `getKeyType()`: returns the key type. This method is a convenient method for `getValue('kty')`
* `getPublicKeyUse()`: returns the key type. This method is a convenient method for `getValue('use')`
* `getKeyOperations()`: returns the key type. This method is a convenient method for `getValue('key_ops')`
* `getAlgorithm()`: returns the key type. This method is a convenient method for `getValue('alg')`
* `getKeyID()`: returns the key type. This method is a convenient method for `getValue('kid')`
* `getX509Url()`: returns the key type. This method is a convenient method for `getValue('x5u')`
* `getX509CertificateChain()`: returns the key type. This method is a convenient method for `getValue('x5c')`
* `getX509CertificateSha1Thumbprint()`: returns the key type. This method is a convenient method for `getValue('x5t')`
* `getX509CertificateSha256Thumbprint()`: returns the key type. This method is a convenient method for `getValue('x5t#256')`
