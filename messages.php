<?php
require('inc/messages.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
        include('inc/head.inc.html');
    ?>
</head>
<body>
<?php
    include('lang_manage/lang_menu.inc.html');
?>
<ul class="menu">
    <li><a href="logout.php"><?php echo $lang_manager->get_word_translate('Logout') ?></a></li>
</ul>
<ul class="menu">
    <li><a href="messages.php"><?php echo $lang_manager->get_word_translate('Messages') ?></a></li>
    <li><a href="new_message.php"><?php echo $lang_manager->get_word_translate('New message') ?></a></li>
</ul>
<h3><?php echo $lang_manager->get_word_translate('Messages manage') ?></h3>

<div>
    <h4><?php echo $lang_manager->get_word_translate('Inbox messages') ?></h4>
    <table class="messagetable">
        <tr>
            <th><?php echo $lang_manager->get_word_translate('Sender') ?></th>
            <th><?php echo $lang_manager->get_word_translate('Text') ?></th>
        </tr>

        <?
        if (is_array($all_user_messages)){

            foreach($all_user_messages as $message){
                echo('<tr>');
                echo('<td>'.$message->sender.'</td>');
                echo('<td '.($message->new_message?' class="new_message" ':'').'><a href="view_message.php?id='.$message->id.'">'.substr($message->text,0,100).'</a></td>');
                echo('</tr>');
            }

        } else {
            echo('<tr>');
            echo('<td colspan="2">'. $lang_manager->get_word_translate('No messages').'</td>');
            echo('</tr>');
        }
        ?>
    </table>

</div>
</body>
</html>
