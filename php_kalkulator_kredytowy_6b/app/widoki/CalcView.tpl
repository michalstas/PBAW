{extends file="main.tpl"}
{* przy zdefiniowanych folderach nie trzeba już podawać pełnej ścieżki *}

{block name=footer}Kalkulator służący do obliczania kredytu{/block}

{block name=content}

<h3>Kalkulator Kredytowy</h2>


<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
	<fieldset>
			<label for="x">Ile potrzebujesz?:</label>
			<input id="x" type="text" placeholder="PLN" name="x" value="{$form->x}">
					
			<label for="y">Na jak długo?</label>
			<input id="y" type="text" placeholder="Lata" name="y" value="{$form->y}">
			
			<label for="z">Oprocentowanie roczne?</label>
			<input id="z" type="text" placeholder="Procenty" name="z" value="{$form->z}">
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

{* wyświeltenie listy błędów, jeśli istnieją *}
{if $msgs->isError()}
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{* wyświeltenie listy informacji, jeśli istnieją *}
{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if isset($res->result)}
	<h4>Wynik</h4>
	<p class="res">
	{$res->result}
	</p>
{/if}

{if isset($res->rata)}
	<h4>rata miesieczna</h4>
	<p class="res">
	{$res->rata}
	</p>
{/if}

</div>

{/block}