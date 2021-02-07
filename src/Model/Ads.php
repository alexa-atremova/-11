<?php

namespace App\Model;

use App\Exception\ValidationException;
use App\Traits\DB;

class Ads
{
    use DB;

    public const TABLE = 'ads';
    private string $title;
    private string $comments;

    public function __construct(
        string $title,
        string $comments

    )
    {
        $this->setTitle($title);
        $this->setComments($comments);

    }

    public static function findAll()
    {
        $db = self::getDb();
        $stm = $db->query('SELECT * FROM ' . static::TABLE);
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function findByTitle(string $title)
    {
        $db = self::getDb();
        $stm = $db->prepare('SELECT * FROM ads WHERE title = ?');
        $stm->execute([$title]);
        $ads = $stm->fetch(\PDO::FETCH_ASSOC);
        return $ads ? $ads : [];
    }

    public static function save(Ads $ads)
    {
        $db = self::getDb();
        $check = self::findByTitle($ads->getTitle());
        if ($check) {
            throw new ValidationException(['title' => "Title already exist"]);
        }
        $stm = $db->prepare('
            INSERT INTO ads (title, comments)
            VALUE (?,?)
        ');

        $stm->execute([
            $ads->getTitle(),
            $ads->getComments(),

        ]);
    }

    public static function remove(string $title)
    {
        $db = self::getDb();
        $stm = $db->prepare('DELETE FROM ads WHERE title = ?');
        $stm->execute([$title]);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getComments(): string
    {
        return $this->comments;
    }

    /**
     * @param string $comments
     */
    public function setComments(string $comments): void
    {
        $this->comments = $comments;
    }


}