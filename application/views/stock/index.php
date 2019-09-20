<?php echo $header ?>

<h2 class="title">Склад</h2>
<div id="add_win" class="add">
    <span id="add_b" class="title">Добавить запись <img src="/application/public/img/ico/down.png" alt="add"></span>
    <form action="" method="post">
        <label for="mark">Маркировка</label>
        <input type="text" name="mark" id="mark" placeholder="маркировка детали"><br>
        <label for="name">Название</label>
        <input type="text" name="name" id="name" placeholder="Название детали"><br>
        <label for="provider">Производитель</label>
        <input type="text" name="provider" id="provider" placeholder="Производитель детали"><br>
        <label for="type_car">Вид авто</label>
        <input type="text" name="type_car" id="type_car" placeholder="Вид авто"><br>
        <label for="count">Количество деталей</label>
        <input type="text" name="count" id="count" placeholder="Количество деталей"><br>
        <label for="cost">Цена (за 1)</label>
        <input type="text" name="cost" id="cost" placeholder="00,00"><br>
        <input type="submit" name="add_item" value="Добавить">
    </form>
</div>
<div class="table">
    <div class="search">
        <label for="search_word">Для поиска начните вводить любые данные</label>
        <input type="text" name="search_word" id="search_word">
    </div>
    <!---->
    <table id="table">
        <tr>
            <th>#</th>
            <th>Маркировка</th>
            <th>Название</th>
            <th>Производитель</th>
            <th>Вид авто</th>
            <th>Количество</th>
            <th>Цена (за 1)</th>
            <?php if($lvl == '0'):?>
            <th></th>
            <?php endif;?>
        </tr>
        <?php foreach($stock as $det): ?>
        <tr class="dynamic" value="<?php echo $det['id']; ?>">
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
                        <?php endif; ?>
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
                        <?php endif; ?>
                    </form>
                </div>
            </td>
            <?php if($lvl == '0'):?>
            <td><img src="/application/public/img/ico/rem.png" alt="<?php echo $det['id']; ?>" id="rem_row"></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    h_block = 385;
    url = "/stock";
    $("#search_word").keyup(function() {
        var str = $("#search_word").val();
        $.ajax({
            url: "/stock/search",
            method: "post",
            data: {
                words: str
            },
            success: function(data) {
                $(".dynamic").remove();
                var data = JSON.parse(data);
                data.forEach(function(item, i, arr) {
                    var row = '<tr class="dynamic"><td>' + item['id'] + '</td><td>' + item['mark'] + '</td><td>' + item['name'] + '</td><td>' + item['provider'] + '</td><td>' + item['type_car'] + '</td>';
                    
                    // form new count
                    row += '<td><div class="form edit"><form action="" method="post"><input type="hidden" name="id" value="' + item['id'] + '"><input type="text" name="count" value="' + item['count'] + '">';
                    if (item['lvl'] == '0')
                        row += '<input type="submit" name="new_count" value="OK">';
                    row += '</form></div></td>';
                    
                    // form new cost
                    row += '<td><div class="form edit"><form action="" method="post"><input type="hidden" name="id" value="' + item['id'] + '"><input type="text" name="count" value="' + item['cost'] + '">';
                    if (item['lvl'] == '0')
                        row += '<input type="submit" name="new_cost" value="OK">';
                    row += '</form></div></td>';
                    
                    if (item['lvl'] == '0')
                        row += '<td><img src="/application/public/img/ico/rem.png" alt="' + item['id'] + '" id="rem_row"></td>';

                    row += '</tr>';

                    $("#table").append(row);
                });
            }
        });
    });

</script>

<?php echo $footer ?>
