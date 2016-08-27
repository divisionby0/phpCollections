<?php
include_once('div0/utils/Logger.php');
include_once('div0/collections/Map.php');
include_once('div0/collections/exceptions/CollectionException.php');
include_once('div0/collections/iterators/MapIterator.php');

class MapIteratorTesting {
    private $map;
    private $mapIterator;

    public function __construct(){
        $this->map = new Map();
        $this->map->add('1', 'value_1');
        $this->map->add('2', 'value_2');
        $this->map->add('3', 'value_3');

        $this->getIterator();
        Logger::logMessage('MapIterator get complete');
        $this->iterate();
    }

    private function getIterator(){
        $this->mapIterator = $this->map->getIterator();
    }

    private function iterate(){
        while($this->mapIterator->hasNext()){
            $element = $this->mapIterator->next();
            Logger::logMessage('Element: "'.$element.'"');
        }
    }
} 