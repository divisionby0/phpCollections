<?php

include_once ('div0/utils/Logger.php');
include_once ('div0/collections/ICollection.php');
include_once ('div0/collections/AbstractCollection.php');
include_once ('div0/collections/iterators/AbstractCollectionIterator.php');
include_once ('div0/collections/iterators/IndexedListIterator.php');

include_once ('div0/collections/exceptions/CollectionException.php');
include_once ('div0/collections/IndexedList.php');
class ListTesting
{
    private $list;
    
    private function iterateList(){
        $listIterator = $this->list->getIterator();
        while($listIterator->hasNext()){
            Logger::logMessage('item :'.$listIterator->next());
        }
    }

    public function __construct()
    {
        $this->list = new IndexedList();
        Logger::logMessage("Size: ".$this->list->size());

        try{
            $this->list->remove(1);
        }
        catch(CollectionException $exception){
            Logger::logMessage('Collection exception: '.$exception->getMessage());
        }

        $this->list->add(45);
        $this->list->add(46);
        $this->list->add(47);

        try{
            $nonExistingItem = $this->list->get(47);
            Logger::logMessage("item by index 47 = ".$nonExistingItem);
        }
        catch(CollectionException $exception){
            Logger::logMessage('Removing  nonExisting index.. Collection exception: '.$exception->getMessage());
        }

        $this->list->remove(1);
        Logger::logMessage("Size: ".$this->list->size());

        Logger::logMessage('item removed');
        $this->iterateList();

        $this->list->remove(1);
        Logger::logMessage("Size: ".$this->list->size());
        $this->iterateList();

        $this->list->remove(0);
        Logger::logMessage("Size: ".$this->list->size());
        $this->iterateList();

        try{
            $deletedItem = $this->list->get(-1);
            Logger::logMessage("deletedItem= ".$deletedItem);
        }
        catch(CollectionException $exception){
            Logger::logMessage('Collection exception: '.$exception->getMessage());
        }

        try{
            $nonExistingItem = $this->list->get(-1);
            Logger::logMessage("nonExistingItem= ".$nonExistingItem);
        }
        catch(CollectionException $exception){
            Logger::logMessage('Collection exception: '.$exception->getMessage());
        }

        try{
            $nonExistingItem = $this->list->get('abs');
            Logger::logMessage("nonExistingItem= ".$nonExistingItem);
        }
        catch(CollectionException $exception){
            Logger::logMessage('Collection exception: '.$exception->getMessage());
        }

        try{
            $nonExistingItem = $this->list->remove(134);
            Logger::logMessage("nonExistingItem= ".$nonExistingItem);
        }
        catch(CollectionException $exception){
            Logger::logMessage('Collection exception: '.$exception->getMessage());
        }
    }
}