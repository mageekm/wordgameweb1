<?php
/**
 *		Created by Dan Blaisdell's DABL
 *		Do not alter base files, as they will be overwritten.
 *		To alter the objects, alter the extended classes in
 *		the 'models' folder.
 *
 */
abstract class basePlayer extends ApplicationModel {

	const PID = 'player.pid';
	const PASSWORD = 'player.password';
	const EMAIL = 'player.email';
	const FIRST_NAME = 'player.firstName';
	const LAST_NAME = 'player.lastName';
	const AGE = 'player.age';
	const EDUCATION = 'player.education';
	const SEX = 'player.sex';
	const PAID_TIER = 'player.paidTier';
	const HIGH_SCORE = 'player.highScore';

	/**
	 * Name of the table
	 * @var string
	 */
	protected static $_tableName = 'player';

	/**
	 * Cache of objects retrieved from the database
	 * @var Player[]
	 */
	protected static $_instancePool = array();

	protected static $_instancePoolCount = 0;

	protected static $_poolEnabled = true;

	/**
	 * Array of all primary keys
	 * @var string[]
	 */
	protected static $_primaryKeys = array(
		'pid',
	);

	/**
	 * string name of the primary key column
	 * @var string
	 */
	protected static $_primaryKey = 'pid';

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
		'pid',
		'password',
		'email',
		'firstName',
		'lastName',
		'age',
		'education',
		'sex',
		'paidTier',
		'highScore',
	);

	/**
	 * array of all column types
	 * @var string[]
	 */
	protected static $_columnTypes = array(
		'pid' => Model::COLUMN_TYPE_INTEGER,
		'password' => Model::COLUMN_TYPE_VARCHAR,
		'email' => Model::COLUMN_TYPE_VARCHAR,
		'firstName' => Model::COLUMN_TYPE_VARCHAR,
		'lastName' => Model::COLUMN_TYPE_VARCHAR,
		'age' => Model::COLUMN_TYPE_INTEGER,
		'education' => Model::COLUMN_TYPE_TINYINT,
		'sex' => Model::COLUMN_TYPE_TINYINT,
		'paidTier' => Model::COLUMN_TYPE_INTEGER,
		'highScore' => Model::COLUMN_TYPE_INTEGER,
	);

	/**
	 * `pid` INTEGER NOT NULL DEFAULT ''
	 * @var int
	 */
	protected $pid;

	/**
	 * `password` VARCHAR NOT NULL
	 * @var string
	 */
	protected $password;

	/**
	 * `email` VARCHAR NOT NULL
	 * @var string
	 */
	protected $email;

	/**
	 * `firstName` VARCHAR
	 * @var string
	 */
	protected $firstName;

	/**
	 * `lastName` VARCHAR
	 * @var string
	 */
	protected $lastName;

	/**
	 * `age` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $age;

	/**
	 * `education` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $education;

	/**
	 * `sex` TINYINT DEFAULT ''
	 * @var int
	 */
	protected $sex;

	/**
	 * `paidTier` INTEGER NOT NULL DEFAULT 0
	 * @var int
	 */
	protected $paidTier = 0;

	/**
	 * `highScore` INTEGER DEFAULT ''
	 * @var int
	 */
	protected $highScore;

	/**
	 * Gets the value of the pid field
	 */
	function getPid() {
		return $this->pid;
	}

	/**
	 * Sets the value of the pid field
	 * @return Player
	 */
	function setPid($value) {
		return $this->setColumnValue('pid', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the password field
	 */
	function getPassword() {
		return $this->password;
	}

	/**
	 * Sets the value of the password field
	 * @return Player
	 */
	function setPassword($value) {
		return $this->setColumnValue('password', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the email field
	 */
	function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the value of the email field
	 * @return Player
	 */
	function setEmail($value) {
		return $this->setColumnValue('email', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the firstName field
	 */
	function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the value of the firstName field
	 * @return Player
	 */
	function setFirstName($value) {
		return $this->setColumnValue('firstName', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the lastName field
	 */
	function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the value of the lastName field
	 * @return Player
	 */
	function setLastName($value) {
		return $this->setColumnValue('lastName', $value, Model::COLUMN_TYPE_VARCHAR);
	}

	/**
	 * Gets the value of the age field
	 */
	function getAge() {
		return $this->age;
	}

	/**
	 * Sets the value of the age field
	 * @return Player
	 */
	function setAge($value) {
		return $this->setColumnValue('age', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the education field
	 */
	function getEducation() {
		return $this->education;
	}

	/**
	 * Sets the value of the education field
	 * @return Player
	 */
	function setEducation($value) {
		return $this->setColumnValue('education', $value, Model::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the sex field
	 */
	function getSex() {
		return $this->sex;
	}

	/**
	 * Sets the value of the sex field
	 * @return Player
	 */
	function setSex($value) {
		return $this->setColumnValue('sex', $value, Model::COLUMN_TYPE_TINYINT);
	}

	/**
	 * Gets the value of the paidTier field
	 */
	function getPaidTier() {
		return $this->paidTier;
	}

	/**
	 * Sets the value of the paidTier field
	 * @return Player
	 */
	function setPaidTier($value) {
		return $this->setColumnValue('paidTier', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * Gets the value of the highScore field
	 */
	function getHighScore() {
		return $this->highScore;
	}

	/**
	 * Sets the value of the highScore field
	 * @return Player
	 */
	function setHighScore($value) {
		return $this->setColumnValue('highScore', $value, Model::COLUMN_TYPE_INTEGER);
	}

	/**
	 * @return DABLPDO
	 */
	static function getConnection() {
		return DBManager::getConnection('default_connection');
	}

	/**
	 * @return Player
	 */
	static function create() {
		return new Player();
	}

	/**
	 * Returns String representation of table name
	 * @return string
	 */
	static function getTableName() {
		return Player::$_tableName;
	}

	/**
	 * Access to array of column names
	 * @return array
	 */
	static function getColumnNames() {
		return Player::$_columnNames;
	}

	/**
	 * Access to array of column types, indexed by column name
	 * @return array
	 */
	static function getColumnTypes() {
		return Player::$_columnTypes;
	}

	/**
	 * Get the type of a column
	 * @return array
	 */
	static function getColumnType($column_name) {
		return Player::$_columnTypes[$column_name];
	}

	/**
	 * @return bool
	 */
	static function hasColumn($column_name) {
		static $lower_case_columns = null;
		if (null === $lower_case_columns) {
			$lower_case_columns = array_map('strtolower', Player::$_columnNames);
		}
		return in_array(strtolower($column_name), $lower_case_columns);
	}

	/**
	 * Access to array of primary keys
	 * @return array
	 */
	static function getPrimaryKeys() {
		return Player::$_primaryKeys;
	}

	/**
	 * Access to name of primary key
	 * @return array
	 */
	static function getPrimaryKey() {
		return Player::$_primaryKey;
	}

	/**
	 * Returns true if the primary key column for this table is auto-increment
	 * @return bool
	 */
	static function isAutoIncrement() {
		return Player::$_isAutoIncrement;
	}

	/**
	 * Searches the database for a row with the ID(primary key) that matches
	 * the one input.
	 * @return Player
	 */
	static function retrieveByPK($the_pk) {
		return Player::retrieveByPKs($the_pk);
	}

	/**
	 * Searches the database for a row with the primary keys that match
	 * the ones input.
	 * @return Player
	 */
	static function retrieveByPKs($pid) {
		if (null === $pid) {
			return null;
		}
		if (Player::$_poolEnabled) {
			$pool_instance = Player::retrieveFromPool($pid);
			if (null !== $pool_instance) {
				return $pool_instance;
			}
		}
		$conn = Player::getConnection();
		$q = new Query;
		$q->add('pid', $pid);
		$records = Player::doSelect($q);
		return array_shift($records);
	}

	/**
	 * Searches the database for a row with a pid
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByPid($value) {
		return Player::retrieveByPK($value);
	}

	/**
	 * Searches the database for a row with a password
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByPassword($value) {
		return Player::retrieveByColumn('password', $value);
	}

	/**
	 * Searches the database for a row with a email
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByEmail($value) {
		return Player::retrieveByColumn('email', $value);
	}

	/**
	 * Searches the database for a row with a firstName
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByFirstName($value) {
		return Player::retrieveByColumn('firstName', $value);
	}

	/**
	 * Searches the database for a row with a lastName
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByLastName($value) {
		return Player::retrieveByColumn('lastName', $value);
	}

	/**
	 * Searches the database for a row with a age
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByAge($value) {
		return Player::retrieveByColumn('age', $value);
	}

	/**
	 * Searches the database for a row with a education
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByEducation($value) {
		return Player::retrieveByColumn('education', $value);
	}

	/**
	 * Searches the database for a row with a sex
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveBySex($value) {
		return Player::retrieveByColumn('sex', $value);
	}

	/**
	 * Searches the database for a row with a paidTier
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByPaidTier($value) {
		return Player::retrieveByColumn('paidTier', $value);
	}

	/**
	 * Searches the database for a row with a highScore
	 * value that matches the one provided
	 * @return Player
	 */
	static function retrieveByHighScore($value) {
		return Player::retrieveByColumn('highScore', $value);
	}

	static function retrieveByColumn($field, $value) {
		$conn = Player::getConnection();
		$q = Query::create()->add($field, $value)->setLimit(1)->order('pid');
		$records = Player::doSelect($q);
		return array_shift($records);
	}

	/**
	 * Populates and returns an instance of Player with the
	 * first result of a query.  If the query returns no results,
	 * returns null.
	 * @return Player
	 */
	static function fetchSingle($query_string) {
		$records = Player::fetch($query_string);
		return array_shift($records);
	}

	/**
	 * Populates and returns an array of Player objects with the
	 * results of a query.  If the query returns no results,
	 * returns an empty Array.
	 * @return Player[]
	 */
	static function fetch($query_string) {
		$conn = Player::getConnection();
		$result = $conn->query($query_string);
		return Player::fromResult($result, 'Player');
	}

	/**
	 * Returns an array of Player objects from
	 * a PDOStatement(query result).
	 *
	 * @see Model::fromResult
	 */
	static function fromResult(PDOStatement $result, $class = 'Player', $use_pool = null) {
		if (null === $use_pool) {
			$use_pool = Player::$_poolEnabled;
		}
		return Model::fromResult($result, $class, $use_pool);
	}

	/**
	 * Casts values of int fields to (int)
	 * @return Player
	 */
	function castInts() {
		$this->pid = (null === $this->pid) ? null : (int) $this->pid;
		$this->age = (null === $this->age) ? null : (int) $this->age;
		$this->education = (null === $this->education) ? null : (int) $this->education;
		$this->sex = (null === $this->sex) ? null : (int) $this->sex;
		$this->paidTier = (null === $this->paidTier) ? null : (int) $this->paidTier;
		$this->highScore = (null === $this->highScore) ? null : (int) $this->highScore;
		return $this;
	}

	/**
	 * Add (or replace) to the instance pool.
	 *
	 * @param Player $object
	 * @return void
	 */
	static function insertIntoPool(Player $object) {
		if (!Player::$_poolEnabled) {
			return;
		}
		if (Player::$_instancePoolCount > Player::MAX_INSTANCE_POOL_SIZE) {
			return;
		}

		Player::$_instancePool[implode('-', $object->getPrimaryKeyValues())] = $object;
		++Player::$_instancePoolCount;
	}

	/**
	 * Return the cached instance from the pool.
	 *
	 * @param mixed $pk Primary Key
	 * @return Player
	 */
	static function retrieveFromPool($pk) {
		if (!Player::$_poolEnabled || null === $pk) {
			return null;
		}
		if (array_key_exists($pk, Player::$_instancePool)) {
			return Player::$_instancePool[$pk];
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

		if (array_key_exists($pk, Player::$_instancePool)) {
			unset(Player::$_instancePool[$pk]);
			--Player::$_instancePoolCount;
		}
	}

	/**
	 * Empty the instance pool.
	 *
	 * @return void
	 */
	static function flushPool() {
		Player::$_instancePool = array();
	}

	static function setPoolEnabled($bool = true) {
		Player::$_poolEnabled = $bool;
	}

	static function getPoolEnabled() {
		return Player::$_poolEnabled;
	}

	/**
	 * Returns an array of all Player objects in the database.
	 * $extra SQL can be appended to the query to LIMIT, SORT, and/or GROUP results.
	 * If there are no results, returns an empty Array.
	 * @param $extra string
	 * @return Player[]
	 */
	static function getAll($extra = null) {
		$conn = Player::getConnection();
		$table_quoted = $conn->quoteIdentifier(Player::getTableName());
		return Player::fetch("SELECT * FROM $table_quoted $extra ");
	}

	/**
	 * @return int
	 */
	static function doCount(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Player::getConnection();
		if (!$q->getTable() || Player::getTableName() != $q->getTable()) {
			$q->setTable(Player::getTableName());
		}
		return $q->doCount($conn);
	}

	/**
	 * @param Query $q
	 * @param bool $flush_pool
	 * @return int
	 */
	static function doDelete(Query $q, $flush_pool = true) {
		$conn = Player::getConnection();
		$q = clone $q;
		if (!$q->getTable() || Player::getTableName() != $q->getTable()) {
			$q->setTable(Player::getTableName());
		}
		$result = $q->doDelete($conn);

		if ($flush_pool) {
			Player::flushPool();
		}

		return $result;
	}

	/**
	 * @param Query $q The Query object that creates the SELECT query string
	 * @param array $additional_classes Array of additional classes for fromResult to instantiate as properties
	 * @return Player[]
	 */
	static function doSelect(Query $q = null, $additional_classes = null) {
		if (is_array($additional_classes)) {
			array_unshift($additional_classes, 'Player');
			$class = $additional_classes;
		} else {
			$class = 'Player';
		}

		return Player::fromResult(self::doSelectRS($q), $class);
	}

	/**
	 * @param array $column_values
	 * @param Query $q The Query object that creates the SELECT query string
	 * @return Player[]
	 */
	static function doUpdate(array $column_values, Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Player::getConnection();

		if (!$q->getTable() || false === strrpos($q->getTable(), Player::getTableName())) {
			$q->setTable(Player::getTableName());
		}

		return $q->doUpdate($column_values, $conn);
	}

	static function coerceTemporalValue($value, $column_type, DABLPDO $conn = null) {
		if (null === $conn) {
			$conn = Player::getConnection();
		}
		return parent::coerceTemporalValue($value, $column_type, $conn);
	}

	/**
	 * Executes a select query and returns the PDO result
	 * @return PDOStatement
	 */
	static function doSelectRS(Query $q = null) {
		$q = $q ? clone $q : new Query;
		$conn = Player::getConnection();

		if (!$q->getTable() || false === strrpos($q->getTable(), Player::getTableName())) {
			$q->setTable(Player::getTableName());
		}

		return $q->doSelect($conn);
	}

	/**
	 * @return Player[]
	 */
	static function doSelectJoinAll(Query $q = null, $join_type = Query::LEFT_JOIN) {
		$q = $q ? clone $q : new Query;
		$columns = $q->getColumns();
		$classes = array();
		$alias = $q->getAlias();
		$this_table = $alias ? $alias : Player::getTableName();
		if (!$columns) {
			$columns[] = $this_table . '.*';
		}

		$q->setColumns($columns);
		return Player::doSelect($q, $classes);
	}

	/**
	 * Returns true if the column values validate.
	 * @return bool
	 */
	function validate() {
		$this->_validationErrors = array();
		if (null === $this->getpassword()) {
			$this->_validationErrors[] = 'password must not be null';
		}
		if (null === $this->getemail()) {
			$this->_validationErrors[] = 'email must not be null';
		}
		return 0 === count($this->_validationErrors);
	}

}
