<?php
    require('inc\message_view.inc.php')
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
    <li><a href="new_message.php"><?php echo $lang_manager->get_word_translate('New message') ?></a></li>
</ul>
    <h3><?php echo $lang_manager->get_word_translate('Message') ?></h3>

    <div class="message">
        <table>
            <tr>
                <td><?php echo $lang_manager->get_word_translate('Sender') ?></td>
                <td><?php echo $msg->sender ?></td>
            </tr>
            <tr>
                <td><?php echo $lang_manager->get_word_translate('Date') ?></td>
                <td><?php echo $msg->message_date ?></td>
            </tr>
            <tr>
                <td><?php echo $lang_manager->get_word_translate('Text') ?></td>
                <td><?php echo $msg->text ?></td>
            </tr>
        </table>
    </div>
    <ul class="menu">
        <li><a href="new_message.php?adressee=<?php echo $msg->sender->id ?>"><?php echo $lang_manager->get_word_translate('Answer') ?></a></li>
        <li><a href="mark_message_read.php?id=<?php echo $msg->id ?>"><?php echo $lang_manager->get_word_translate('Mark as read') ?></a></li>
        <li><a href="delete_message.php?id=<?php echo $msg->id ?>"><?php echo $lang_manager->get_word_translate('Delete message') ?></a></li>
    </ul>
</body>
</html>