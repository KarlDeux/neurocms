<?php /* Smarty version Smarty-3.1.15, created on 2014-05-05 13:32:11
         compiled from "I:\xampp\htdocs\proyecto\themes\basic\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13617536776bb3d6183-08904165%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a9ed2a0f3d6cd7887819b565895bd6c7cb0de7f' => 
    array (
      0 => 'I:\\xampp\\htdocs\\proyecto\\themes\\basic\\header.tpl',
      1 => 1399288986,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13617536776bb3d6183-08904165',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_title' => 0,
    'meta_description' => 0,
    'meta_keywords' => 0,
    'img_theme_dir' => 0,
    'page_name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_536776bb408e03_71751763',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_536776bb408e03_71751763')) {function content_536776bb408e03_71751763($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include 'I:\\xampp\\htdocs\\proyecto\\tools\\plugins\\modifier.escape.php';
?>
<!DOCTYPE html><html lang="es-ES"><head><title><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['meta_title']->value, 'htmlall', 'UTF-8');?>
</title><?php if (isset($_smarty_tpl->tpl_vars['meta_description']->value)&&$_smarty_tpl->tpl_vars['meta_description']->value) {?><meta name="description" content="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['meta_description']->value, 'html', 'UTF-8');?>
" /><?php }?><?php if (isset($_smarty_tpl->tpl_vars['meta_keywords']->value)&&$_smarty_tpl->tpl_vars['meta_keywords']->value) {?><meta name="keywords" content="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['meta_keywords']->value, 'html', 'UTF-8');?>
" /><?php }?><meta charset="UTF-8"/><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="author" content="neurotix" /><meta name="revisit-after" content="2 days" /><link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->tpl_vars['img_theme_dir']->value;?>
favicon.ico?" /><link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['img_theme_dir']->value;?>
favicon.ico" /><link href="themes/basic/css/global.css" rel="stylesheet" type="text/css"/></head><body <?php if ($_smarty_tpl->tpl_vars['page_name']->value) {?>id="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['page_name']->value, 'htmlall', 'UTF-8');?>
"<?php }?>><div class="container"><div class="cbp-af-header"><div class="cbp-af-inner"><h1>Alejandro Albarracín</h1></div></div><?php }} ?>
