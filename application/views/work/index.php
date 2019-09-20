<?php echo $header ?>

<h2 class="title">Работы</h2>
<div id="add_win" class="add">
    <span id="add_b" class="title">Добавить запись <img src="/application/public/img/ico/down.png" alt="add"></span>
    <form action="" method="post">
        <label for="employee">Сотрудник</label>
        <select name="emp_id" id="employee">
            <?php foreach($employee as $emp): ?>
            <option value="<?php echo $emp['id']; ?>">
                <?php echo $emp['name']; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <label for="client">Клиент</label>
        <select name="cl_id" id="client">
            <?php foreach($clients as $client): ?>
            <option value="<?php echo $client['id']; ?>">
                <?php echo $client['name'].". ".$client["car_mark"]; ?>
            </option>
            <?php endforeach; ?>
        </select>
        <label for="date_st">Дата начала</label>
        <input type="date" name="date_st" id="date_st">
        <input type="submit" name="add" value="Добавить">
    </form>
</div>
<div class="table">
    <!--<div class="period">
        <label for="date_st">Период с</label>
        <input type="date" name="date_st" id="date_st">
        <label for="date_fin">по</label>
        <input type="date" name="date_fin" id="date_fin">
        <input type="button" name="period" id="period" value="Фильтр">
    </div>-->
    <table>
        <tr>
            <th>#</th>
            <th>Имя сотрудника</th>
            <th>Имя клиента</th>
            <th>Контакты клиента</th>
            <th>Авто</th>
            <th>Дата начала</th>
            <th>Дата окончания</th>
            <th>Операции</th>
            <th>Стоимость работ</th>
            <th></th>
            <?php if($lvl == '0'):?>
            <th></th>
            <?php endif; ?>
        </tr>
        <?php foreach($works as $work): ?>
        <tr>
            <td><?php echo $work['id']; ?></td>
            <td><?php echo $employee[$work['emp_id']]['name']; ?></td>
            <td>
                <a href="/clients/more/<?php echo $clients[$row['cl_id']]['id']; ?>">
                    <?php echo $clients[$work['cl_id']]['name']; ?>
                </a>
            </td>
            <td><?php echo $clients[$work['cl_id']]['contact']; ?></td>
            <td><?php echo $clients[$work['cl_id']]['car_mark']."(".$clients[$work['cl_id']]['car_num'].")"; ?></td>
            <td><?php echo $work['date_st']; ?></td>
            <td><?php echo $work['date_fin']; ?></td>
            <td><?php echo $work['description']; ?></td>
            <td><?php echo $work['cost']; ?></td>
            <td><a href="/work/more/<?php echo $work['id']; ?>"><img src="/application/public/img/ico/edit.png" alt="edit"></a></td>
            <?php if($lvl == '0'):?>
            <td><img src="/application/public/img/ico/rem.png" alt="<?php echo $work['id']; ?>" id="rem_row"></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
        <tr class="total">
            <td><?php echo $count; ?></td>
            <td>всего</td>
            <td></td>
            <td></td>
            <td>Охваченный период</td>
            <td><?php echo $date_min; ?></td>
            <td><?php echo $date_max; ?></td>
            <td></td>
            <td><?php echo $total; ?></td>
            <td></td>
            <?php if($lvl == '0'):?>
            <td></td>
            <?php endif; ?>
        </tr>
    </table>
</div>
<script>
    h_block = 230;
    url = "/work";

</script>

<?php echo $footer ?>
