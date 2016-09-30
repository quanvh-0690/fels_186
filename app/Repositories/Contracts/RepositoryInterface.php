<?php
namespace App\Repositories\Contracts;

interface RepositoryInterface {
    
    public function count();
    
    public function get($columns = array('*'));
    
    public function paginate($perPage = 10, $columns = array('*'));
    
    public function lists($field, $key = null);
    
    public function create(array $data);
    
    public function insert(array $data);
    
    public function update(array $data, $value, $attribute = 'id');
    
    public function delete($id);
    
    public function find($id, $columns = array('*'));
    
    public function findBy($field, $value, $columns = array('*'));
    
    public function findAllBy($field, $value, $columns = array('*'));
    
    public function search($field, $value, $columns = array('*'));
        
    public function withTrashed();
    
    public function onlyTrashed();
    
    public function where($var1, $var2 = null, $var3 = null);
    
    public function orWhere($var1, $var2 = null, $var3 = null);
    
    public function whereIn($field, $values);
    
    public function whereNotIn($field, $values);
    
    public function whereNull($field);
    
    public function groupBy($field);
    
    public function orderBy($field, $direction = 'asc');
    
    public function first($columns = ['*']);
    
    public function deleteAll();
    
    public function whereHas($relatedModel, $query);
    
    public function limit($limit, $offset = 0);
    
    public function with($relatedModel);
}