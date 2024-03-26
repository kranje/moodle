<?php

/**
 * SCSSPHP
 *
 * @copyright 2012-2020 Leaf Corcoran
 *
 * @license http://opensource.org/licenses/MIT MIT
 *
 * @link http://scssphp.github.io/scssphp
 */

namespace ScssPhp\ScssPhp\Exception;

/**
 * Parser Exception
 *
 * @author Oleksandr Savchenko <traveltino@gmail.com>
 *
 * @internal
 */
class ParserException extends \Exception implements SassException
{
    /**
<<<<<<< HEAD
     * @var array|null
     * @phpstan-var array{string, int, int}|null
=======
     * @var array
>>>>>>> forked/LAE_400_PACKAGE
     */
    private $sourcePosition;

    /**
     * Get source position
     *
     * @api
<<<<<<< HEAD
     *
     * @return array|null
     * @phpstan-return array{string, int, int}|null
=======
>>>>>>> forked/LAE_400_PACKAGE
     */
    public function getSourcePosition()
    {
        return $this->sourcePosition;
    }

    /**
     * Set source position
     *
     * @api
     *
     * @param array $sourcePosition
<<<<<<< HEAD
     *
     * @return void
     *
     * @phpstan-param array{string, int, int} $sourcePosition
=======
>>>>>>> forked/LAE_400_PACKAGE
     */
    public function setSourcePosition($sourcePosition)
    {
        $this->sourcePosition = $sourcePosition;
    }
}
