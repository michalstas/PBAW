{extends file="main.tpl"}

{block name=top}

<div class="bottom-margin">
<form action="{$conf->action_root}calcSave" method="post" class="pure-form pure-form-aligned">
	<fieldset>
		<legend>Dane osoby</legend>
		<div class="pure-control-group">
            <label for="xxx">Ile potrzebujesz</label>
            <input id="xxx" type="text" placeholder="Ile potrzebujesz?" name="xxx" value="{$form->xxx}">
        </div>
		<div class="pure-control-group">
            <label for="yyy">Jakie oprocentowanie</label>
            <input id="yyy" type="text" placeholder="Jakie oprocentowanie?" name="yyy" value="{$form->yyy}">
        </div>
		<div class="pure-control-group">
            <label for="zzz">Na ile lat?</label>
            <input id="zzz" type="text" placeholder="Na ile lat" name="zzz" value="{$form->zzz}">
        </div>
		<div class="pure-control-group">
            <label for="calcres">Należna kwota</label>
            <input id="calcres" type="text" placeholder="Należna kwota" name="calcres" value="{$form->calcres}">
        </div>
		<div class="pure-controls">
			<input type="submit" class="pure-button pure-button-primary" value="Zapisz"/>
			<a class="pure-button button-secondary" href="{$conf->action_root}calcList">Powrót</a>
		</div>
	</fieldset>
    <input type="hidden" name="id" value="{$form->id}">
</form>	
</div>

{/block}
