<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseKnownWords extends ApplicationModel {

	const WID = 'knownWords.wid';
	const PID = 'knownWords.pid';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'knownWords';

	/**
	 * Cache of objects retrieved from the database
	 * @var KnownWords[]
	 */
	protected static $_instancePool = array();

	protected static $_instancePoolCount = 0;

	protected static $_poolEnabled = true;

	/**
	 * Array of all primary keys
	 * @var string[]
	 */
	protected static $_primaryKeys = array(
		'wid',
		'pid',
	);

	/**
	 * string name of the primary key column
	 * @var string
	 */
	protected static $_primaryKey = '';

	/**
	 * true if primary key is an auto-increment column
	 * @var bool
	 */
	protected static $_isAutoIncrement = false;

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'wid',
		'pid',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'wid' => Model::COLUMN_TYPE_INTEGER,
		'pid' => Model::COLUMN_TYPE_INTEGER,
	);

	/**
	 * `wid` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $wid;

	/**
	 * `pid` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $pid;

	/**
	 * Gets the value of the wid field
	 */
	function getWid() {
		return $this->wid;
	}

	/**
	 * Sets the value of the wid field
	 * @return KnownWords
	 */
	function setWid($value) {
		return $this->setColumnValue('wid', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the pid field
	 */
	function getPid() {
		return $this->pid;
	}

	/**
	 * Sets the value of the pid field
	 * @return KnownWords
	 */
	function setPid($value) {
		return $this->setColumnValue('pid', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_connection');
	}

	/**
	 * @return KnownWords
	 */
	static function create() {
		return new KnownWords();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return KnownWords::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return KnownWords::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return KnownWords::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return KnownWords::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', KnownWords::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return KnownWords::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return KnownWords::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return KnownWords::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return KnownWords
	 */
	static function retrieveByPK($the_pk) {
		throw new Exception('This table has more than one primary key.  Use retrieveByPKs() instead.');
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return KnownWords
	 */
	static function retrieveByPKs($wid, $pid) {
		if (null === $wid) {
			return null;
		}
		if (null === $pid) {
			return null;
		}
		$args = func_get_args();
		if (KnownWords::$_poolEnabled) {
			$pool_instance = KnownWords::retrieveFromPool(implode('-', $args));
			if (null !== $pool_instance) {
				return $pool_instance;
			}
		}
		$conn = KnownWords::getConnection();
		$q = new Query;
		$q->add('wid', $wid);
		$q->add('pid', $pid);
		$records = KnownWords::doSelect($q);
		return array_shift($records);
	}

	/**
	 * Searches the database for a row with a wid
	 * value that matches the one provided
	 * @return KnownWords
	 */
	static function retrieveByWid($value) {
		return KnownWords::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a pid
	 * value that matches the one provided
	 * @return KnownWords
	 */
	static function retrieveByPid($value) {
		return KnownWords::retrieveByPK($value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = KnownWords::getConnection();
		$q = Query::create()->add($field, $value)->setLimit(1);
		$records = KnownWords::doSelect($q);
		return array_shift($records);
	}

	/**
	 * Populates and returns an instance of KnownWords with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return KnownWords
	 */
	static function fetchSingle($query_string) {
		$records = KnownWords::fetch($query_string);
		return array_shift($records);
	}

	/**
	 * Populates and returns an array of KnownWords objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return KnownWords[]
	 */
	static function fetch($query_string) {
		$conn = KnownWords::getConnection();
		$result = $conn->query($query_string);
		return KnownWords::fromResult($result, 'KnownWords');
	}

	/**
	 * Returns an array of KnownWords objects from
	 * a PDOStatement(query result).
	 *
	 * @see Model::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'KnownWords', $use_pool = null) {
		if (null === $use_pool) {
			$use_pool = KnownWords::$_poolEnabled;
		}
		return Model::fromResult($result, $class, $use_pool);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return KnownWords
	 */
	function castInts() {
		$this->wid = (null === $this->wid) ? null : (int) $this->wid;
		$this->pid = (null === $this->pid) ? null : (int) $this->pid;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param KnownWords $object
	 * @return void
	 */
	static function insertIntoPool(KnownWords $object) {
		if (!KnownWords::$_poolEnabled) {
			return;
		}
		if (KnownWords::$_instancePoolCount > KnownWords::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		KnownWords::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = $object;
		++KnownWords::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return KnownWords
	 */
	static function retrieveFromPool($pk) {
		if (!KnownWords::$_poolEnabled || null === $pk) {
			return null;
		}
		if (array_key_exists($pk, KnownWords::$_instancePool)) {
			return KnownWords::$_instancePool[$pk];
		}

		return null;
	}

	/**
	 * Remove the object from the instance pool.
	 *
	 * @param mixed $object Object or PK to remove
	 * @return void
	 */
	static function removeFromPool($object) {
		$pk = is_object($object) ? implode('-', $object->getPrimaryKeyValues()) : $object;

		if (array_key_exists($pk, KnownWords::$_instancePool)) {
			unset(KnownWords::$_instancePool[$pk]);
			--KnownWords::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		KnownWords::$_instancePool = array();
	}

	static function setPoolEnabled($bool = true) {
		KnownWords::$_poolEnabled = $bool;
	}

	static function getPoolEnabled() {
		return KnownWords::$_poolEnabled;
	}

	/**
	 * Returns an array of all KnownWords objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return KnownWords[]
	 */
	static function getAll($extra = null) {
		$conn = KnownWords::getConnection();
		$table_quoted = $conn->quoteIdentifier(KnownWords::getTableName());
		return KnownWords::fetch("SELECT * FROM $table_quoted $extra ");
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = KnownWords::getConnection();
		if (!$q->getTable() || KnownWords::getTableName() != $q->getTable()) {
			$q->setTable(KnownWords::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $flush_pool
	 * @return int
	 */
	static function doDelete(Query $q, $flush_pool = true) {
		$conn = KnownWords::getConnection();
		$q = clone $q;
		if (!$q->getTable() || KnownWords::getTableName() != $q->getTable()) {
			$q->setTable(KnownWords::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($flush_pool) {
			KnownWords::flushPool();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return KnownWords[]
	 */
	static function doSelect(Query $q = null, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'KnownWords');
			$class = $additional_classes;
		} else {
			$class = 'KnownWords';
		}

		return KnownWords::fromResult(self::doSelectRS($q), $class);
	}

	/**
	 * @param array $column_values
	 * @param Query $q The Query object that creates the SELECT query string
	 * @return KnownWords[]
	 */
	static function doUpdate(array $column_values, Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = KnownWords::getConnection();

		if (!$q->getTable() || false === strrpos($q->getTable(), KnownWords::getTableName())) {
			$q->setTable(KnownWords::getTableName());
		}

		return $q->doUpdate($column_values, $conn);
	}

	static function coerceTemporalValue($value, $column_type, DABLPDO $conn = null) {
		if (null === $conn) {
			$conn = KnownWords::getConnection();
		}
		return parent::coerceTemporalValue($value, $column_type, $conn);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = KnownWords::getConnection();

		if (!$q->getTable() || false === strrpos($q->getTable(), KnownWords::getTableName())) {
			$q->setTable(KnownWords::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return KnownWords[]
	 */
	static function doSelectJoinAll(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : KnownWords::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return KnownWords::doSelect($q, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		return 0 === count($this->_validationErrors);
	}

}
