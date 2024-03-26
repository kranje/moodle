<?php

namespace Firebase\JWT;

use InvalidArgumentException;
use OpenSSLAsymmetricKey;
<<<<<<< HEAD
use OpenSSLCertificate;
use TypeError;

class Key
{
    /** @var string|resource|OpenSSLAsymmetricKey|OpenSSLCertificate */
    private $keyMaterial;
    /** @var string */
    private $algorithm;

    /**
     * @param string|resource|OpenSSLAsymmetricKey|OpenSSLCertificate $keyMaterial
     * @param string $algorithm
     */
    public function __construct(
        $keyMaterial,
        string $algorithm
    ) {
        if (
            !\is_string($keyMaterial)
            && !$keyMaterial instanceof OpenSSLAsymmetricKey
            && !$keyMaterial instanceof OpenSSLCertificate
            && !\is_resource($keyMaterial)
        ) {
            throw new TypeError('Key material must be a string, resource, or OpenSSLAsymmetricKey');
        }

        if (empty($keyMaterial)) {
            throw new InvalidArgumentException('Key material must not be empty');
        }

        if (empty($algorithm)) {
            throw new InvalidArgumentException('Algorithm must not be empty');
        }

        // TODO: Remove in PHP 8.0 in favor of class constructor property promotion
=======

class Key
{
    /** @var string $algorithm */
    private $algorithm;

    /** @var string|resource|OpenSSLAsymmetricKey $keyMaterial */
    private $keyMaterial;

    /**
     * @param string|resource|OpenSSLAsymmetricKey $keyMaterial
     * @param string $algorithm
     */
    public function __construct($keyMaterial, $algorithm)
    {
        if (
            !is_string($keyMaterial)
            && !is_resource($keyMaterial)
            && !$keyMaterial instanceof OpenSSLAsymmetricKey
        ) {
            throw new InvalidArgumentException('Type error: $keyMaterial must be a string, resource, or OpenSSLAsymmetricKey');
        }

        if (empty($keyMaterial)) {
            throw new InvalidArgumentException('Type error: $keyMaterial must not be empty');
        }

        if (!is_string($algorithm)|| empty($keyMaterial)) {
            throw new InvalidArgumentException('Type error: $algorithm must be a string');
        }

>>>>>>> forked/LAE_400_PACKAGE
        $this->keyMaterial = $keyMaterial;
        $this->algorithm = $algorithm;
    }

    /**
     * Return the algorithm valid for this key
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAlgorithm(): string
=======
    public function getAlgorithm()
>>>>>>> forked/LAE_400_PACKAGE
    {
        return $this->algorithm;
    }

    /**
<<<<<<< HEAD
     * @return string|resource|OpenSSLAsymmetricKey|OpenSSLCertificate
=======
     * @return string|resource|OpenSSLAsymmetricKey
>>>>>>> forked/LAE_400_PACKAGE
     */
    public function getKeyMaterial()
    {
        return $this->keyMaterial;
    }
}
