<?php
require('inc\message_new.inc.php')
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    include('inc/head.inc.html');
    ?>
</head>
<body>
<ul class="menu">
    <li><a href="logout.php"><?php echo $lang_manager->get_word_translate('Logout') ?></a></li>
</ul>

<ul class="menu">
    <li><a href="messages.php"><?php echo $lang_manager->get_word_translate('Messages') ?></a></li>
</ul>
<h3><?php echo $lang_manager->get_word_translate('New message') ?></h3>

<div class="message">
    <div id="server_errors_field" class="server_errors_field"></div>
    <form action="new_message.php" method="post" id="new_message">
    <table>
        <tr>
            <td><label for="addressee"> <?php echo $lang_manager->get_word_translate('Adressee') ?></label></td>
            <td>
                <select name="addressee" id="addressee">
                    <?php
                        foreach($all_adresses as $addreesse_iter){
                            if($addreesse_iter['id'] == $addressee_id){
                                echo('<option selected value="'.$addreesse_iter['id'].'">'.$addreesse_iter['username'].'</option>');
                            }else{
                                echo('<option value="'.$addreesse_iter['id'].'">'.$addreesse_iter['username'].'</option>');
                            }
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td><label for="text"><?php echo $lang_manager->get_word_translate('Message text') ?></label></td>
            <td><textarea name="text" id="text" cols="50" rows="20"></textarea></td>
        </tr>

        <tr>
            <td><input type="submit" value="<?php echo $lang_manager->get_word_translate('Send') ?>"></td>
        </tr>

    </table>
    </form>
</div>
<script>
      form = document.getElementById('new_message');
      form.addEventListener("submit", newmessageFormSubmitListener);
</script>
</body>
</html>