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

    public function savePost($data){
        $prepare = $this->pdo->prepare("
            INSERT INTO `posts` 
            (`data`, `message`, `provider`, `status`, `uptime`,`publish_time`) VALUES 
            (:data,:message,:provider,:status,:uptime,:publish_time)
        ");

        $time = date('Y-m-d H:i:s',time());

        $prepare->bindParam(':data', json_encode($data['img']));
        $prepare->bindParam(':message',$data['message']);
        $prepare->bindParam(':provider',$data['type']);
        $prepare->bindParam(':status',$data['status']);
        $prepare->bindParam(':uptime',$time);
        $prepare->bindParam(':publish_time',$data['time']);
        $execute = $prepare->execute();

        return $execute;
    }

    public function allPosts(){
        $prepare = $this->pdo->prepare('SELECT * FROM posts');
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function postById($id){
        $prepare = $this->pdo->prepare('SELECT * FROM posts WHERE id=:id');
        $prepare->bindParam(':id', $id, \PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function postByPending(){
        $status = 'pending';
        $prepare = $this->pdo->prepare('SELECT * FROM posts WHERE status=:status');
        $prepare->bindParam(':status', $status, \PDO::PARAM_STR);
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }
}