<?php


class IndexedList extends AbstractCollection
{
    public function __construct(){
        $this->collection = array();
    }

    public function add($value){
        array_push($this->collection, $value);
    }
    public function get($index){
        return $this->collection[$index];
    }

    public function remove($index){
        unset($this->collection[$index]);
    }
}