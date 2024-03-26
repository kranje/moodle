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
use MongoDB\Exception\UnexpectedValueException;
use MongoDB\Exception\UnsupportedException;
<<<<<<< HEAD

use function array_key_exists;
=======
>>>>>>> forked/LAE_400_PACKAGE
use function current;
use function is_array;
use function is_bool;
use function is_integer;
use function is_object;
use function is_string;
use function MongoDB\create_field_path_type_map;
use function MongoDB\is_pipeline;
<<<<<<< HEAD
use function MongoDB\is_write_concern_acknowledged;
=======
>>>>>>> forked/LAE_400_PACKAGE
use function MongoDB\server_supports_feature;

/**
 * Operation for the findAndModify command.
 *
 * This class is used internally by the FindOneAndDelete, FindOneAndReplace, and
 * FindOneAndUpdate operation classes.
 *
 * @internal
<<<<<<< HEAD
 * @see https://mongodb.com/docs/manual/reference/command/findAndModify/
=======
 * @see http://docs.mongodb.org/manual/reference/command/findAndModify/
>>>>>>> forked/LAE_400_PACKAGE
 */
class FindAndModify implements Executable, Explainable
{
    /** @var integer */
<<<<<<< HEAD
    private static $wireVersionForHint = 9;

    /** @var integer */
    private static $wireVersionForUnsupportedOptionServerSideError = 8;
=======
    private static $wireVersionForArrayFilters = 6;

    /** @var integer */
    private static $wireVersionForCollation = 5;

    /** @var integer */
    private static $wireVersionForDocumentLevelValidation = 4;

    /** @var integer */
    private static $wireVersionForHint = 9;

    /** @var integer */
    private static $wireVersionForHintServerSideError = 8;

    /** @var integer */
    private static $wireVersionForWriteConcern = 4;
>>>>>>> forked/LAE_400_PACKAGE

    /** @var string */
    private $databaseName;

    /** @var string */
    private $collectionName;

    /** @var array */
    private $options;

    /**
     * Constructs a findAndModify command.
     *
     * Supported options:
     *
     *  * arrayFilters (document array): A set of filters specifying to which
     *    array elements an update should apply.
     *
<<<<<<< HEAD
     *  * collation (document): Collation specification.
     *
     *  * comment (mixed): BSON value to attach as a comment to this command.
     *
     *    This is not supported for servers versions < 4.4.
=======
     *    This is not supported for server versions < 3.6 and will result in an
     *    exception at execution time if used.
     *
     *  * collation (document): Collation specification.
     *
     *    This is not supported for server versions < 3.4 and will result in an
     *    exception at execution time if used.
>>>>>>> forked/LAE_400_PACKAGE
     *
     *  * bypassDocumentValidation (boolean): If true, allows the write to
     *    circumvent document level validation.
     *
<<<<<<< HEAD
=======
     *    For servers < 3.2, this option is ignored as document level validation
     *    is not available.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * fields (document): Limits the fields to return for the matching
     *    document.
     *
     *  * hint (string|document): The index to use. Specify either the index
     *    name as a string or the index key pattern as a document. If specified,
     *    then the query system will only consider plans using the hinted index.
     *
     *    This is only supported on server versions >= 4.4. Using this option in
     *    other contexts will result in an exception at execution time.
     *
     *  * maxTimeMS (integer): The maximum amount of time to allow the query to
     *    run.
     *
     *  * new (boolean): When true, returns the modified document rather than
     *    the original. This option is ignored for remove operations. The
     *    The default is false.
     *
     *  * query (document): Query by which to filter documents.
     *
     *  * remove (boolean): When true, removes the matched document. This option
     *    cannot be true if the update option is set. The default is false.
     *
     *  * session (MongoDB\Driver\Session): Client session.
     *
<<<<<<< HEAD
=======
     *    Sessions are not supported for server versions < 3.6.
     *
>>>>>>> forked/LAE_400_PACKAGE
     *  * sort (document): Determines which document the operation modifies if
     *    the query selects multiple documents.
     *
     *  * typeMap (array): Type map for BSON deserialization.
     *
     *  * update (document): Update or replacement to apply to the matched
     *    document. This option cannot be set if the remove option is true.
     *
     *  * upsert (boolean): When true, a new document is created if no document
     *    matches the query. This option is ignored for remove operations. The
     *    default is false.
     *
<<<<<<< HEAD
     *  * let (document): Map of parameter names and values. Values must be
     *    constant or closed expressions that do not reference document fields.
     *    Parameters can then be accessed as variables in an aggregate
     *    expression context (e.g. "$$var").
     *
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
=======
     *  * writeConcern (MongoDB\Driver\WriteConcern): Write concern.
     *
     *    This is not supported for server versions < 3.2 and will result in an
     *    exception at execution time if used.
     *
>>>>>>> forked/LAE_400_PACKAGE
     * @param string $databaseName   Database name
     * @param string $collectionName Collection name
     * @param array  $options        Command options
     * @throws InvalidArgumentException for parameter/option parsing errors
     */
<<<<<<< HEAD
    public function __construct(string $databaseName, string $collectionName, array $options)
    {
        $options += ['remove' => false];
=======
    public function __construct($databaseName, $collectionName, array $options)
    {
        $options += [
            'new' => false,
            'remove' => false,
            'upsert' => false,
        ];
>>>>>>> forked/LAE_400_PACKAGE

        if (isset($options['arrayFilters']) && ! is_array($options['arrayFilters'])) {
            throw InvalidArgumentException::invalidType('"arrayFilters" option', $options['arrayFilters'], 'array');
        }

        if (isset($options['bypassDocumentValidation']) && ! is_bool($options['bypassDocumentValidation'])) {
            throw InvalidArgumentException::invalidType('"bypassDocumentValidation" option', $options['bypassDocumentValidation'], 'boolean');
        }

        if (isset($options['collation']) && ! is_array($options['collation']) && ! is_object($options['collation'])) {
            throw InvalidArgumentException::invalidType('"collation" option', $options['collation'], 'array or object');
        }

        if (isset($options['fields']) && ! is_array($options['fields']) && ! is_object($options['fields'])) {
            throw InvalidArgumentException::invalidType('"fields" option', $options['fields'], 'array or object');
        }

        if (isset($options['hint']) && ! is_string($options['hint']) && ! is_array($options['hint']) && ! is_object($options['hint'])) {
            throw InvalidArgumentException::invalidType('"hint" option', $options['hint'], ['string', 'array', 'object']);
        }

        if (isset($options['maxTimeMS']) && ! is_integer($options['maxTimeMS'])) {
            throw InvalidArgumentException::invalidType('"maxTimeMS" option', $options['maxTimeMS'], 'integer');
        }

<<<<<<< HEAD
        if (array_key_exists('new', $options) && ! is_bool($options['new'])) {
=======
        if (! is_bool($options['new'])) {
>>>>>>> forked/LAE_400_PACKAGE
            throw InvalidArgumentException::invalidType('"new" option', $options['new'], 'boolean');
        }

        if (isset($options['query']) && ! is_array($options['query']) && ! is_object($options['query'])) {
            throw InvalidArgumentException::invalidType('"query" option', $options['query'], 'array or object');
        }

        if (! is_bool($options['remove'])) {
            throw InvalidArgumentException::invalidType('"remove" option', $options['remove'], 'boolean');
        }

        if (isset($options['session']) && ! $options['session'] instanceof Session) {
            throw InvalidArgumentException::invalidType('"session" option', $options['session'], Session::class);
        }

        if (isset($options['sort']) && ! is_array($options['sort']) && ! is_object($options['sort'])) {
            throw InvalidArgumentException::invalidType('"sort" option', $options['sort'], 'array or object');
        }

        if (isset($options['typeMap']) && ! is_array($options['typeMap'])) {
            throw InvalidArgumentException::invalidType('"typeMap" option', $options['typeMap'], 'array');
        }

        if (isset($options['update']) && ! is_array($options['update']) && ! is_object($options['update'])) {
            throw InvalidArgumentException::invalidType('"update" option', $options['update'], 'array or object');
        }

        if (isset($options['writeConcern']) && ! $options['writeConcern'] instanceof WriteConcern) {
            throw InvalidArgumentException::invalidType('"writeConcern" option', $options['writeConcern'], WriteConcern::class);
        }

<<<<<<< HEAD
        if (array_key_exists('upsert', $options) && ! is_bool($options['upsert'])) {
            throw InvalidArgumentException::invalidType('"upsert" option', $options['upsert'], 'boolean');
        }

        if (isset($options['let']) && ! is_array($options['let']) && ! is_object($options['let'])) {
            throw InvalidArgumentException::invalidType('"let" option', $options['let'], 'array or object');
        }

        if (isset($options['bypassDocumentValidation']) && ! $options['bypassDocumentValidation']) {
            unset($options['bypassDocumentValidation']);
        }

=======
        if (! is_bool($options['upsert'])) {
            throw InvalidArgumentException::invalidType('"upsert" option', $options['upsert'], 'boolean');
        }

>>>>>>> forked/LAE_400_PACKAGE
        if (! (isset($options['update']) xor $options['remove'])) {
            throw new InvalidArgumentException('The "remove" option must be true or an "update" document must be specified, but not both');
        }

        if (isset($options['writeConcern']) && $options['writeConcern']->isDefault()) {
            unset($options['writeConcern']);
        }

<<<<<<< HEAD
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
     * @return array|object|null
     * @throws UnexpectedValueException if the command response was malformed
     * @throws UnsupportedException if hint or write concern is used and unsupported
=======
     * @param Server $server
     * @return array|object|null
     * @throws UnexpectedValueException if the command response was malformed
     * @throws UnsupportedException if array filters, collation, or write concern is used and unsupported
>>>>>>> forked/LAE_400_PACKAGE
     * @throws DriverRuntimeException for other driver errors (e.g. connection errors)
     */
    public function execute(Server $server)
    {
<<<<<<< HEAD
        /* Server versions >= 4.2.0 raise errors for unsupported update options.
         * For previous versions, the CRUD spec requires a client-side error. */
        if (isset($this->options['hint']) && ! server_supports_feature($server, self::$wireVersionForUnsupportedOptionServerSideError)) {
            throw UnsupportedException::hintNotSupported();
        }

        /* CRUD spec requires a client-side error when using "hint" with an
         * unacknowledged write concern on an unsupported server. */
        if (
            isset($this->options['writeConcern']) && ! is_write_concern_acknowledged($this->options['writeConcern']) &&
            isset($this->options['hint']) && ! server_supports_feature($server, self::$wireVersionForHint)
        ) {
            throw UnsupportedException::hintNotSupported();
=======
        if (isset($this->options['arrayFilters']) && ! server_supports_feature($server, self::$wireVersionForArrayFilters)) {
            throw UnsupportedException::arrayFiltersNotSupported();
        }

        if (isset($this->options['collation']) && ! server_supports_feature($server, self::$wireVersionForCollation)) {
            throw UnsupportedException::collationNotSupported();
        }

        /* Server versions >= 4.1.10 raise errors for unknown findAndModify
         * options (SERVER-40005), but the CRUD spec requires client-side errors
         * for server versions < 4.2. For later versions, we'll rely on the
         * server to either utilize the option or report its own error. */
        if (isset($this->options['hint']) && ! $this->isHintSupported($server)) {
            throw UnsupportedException::hintNotSupported();
        }

        if (isset($this->options['writeConcern']) && ! server_supports_feature($server, self::$wireVersionForWriteConcern)) {
            throw UnsupportedException::writeConcernNotSupported();
>>>>>>> forked/LAE_400_PACKAGE
        }

        $inTransaction = isset($this->options['session']) && $this->options['session']->isInTransaction();
        if ($inTransaction && isset($this->options['writeConcern'])) {
            throw UnsupportedException::writeConcernNotSupportedInTransaction();
        }

<<<<<<< HEAD
        $cursor = $server->executeWriteCommand($this->databaseName, new Command($this->createCommandDocument()), $this->createOptions());
=======
        $cursor = $server->executeWriteCommand($this->databaseName, new Command($this->createCommandDocument($server)), $this->createOptions());
>>>>>>> forked/LAE_400_PACKAGE

        if (isset($this->options['typeMap'])) {
            $cursor->setTypeMap(create_field_path_type_map($this->options['typeMap'], 'value'));
        }

        $result = current($cursor->toArray());

<<<<<<< HEAD
        return is_object($result) ? ($result->value ?? null) : null;
    }

    /**
     * Returns the command document for this operation.
     *
     * @see Explainable::getCommandDocument()
     * @return array
     */
    public function getCommandDocument(Server $server)
    {
        return $this->createCommandDocument();
=======
        return $result->value ?? null;
    }

    public function getCommandDocument(Server $server)
    {
        return $this->createCommandDocument($server);
>>>>>>> forked/LAE_400_PACKAGE
    }

    /**
     * Create the findAndModify command document.
<<<<<<< HEAD
     */
    private function createCommandDocument(): array
=======
     *
     * @param Server $server
     * @return array
     */
    private function createCommandDocument(Server $server)
>>>>>>> forked/LAE_400_PACKAGE
    {
        $cmd = ['findAndModify' => $this->collectionName];

        if ($this->options['remove']) {
            $cmd['remove'] = true;
        } else {
<<<<<<< HEAD
            if (isset($this->options['new'])) {
                $cmd['new'] = $this->options['new'];
            }

            if (isset($this->options['upsert'])) {
                $cmd['upsert'] = $this->options['upsert'];
            }
        }

        foreach (['collation', 'fields', 'let', 'query', 'sort'] as $option) {
=======
            $cmd['new'] = $this->options['new'];
            $cmd['upsert'] = $this->options['upsert'];
        }

        foreach (['collation', 'fields', 'query', 'sort'] as $option) {
>>>>>>> forked/LAE_400_PACKAGE
            if (isset($this->options[$option])) {
                $cmd[$option] = (object) $this->options[$option];
            }
        }

        if (isset($this->options['update'])) {
            $cmd['update'] = is_pipeline($this->options['update'])
                ? $this->options['update']
                : (object) $this->options['update'];
        }

<<<<<<< HEAD
        foreach (['arrayFilters', 'bypassDocumentValidation', 'comment', 'hint', 'maxTimeMS'] as $option) {
=======
        foreach (['arrayFilters', 'hint', 'maxTimeMS'] as $option) {
>>>>>>> forked/LAE_400_PACKAGE
            if (isset($this->options[$option])) {
                $cmd[$option] = $this->options[$option];
            }
        }

<<<<<<< HEAD
=======
        if (! empty($this->options['bypassDocumentValidation']) &&
            server_supports_feature($server, self::$wireVersionForDocumentLevelValidation)
        ) {
            $cmd['bypassDocumentValidation'] = $this->options['bypassDocumentValidation'];
        }

>>>>>>> forked/LAE_400_PACKAGE
        return $cmd;
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
<<<<<<< HEAD
=======

    private function isAcknowledgedWriteConcern() : bool
    {
        if (! isset($this->options['writeConcern'])) {
            return true;
        }

        return $this->options['writeConcern']->getW() > 1 || $this->options['writeConcern']->getJournal();
    }

    private function isHintSupported(Server $server) : bool
    {
        $requiredWireVersion = $this->isAcknowledgedWriteConcern() ? self::$wireVersionForHintServerSideError : self::$wireVersionForHint;

        return server_supports_feature($server, $requiredWireVersion);
    }
>>>>>>> forked/LAE_400_PACKAGE
}
