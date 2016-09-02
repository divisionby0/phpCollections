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
    private $encodedString;
    private $decodedMap;

    public function __construct(){
        $this->map = new Map('rootMap');

        $subMap_1 = new Map('subMap1');
        $subMap_2 = new Map('subMap2');
        $subMap_3 = new Map('subMap3');

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
            $this->encodedString = $this->jsonEncoder->encode();
        }
        catch(MapJsonEncoderException $exception){
            Logger::logError('MapJsonEncoderException. '.$exception->getMessage());
            return;
        }

        Logger::logMessage('JSON: '.$this->encodedString);


        $this->decodedMap = $this->decode($this->encodedString);

        $this->jsonEncoder = $this->decodedMap->getJsonEncoder();
        $this->encodedString = $this->jsonEncoder->encode();
        Logger::logMessage('JSON: '.$this->encodedString);

        $jsDataMap  = null;
        //$testJSEncodedString = '{"1":{"id":"subMap1","key1":"\"sub1_1\"","key2":"\"sub1_2\"","key3":"\"sub1_3\""},"2":{"id":"subMap2","key1":"\"sub2_1\"","key2":"\"sub2_2\"","key3":"\"sub2_3\""},"3":{"id":"subMap3","key1":"\"sub3_1\"","key2":"\"sub3_2\"","key3":"\"sub3_3\""},"id":"rootMap"}';
        $testJSEncodedString = '{"1":"{\"1\":\"sub1_1\",\"2\":\"sub1_2\",\"3\":\"sub1_3\"}","2":"{\"1\":\"sub2_1\",\"2\":\"sub2_2\",\"3\":\"sub2_3\"}","3":"{\"1\":\"sub3_1\",\"2\":\"sub3_2\",\"3\":\"sub3_3\"}"}';
        $jsDataMap = $this->decode($testJSEncodedString);
    }

    private function decode($string){

        $mapJsonDecoder = new MapJsonDecoder($string);
        $decoded = null;
        try{
            $decoded = $mapJsonDecoder->decode();
            return $decoded;
        }
        catch(MapJsonEncoderException $exception){
            Logger::logError('MapJsonEncoderException. '.$exception->getMessage());
        }
    }
} 