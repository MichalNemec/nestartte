<?php


namespace App\Model;

use Nette;


abstract class BaseTable extends Nette\Object
{

    /** @var Nette\Database\Context */
    protected $connection;

    /** @var string */
    protected $tableName;



    public function __construct(Nette\Database\Context $connection)
    {
        $this->connection = $connection;
    }



    /**
     * @return Nette\Database\Table\Selection
     */
    protected function getTable()
    {
        if (!$this->tableName) {
            preg_match('#(\w+)Table#', get_class($this), $m);
            $this->tableName = lcfirst($m[1]);
        }

        return $this->connection->table($this->tableName);
    }



    /**
     * @param $id
     * @return Nette\Database\Table\ActiveRow
     */
    protected function find($id)
    {
        return $this->getTable()->get($id);
    }



    /**
     * @return Nette\Database\Table\Selection
     */
    protected function findAll()
    {
        return $this->getTable();
    }



    /**
     * @param $condition
     * @param array $parameters
     * @return Nette\Database\Table\Selection
     */
    protected function findBy($condition, $parameters = array())
    {
        return $this->getTable()->where($condition, $parameters);
    }



    /**
     * @param $condition
     * @param array $parameters
     * @return Nette\Database\Table\ActiveRow|bool
     */
    protected function findOneBy($condition, $parameters = array())
    {
        return $this->findBy($condition, $parameters)->limit(1)->fetch();
    }
}