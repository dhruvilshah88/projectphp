<?php

class myprojMongoSingleton
{
    static $m1 = NULL;

    static function getMongoCon()
    {
        if (self::$m1 === null)
        {
            try {
                $m = new Mongo();

            } catch (MongoConnectionException $e) {
                die('Failed to connect to MongoDB '.$e->getMessage());
            }
            self::$m1 = $m;
        }

        return self::$m1;
    }
}
?>