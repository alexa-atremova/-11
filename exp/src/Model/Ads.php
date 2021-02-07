<?php

namespace App\Model;

use App\Exception\ValidationException;
use App\Traits\DB;
use DateTime;

class Ads extends Model
{
    use DB;

    public const ADS_TITLE_MAX = 100;
    public const ADS_BODY_MAX = 1000;
    public const TABLE = 'ads';


    private string $title;
    private string $body;
    private DateTime $createdAt;

    public function __construct(string $title, string $body)
    {

        $this->title = $title;
        $this->body = $body;
        $this->createdAt = new DateTime();
    }

    public static function save(Ads $ads)
    {
        $checkAdsExist = self::findByTitle($ads->getTitle());
        if ($checkAdsExist) {
            throw new ValidationException([
                'adsTitle' => 'Title already exist'
            ]);
        }

        $db = self::getDb();
        $stm = $db->prepare('
            INSERT INTO ads (title,body,created_at)
            VALUE (?,?,?)
        ');

        $stm->execute([
            $ads->getTitle(),
            $ads->getBody(),
            $ads->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }

    public static function findByTitle(string $title): array
    {
        $db = self::getDb();
        $stm = $db->prepare('SELECT * FROM ads WHERE title = ?');
        $stm->execute([$title]);
        $result = $stm->fetch(\PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

}