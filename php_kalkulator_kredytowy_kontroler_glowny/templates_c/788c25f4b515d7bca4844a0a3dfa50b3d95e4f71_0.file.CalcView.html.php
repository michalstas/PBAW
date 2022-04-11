<?php
/* Smarty version 3.1.30, created on 2022-04-11 20:58:35
  from "C:\xampp\htdocs\php_kalkulator_kredytowy_kontroler_glowny\app\calc\CalcView.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62547a5b286223_68654135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '788c25f4b515d7bca4844a0a3dfa50b3d95e4f71' => 
    array (
      0 => 'C:\\xampp\\htdocs\\php_kalkulator_kredytowy_kontroler_glowny\\app\\calc\\CalcView.html',
      1 => 1649703424,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62547a5b286223_68654135 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_78668052862547a5b2729d5_11542565', 'footer');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_171176592962547a5b285d54_56149609', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender(($_smarty_tpl->tpl_vars['conf']->value->root_path).("/templates/main.html"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'footer'} */
class Block_78668052862547a5b2729d5_11542565 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Kalkulator służący do obliczania kredytu<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_171176592962547a5b285d54_56149609 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<h2 class="content-head is-center">Kalkulator Kredytowy</h2>

<div class="pure-g">
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
	<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcCompute" method="post">
		<fieldset>

			<label for="x">Ile potrzebujesz?:</label>
			<input id="x" type="text" placeholder="PLN" name="x" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->x;?>
">
					
			<label for="y">Na jak długo?</label>
			<input id="y" type="text" placeholder="Lata" name="y" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->y;?>
">
			
			<label for="z">Oprocentowanie roczne?</label>
			<input id="z" type="text" placeholder="Procenty" name="z" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->z;?>
">

			<button type="submit" class="pure-button">Oblicz</button>
		</fieldset>
	</form>
</div>

<div class="l-box-lrg pure-u-1 pure-u-med-3-5">


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isError()) {?>
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getErrors(), 'err');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['err']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isInfo()) {?>
	<h4>Informacje: </h4>
	<ol class="inf">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getInfos(), 'inf');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['inf']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['inf']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
	<h4>Nalezna kwota</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

	</p>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->rata)) {?>
	<h4>rata miesieczna</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['res']->value->rata;?>

	</p>
<?php }?>

</div>
</div>

<?php
}
}
/* {/block 'content'} */
}
