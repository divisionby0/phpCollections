<?php

// TODO add json decoder exception
class MapJsonDecoder {
    private $dataString;

    public function __construct($dataString){
        $this->dataString = $dataString;
    }

    public function decode(){
        $rootMap = new Map('rootMap');
        Logger::logMessage('Decoding  '.$this->dataString);
        $this->decodeObject($rootMap, $this->dataString);
        return $rootMap;
    }

    private function decodeObject($parentMap, $dataString){
        $stringIsJson = $this->isJson($dataString);
        Logger::logMessage('Is json: '.$stringIsJson);
        if($stringIsJson){
            $decodedObject = $this->decodeFromString($dataString);
        }
        else{
            throw new MapJsonEncoderException('MapJsonDecoder error. Data is not json');
        }

        /*
        $decodedObject = json_decode($dataString);
        $jsonDecodeException = json_last_error();
        if($jsonDecodeException){
            Logger::logError($jsonDecodeException);
            throw new MapJsonEncoderException('MapJsonDecoder exception. '.$jsonDecodeException);
        }
        */

        $this->iterateObject($decodedObject, $parentMap);

    }

    private function iterateObject($decodedObject, $parentMap){
        foreach($decodedObject as $key=>$value){
            $valueIsJson = $this->isJson($value);

            if($valueIsJson){
                $subMap = new Map('subMap');

                $parentMap->add($key, $subMap);
                $this->decodeObject($subMap, $value);
            }
            else{
                $this->iterateObject($parentMap, $key, $value);
            }
        }
    }

    private function decodeFromString($dataString){
        $decodedObject = json_decode($dataString);
        $jsonDecodeException = json_last_error();

        if($jsonDecodeException){
            Logger::logError($jsonDecodeException);
            throw new MapJsonEncoderException('MapJsonDecoder exception. '.$jsonDecodeException);
            return;
        }
        return $decodedObject;
    }

    private function addToMap($map, $key, $value){
        $map->add($key, $value);
    }

    private function isJson($data) {
        json_decode($data);
        return (json_last_error() == JSON_ERROR_NONE);
    }
} 