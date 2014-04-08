<?php

/**
 * Description of getsomething
 *
 * @author dhruvil
 */

class getsomething {

    

    function getitnow($collection, $query, $extra) {

        $m = myprojMongoSingleton::getMongoCon();
        $col = $m->admin->$collection;
        $cursorgetitnow = $col->find($query, $extra);
        return $cursorgetitnow;
    }

    function getonlyone($collection, $query, $extra) {
        $m = myprojMongoSingleton::getMongoCon();
        $colone = $m->admin->$collection;
        $cursorgetonlyone = $colone->findOne($query, $extra);
        return $cursorgetonlyone;
    }

}
