<?php


class MapIterator {
    private $collection;
    private $keys;
    private $index = -1;

    public function __construct($collection){
        $this->collection = $collection;
        $this->keys = array_keys($this->collection);
    }

    public function hasNext(){
        $nextIndex = $this->index + 1;
        if($nextIndex<count($this->keys)){
            return true;
        }
        else{
            return false;
        }
    }

    public function next(){
        $this->index = $this->index + 1;
        $key = $this->keys[$this->index];
        return $this->collection[$key];
    }
} 