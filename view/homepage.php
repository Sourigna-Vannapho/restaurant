<?php $title = 'Van\' à pho'; ?>
<?php ob_start(); ?>
<?php echo ('test'); ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>