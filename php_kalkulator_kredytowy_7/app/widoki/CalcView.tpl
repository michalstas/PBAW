{extends file="main.tpl"}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>

<form action="{$conf->action_url}calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator Kredytowy</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_x">Ile potrzebujesz?: </label>
			<input id="id_x" type="text" placeholder="PLN" name="x" value="{$form->x}" />
		</div>
        <div class="pure-control-group">
			<label for="y">Na jak długo?</label>
			<input id="y" type="text" placeholder="Procenty" name="y" value="{$form->y}">
		</div>
        <div class="pure-control-group">
			<label for="id_z">Oprocentowanie roczne? </label>
			<input id="id_z" type="text" placeholder="%" name="z" value="{$form->z}" />
		</div>
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	

{include file='messages.tpl'}

{if isset($res->result)}
<div class="messages inf">
	Wynik: {$res->result}
</div>
{/if}

{if isset($res->rata)}
	<h4>rata miesieczna</h4>
	<p class="res">
	{$res->rata}
	</p>
{/if}

{/block}