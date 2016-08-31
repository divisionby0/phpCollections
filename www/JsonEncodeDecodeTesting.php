<?php

include_once('div0/utils/Logger.php');
include_once('div0/collections/Map.php');
include_once('div0/collections/exceptions/CollectionException.php');
include_once('div0/collections/json/MapJsonEncoder.php');
include_once('div0/collections/json/MapJsonDecoder.php');
include_once('div0/collections/json/MapJsonEncoderException.php');

class JsonEncodeDecodeTesting {
    private $map;
    private $jsonEncoder;
    private $encodedMap;
    private $decodedMap;

    public function __construct(){
        $this->map = new Map();

        $subMap_1 = new Map();
        $subMap_2 = new Map();
        $subMap_3 = new Map();

        $this->map->add('1', $subMap_1);
        $this->map->add('2', $subMap_2);
        $this->map->add('3', $subMap_3);

        $subMap_1->add('1', 'sub1_1');
        $subMap_1->add('2', 'sub1_2');
        $subMap_1->add('3', 'sub1_3');

        $subMap_2->add('1', 'sub2_1');
        $subMap_2->add('2', 'sub2_2');
        $subMap_2->add('3', 'sub2_3');

        $subMap_3->add('1', 'sub3_1');
        $subMap_3->add('2', 'sub3_2');
        $subMap_3->add('3', 'sub3_3');

        $this->jsonEncoder = $this->map->getJsonEncoder();
        try{
            $this->encodedMap = $this->jsonEncoder->encode();
        }
        catch(MapJsonEncoderException $exception){
            Logger::logError('MapJsonEncoderException. '.$exception->getMessage());
            return;
        }

        Logger::logMessage('JSON: '.$this->encodedMap);

        $this->decodedMap = $this->decode();

        $this->jsonEncoder = $this->decodedMap->getJsonEncoder();
        $this->encodedMap = $this->jsonEncoder->encode();
        Logger::logMessage('JSON: '.$this->encodedMap);
    }

    private function decode(){
        $mapJsonDecoder = new MapJsonDecoder($this->encodedMap);
        return $mapJsonDecoder->decode();
    }
} 