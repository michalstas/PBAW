<?php

namespace app\controllers;

use app\forms\CalcEditForm;
use DateTime;
use PDOException;

class CalcEditCtrl {

	private $form; //dane formularza

	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CalcEditForm();
	}

	//validacja danych przed zapisem (nowe dane lub edycja)
	public function validateSave() {
		//0. Pobranie parametrów z walidacją
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		$this->form->xxx = getFromRequest('xxx',true,'Błędne wywołanie aplikacji');
		$this->form->yyy = getFromRequest('yyy',true,'Błędne wywołanie aplikacji');
		$this->form->zzz = getFromRequest('zzz',true,'Błędne wywołanie aplikacji');
		$this->form->calcres = getFromRequest('calcres',true,'Błędne wywołanie aplikacji');

		if ( getMessages()->isError() ) return false;

		// 1. sprawdzenie czy wartości wymagane nie są puste
		if (empty(trim($this->form->xxx))) {
			getMessages()->addError('Wprowadź imię');
		}
		if (empty(trim($this->form->yyy))) {
			getMessages()->addError('Wprowadź nazwisko');
		}
		if (empty(trim($this->form->zzz))) {
			getMessages()->addError('Wprowadź datę urodzenia');
		}
		if (empty(trim($this->form->calcres))) {
			getMessages()->addError('Wprowadź datę urodzenia');
		}


		if ( getMessages()->isError() ) return false;
		
		
		return ! getMessages()->isError();
	}

	//validacja danych przed wyswietleniem do edycji
	public function validateEdit() {
		//pobierz parametry na potrzeby wyswietlenia danych do edycji
		//z widoku listy osób (parametr jest wymagany)
		$this->form->id = getFromRequest('id',true,'Błędne wywołanie aplikacji');
		return ! getMessages()->isError();
	}
	
	public function action_calcNew(){
		$this->generateView();
	}
	
	//wysiweltenie rekordu do edycji wskazanego parametrem 'id'
	public function action_calcEdit(){
		// 1. walidacja id osoby do edycji
		if ( $this->validateEdit() ){
			try {
				// 2. odczyt z bazy danych osoby o podanym ID (tylko jednego rekordu)
				$record = getDB()->get("calc", "*",[
					"idcalc" => $this->form->id
				]);
				// 2.1 jeśli osoba istnieje to wpisz dane do obiektu formularza
				$this->form->id = $record['idcalc'];
				$this->form->xxx = $record['xxx'];
				$this->form->yyy = $record['yyy'];
				$this->form->zzz = $record['zzz'];
				$this->form->calcres = $record['calcres'];
			} catch (PDOException $e){
				getMessages()->addError('Wystąpił błąd podczas odczytu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		} 
		
		// 3. Wygenerowanie widoku
		$this->generateView();		
	}

	public function action_calcDelete(){		
		// 1. walidacja id osoby do usuniecia
		if ( $this->validateEdit() ){
			
			try{
				// 2. usunięcie rekordu
				getDB()->delete("calc",[
					"idcalc" => $this->form->id
				]);
				getMessages()->addInfo('Pomyślnie usunięto rekord');
			} catch (PDOException $e){
				getMessages()->addError('Wystąpił błąd podczas usuwania rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		}
		
		// 3. Przekierowanie na stronę listy osób
		forwardTo('calcList');		
	}

	public function action_calcSave(){
			
		// 1. Walidacja danych formularza (z pobraniem)
		if ($this->validateSave()) {
			// 2. Zapis danych w bazie
			try {
				
				//2.1 Nowy rekord
				if ($this->form->id == '') {
					//sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
					$count = getDB()->count("calc");
					if ($count <= 20) {
						getDB()->insert("calc", [
							"xxx" => $this->form->xxx,
							"yyy" => $this->form->yyy,
							"zzz" => $this->form->zzz,
							"calcres" => $this->form->calcres
						]);
					} else { //za dużo rekordów
						// Gdy za dużo rekordów to pozostań na stronie
						getMessages()->addInfo('Ograniczenie: Zbyt dużo rekordów. Aby dodać nowy usuń wybrany wpis.');
						$this->generateView(); //pozostań na stronie edycji
						exit(); //zakończ przetwarzanie, aby nie dodać wiadomości o pomyślnym zapisie danych
					}
				} else { 
				//2.2 Edycja rekordu o danym ID
					getDB()->update("calc", [
						"xxx" => $this->form->xxx,
						"yyy" => $this->form->yyy,
						"zzz" => $this->form->zzz,
						"calcres" => $this->form->calcres
					], [ 
						"idcalc" => $this->form->id
					]);
				}
				getMessages()->addInfo('Pomyślnie zapisano rekord');

			} catch (PDOException $e){
				getMessages()->addError('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}
			
			// 3b. Po zapisie przejdź na stronę listy osób (w ramach tego samego żądania http)
			forwardTo('calcList');

		} else {
			// 3c. Gdy błąd walidacji to pozostań na stronie
			$this->generateView();
		}		
	}
	
	public function generateView(){
		getSmarty()->assign('form',$this->form); // dane formularza dla widoku
		getSmarty()->display('CalcEdit.tpl');
	}
}
 