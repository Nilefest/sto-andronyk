<?php echo $header ?>
<h2 class="title">КЛИЕНТ:
    <?php echo $client['name']; ?>
</h2>
<div class="form">
    <form action="" method="post">
        <label for="name">ФИО</label>
        <input type="text" name="name" id="name" placeholder="Имя Фамилия Отчество" value="<?php echo $client['name']; ?>"><br>
        <label for="contact">Контактные данные</label>
        <textarea name="contact" id="contact" placeholder="Телефон, почта..."><?php echo $client['contact']; ?></textarea>
        <label for="car">Марка авто</label>
        <input type="text" name="car_mark" id="car" placeholder="марка" value="<?php echo $client['car_mark']; ?>">
        <label for="car_num">Номер</label>
        <input type="text" name="car_num" id="car_num" placeholder="номер" value="<?php echo $client['car_num']; ?>"><br>
        <input type="hidden" name="id" value="<?php echo $client['id']; ?>">
        <input type="submit" name="save" value="Сохранить">
    </form>
</div>
<h3 class="title">Проводимые работы</h3>
<div class="table">
    <div class="period">
        <label for="date_st">Период с</label>
        <input type="date" name="date_st" id="date_st">
        <label for="date_fin">по</label>
        <input type="date" name="date_fin" id="date_fin">
        <input type="button" name="period" id="period" value="Фильтр">
    </div>
    <table>
        <tr>
            <th>#</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Описание работ</th>
            <th>Общая стоимость</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach($works as $work): ?>
        <tr>
            <td>
                <?php echo $work['id']; ?>
            </td>
            <td>
                <?php echo $work['date_st']; ?>
            </td>
            <td>
                <?php echo $work['date_fin']; ?>
            </td>
            <td>
                <?php echo $work['description']; ?>
            </td>
            <td>
                <?php echo $work['cost']; ?>
            </td>
            <td><a href="/work/more/<?php echo $work['id']; ?>"><img src="/application/public/img/ico/edit.png" alt="edit"></a></td>
            <td><img src="/application/public/img/ico/rem.png" alt="<?php echo $work['id']; ?>" id="rem_row"></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    url = "/clients/more";

</script>
<?php echo $footer ?>
