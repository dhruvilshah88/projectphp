<?php
class updatesomething{
   
    function updateit($collection,$condition,$query,$extras){
       
        $m=  myprojMongoSingleton::getMongoCon();
        $coll=$m->admin->$collection;
        $cursor=$coll->update($condition,$query,$extras);
        return $cursor;
    }
    
}