<?php

include_once('div0/utils/Logger.php');
include_once('div0/collections/ICollection.php');
include_once('div0/collections/AbstractCollection.php');
include_once('div0/collections/sorters/MapSorterByKey.php');
include_once('div0/collections/Map.php');
include_once('div0/collections/exceptions/CollectionException.php');

class MapSortByKeysTesting
{
    private $map;

    private  $zKey = 'z';
    private  $zValue = 'zValue';

    private  $firstKey = 'a';
    private  $firstValue = 'aValue';

    private  $secondKey = 'b';
    private  $secondValue = 'bValue';

    private  $thirdKey = 'c';
    private  $thirdValue = 'cValue';

    private  $oKey = 'o';
    private  $oValue = 'oValue';
    
    public function __construct()
    {
        $this->map = new Map('testMap');
        $this->map->add($this->zKey, $this->zValue);
        $this->map->add($this->secondKey, $this->secondValue);
        $this->map->add($this->firstKey, $this->firstValue);
        $this->map->add($this->oKey, $this->oValue);
        $this->map->add($this->thirdKey, $this->thirdValue);

        //$this->map->dumpCollection();
        Logger::logObject($this->map);

        $this->map->sortByKey();
        Logger::logMessage("sorted by key");
        $this->map->dumpCollection();
    }
}