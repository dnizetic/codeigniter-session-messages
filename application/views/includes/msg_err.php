<?php if ($msg): ?>
    <div class="alert alert-danger fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-times"></i>
        <strong>Error!</strong> <span class=""><?php echo $msg; ?></span>
        <?php if (isset($msg_additional)): ?>
            <ul>
                <?php foreach ($msg_additional as $msg): ?>

                    <li><?php echo $msg; ?></li>

                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>
