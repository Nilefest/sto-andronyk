<?php echo $header ?>

<h2 class="title">РАБОТЫ: #
    <?php echo $work['id']; ?>
</h2>
<div class="form">
    <form action="" method="post">
        <label for="employee">Сотрудник</label>
        <select name="emp_id" id="employee">
            <?php foreach($employee as $emp): ?>
            <option value="<?php echo $emp['id']; ?>" <?php echo ($emp['id']==$work['emp_id']?'selected':''); ?>>
                <?php echo $emp['name']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <label for="client">Клиент</label>
        <select name="cl_id" id="client">
            <?php foreach($clients as $client): ?>
            <option value="<?php echo $client['id']; ?>" <?php echo ($client['id']==$work['cl_id']?'selected':''); ?>>
                <?php echo $client['name']." (".$client['car_mark']." ".$client['car_num'].")"; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <label for="date_st">Дата начала (yyyy-mm-dd)</label>
        <input type="date" name="date_st" id="date_st" value="<?php echo str_replace(" .", "-" , $work['date_st']); ?>">
        <label for="date_fin">Дата окончания (yyyy-mm-dd)</label>
        <input type="date" name="date_fin" id="date_fin" value="<?php echo str_replace(" .", "-" , $work['date_fin']); ?>">
        <input type="hidden" name="id" id="id" value="<?php echo $work['id']; ?>">
        <?php if($edit):?><input type="submit" name="save" value="Сохранить">
        <?php endif;?>
    </form>
    <fieldset>
        <h3 class="title">Детали и материалы со склада</h3>
        <hr>
        <?php if($edit):?>
        <form action="" method="post">
            <label for="detail">Наименование</label>
            <select name="detail" id="detail">
                <?php foreach($stock as $det): ?>
                <option value="<?php echo $det['id']; ?>">
                    <?php echo $det['name']." (".$det['count']." / ".$det['cost'].")"; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label for="count">Количество</label>
            <input type="text" name="count" id="det_count" placeholder="Количество">
            <input type="hidden" name="w_id" id="w_id" value="<?php echo $work['id']; ?>">
            <input type="submit" name="det" id="det" value="Добавить">
        </form>
        <?php endif;?>
        <div class="table">
            <table id="det_tab">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Описание</th>
                        <th>Общая стоимость</th>
                        <?php if($edit):?>
                        <th></th>
                        <?php endif;?>
                    </tr>
                </thead>
                <?php $total = 0; foreach($work_op as $op): ?>
                <tr>
                    <td>
                        <?php echo $op['id']; ?>
                    </td>
                    <td>
                        <?php echo $op['description']; ?>
                    </td>
                    <td>
                        <?php $total += 1*$op['cost']; echo $op['cost']; ?>
                    </td>
                    <?php if($edit):?>
                    <td><img src="/application/public/img/ico/rem.png" alt="<?php echo $op['id']; ?>" id="rem_row"></td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
                <tr class="total">
                    <td><span class="count_all">
                            <?php echo count($work_op); ?></span></td>
                    <td>Общая стоимость</td>
                    <td><span class="sum_all">
                            <?php echo $total; ?></span></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <hr>
    </fieldset>
    <?php if($edit):?>
    <h3>Оплата труда</h3>
    <form action="" method="post">
        <label for="description">Описание работ</label>
        <textarea name="description" id="description" placeholder="Описание"></textarea>
        <label for="cost">Стоимость работ</label>
        <input type="text" name="cost" id="cost" placeholder="Сумма">
        <input type="hidden" name="w_id" id="w_id" value="<?php echo $work['id']; ?>">
        <input type="submit" name="op" value="Сохранить">
    </form>
    <?php endif;?>
</div>
<script>
    url = "/work/more";

</script>
<?php echo $footer ?>
