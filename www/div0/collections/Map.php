<?php

class Map {
    private $collection;

    public function __construct(){
        $this->collection = array();
    }

    public function add($key, $value){
        $keyExists = $this->isKeyExists($key);

        if($keyExists == true){
            throw new KeyExistsException('key "'.$key.'" already exists');
        }
        else{
            $this->collection[$key] = $value;
        }
    }

    public function get($key){
        $isEmpty = $this->isEmpty();

        if($isEmpty){
            throw new CollectionException('CollectionException. Map is empty.');
        }
        else{
            $keyExists = $this->isKeyExists($key);

            if($keyExists == true){
                return $this->collection[$key];
            }
            else{
                throw new CollectionException('CollectionException. Key "'.$key.'" not exists');
            }
        }
    }

    public function update($key, $value){
        $keyExists = $this->isKeyExists($key);

        if($keyExists == true){
            unset($this->collection[$key]);
            $this->add($key, $value);
        }
        else{
            throw new CollectionException('key '.$key.' not exists');
        }
    }

    public function remove($key){
        $keyExists = $this->isKeyExists($key);

        if($keyExists == true){
            unset($this->collection[$key]);
        }
        else{
            throw new CollectionException('key '.$key.' not exists');
        }
    }

    public function clear(){
        $this->collection = array();
    }
    public function size(){
        return count($this->collection);
    }

    public function getIterator(){
        return new MapIterator($this->collection);
    }
    public function dumpCollection(){
        return var_dump($this->collection);
    }

    private function isEmpty(){
        if($this->size() > 0){
            return false;
        }
        else{
            return true;
        }
    }

    private function isKeyExists($key){
        $result = isset($this->collection[$key]) || array_key_exists($key, $this->collection);
        return $result;
    }
} 