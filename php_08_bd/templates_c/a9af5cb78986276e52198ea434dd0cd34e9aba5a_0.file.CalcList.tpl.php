<?php
/* Smarty version 3.1.30, created on 2022-04-26 06:03:54
  from "C:\xampp\htdocs\php_08_bd\app\views\CalcList.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62676f2a600853_67913940',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9af5cb78986276e52198ea434dd0cd34e9aba5a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\php_08_bd\\app\\views\\CalcList.tpl',
      1 => 1650945833,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
  ),
),false)) {
function content_62676f2a600853_67913940 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3409323362676f2a5ee942_55023093', 'top');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_199409336162676f2a5f5353_63098678', 'content');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5540672662676f2a600395_04495996', 'bottom');
?>

<?php $_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'top'} */
class Block_3409323362676f2a5ee942_55023093 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
calcList">
	<legend>Opcje wyszukiwania</legend>
	<fieldset>
		<input type="text" placeholder="należna kwota" name="sf_yyy" value="<?php echo $_smarty_tpl->tpl_vars['searchForm']->value->yyy;?>
" /><br />
		<button type="submit" class="pure-button pure-button-primary">Filtruj</button>
	</fieldset>
</form>
</div>	

<?php
}
}
/* {/block 'top'} */
/* {block 'content'} */
class Block_199409336162676f2a5f5353_63098678 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<form action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
calcList" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator kredytowy</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_x">Ile potrzebujesz: </label>
			<input id="id_x" type="text" name="x" value="<?php echo $_smarty_tpl->tpl_vars['calcform']->value->x;?>
" />
		</div>
        <div class="pure-control-group">
			<label for="id_y">Jakie oprocentowanie: </label>
			<input id="id_y" type="text" name="y" value="<?php echo $_smarty_tpl->tpl_vars['calcform']->value->y;?>
" />
		</div>
        <div class="pure-control-group">
			<label for="id_z">Na ile lat: </label>
			<input id="id_z" type="text" name="z" value="<?php echo $_smarty_tpl->tpl_vars['calcform']->value->z;?>
" />
		</div>
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
<div class="messages info">
	Należna kwota: <?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

</div>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->rata)) {?>
<div class="messages info">
	Rata miesięczna: <?php echo $_smarty_tpl->tpl_vars['res']->value->rata;?>

</div>
<?php }?>

<?php
}
}
/* {/block 'content'} */
/* {block 'bottom'} */
class Block_5540672662676f2a600395_04495996 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="bottom-margin">
<a class="pure-button button-success" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcNew">+ Nowy rekord</a>
</div>	

<table id="tab_people" class="pure-table pure-table-bordered">
<thead>
	<tr>
		<th>Ile potrzebujesz</th>
		<th>Jakie oprocentowanie</th>
		<th>Na ile lat</th>
		<th>Należna kwota</th>
		<th>Opcje(admin może usuwać)</th>
	</tr>
</thead>
<tbody>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['people']->value, 'p');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value) {
?>
<tr><td><?php echo $_smarty_tpl->tpl_vars['p']->value["xxx"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["yyy"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["zzz"];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['p']->value["calcres"];?>
</td><td><a class="button-small pure-button button-secondary" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
calcEdit&id=<?php echo $_smarty_tpl->tpl_vars['p']->value['idcalc'];?>
">Edytuj</a>&nbsp;<a class="button-small pure-button button-warning" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
calcDelete&id=<?php echo $_smarty_tpl->tpl_vars['p']->value['idcalc'];?>
">Usuń</a></td></tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</tbody>
</table>

<?php
}
}
/* {/block 'bottom'} */
}
