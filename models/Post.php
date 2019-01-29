<?php
namespace models;
use component\db;
class Post
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = db::connect();
    }

    public function byPostTelegram($status){
        $prepare = $this->pdo->prepare('SELECT * FROM posts WHERE status=:status');
        $prepare->bindParam(':status', $status, \PDO::PARAM_STR);
        $prepare->execute();
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);

        return $result;
    }
}