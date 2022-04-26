{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form class="pure-form pure-form-stacked" action="{$conf->action_url}calcList">
	<legend>Opcje wyszukiwania</legend>
	<fieldset>
		<input type="text" placeholder="należna kwota" name="sf_yyy" value="{$searchForm->yyy}" /><br />
		<button type="submit" class="pure-button pure-button-primary">Filtruj</button>
	</fieldset>
</form>
</div>	

{/block}


{block name=content}


<form action="{$conf->action_url}calcList" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator kredytowy</legend>
	<fieldset>
        <div class="pure-control-group">
			<label for="id_x">Ile potrzebujesz: </label>
			<input id="id_x" type="text" name="x" value="{$calcform->x}" />
		</div>
        <div class="pure-control-group">
			<label for="id_y">Jakie oprocentowanie: </label>
			<input id="id_y" type="text" name="y" value="{$calcform->y}" />
		</div>
        <div class="pure-control-group">
			<label for="id_z">Na ile lat: </label>
			<input id="id_z" type="text" name="z" value="{$calcform->z}" />
		</div>
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary"/>
		</div>
	</fieldset>
</form>	

{if isset($res->result)}
<div class="messages info">
	Należna kwota: {$res->result}
</div>
{/if}

{if isset($res->rata)}
<div class="messages info">
	Rata miesięczna: {$res->rata}
</div>
{/if}

{/block}


{block name=bottom}

<div class="bottom-margin">
<a class="pure-button button-success" href="{$conf->action_root}calcNew">+ Nowy rekord</a>
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
{foreach $people as $p}
{strip}
	<tr>
		<td>{$p["xxx"]}</td>
		<td>{$p["yyy"]}</td>
		<td>{$p["zzz"]}</td>
		<td>{$p["calcres"]}</td>
		<td>
			<a class="button-small pure-button button-secondary" href="{$conf->action_url}calcEdit&id={$p['idcalc']}">Edytuj</a>
			&nbsp;
			<a class="button-small pure-button button-warning" href="{$conf->action_url}calcDelete&id={$p['idcalc']}">Usuń</a>
		</td>
	</tr>
{/strip}
{/foreach}
</tbody>
</table>

{/block}
