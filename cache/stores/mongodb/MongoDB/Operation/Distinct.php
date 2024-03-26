<?php
/*
<<<<<<< HEAD
 * Copyright 2015-present MongoDB, Inc.
=======
 * Copyright 2015-2017 MongoDB, Inc.
>>>>>>> forked/LAE_400_PACKAGE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
<<<<<<< HEAD
 *   https://www.apache.org/licenses/LICENSE-2.0
=======
 *   http://www.apache.org/licenses/LICENSE-2.0
>>>>>>> forked/LAE_400_PACKAGE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace MongoDB\Operation;

use MongoDB\Driver\Command;
use MongoDB\Driver\Exception\RuntimeException as DriverRuntimeException;
use MongoDB\Driver\ReadConcern;
use MongoDB\Driver\ReadPreference;
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Exception\InvalidArgumentException;
use MongoDB\Exception\UnexpectedValueException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

=======
>>>>>>> forked/LAE_400_PACKAGE
use function current;
use function is_array;
use function is_integer;
use function is_object;
use function MongoDB\create_field_path_type_map;
<<<<<<< HEAD
=======
use function MongoDB\server_supports_feature;
>>>>>>> forked/LAE_400_PACKAGE

/**
 * Operation for the distinct command.
 *
 * @api
 * @see \MongoDB\Collection::distinct()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/distinct/
 */
class Distinct implements Executable, Explainable
{
=======
 * @see http://docs.mongodb.org/manual/reference/command/distinct/
 */
class Distinct implements Executable, Explainable
{
    /** @var integer */
    private static $wireVersionForCollation = 5;

    /** @var integer */
    private static $wireVersionForReadConcern = 4;

>>>>>>> forked/LAE_400_PACKAGE
    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var string */
    private $fieldName;

    /** @var array|object */
    private $filter;

    /** @var array */
    private $options;

    /**
     * Constructs a distinct command.
     *
     * Supported options:
     *
     *  * collation (document): Collation specification.
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
=======
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
     *  * readConcern (MongoDB\Driver\ReadConcern): Read concern.
     *
<<<<<<< HEAD
=======
     *    This is not supported for server versions < 3.2 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * readPreference (MongoDB\Driver\ReadPreference): Read preference.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * typeMap (array): Type map for BSON deserialization.
     *
     * @param string       $databaseName   Database name
     * @param string       $collectionName Collection name
     * @param string       $fieldName      Field for which to return distinct values
     * @param array|object $filter         Query by which to filter documents
     * @param array        $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, string $fieldName, $filter = [], array $options = [])
=======
    public function __construct($databaseName, $collectionName, $fieldName, $filter = [], array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (! is_array($filter) && ! is_object($filter)) {
            throw InvalidArgumentException::invalidType('$filter', $filter, 'array or object');
        }

        if (isset($options['collation']) && ! is_array($options['collation']) && ! is_object($options['collation'])) {
            throw InvalidArgumentException::invalidType('"collation" option', $options['collation'], 'array or object');
        }

        if (isset($options['maxTimeMS']) && ! is_integer($options['maxTimeMS'])) {
            throw InvalidArgumentException::invalidType('"maxTimeMS" option', $options['maxTimeMS'], 'integer');
        }

        if (isset($options['readConcern']) && ! $options['readConcern'] instanceof ReadConcern) {
            throw InvalidArgumentException::invalidType('"readConcern" option', $options['readConcern'], ReadConcern::class);
        }

        if (isset($options['readPreference']) && ! $options['readPreference'] instanceof ReadPreference) {
            throw InvalidArgumentException::invalidType('"readPreference" option', $options['readPreference'], ReadPreference::class);
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['typeMap']) && ! is_array($options['typeMap'])) {
            throw InvalidArgumentException::invalidType('"typeMap" option', $options['typeMap'], 'array');
        }

        if (isset($options['readConcern']) && $options['readConcern']->isDefault()) {
            unset($options['readConcern']);
        }

<<<<<<< HEAD
        $this->databaseName = $databaseName;
        $this->collectionName = $collectionName;
        $this->fieldName = $fieldName;
=======
        $this->databaseName = (string) $databaseName;
        $this->collectionName = (string) $collectionName;
        $this->fieldName = (string) $fieldName;
>>>>>>> forked/LAE_400_PACKAGE
        $this->filter = $filter;
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @return array
     * @throws UnexpectedValueException if the command response was malformed
     * @throws UnsupportedException if read concern is used and unsupported
=======
     * @param Server $server
     * @return mixed[]
     * @throws UnexpectedValueException if the command response was malformed
     * @throws UnsupportedException if collation or read concern is used and unsupported
>>>>>>> forked/LAE_400_PACKAGE
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
<<<<<<< HEAD
=======
        if (isset($this->options['collation']) && ! server_supports_feature($server, self::$wireVersionForCollation)) {
            throw UnsupportedException::collationNotSupported();
        }

        if (isset($this->options['readConcern']) && ! server_supports_feature($server, self::$wireVersionForReadConcern)) {
            throw UnsupportedException::readConcernNotSupported();
        }

>>>>>>> forked/LAE_400_PACKAGE
        $inTransaction = isset($this->options['session']) && $this->options['session']->isInTransaction();
        if ($inTransaction && isset($this->options['readConcern'])) {
            throw UnsupportedException::readConcernNotSupportedInTransaction();
        }

        $cursor = $server->executeReadCommand($this->databaseName, new Command($this->createCommandDocument()), $this->createOptions());

        if (isset($this->options['typeMap'])) {
            $cursor->setTypeMap(create_field_path_type_map($this->options['typeMap'], 'values.$'));
        }

        $result = current($cursor->toArray());

<<<<<<< HEAD
        if (! is_object($result) || ! isset($result->values) || ! is_array($result->values)) {
=======
        if (! isset($result->values) || ! is_array($result->values)) {
>>>>>>> forked/LAE_400_PACKAGE
            throw new UnexpectedValueException('distinct command did not return a "values" array');
        }

        return $result->values;
    }

<<<<<<< HEAD
    /**
     * Returns the command document for this operation.
     *
     * @see Explainable::getCommandDocument()
     * @return array
     */
=======
>>>>>>> forked/LAE_400_PACKAGE
    public function getCommandDocument(Server $server)
    {
        return $this->createCommandDocument();
    }

    /**
     * Create the distinct command document.
<<<<<<< HEAD
     */
    private function createCommandDocument(): array
=======
     *
     * @return array
     */
    private function createCommandDocument()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $cmd = [
            'distinct' => $this->collectionName,
            'key' => $this->fieldName,
        ];

        if (! empty($this->filter)) {
            $cmd['query'] = (object) $this->filter;
        }

        if (isset($this->options['collation'])) {
            $cmd['collation'] = (object) $this->options['collation'];
        }

<<<<<<< HEAD
        foreach (['comment', 'maxTimeMS'] as $option) {
            if (isset($this->options[$option])) {
                $cmd[$option] = $this->options[$option];
            }
=======
        if (isset($this->options['maxTimeMS'])) {
            $cmd['maxTimeMS'] = $this->options['maxTimeMS'];
>>>>>>> forked/LAE_400_PACKAGE
        }

        return $cmd;
    }

    /**
     * Create options for executing the command.
     *
<<<<<<< HEAD
     * @see https://php.net/manual/en/mongodb-driver-server.executereadcommand.php
     */
    private function createOptions(): array
=======
     * @see http://php.net/manual/en/mongodb-driver-server.executereadcommand.php
     * @return array
     */
    private function createOptions()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $options = [];

        if (isset($this->options['readConcern'])) {
            $options['readConcern'] = $this->options['readConcern'];
        }

        if (isset($this->options['readPreference'])) {
            $options['readPreference'] = $this->options['readPreference'];
        }

        if (isset($this->options['session'])) {
            $options['session'] = $this->options['session'];
        }

        return $options;
    }
}
