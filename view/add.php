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
    <div class="block">
        <div class="name">В какой меседжер</div>
        <select name="type">
            <option value="telegram">telegram</option>
            <option value="facebook">facebook</option>
        </select>
    </div>
    <div class="block"><div class="name">Идонтификатор паблика</div><input name="pubId"/></div>
    <div class="block"><div class="name">Время публикации</div><input name="time" type="datetime-local"/></div>
    <div class="block"><div class="name">Пикча</div><input type="file" name="pic[]" min="1" max="5" multiple="true"/></div>
    <div class="block"><div class="name">Текст</div><textarea name="desc"></textarea></div>
    <div class="block"><div class="name">Отослать</div><input type="submit"></div>
</form>