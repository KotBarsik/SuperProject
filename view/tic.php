<?php
foreach ($data as $key => $value){
    $data = json_decode($value['data'],true);

    $img = '';

    if($data['file']){
        $template = '<a href="index.php?controller=img&method=get&type=updates&id='.$data['update_id'].'" target="_blank"><img src="index.php?controller=img&method=get&type=updates&id='.$data['update_id'].'" style="width: 100px;border: 1px solid;margin: 2px"/></a>';
        $img .= $template;
    }

    if(isset($data['message']) || strlen($img) >= 10) {
        $name = isset($data['message']['chat']['username']) ? $data['message']['chat']['username'] : $data['channel_post']['author_signature'];
        $time = isset($data['message']['date']) ? $data['message']['date'] :  (int)$data['channel_post']['date'];
        echo '
        <div>
            <div>Пользователь:' . $name . '</div>
            <div>Сообщение:' . $data['message']['text'] . '</div>
            <div>' . $img . '</div>
            <div>Дата публикации:' . date('Y-m-d H:i:s', $time) . '</div>
        </div><br>';
    }
}
?>