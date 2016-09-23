<?php
namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;

abstract class BaseRepository implements RepositoryInterface
{

    private $app;
    protected $model;
    
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract function model();
    
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        
        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        
        return $this->model = $model->newQuery();
    }
    
    private function resetModel()
    {
        $this->makeModel();
    }
    
    public function count()
    {
        $result = $this->model->count();
        $this->resetModel();
        
        return $result;
    }
    
    public function get($columns = array('*'))
    {
        $result = $this->model->get();
        $this->resetModel();
        
        return $result;
    }
    
    public function paginate($perPage = null, $columns = array('*'))
    {
        $result = $this->model->paginate($perPage, $columns);
        $this->resetModel();
        
        return $result;
    }
    
    public function lists($field, $key = null)
    {
        $result = $this->model->lists($field, $key);
        $this->resetModel();
        
        return $result;
    }
    
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }
    
    public function update(array $data, $value, $attribute = 'id')
    {
        return $this->model->where($attribute, $value)->update($data);
    }
    
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    
    public function find($id, $columns = array('*'))
    {
        $this->resetModel();
        
        return $this->model->find($id, $columns);
    }
    
    public function findBy($field, $value, $columns = array('*'))
    {
        $this->resetModel();
        
        return $this->model->where($field, $value)->first($columns);
    }
    
    public function findAllBy($field, $value, $columns = array('*'))
    {
        $this->resetModel();
        
        return $this->model->where($field, $value)->get($columns);
    }
    
    public function search($field, $value, $columns = array('*'))
    {
        $this->resetModel();
        
        return $this->model->where($field, 'LIKE', "%$value%")->get($columns);
    }
    
    public function where($var1, $var2 = null, $var3 = null)
    {
        if (!is_null($var2)) {
            $this->model = $this->model->where($var1, $var2, $var3);
        } elseif (is_array($var1)) {
            foreach ($var1 as $value) {
                $value3 = isset($value[2]) ? $value[2] : null;
                $this->model = $this->model->where($value[0], $value[1], $value3);
            }
        }
        
        return $this;
    }
    
    public function orWhere($var1, $var2 = null, $var3 = null)
    {
        if (!is_null($var2)) {
            $this->model = $this->model->orWhere($var1, $var2, $var3);
        } elseif (is_array($var1)) {
            foreach ($var1 as $value) {
                $value3 = isset($value[2]) ? $value[2] : null;
                $this->model = $this->model->orWhere($value[0], $value[1], $value3);
            }
        }
        
        return $this;
    }
    
    public function whereIn($field, $values)
    {
        $this->model = $this->model->whereIn($field, $values);
        
        return $this;
    }
    
    public function whereNotIn($field, $values)
    {
        $this->model = $this->model->whereNotIn($field, $values);
        
        return $this;
    }
    
    public function whereNull($field)
    {
        $this->model = $this->model->whereNull($field);
        
        return $this;
    }
    
    public function groupBy($field)
    {
        $this->model = $this->model->groupBy($field);
        
        return $this;
    }
    
    public function orderBy($field, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($field, $direction);
        
        return $this;
    }
    
    public function first($columns = ['*'])
    {
        $result = $this->model->first($columns);
        $this->resetModel();
        
        return $result;
    }
    
    public function deleteAll()
    {
        $result = $this->model->delete();
        $this->resetModel();
        
        return $result;
    }
    
    public function withTrashed()
    {
        $result = $this->model->withTrashed()->get();
        $this->resetModel();
        
        return $result;
    }
    
    public function onlyTrashed()
    {
        $result = $this->model->onlyTrashed()->get();
        $this->resetModel();
        
        return $result;
    }
}