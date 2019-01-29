<style>
    .name{
        width: 130px;
        display: inline-block;
    }
    .block{
        margin: 5px;
    }
</style>
<form enctype="multipart/form-data" method="post">
    <div class="block">Пост для : <?php echo $data['type']?></div>
    <input type="hidden" name="type" value="<?php echo $data['type']?>">
    <div class="block"><div class="name">Время публикации</div><input name="time" type="datetime-local"/></div>
    <div class="block"><div class="name">Пикча</div><input type="file" name="pic[]" min="1" max="5" multiple="true"/></div>
    <div class="block"><div class="name">Текст</div><textarea name="desc"></textarea></div>
    <div class="block"><div class="name">Отослать</div><input type="submit"></div>
</form>