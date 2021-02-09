<?php


namespace App\Model;


use App\Traits\DB;

abstract class Model
{
    use DB;

    public static function findAll()
    {
        $db = self::getDb();
        $stm = $db->query('SELECT * FROM ' . static::TABLE);
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): array
    {
        $db = self::getDb();
        $stm = $db->prepare('SELECT * FROM ' . static::TABLE . ' WHERE id = ?');
        $stm->execute([$id]);
        $result = $stm->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public static function remove(int $id)
    {
        $db = self::getDb();
        $stm = $db->prepare('DELETE FROM ' . static::TABLE . ' WHERE id = ?');
        $stm->execute([$id]);
    }

}