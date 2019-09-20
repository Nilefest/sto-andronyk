<?php echo $header ?>

<h2 class="title">Главная</h2>
<hr>
<h3 class="title">Незавершённые <a href="/work">работы</a> (<b class="minus">
        <?php echo count($works); ?></b>)</h3>
<div class="table">
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
        </tr>
        <?php foreach($works as $work): ?>
        <tr>
            <td>
                <?php echo $work['id']; ?>
            </td>
            <td>
                <?php echo $employee[$work['emp_id']]['name']; ?>
            </td>
            <td>
                <a href="/clients/more/<?php echo $clients[$row['cl_id']]['id']; ?>">
                    <?php echo $clients[$work['cl_id']]['name']; ?>
                </a>
            </td>
            <td>
                <?php echo $clients[$work['cl_id']]['contact']; ?>
            </td>
            <td>
                <?php echo $clients[$work['cl_id']]['car_mark']."(".$clients[$work['cl_id']]['car_num'].")"; ?>
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
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<h3 class="title">Заканчивающиея детали / материалы на <a href="/work">складе</a> (<b class="minus">
        <?php echo count($stock); ?></b>)</h3>
<div class="table">
    <table>
        <tr>
            <th>#</th>
            <th>Маркировка</th>
            <th>Название</th>
            <th>Производитель</th>
            <th>Вид авто</th>
            <th>Количество</th>
            <th>Цена (за 1)</th>
        </tr>
        <?php foreach($stock as $det): ?>
        <tr value="<?php echo $det['id']; ?>">
            <td>
                <?php echo $det['id']; ?>
            </td>
            <td>
                <?php echo $det['mark']; ?>
            </td>
            <td>
                <?php echo $det['name']; ?>
            </td>
            <td>
                <?php echo $det['provider']; ?>
            </td>
            <td>
                <?php echo $det['type_car']; ?>
            </td>
            <td>
                <div class="form edit">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $det['id']; ?>">
                        <input type="text" name="count" value="<?php echo $det['count']; ?>">
            <?php if($lvl == '0'):?>
                        <input type="submit" name="new_count" value="OK">
                        <?php endif;?>
                    </form>
                </div>
            </td>
            <td>
                <div class="form edit">
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $det['id']; ?>">
                        <input type="text" name="cost" value="<?php echo $det['cost']; ?>">
            <?php if($lvl == '0'):?>
                        <input type="submit" name="new_cost" value="OK">
                        <?php endif;?>
                    </form>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<br>
<?php echo $footer ?>
