<?php

namespace App\Models;

use Nette\Object,
	Nette\Database\Context,
	Nette\Database\Table\Selection,
	Nette\Utils\Strings,
	Nette\InvalidStateException;

/**
 * The ancestor of all models.
 *
 * @author Ondrej Tom
 */
abstract class BaseModel extends Object
{
	/**
	 * DB connection.
	 *
	 * @var Context
	 */
	protected $connection;


	/**
	 * Table name.
	 *
	 * @var string
	 */
	protected $tableName;


	/**
	 * Saves DB connection.
	 *
	 * @param	Context		$connection
	 * @throws	InvalidStateException
	 */
	public function __construct(Context $connection)
	{
		if (!isset($this->tableName))
		{
			throw new InvalidStateException('Model table name has not been set!');
		}

		$this->connection = $connection;
	}


	/**
	 * Returns particular table selection.
	 *
	 * @return Selection
	 */
	protected function getTable()
	{
		return $this->connection->table($this->tableName);
	}


	/**
	 * Returns DB driver.
	 *
	 * @return PDO
	 */
	public function getDb()
	{
		return $this->connection->getConnection()->getPdo();
	}


	/**
	 * Returns all rows from table.
	 *
	 * @return Selection
	 */
	public function getAll()
	{
		return $this->getTable();
	}


	/**
	 * Inserts row into the table.
	 *
	 * @see Selection::insert()
	 */
	public function insert($values)
	{
		return $this->getTable()->insert($values);
	}


	/**
	 * Update table rows.
	 *
	 * @see Selection::update()
	 */
	public function update($values, $id)
	{
		return $this->find($id, false)->update($values);
	}


	/**
	 * Returns record by table primary key (ID).
	 *
	 * @param	int		$id		Primary key.
	 * @param	bool	$fetch	Flag for fetching the row.
	 * @return	Selection|IRow
	 */
	public function find($id, $fetch = true)
	{
		$row = $this->getTable()->wherePrimary($id);

		return $fetch ? $row->fetch() : $row;
	}


	/**
	 * Returns table selection based on conditions.
	 *
	 * @param	array	$where	Conditions.
	 * @return	Selection
	 */
	public function findBy(array $where)
	{
		return $this->getTable()->where($where);
	}


	/**
	 * Deletes row based on primary key.
	 *
	 * @param	int		$id		Primery key.
	 * @return	int		Number of affected rows.
	 */
	public function delete($id)
	{
		return $this->find($id, false)->delete();
	}


	/**
	 * Deletes rows based on conditions.
	 *
	 * @param	array	$where	Conditions.
	 * @return	int		Number of affected rows.
	 */
	public function deleteBy(array $where)
	{
		return $this->findBy($where)->delete();
	}


	/**
	 * Returns list of table rows:
	 *
	 * [id => title, ...]
	 *
	 * @param	string			$idColumn		Name of ID column.
	 * @param	string			$titleColumn	Name of title column.
	 * @param	Selection|null	$selection		Selection
	 * @param	bool			$capitalize		Flag for capitalizing title.
	 * @return	array
	 */
	protected function getList($idColumn, $titleColumn, Selection $selection = null, $capitalize = true)
	{
		$list		= [];
		$selection	= $selection ? $selection : $this->getAll();

		foreach ($selection as $item)
		{
			$list[$item->{$idColumn}] = $capitalize ? Strings::capitalize($item->{$titleColumn}) : $item->{$titleColumn};
		}

		return $list;
	}
}