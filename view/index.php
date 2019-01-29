<?php
foreach ($data as $key => $value){
    $data = json_decode($value['data']);

    $img = '';

    foreach ($data as $id => $i){
        $template = '<a href="index.php?controller=img&method=get&id='.$value['id'].'|'.$id.'" target="_blank"><img src="index.php?controller=img&method=get&id='.$value['id'].'|'.$id.'" style="width: 100px;border: 1px solid;margin: 2px"/></a>';
        $img .= $template;
    }

    echo '
    <div>
        <div>Меседжер:'.$value['provider'].'</div>
        <div>Кол.во картинок:'.count(json_decode($value['data'])).'</div>
        <div>'.$img.'</div>
        <div>Статус:'.$value['status'].'</div>
        <div>Дата публикации:'.$value['publish_time'].'</div>
    </div><br>';
}
?>
