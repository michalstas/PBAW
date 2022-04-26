<?php
/* Smarty version 3.1.30, created on 2022-04-26 06:04:49
  from "C:\xampp\htdocs\php_08_bd\app\views\CalcEdit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62676f61e22964_19774402',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eef8589ec74f6a4375b0e099c4e19cfdf09900cf' => 
    array (
      0 => 'C:\\xampp\\htdocs\\php_08_bd\\app\\views\\CalcEdit.tpl',
      1 => 1650945888,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_62676f61e22964_19774402 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_164685598462676f61e22471_76146726', 'top');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_164685598462676f61e22471_76146726 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane osoby</legend>
		<div class="pure-control-group">
            <label for="xxx">Ile potrzebujesz</label>
            <input id="xxx" type="text" placeholder="Ile potrzebujesz?" name="xxx" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->xxx;?>
">
        </div>
		<div class="pure-control-group">
            <label for="yyy">Jakie oprocentowanie</label>
            <input id="yyy" type="text" placeholder="Jakie oprocentowanie?" name="yyy" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->yyy;?>
">
        </div>
		<div class="pure-control-group">
            <label for="zzz">Na ile lat?</label>
            <input id="zzz" type="text" placeholder="Na ile lat" name="zzz" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->zzz;?>
">
        </div>
		<div class="pure-control-group">
            <label for="calcres">Należna kwota</label>
            <input id="calcres" type="text" placeholder="Należna kwota" name="calcres" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->calcres;?>
">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->id;?>
">
</form>	
</div>

<?php
}
}
/* {/block 'top'} */
}
