<?php
namespace models;
use component\db;
class Updates
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct()
    {
        $this->pdo = db::connect();
    }

    public function save($data){
        $prepare = $this->pdo->prepare("
            INSERT INTO `updates` 
            (`data`,`update_id`,`uptime`,`create_time`) VALUES 
            (:data,:update_id,:uptime,:create_time)
        ");

        $time = date('Y-m-d H:i:s',time());

        $prepare->bindParam(':data', json_encode($data['data']));
        $prepare->bindParam(':update_id',$data['update_id']);
        $prepare->bindParam(':uptime',$time);
        $prepare->bindParam(':create_time',$time);
        $execute = $prepare->execute();

        return $execute;
    }

    public function all(){
        $prepare = $this->pdo->prepare('SELECT * FROM updates');
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function lastUpdateId(){
        $prepare = $this->pdo->prepare('SELECT max(update_id) as max FROM updates');
        $prepare->execute();
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);

        return isset($result['max']) ? (int)$result['max'] : 0;
    }

    public function byId($id){
        $prepare = $this->pdo->prepare('SELECT * FROM updates WHERE update_id=:update_id');
        $prepare->bindParam(':update_id', $id, \PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}