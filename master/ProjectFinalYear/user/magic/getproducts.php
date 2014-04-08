<?php

class getprod {

    function getprod() {
        echo 'inside constructor';
        
        
    }
    function getfromquery($collection, $query) {
        $m = myprojMongoSingleton::getMongoCon();
        $collec = $m->admin->$collection;
        $cursor=$collec->find($query);
        return $cursor;
    }

    function getdata($collection) {
        $m = myprojMongoSingleton::getMongoCon();
        $coll = $m->admin->$collection;
        $cursor = $coll->find();
        return $cursor;
    }

}
