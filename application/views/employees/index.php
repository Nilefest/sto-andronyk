<?php echo $header ?>

<h2 class="title">Сотрудники</h2>
<div id="add_win" class="add">
    <span id="add_b" class="title">Добавить сотрудника <img src="/application/public/img/ico/down.png" alt="add"></span>
    <form action="" method="post">
        <label for="name">ФИО</label>
        <input type="text" name="name" id="name" placeholder="Имя Фамилия Отчество"><br>
        <label for="contact">Контактные данные</label>
        <textarea name="contact" id="contact" placeholder="Телефон, почта..."></textarea><br>
        <input type="submit" name="add" value="Добавить">
    </form>
</div>
<div class="table">
    <table>
        <tr>
            <th>#</th>
            <th>Имя</th>
            <th>Контакты</th>
            <?php if($lvl == '0'):?>
            <th></th>
            <?php endif; ?>
        </tr>
        <?php foreach($employees as $employee): ?>
        <tr>
            <td>
                <?php echo $employee['id']; ?>
            </td>
            <td>
                <?php echo $employee['name']; ?>
            </td>
            <td>
                <?php echo $employee['contact']; ?>
            </td>
            <?php if($lvl == '0'):?>
            <td><img src="/application/public/img/ico/rem.png" alt="<?php echo $employee['id']; ?>" id="rem_row"></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<script>
    h_block = 210;
    url = "/emloyees";
    /*$('html').on('click', 'img#rem_row', function() {
        var id = $(this).attr('alt');
        $.ajax({
            method: "post",
            data: {
                rem: 1,
                id: id
            }
        });
        //alert("--" + id);
    });/**/

</script>
<?php echo $footer ?>
