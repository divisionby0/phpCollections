<?php

// TODO add json decoder exception
class MapJsonDecoder {
    private $dataString;

    public function __construct($dataString){
        $this->dataString = $dataString;
    }

    public function decode(){
        $rootMap = new Map();
        $this->decodeObject($rootMap, $this->dataString);
        return $rootMap;
    }

    private function decodeObject($parentMap, $dataString){
        $decodedObject = json_decode($dataString);

        foreach($decodedObject as $key=>$value){
            $valueIsJson = $this->isJson($value);

            if($valueIsJson){
                $subMap = new Map();

                $parentMap->add($key, $subMap);
                $this->decodeObject($subMap, $value);
            }
            else{
                $this->addToMap($parentMap, $key, $value);
            }
        }
    }

    private function addToMap($map, $key, $value){
        $map->add($key, $value);
    }

    private function isJson($data) {
        json_decode($data);
        return (json_last_error() == JSON_ERROR_NONE);
    }
} 