<?php if ($msg): ?>
    <div class="alert alert-warning fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-warning"></i>
        <strong>Warning</strong> <?php echo $msg; ?>
        <?php if (isset($msg_additional)): ?>
            <ul>
                <?php foreach ($msg_additional as $msg): ?>

                    <li><?php echo $msg; ?></li>

                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
<?php endif; ?>
 