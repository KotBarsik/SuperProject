<?php
namespace command;

use models\Post;
use models\Telegram;
use models\Updates;

class Parse
{
    /**
     * Публиковать ли просроченые посты
     * @var int
     */
    private $overdue = true;

    public function telegram(){
        $telegram = new Telegram();
        $updateData = json_decode($telegram->getUpdates(),true);

        $update = new Updates();
        $lastUpdateId = $update->lastUpdateId();
        foreach ($updateData['result'] as $uid => $uval){
            $updateId = (int)$uval['update_id'];
            if($updateId > $lastUpdateId) {
                if(isset($uval['channel_post']['document'])){
                    $uval['file'] = $telegram->getFile($uval['channel_post']['document']['file_id']);
                }
                $update->save([
                    'data' => $uval,
                    'update_id' => $updateId
                ]);
            }
        }
    }
}