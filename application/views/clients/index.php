<?php echo $header ?>

<h2 class="title">Клиенты</h2>
<div id="add_win" class="add">
    <span id="add_b" class="title">Добавить клиента <img src="/application/public/img/ico/down.png" alt="add"></span>
    <form action="" method="post">
        <label for="name">ФИО</label>
        <input type="text" name="name" id="name" placeholder="Имя Фамилия Отчество"><br>
        <label for="car">Марка автомобиля</label>
        <input type="text" name="car_mark" id="car" placeholder="Марка авто"><br>
        <label for="car_num">Номер автомобиля</label>
        <input type="text" name="car_num" id="car_num" placeholder="Номер авто"><br>
        <label for="contact">Контактные данные</label>
        <textarea name="contact" id="contact" placeholder="Телефон, почта..."></textarea><br>
        <input type="submit" name="add" value="Добавить">
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
            <th>Имя</th>
            <th>Контакты</th>
            <th>Авто</th>
            <?php if($lvl == '0'):?>
            <th></th>
            <?php endif; ?>
        </tr>
        <?php foreach($clients as $client): ?>
        <tr class="dynamic">
            <td>
                <?php echo $client['id']; ?>
            </td>
            <td>
                <a href="/clients/more/<?php echo $client['id']; ?>">
                    <?php echo $client['name']; ?>
                </a>
            </td>
            <td>
                <?php echo $client['contact']; ?>
            </td>
            <td>
                <?php echo $client['car_mark']."(".$client['car_num'].")"; ?>
            </td>
            <?php if($lvl == '0'):?>
            <td><img src="/application/public/img/ico/rem.png" alt="<?php echo $client['id']; ?>" id="rem_row"></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<script>
    h_block = 320;
    url = "/clients";
    $("#search_word").keyup(function() {
        var str = $("#search_word").val();
        $.ajax({
            url: "/clients/search",
            method: "post",
            data: {
                words: str
            },
            success: function(data) {
                $(".dynamic").remove();
                var data = JSON.parse(data);
                data.forEach(function(item, i, arr) {
                    var row = '<tr class="dynamic"><td>' + item['id'] + '</td><td><a href="/clients/more/' + item['id'] + '">' + item['name'] + '</a></td><td>' + item['contact'] + '</td><td>' + item['car_mark'] + '( ' + item['car_num'] + ')</td>';
                    
                    if(item['lvl'] == '0')
                        row += '<td><img src="/application/public/img/ico/rem.png" alt="' + item['id'] + '" id="rem_row"></td>';
                                        
                    row += '</tr>';
                    
                    $("#table").append(row);
                });
            }
        });
    });

</script>
<?php echo $footer ?>
