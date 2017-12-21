<?php 
namespace sebastiangolian\php\component\sql;

use sebastiangolian\php\component\helper\ArrayHelper;

/**
 * Query represents a SELECT SQL statement
 * 
 * $sql = Query::create()
 * ->columns(['id','firstname','lastname'])
 * ->where([['id','>',1],['firstname','=','Kowalski'],['OR','firstname','=','Kowalski']])
 * ->select(['customer']);
 * echo $sql;
 * @author seba
 *
 */
class Query
{
    protected $columns = ['*'];
    protected $from;
    protected $where;
    
    
    public static function create()
    {
        return new self();
    }
    
    /**
     * @param string[] $tables
     * @return string
     */
    public function select($tables)
    {
        $this->from($tables);
        $sql =
        $this->bulidColumns().
        $this->bulidFrom().
        $this->bulidWhere();
      
        return $sql;
    }
    
    /**
     * @param string[] $columns
     * @return self
     */
    public function columns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @param array|array[] $condition
     * @return self
     */
    public function where($condition)
    {
        $this->where = $condition;
        return $this;
    }
    
    /**
     * @param string[] $tables
     * @return self
     */
    protected function from($tables)
    {
        if (!is_array($tables)) {
            $tables = preg_split('/\s*,\s*/', trim($tables), -1, PREG_SPLIT_NO_EMPTY);
        }
        $this->from = $tables;
        return $this;
    }
    
    /**
     * @return string
     */
    protected function bulidColumns()
    {
        return "SELECT ".implode(', ',$this->columns);
    }
    
    /**
     * @return string
     */
    protected function bulidFrom()
    {
        return " FROM ".implode(', ',$this->from);
    }
    
    /**
     * @return string
     */
    protected function bulidWhere()
    {
        if($this->where == null)
        {
            return "";
        }
        else 
        {
            $retString = '';
            foreach ($this->normalizeWhere() as $row)
            {
                if($retString == ''){
                    $retString .= ' WHERE '.$row[1].$row[2]."'".$row[3]."'";
                } 
                else{
                    $retString .= ' '.$row[0].' '.$row[1].$row[2]."'".$row[3]."'";
                }
            }
            return $retString;
        }
    }
    
    /**
     * @return array
     */
    protected function normalizeWhere()
    {
        $retArray = array();        
        foreach ($this->where as $row)
        {
            if(!is_array($row)){
                array_push($retArray,$this->normalizeWhereRow($this->where));
            }
            else {
                array_push($retArray,$this->normalizeWhereRow($row));
            }
        }
        
        
        return $retArray;
    }
    
    /**
     * @param array $row
     * @throws \Exception
     * @return string[]
     */
    protected function normalizeWhereRow($row)
    {
        if(ArrayHelper::isAssoc($row))
        {
            return ['AND',key($row),'=',$row[key($row)]];
        }
        
        switch (count($row))
        {
            case 2:
                return ['AND',$row[0],'=',$row[1]];
                break;
            case 3:
                return ['AND',$row[0],$row[1],$row[2]];
                break;
            case 4:
                return $row;
                break;
            default:
                throw new \Exception('"Where" array row must have from 2 to 4 position.');
                break;
        }
    }   
}