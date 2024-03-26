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
use MongoDB\Driver\Server;
use MongoDB\Driver\Session;
use MongoDB\Driver\WriteConcern;
use MongoDB\Exception\InvalidArgumentException;
<<<<<<< HEAD

=======
use MongoDB\Exception\UnsupportedException;
>>>>>>> forked/LAE_400_PACKAGE
use function current;
use function is_array;
use function is_bool;
use function is_integer;
use function is_object;
use function is_string;
<<<<<<< HEAD
use function sprintf;
use function trigger_error;

=======
use function MongoDB\server_supports_feature;
use function trigger_error;
>>>>>>> forked/LAE_400_PACKAGE
use const E_USER_DEPRECATED;

/**
 * Operation for the create command.
 *
 * @api
 * @see \MongoDB\Database::createCollection()
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/create/
 */
class CreateCollection implements Executable
{
    public const USE_POWER_OF_2_SIZES = 1;
    public const NO_PADDING = 2;
=======
 * @see http://docs.mongodb.org/manual/reference/command/create/
 */
class CreateCollection implements Executable
{
    const USE_POWER_OF_2_SIZES = 1;
    const NO_PADDING = 2;

    /** @var integer */
    private static $wireVersionForCollation = 5;

    /** @var integer */
    private static $wireVersionForWriteConcern = 5;
>>>>>>> forked/LAE_400_PACKAGE

    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array */
    private $options = [];

    /**
     * Constructs a create command.
     *
     * Supported options:
     *
     *  * autoIndexId (boolean): Specify false to disable the automatic creation
     *    of an index on the _id field. For replica sets, this option cannot be
     *    false. The default is true.
     *
     *    This option has been deprecated since MongoDB 3.2. As of MongoDB 4.0,
     *    this option cannot be false when creating a replicated collection
     *    (i.e. a collection outside of the local database in any mongod mode).
     *
     *  * capped (boolean): Specify true to create a capped collection. If set,
     *    the size option must also be specified. The default is false.
     *
<<<<<<< HEAD
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
     *
     *  * changeStreamPreAndPostImages (document): Used to configure support for
     *    pre- and post-images in change streams.
     *
     *    This is not supported for server versions < 6.0.
     *
     *  * clusteredIndex (document): A clustered index specification.
     *
     *    This is not supported for server versions < 5.3.
     *
     *  * collation (document): Collation specification.
     *
     *  * encryptedFields (document): CSFLE specification.
     *
     *  * expireAfterSeconds: The TTL for documents in time series collections.
     *
     *    This is not supported for servers versions < 5.0.
=======
     *  * collation (document): Collation specification.
     *
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * flags (integer): Options for the MMAPv1 storage engine only. Must be a
     *    bitwise combination CreateCollection::USE_POWER_OF_2_SIZES and
     *    CreateCollection::NO_PADDING. The default is
     *    CreateCollection::USE_POWER_OF_2_SIZES.
     *
     *  * indexOptionDefaults (document): Default configuration for indexes when
     *    creating the collection.
     *
     *  * max (integer): The maximum number of documents allowed in the capped
     *    collection. The size option takes precedence over this limit.
     *
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
<<<<<<< HEAD
     *  * pipeline (array): An array that consists of the aggregation pipeline
     *    stage(s), which will be applied to the collection or view specified by
     *    viewOn.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
=======
     *  * session (MongoDB\Driver\Session): Client session.
     *
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * size (integer): The maximum number of bytes for a capped collection.
     *
     *  * storageEngine (document): Storage engine options.
     *
<<<<<<< HEAD
     *  * timeseries (document): Options for time series collections.
     *
     *    This is not supported for servers versions < 5.0.
     *
=======
>>>>>>> forked/LAE_400_PACKAGE
     *  * typeMap (array): Type map for BSON deserialization. This will only be
     *    used for the returned command result document.
     *
     *  * validationAction (string): Validation action.
     *
     *  * validationLevel (string): Validation level.
     *
     *  * validator (document): Validation rules or expressions.
     *
<<<<<<< HEAD
     *  * viewOn (string): The name of the source collection or view from which
     *    to create the view.
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     * @see https://source.wiredtiger.com/2.4.1/struct_w_t___s_e_s_s_i_o_n.html#a358ca4141d59c345f401c58501276bbb
     * @see https://mongodb.com/docs/manual/core/schema-validation/
=======
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
     *
     * @see http://source.wiredtiger.com/2.4.1/struct_w_t___s_e_s_s_i_o_n.html#a358ca4141d59c345f401c58501276bbb
     * @see https://docs.mongodb.org/manual/core/document-validation/
>>>>>>> forked/LAE_400_PACKAGE
     * @param string $databaseName   Database name
     * @param string $collectionName Collection name
     * @param array  $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, array $options = [])
=======
    public function __construct($databaseName, $collectionName, array $options = [])
>>>>>>> forked/LAE_400_PACKAGE
    {
        if (isset($options['autoIndexId']) && ! is_bool($options['autoIndexId'])) {
            throw InvalidArgumentException::invalidType('"autoIndexId" option', $options['autoIndexId'], 'boolean');
        }

        if (isset($options['capped']) && ! is_bool($options['capped'])) {
            throw InvalidArgumentException::invalidType('"capped" option', $options['capped'], 'boolean');
        }

<<<<<<< HEAD
        if (isset($options['changeStreamPreAndPostImages']) && ! is_array($options['changeStreamPreAndPostImages']) && ! is_object($options['changeStreamPreAndPostImages'])) {
            throw InvalidArgumentException::invalidType('"changeStreamPreAndPostImages" option', $options['changeStreamPreAndPostImages'], 'array or object');
        }

        if (isset($options['clusteredIndex']) && ! is_array($options['clusteredIndex']) && ! is_object($options['clusteredIndex'])) {
            throw InvalidArgumentException::invalidType('"clusteredIndex" option', $options['clusteredIndex'], 'array or object');
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['collation']) && ! is_array($options['collation']) && ! is_object($options['collation'])) {
            throw InvalidArgumentException::invalidType('"collation" option', $options['collation'], 'array or object');
        }

<<<<<<< HEAD
        if (isset($options['encryptedFields']) && ! is_array($options['encryptedFields']) && ! is_object($options['encryptedFields'])) {
            throw InvalidArgumentException::invalidType('"encryptedFields" option', $options['encryptedFields'], 'array or object');
        }

        if (isset($options['expireAfterSeconds']) && ! is_integer($options['expireAfterSeconds'])) {
            throw InvalidArgumentException::invalidType('"expireAfterSeconds" option', $options['expireAfterSeconds'], 'integer');
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['flags']) && ! is_integer($options['flags'])) {
            throw InvalidArgumentException::invalidType('"flags" option', $options['flags'], 'integer');
        }

        if (isset($options['indexOptionDefaults']) && ! is_array($options['indexOptionDefaults']) && ! is_object($options['indexOptionDefaults'])) {
            throw InvalidArgumentException::invalidType('"indexOptionDefaults" option', $options['indexOptionDefaults'], 'array or object');
        }

        if (isset($options['max']) && ! is_integer($options['max'])) {
            throw InvalidArgumentException::invalidType('"max" option', $options['max'], 'integer');
        }

        if (isset($options['maxTimeMS']) && ! is_integer($options['maxTimeMS'])) {
            throw InvalidArgumentException::invalidType('"maxTimeMS" option', $options['maxTimeMS'], 'integer');
        }

<<<<<<< HEAD
        if (isset($options['pipeline']) && ! is_array($options['pipeline'])) {
            throw InvalidArgumentException::invalidType('"pipeline" option', $options['pipeline'], 'array');
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['size']) && ! is_integer($options['size'])) {
            throw InvalidArgumentException::invalidType('"size" option', $options['size'], 'integer');
        }

        if (isset($options['storageEngine']) && ! is_array($options['storageEngine']) && ! is_object($options['storageEngine'])) {
            throw InvalidArgumentException::invalidType('"storageEngine" option', $options['storageEngine'], 'array or object');
        }

<<<<<<< HEAD
        if (isset($options['timeseries']) && ! is_array($options['timeseries']) && ! is_object($options['timeseries'])) {
            throw InvalidArgumentException::invalidType('"timeseries" option', $options['timeseries'], ['array', 'object']);
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['typeMap']) && ! is_array($options['typeMap'])) {
            throw InvalidArgumentException::invalidType('"typeMap" option', $options['typeMap'], 'array');
        }

        if (isset($options['validationAction']) && ! is_string($options['validationAction'])) {
            throw InvalidArgumentException::invalidType('"validationAction" option', $options['validationAction'], 'string');
        }

        if (isset($options['validationLevel']) && ! is_string($options['validationLevel'])) {
            throw InvalidArgumentException::invalidType('"validationLevel" option', $options['validationLevel'], 'string');
        }

        if (isset($options['validator']) && ! is_array($options['validator']) && ! is_object($options['validator'])) {
            throw InvalidArgumentException::invalidType('"validator" option', $options['validator'], 'array or object');
        }

<<<<<<< HEAD
        if (isset($options['viewOn']) && ! is_string($options['viewOn'])) {
            throw InvalidArgumentException::invalidType('"viewOn" option', $options['viewOn'], 'string');
        }

=======
>>>>>>> forked/LAE_400_PACKAGE
        if (isset($options['writeConcern']) && ! $options['writeConcern'] instanceof WriteConcern) {
            throw InvalidArgumentException::invalidType('"writeConcern" option', $options['writeConcern'], WriteConcern::class);
        }

        if (isset($options['writeConcern']) && $options['writeConcern']->isDefault()) {
            unset($options['writeConcern']);
        }

        if (isset($options['autoIndexId'])) {
            trigger_error('The "autoIndexId" option is deprecated and will be removed in a future release', E_USER_DEPRECATED);
        }

<<<<<<< HEAD
        if (isset($options['pipeline'])) {
            $expectedIndex = 0;

            foreach ($options['pipeline'] as $i => $operation) {
                if ($i !== $expectedIndex) {
                    throw new InvalidArgumentException(sprintf('The "pipeline" option is not a list (unexpected index: "%s")', $i));
                }

                if (! is_array($operation) && ! is_object($operation)) {
                    throw InvalidArgumentException::invalidType(sprintf('$options["pipeline"][%d]', $i), $operation, 'array or object');
                }

                $expectedIndex += 1;
            }
        }

        $this->databaseName = $databaseName;
        $this->collectionName = $collectionName;
=======
        $this->databaseName = (string) $databaseName;
        $this->collectionName = (string) $collectionName;
>>>>>>> forked/LAE_400_PACKAGE
        $this->options = $options;
    }

    /**
     * Execute the operation.
     *
     * @see Executable::execute()
<<<<<<< HEAD
     * @return array|object Command result document
=======
     * @param Server $server
     * @return array|object Command result document
     * @throws UnsupportedException if collation or write concern is used and unsupported
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

        if (isset($this->options['writeConcern']) && ! server_supports_feature($server, self::$wireVersionForWriteConcern)) {
            throw UnsupportedException::writeConcernNotSupported();
        }

>>>>>>> forked/LAE_400_PACKAGE
        $cursor = $server->executeWriteCommand($this->databaseName, $this->createCommand(), $this->createOptions());

        if (isset($this->options['typeMap'])) {
            $cursor->setTypeMap($this->options['typeMap']);
        }

        return current($cursor->toArray());
    }

    /**
     * Create the create command.
<<<<<<< HEAD
     */
    private function createCommand(): Command
    {
        $cmd = ['create' => $this->collectionName];

        foreach (['autoIndexId', 'capped', 'comment', 'expireAfterSeconds', 'flags', 'max', 'maxTimeMS', 'pipeline', 'size', 'validationAction', 'validationLevel', 'viewOn'] as $option) {
=======
     *
     * @return Command
     */
    private function createCommand()
    {
        $cmd = ['create' => $this->collectionName];

        foreach (['autoIndexId', 'capped', 'flags', 'max', 'maxTimeMS', 'size', 'validationAction', 'validationLevel'] as $option) {
>>>>>>> forked/LAE_400_PACKAGE
            if (isset($this->options[$option])) {
                $cmd[$option] = $this->options[$option];
            }
        }

<<<<<<< HEAD
        foreach (['changeStreamPreAndPostImages', 'clusteredIndex', 'collation', 'encryptedFields', 'indexOptionDefaults', 'storageEngine', 'timeseries', 'validator'] as $option) {
=======
        foreach (['collation', 'indexOptionDefaults', 'storageEngine', 'validator'] as $option) {
>>>>>>> forked/LAE_400_PACKAGE
            if (isset($this->options[$option])) {
                $cmd[$option] = (object) $this->options[$option];
            }
        }

        return new Command($cmd);
    }

    /**
     * Create options for executing the command.
     *
<<<<<<< HEAD
     * @see https://php.net/manual/en/mongodb-driver-server.executewritecommand.php
     */
    private function createOptions(): array
=======
     * @see http://php.net/manual/en/mongodb-driver-server.executewritecommand.php
     * @return array
     */
    private function createOptions()
>>>>>>> forked/LAE_400_PACKAGE
    {
        $options = [];

        if (isset($this->options['session'])) {
            $options['session'] = $this->options['session'];
        }

        if (isset($this->options['writeConcern'])) {
            $options['writeConcern'] = $this->options['writeConcern'];
        }

        return $options;
    }
}
