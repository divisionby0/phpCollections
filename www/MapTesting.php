<?php
include_once('div0/utils/Logger.php');
include_once('div0/collections/Map.php');
include_once('div0/collections/exceptions/CollectionException.php');

class MapTesting {

    private $map;
    private $mapSize;
    private  $unusedKey = 'empty_key';

    private  $firstKey = 'firstKey';
    private  $firstValue = 'firstValue';

    private  $secondKey = 'secondKey';
    private  $secondValue = 'secondValue';

    private  $thirdKey = 'thirdKey';
    private  $thirdValue = 'thirdValue';

    public function __construct(){
        $this->map = new Map();

        $this->testCollectionSize(0);

        Logger::logMessage('Testing get element from empty collection exception.');
        try{
            $value = $this->map->get($this->unusedKey);
        }
        catch(CollectionException $exception){
            Logger::logError($exception->getMessage());
            $this->testPassed();
        }

        // add one element
        $this->map->add($this->firstKey, $this->firstValue);

        Logger::logMessage('added one element key="'.$this->firstKey.'" value="'.$this->firstValue.'"');

        $this->testCollectionSize(1);

        Logger::logMessage('Testing get value by unused key exception.');

        try{
            $nullValue = $this->map->get($this->unusedKey);
        }
        catch(CollectionException $exception){
            Logger::logError($exception->getMessage());
            $this->testPassed();
        }

        $this->testGetFirstValueByKey();

        Logger::logMessage('Testing add 2 more elements...');
        $this->map->add($this->secondKey, $this->secondValue);
        $this->map->add($this->thirdKey, $this->thirdValue);

        $this->testPassed();
        $this->testCollectionSize(3);

        $this->testGetThirdValueByKey();
        $this->testGetSecondValueByKey();

        Logger::logMessage('Testing remove element by unused key');
        try{
            $nullValue = $this->map->remove($this->unusedKey);
        }
        catch(CollectionException $exception){
            $this->testPassed();
        }

        Logger::logMessage('Testing remove element by existing key');
        try{
            $this->map->remove($this->firstKey);
            $this->testPassed();
        }
        catch(CollectionException $exception){
            Logger::logError($exception->getMessage());
        }

        $this->testCollectionSize(2);

        Logger::logMessage('Testing get value by removed key');
        try{
            $this->map->get($this->firstKey);
        }
        catch(CollectionException $exception){
            $this->testPassed();
        }

        Logger::logMessage('Testing clear map...');
        $this->map->clear();
        $this->testPassed();

        $this->testCollectionSize(0);
    }

    private function testGetFirstValueByKey(){
        Logger::logMessage('Testing get 1st value by key...');
        try{
            $value = $this->map->get($this->firstKey);

            if($value == $this->firstValue){
                $this->testPassed();
            }
            else{
                Logger::logError('assertion error. waiting "'.$this->firstValue.'"  received "'.$value.'"');
            }
        }
        catch(CollectionException $exception){
            Logger::logError($exception->getMessage());
        }
    }

    private function testGetSecondValueByKey(){
        Logger::logMessage('Testing get 2nd value by key...');
        try{
            $value = $this->map->get($this->secondKey);

            if($value == $this->secondValue){
                $this->testPassed();
            }
            else{
                Logger::logError('assertion error. waiting "'.$this->secondValue.'"  received "'.$value.'"');
            }
        }
        catch(CollectionException $exception){
            Logger::logError($exception->getMessage());
        }
    }

    private function testGetThirdValueByKey(){
        Logger::logMessage('Testing get 3rd value by key...');
        try{
            $value = $this->map->get($this->thirdKey);

            if($value == $this->thirdValue){
                $this->testPassed();
            }
            else{
                Logger::logError('assertion error. waiting "'.$this->thirdValue.'"  received "'.$value.'"');
            }
        }
        catch(CollectionException $exception){
            Logger::logError($exception->getMessage());
        }
    }

    private function testCollectionSize($assertionSize){
        Logger::logMessage('Testing collection size...');
        $this->mapSize = $this->getSize();
        if($this->map->size() == $assertionSize){
            $this->testPassed();
        }
        else{
            Logger::logError('assertion error. waiting '.$assertionSize.' received "'.$this->mapSize.'"');
        }
    }

    private function testPassed(){
        Logger::logMessage('<b style="color: white; background-color: green">Test passed</b>');
    }

    private function getSize(){
        return $this->map->size();
    }

    private function dumpMap(){
        return $this->map->dumpCollection();
    }
} 