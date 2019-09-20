<?php echo $header ?>

<h2 class="title">Отчёт</h2>
<div id="add_win" class="add">
    <span id="add_b" class="title">Добавить запись <img src="/application/public/img/ico/down.png" alt="add"></span>
    <form action="" method="post">
        <label for="date">Дата записи</label>
        <input type="date" name="date" id="date"><br>
        <label for="name">Кто записал</label>
        <input type="text" name="name" id="name" placeholder="Имя Фамилия"><br>
        <label for="object">Описание</label>
        <textarea name="object" id="object" placeholder="Объект и предмет расходов / доходов"></textarea><br>
        <label for="sum">Сумма, грн</label>
        <input type="text" name="sum" id="sum" placeholder="Сумма"><br>
        <input type="submit" name="add" value="Добавить">
    </form>
</div>
<div class="table">
   <!--
    <div class="period">
        <label for="date_st">Период с</label>
        <input type="date" name="date_st" id="date_st">
        <label for="date_fin">по</label>
        <input type="date" name="date_fin" id="date_fin">
        <input type="button" name="period" id="period" value="Фильтр">
    </div>
    <div class="search">
        <label for="search_word">Для поиска начните вводить любые данные</label>
        <input type="text" name="search_word" id="search_word">
    </div>-->
    <table>
        <tr>
            <th>#</th>
            <th>Дата</th>
            <th>Кто записал</th>
            <th>Объект</th>
            <th>Сумма</th>
        </tr>
        <?php 
        $plus = 0;
        $minus = 0;
        ?>
        <?php $count = count($reports); foreach($reports as $report): ?>
        <tr>
            <td>
                <?php echo $report['id']; ?>
            </td>
            <td>
                <?php echo $report['date']; ?>
            </td>
            <td>
                <?php echo $report['writer']; ?>
            </td>
            <td>
                <?php echo $report['description']; ?>
            </td>
            <td class="<?php echo ($report['cost'] < 0?'minus':'plus'); ?>">
                <?php echo $report['cost']; ?>
                <?php 
                if($report['cost'] < 0) $minus += $report['cost'];
                else $plus += $report['cost'];
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <tr class="total">
            <td><?php echo $count; ?></td>
            <td></td>
            <td>Ушло : <b class="minus"><?php echo $minus; ?></b></td>
            <td>Пришло : <b class="plus"><?php echo $plus; ?></b></td>
            <td>Всего: <b class="<?php echo (($plus+$minus) < 0?'minus':'plus'); ?>"><?php echo $plus + $minus; ?></b></td>
        </tr>
    </table>
</div>
<script>
    h_block = 320;
    url = "/report";
 
</script>

<?php echo $footer ?>
