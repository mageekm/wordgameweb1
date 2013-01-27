<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class baseWord extends ApplicationModel {

	const DEFINITION = 'word.definition';
	const WID = 'word.wid';
	const WORD = 'word.word';
	const PRONUNCIATION_URL = 'word.pronunciationURL';
	const TYPE = 'word.type';
	const DIFFICULTY = 'word.difficulty';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'word';

	/**
	 * Cache of objects retrieved from the database
	 * @var Word[]
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
	);

	/**
	 * string name of the primary key column
	 * @var string
	 */
	protected static $_primaryKey = 'wid';

	/**
	 * true if primary key is an auto-increment column
	 * @var bool
	 */
	protected static $_isAutoIncrement = true;

	/**
	 * array of all column names
	 * @var string[]
	 */
	protected static $_columnNames = array(
		'definition',
		'wid',
		'word',
		'pronunciationURL',
		'type',
		'difficulty',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'definition' => Model::COLUMN_TYPE_VARCHAR,
		'wid' => Model::COLUMN_TYPE_INTEGER,
		'word' => Model::COLUMN_TYPE_VARCHAR,
		'pronunciationURL' => Model::COLUMN_TYPE_VARCHAR,
		'type' => Model::COLUMN_TYPE_VARCHAR,
		'difficulty' => Model::COLUMN_TYPE_INTEGER,
	);

	/**
	 * `definition` VARCHAR NOT NULL
	 * @var string
	 */
	protected $definition;

	/**
	 * `wid` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $wid;

	/**
	 * `word` VARCHAR NOT NULL
	 * @var string
	 */
	protected $word;

	/**
	 * `pronunciationURL` VARCHAR
	 * @var string
	 */
	protected $pronunciationURL;

	/**
	 * `type` VARCHAR
	 * @var string
	 */
	protected $type;

	/**
	 * `difficulty` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $difficulty;

	/**
	 * Gets the value of the definition field
	 */
	function getDefinition() {
		return $this->definition;
	}

	/**
	 * Sets the value of the definition field
	 * @return Word
	 */
	function setDefinition($value) {
		return $this->setColumnValue('definition', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the wid field
	 */
	function getWid() {
		return $this->wid;
	}

	/**
	 * Sets the value of the wid field
	 * @return Word
	 */
	function setWid($value) {
		return $this->setColumnValue('wid', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the word field
	 */
	function getWord() {
		return $this->word;
	}

	/**
	 * Sets the value of the word field
	 * @return Word
	 */
	function setWord($value) {
		return $this->setColumnValue('word', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the pronunciationURL field
	 */
	function getPronunciationURL() {
		return $this->pronunciationURL;
	}

	/**
	 * Sets the value of the pronunciationURL field
	 * @return Word
	 */
	function setPronunciationURL($value) {
		return $this->setColumnValue('pronunciationURL', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the type field
	 */
	function getType() {
		return $this->type;
	}

	/**
	 * Sets the value of the type field
	 * @return Word
	 */
	function setType($value) {
		return $this->setColumnValue('type', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the difficulty field
	 */
	function getDifficulty() {
		return $this->difficulty;
	}

	/**
	 * Sets the value of the difficulty field
	 * @return Word
	 */
	function setDifficulty($value) {
		return $this->setColumnValue('difficulty', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_connection');
	}

	/**
	 * @return Word
	 */
	static function create() {
		return new Word();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Word::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Word::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Word::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Word::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Word::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Word::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Word::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Word::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Word
	 */
	static function retrieveByPK($the_pk) {
		return Word::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Word
	 */
	static function retrieveByPKs($wid) {
		if (null === $wid) {
			return null;
		}
		if (Word::$_poolEnabled) {
			$pool_instance = Word::retrieveFromPool($wid);
			if (null !== $pool_instance) {
				return $pool_instance;
			}
		}
		$conn = Word::getConnection();
		$q = new Query;
		$q->add('wid', $wid);
		$records = Word::doSelect($q);
		return array_shift($records);
	}

	/**
	 * Searches the database for a row with a definition
	 * value that matches the one provided
	 * @return Word
	 */
	static function retrieveByDefinition($value) {
		return Word::retrieveByColumn('definition', $value);
	}

	/**
	 * Searches the database for a row with a wid
	 * value that matches the one provided
	 * @return Word
	 */
	static function retrieveByWid($value) {
		return Word::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a word
	 * value that matches the one provided
	 * @return Word
	 */
	static function retrieveByWord($value) {
		return Word::retrieveByColumn('word', $value);
	}

	/**
	 * Searches the database for a row with a pronunciationURL
	 * value that matches the one provided
	 * @return Word
	 */
	static function retrieveByPronunciationURL($value) {
		return Word::retrieveByColumn('pronunciationURL', $value);
	}

	/**
	 * Searches the database for a row with a type
	 * value that matches the one provided
	 * @return Word
	 */
	static function retrieveByType($value) {
		return Word::retrieveByColumn('type', $value);
	}

	/**
	 * Searches the database for a row with a difficulty
	 * value that matches the one provided
	 * @return Word
	 */
	static function retrieveByDifficulty($value) {
		return Word::retrieveByColumn('difficulty', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Word::getConnection();
		$q = Query::create()->add($field, $value)->setLimit(1)->order('wid');
		$records = Word::doSelect($q);
		return array_shift($records);
	}

	/**
	 * Populates and returns an instance of Word with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Word
	 */
	static function fetchSingle($query_string) {
		$records = Word::fetch($query_string);
		return array_shift($records);
	}

	/**
	 * Populates and returns an array of Word objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Word[]
	 */
	static function fetch($query_string) {
		$conn = Word::getConnection();
		$result = $conn->query($query_string);
		return Word::fromResult($result, 'Word');
	}

	/**
	 * Returns an array of Word objects from
	 * a PDOStatement(query result).
	 *
	 * @see Model::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Word', $use_pool = null) {
		if (null === $use_pool) {
			$use_pool = Word::$_poolEnabled;
		}
		return Model::fromResult($result, $class, $use_pool);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Word
	 */
	function castInts() {
		$this->wid = (null === $this->wid) ? null : (int) $this->wid;
		$this->difficulty = (null === $this->difficulty) ? null : (int) $this->difficulty;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Word $object
	 * @return void
	 */
	static function insertIntoPool(Word $object) {
		if (!Word::$_poolEnabled) {
			return;
		}
		if (Word::$_instancePoolCount > Word::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Word::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = $object;
		++Word::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Word
	 */
	static function retrieveFromPool($pk) {
		if (!Word::$_poolEnabled || null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Word::$_instancePool)) {
			return Word::$_instancePool[$pk];
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

		if (array_key_exists($pk, Word::$_instancePool)) {
			unset(Word::$_instancePool[$pk]);
			--Word::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Word::$_instancePool = array();
	}

	static function setPoolEnabled($bool = true) {
		Word::$_poolEnabled = $bool;
	}

	static function getPoolEnabled() {
		return Word::$_poolEnabled;
	}

	/**
	 * Returns an array of all Word objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Word[]
	 */
	static function getAll($extra = null) {
		$conn = Word::getConnection();
		$table_quoted = $conn->quoteIdentifier(Word::getTableName());
		return Word::fetch("SELECT * FROM $table_quoted $extra ");
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Word::getConnection();
		if (!$q->getTable() || Word::getTableName() != $q->getTable()) {
			$q->setTable(Word::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $flush_pool
	 * @return int
	 */
	static function doDelete(Query $q, $flush_pool = true) {
		$conn = Word::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Word::getTableName() != $q->getTable()) {
			$q->setTable(Word::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($flush_pool) {
			Word::flushPool();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Word[]
	 */
	static function doSelect(Query $q = null, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Word');
			$class = $additional_classes;
		} else {
			$class = 'Word';
		}

		return Word::fromResult(self::doSelectRS($q), $class);
	}

	/**
	 * @param array $column_values
	 * @param Query $q The Query object that creates the SELECT query string
	 * @return Word[]
	 */
	static function doUpdate(array $column_values, Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Word::getConnection();

		if (!$q->getTable() || false === strrpos($q->getTable(), Word::getTableName())) {
			$q->setTable(Word::getTableName());
		}

		return $q->doUpdate($column_values, $conn);
	}

	static function coerceTemporalValue($value, $column_type, DABLPDO $conn = null) {
		if (null === $conn) {
			$conn = Word::getConnection();
		}
		return parent::coerceTemporalValue($value, $column_type, $conn);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Word::getConnection();

		if (!$q->getTable() || false === strrpos($q->getTable(), Word::getTableName())) {
			$q->setTable(Word::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Word[]
	 */
	static function doSelectJoinAll(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Word::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Word::doSelect($q, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getdefinition()) {
			$this->_validationErrors[] = 'definition must not be null';
		}
		if (null === $this->getword()) {
			$this->_validationErrors[] = 'word must not be null';
		}
		if (null === $this->getdifficulty()) {
			$this->_validationErrors[] = 'difficulty must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
