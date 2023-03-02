<?php

namespace Blog\Base;

use \Exception;
use \PDO;
use Blog\Role as ChildRole;
use Blog\RoleQuery as ChildRoleQuery;
use Blog\Map\RoleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the `roles` table.
 *
 * @method     ChildRoleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildRoleQuery orderByDisplay($order = Criteria::ASC) Order by the display column
 * @method     ChildRoleQuery orderByCanmoderate($order = Criteria::ASC) Order by the canModerate column
 * @method     ChildRoleQuery orderByCanwrite($order = Criteria::ASC) Order by the canWrite column
 * @method     ChildRoleQuery orderByCanadministrate($order = Criteria::ASC) Order by the canAdministrate column
 *
 * @method     ChildRoleQuery groupById() Group by the id column
 * @method     ChildRoleQuery groupByDisplay() Group by the display column
 * @method     ChildRoleQuery groupByCanmoderate() Group by the canModerate column
 * @method     ChildRoleQuery groupByCanwrite() Group by the canWrite column
 * @method     ChildRoleQuery groupByCanadministrate() Group by the canAdministrate column
 *
 * @method     ChildRoleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildRoleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildRoleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildRoleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildRoleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildRoleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildRoleQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildRoleQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildRoleQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildRoleQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildRoleQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildRoleQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildRoleQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \Blog\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildRole|null findOne(?ConnectionInterface $con = null) Return the first ChildRole matching the query
 * @method     ChildRole findOneOrCreate(?ConnectionInterface $con = null) Return the first ChildRole matching the query, or a new ChildRole object populated from the query conditions when no match is found
 *
 * @method     ChildRole|null findOneById(int $id) Return the first ChildRole filtered by the id column
 * @method     ChildRole|null findOneByDisplay(string $display) Return the first ChildRole filtered by the display column
 * @method     ChildRole|null findOneByCanmoderate(boolean $canModerate) Return the first ChildRole filtered by the canModerate column
 * @method     ChildRole|null findOneByCanwrite(boolean $canWrite) Return the first ChildRole filtered by the canWrite column
 * @method     ChildRole|null findOneByCanadministrate(boolean $canAdministrate) Return the first ChildRole filtered by the canAdministrate column
 *
 * @method     ChildRole requirePk($key, ?ConnectionInterface $con = null) Return the ChildRole by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRole requireOne(?ConnectionInterface $con = null) Return the first ChildRole matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRole requireOneById(int $id) Return the first ChildRole filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRole requireOneByDisplay(string $display) Return the first ChildRole filtered by the display column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRole requireOneByCanmoderate(boolean $canModerate) Return the first ChildRole filtered by the canModerate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRole requireOneByCanwrite(boolean $canWrite) Return the first ChildRole filtered by the canWrite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildRole requireOneByCanadministrate(boolean $canAdministrate) Return the first ChildRole filtered by the canAdministrate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildRole[]|Collection find(?ConnectionInterface $con = null) Return ChildRole objects based on current ModelCriteria
 * @psalm-method Collection&\Traversable<ChildRole> find(?ConnectionInterface $con = null) Return ChildRole objects based on current ModelCriteria
 *
 * @method     ChildRole[]|Collection findById(int|array<int> $id) Return ChildRole objects filtered by the id column
 * @psalm-method Collection&\Traversable<ChildRole> findById(int|array<int> $id) Return ChildRole objects filtered by the id column
 * @method     ChildRole[]|Collection findByDisplay(string|array<string> $display) Return ChildRole objects filtered by the display column
 * @psalm-method Collection&\Traversable<ChildRole> findByDisplay(string|array<string> $display) Return ChildRole objects filtered by the display column
 * @method     ChildRole[]|Collection findByCanmoderate(boolean|array<boolean> $canModerate) Return ChildRole objects filtered by the canModerate column
 * @psalm-method Collection&\Traversable<ChildRole> findByCanmoderate(boolean|array<boolean> $canModerate) Return ChildRole objects filtered by the canModerate column
 * @method     ChildRole[]|Collection findByCanwrite(boolean|array<boolean> $canWrite) Return ChildRole objects filtered by the canWrite column
 * @psalm-method Collection&\Traversable<ChildRole> findByCanwrite(boolean|array<boolean> $canWrite) Return ChildRole objects filtered by the canWrite column
 * @method     ChildRole[]|Collection findByCanadministrate(boolean|array<boolean> $canAdministrate) Return ChildRole objects filtered by the canAdministrate column
 * @psalm-method Collection&\Traversable<ChildRole> findByCanadministrate(boolean|array<boolean> $canAdministrate) Return ChildRole objects filtered by the canAdministrate column
 *
 * @method     ChildRole[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildRole> paginate($page = 1, $maxPerPage = 10, ?ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 */
abstract class RoleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Blog\Base\RoleQuery object.
     *
     * @param string $dbName The database name
     * @param string $modelName The phpName of a model, e.g. 'Book'
     * @param string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Blog\\Role', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildRoleQuery object.
     *
     * @param string $modelAlias The alias of a model in the query
     * @param Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildRoleQuery
     */
    public static function create(?string $modelAlias = null, ?Criteria $criteria = null): Criteria
    {
        if ($criteria instanceof ChildRoleQuery) {
            return $criteria;
        }
        $query = new ChildRoleQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildRole|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ?ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(RoleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = RoleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildRole A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, display, canModerate, canWrite, canAdministrate FROM roles WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildRole $obj */
            $obj = new ChildRole();
            $obj->hydrate($row);
            RoleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con A connection object
     *
     * @return ChildRole|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param array $keys Primary keys to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return Collection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ?ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param mixed $key Primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        $this->addUsingAlias(RoleTableMap::COL_ID, $key, Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param array|int $keys The list of primary key to use for the query
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        $this->addUsingAlias(RoleTableMap::COL_ID, $keys, Criteria::IN);

        return $this;
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterById($id = null, ?string $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RoleTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RoleTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RoleTableMap::COL_ID, $id, $comparison);

        return $this;
    }

    /**
     * Filter the query on the display column
     *
     * Example usage:
     * <code>
     * $query->filterByDisplay('fooValue');   // WHERE display = 'fooValue'
     * $query->filterByDisplay('%fooValue%', Criteria::LIKE); // WHERE display LIKE '%fooValue%'
     * $query->filterByDisplay(['foo', 'bar']); // WHERE display IN ('foo', 'bar')
     * </code>
     *
     * @param string|string[] $display The value to use as filter.
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByDisplay($display = null, ?string $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($display)) {
                $comparison = Criteria::IN;
            }
        }

        $this->addUsingAlias(RoleTableMap::COL_DISPLAY, $display, $comparison);

        return $this;
    }

    /**
     * Filter the query on the canModerate column
     *
     * Example usage:
     * <code>
     * $query->filterByCanmoderate(true); // WHERE canModerate = true
     * $query->filterByCanmoderate('yes'); // WHERE canModerate = true
     * </code>
     *
     * @param bool|string $canmoderate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanmoderate($canmoderate = null, ?string $comparison = null)
    {
        if (is_string($canmoderate)) {
            $canmoderate = in_array(strtolower($canmoderate), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(RoleTableMap::COL_CANMODERATE, $canmoderate, $comparison);

        return $this;
    }

    /**
     * Filter the query on the canWrite column
     *
     * Example usage:
     * <code>
     * $query->filterByCanwrite(true); // WHERE canWrite = true
     * $query->filterByCanwrite('yes'); // WHERE canWrite = true
     * </code>
     *
     * @param bool|string $canwrite The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanwrite($canwrite = null, ?string $comparison = null)
    {
        if (is_string($canwrite)) {
            $canwrite = in_array(strtolower($canwrite), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(RoleTableMap::COL_CANWRITE, $canwrite, $comparison);

        return $this;
    }

    /**
     * Filter the query on the canAdministrate column
     *
     * Example usage:
     * <code>
     * $query->filterByCanadministrate(true); // WHERE canAdministrate = true
     * $query->filterByCanadministrate('yes'); // WHERE canAdministrate = true
     * </code>
     *
     * @param bool|string $canadministrate The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByCanadministrate($canadministrate = null, ?string $comparison = null)
    {
        if (is_string($canadministrate)) {
            $canadministrate = in_array(strtolower($canadministrate), array('false', 'off', '-', 'no', 'n', '0', ''), true) ? false : true;
        }

        $this->addUsingAlias(RoleTableMap::COL_CANADMINISTRATE, $canadministrate, $comparison);

        return $this;
    }

    /**
     * Filter the query by a related \Blog\User object
     *
     * @param \Blog\User|ObjectCollection $user the related object to use as filter
     * @param string|null $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this The current query, for fluid interface
     */
    public function filterByUser($user, ?string $comparison = null)
    {
        if ($user instanceof \Blog\User) {
            $this
                ->addUsingAlias(RoleTableMap::COL_ID, $user->getRoleId(), $comparison);

            return $this;
        } elseif ($user instanceof ObjectCollection) {
            $this
                ->useUserQuery()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();

            return $this;
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \Blog\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param string|null $relationAlias Optional alias for the relation
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this The current query, for fluid interface
     */
    public function joinUser(?string $relationAlias = null, ?string $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Blog\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\Blog\UserQuery');
    }

    /**
     * Use the User relation User object
     *
     * @param callable(\Blog\UserQuery):\Blog\UserQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }

    /**
     * Use the relation to User table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string $typeOfExists Either ExistsQueryCriterion::TYPE_EXISTS or ExistsQueryCriterion::TYPE_NOT_EXISTS
     *
     * @return \Blog\UserQuery The inner query object of the EXISTS statement
     */
    public function useUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        /** @var $q \Blog\UserQuery */
        $q = $this->useExistsQuery('User', $modelAlias, $queryClass, $typeOfExists);
        return $q;
    }

    /**
     * Use the relation to User table for a NOT EXISTS query.
     *
     * @see useUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \Blog\UserQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Blog\UserQuery */
        $q = $this->useExistsQuery('User', $modelAlias, $queryClass, 'NOT EXISTS');
        return $q;
    }

    /**
     * Use the relation to User table for an IN query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the IN query, like ExtendedBookQuery::class
     * @param string $typeOfIn Criteria::IN or Criteria::NOT_IN
     *
     * @return \Blog\UserQuery The inner query object of the IN statement
     */
    public function useInUserQuery($modelAlias = null, $queryClass = null, $typeOfIn = 'IN')
    {
        /** @var $q \Blog\UserQuery */
        $q = $this->useInQuery('User', $modelAlias, $queryClass, $typeOfIn);
        return $q;
    }

    /**
     * Use the relation to User table for a NOT IN query.
     *
     * @see useUserInQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the NOT IN query, like ExtendedBookQuery::class
     *
     * @return \Blog\UserQuery The inner query object of the NOT IN statement
     */
    public function useNotInUserQuery($modelAlias = null, $queryClass = null)
    {
        /** @var $q \Blog\UserQuery */
        $q = $this->useInQuery('User', $modelAlias, $queryClass, 'NOT IN');
        return $q;
    }

    /**
     * Exclude object from result
     *
     * @param ChildRole $role Object to remove from the list of results
     *
     * @return $this The current query, for fluid interface
     */
    public function prune($role = null)
    {
        if ($role) {
            $this->addUsingAlias(RoleTableMap::COL_ID, $role->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the roles table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            RoleTableMap::clearInstancePool();
            RoleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws \Propel\Runtime\Exception\PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(?ConnectionInterface $con = null): int
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(RoleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(RoleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            RoleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            RoleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

}
