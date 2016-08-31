<?php
include_once('div0/utils/Logger.php');
include_once('div0/collections/json/MapJsonUtils.php');
include_once('div0/collections/Map.php');
include_once('div0/collections/exceptions/CollectionException.php');
include_once('div0/collections/iterators/MapIterator.php');

class TableTesting {
    private $map;
    private $mapIterator;

    private $jsonUtils;

    private $row1_id = 'row_1';
    private $row2_id = 'row_2';
    private $row3_id = 'row_3';
    private $row4_id = 'row_4';

    public function __construct(){
        $this->map = new Map();
        $this->createRows();

        $jsonUtils = new MapJsonUtils();

        $encoded = $jsonUtils->encode($this->map);
        Logger::logMessage('JSON: '.$encoded);
    }

    private function createRows(){
        $row_1 = new Map();
        $row_1->setId($this->row1_id);

        $row_2 = new Map();
        $row_2->setId($this->row2_id);

        $row_3 = new Map();
        $row_3->setId($this->row3_id);

        $row_4 = new Map();
        $row_4->setId($this->row4_id);

        $this->map->add($row_1->getId(), $row_1);
        $this->map->add($row_2->getId(), $row_2);
        $this->map->add($row_3->getId(), $row_3);
        $this->map->add($row_4->getId(), $row_4);

        $this->fillRows();
        Logger::logMessage('total rows: '.$this->map->size());
        $this->iterateMap();
    }

    private function iterateMap(){
        $this->getMapIterator();

        while($this->mapIterator->hasNext()){
            $row = $this->mapIterator->next();
            $rowId = $row->getId();

            Logger::logMessage('<b>Current row: '.$rowId.'</b>');
            $rowIterator = $row->getIterator();

            Logger::logMessage('Current row size: '.$row->size());

            while($rowIterator->hasNext()){
                $rowValue = $rowIterator->next();
                Logger::logMessage($rowValue);
            }
        }
    }

    private function getMapIterator(){
        $this->mapIterator = $this->map->getIterator();
    }

    private function fillRows(){
        Logger::logMessage('fillRows...');
        $this->getMapIterator();

        while($this->mapIterator->hasNext()){
            $row = $this->mapIterator->next();

            $rowId = $row->getId();

            Logger::logMessage('current rowId: '.$rowId);

            for($i=0; $i<4; $i++){
                $key = 'column_'.$i;
                $value = $rowId.'_value_'.$i;
                $row->add($key, $value);
            }
            Logger::logMessage('current row size after add 4 elements : '.$row->size());

            //$row->dumpCollection();
        }
    }
} 