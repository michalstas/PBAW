<?php

namespace app\controllers;

use app\forms\CalcEditForm;
use app\forms\CalcSearchForm;
use app\forms\CalcForm;
use app\transfer\CalcResult;
use PDOException;

class CalcListCtrl {

	private $form; //dane formularza wyszukiwania
	private $calcform;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku
	private $records; //rekordy pobrane z bazy danych
	private $editform; //dane formularza

	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CalcSearchForm();
		$this->calcform = new CalcForm();
		$this->result = new CalcResult();
		$this->editform = new CalcEditForm();
	}
	
	/** 
	 * Pobranie parametrów
	 */
	public function getParams(){
		$this->calcform->x = getFromRequest('x');
		$this->calcform->y = getFromRequest('y');
		$this->calcform->z = getFromRequest('z');
	}
	
	public function validate() {
		// 1. sprawdzenie, czy parametry zostały przekazane
		// - nie trzeba sprawdzać
		$this->form->calcres = getFromRequest('sf_calcres');
	
	// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->calcform->x ) && isset ( $this->calcform->y ) && isset ( $this->calcform->z ))) {
			// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
			return false;
		}
		
		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->calcform->x == "") {
			getMessages()->addError('Nie podano liczby 1');
		}
		if ($this->calcform->y == "") {
			getMessages()->addError('Nie podano liczby 2');
		}
		if ($this->calcform->z == "") {
			getMessages()->addError('Nie podano liczby 3');
		}
		
		// nie ma sensu walidować dalej gdy brak parametrów
		if (! getMessages()->isError()) {
			
			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this->calcform->x )) {
				getMessages()->addError('Pierwsza wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->calcform->y )) {
				getMessages()->addError('Druga wartość nie jest liczbą całkowitą');
			}
			
			if (! is_numeric ( $this->calcform->z )) {
				getMessages()->addError('Trzecia wartość nie jest liczbą całkowitą');
			}
		}
		
		return ! getMessages()->isError();
	}
	
	public function action_calcList(){
		// 1. Walidacja danych formularza (z pobraniem)
		// - W tej aplikacji walidacja nie jest potrzebna, ponieważ nie wystąpią błedy podczas podawania nazwiska.
		//   Jednak pozostawiono ją, ponieważ gdyby uzytkownik wprowadzał np. datę, lub wartość numeryczną, to trzeba
		//   odpowiednio zareagować wyświetlając odpowiednią informację (poprzez obiekt wiadomości Messages)
		//$this->validate();
		
		// 2. Przygotowanie mapy z parametrami wyszukiwania (nazwa_kolumny => wartość)
		$search_params = []; //przygotowanie pustej struktury (aby była dostępna nawet gdy nie będzie zawierała wierszy)
		if ( isset($this->form->calcres) && strlen($this->form->calcres) > 0) {
			$search_params['calcres[~]'] = $this->form->calcres.'%'; // dodanie symbolu % zastępuje dowolny ciąg znaków na końcu
		}
		//2.b kalkulator
		$this->getParams();
		
		if ($this->validate()) {
				
			//konwersja parametrów na int
			$this->calcform->x = intval($this->calcform->x);
			$this->calcform->y = intval($this->calcform->y);
			$this->calcform->z = intval($this->calcform->z);
			getMessages()->addInfo('Parametry poprawne.');
				
			//wykonanie operacji
			$this->result->result = $this->calcform->x + ($this->calcform->z * $this->calcform->y)/100 * $this->calcform->x;
			$this->result->rata = ((($this->calcform->z * $this->calcform->y)/100 * $this->calcform->x)/$this->calcform->y)/12;
			$this->result->rata = round($this->result->rata, 2);
			
			getMessages()->addInfo('Wykonano obliczenia.');
		}
		//2.c zapisanie rekordów
		if($this->validate()){
			try {
				
				//2.1 Nowy rekord
				if ($this->editform->id == '') {
					//sprawdź liczebność rekordów - nie pozwalaj przekroczyć 20
					$count = getDB()->count("calc");
					if ($count <= 20) {
						getDB()->insert("calc", [
							"xxx" => $this->calcform->x,
							"yyy" => $this->calcform->y,
							"zzz" => $this->calcform->z,
							"calcres" => $this->result->result
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
							"xxx" => $this->calcform->x,
							"yyy" => $this->calcform->y,
							"zzz" => $this->calcform->z,
							"calcres" => $this->result->result
					], [ 
						"idcalc" => $this->form->id
					]);
				}
				getMessages()->addInfo('Pomyślnie zapisano rekord');

			} catch (PDOException $e){
				getMessages()->addError('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
				if (getConf()->debug) getMessages()->addError($e->getMessage());			
			}	
		}			
		// 3. Pobranie listy rekordów z bazy danych
		// W tym wypadku zawsze wyświetlamy listę osób bez względu na to, czy dane wprowadzone w formularzu wyszukiwania są poprawne.
		// Dlatego pobranie nie jest uwarunkowane poprawnością walidacji (jak miało to miejsce w kalkulatorze)
		
		//przygotowanie frazy where na wypadek większej liczby parametrów
		$num_params = sizeof($search_params);
		if ($num_params > 1) {
			$where = [ "AND" => &$search_params ];
		} else {
			$where = &$search_params;
		}
		//dodanie frazy sortującej po nazwisku
		$where ["ORDER"] = "yyy";
		//wykonanie zapytania
		
		try{
			$this->records = getDB()->select("calc", [
					"idcalc",
					"xxx",
					"yyy",
					"zzz",
					"calcres",
				], $where );
		} catch (PDOException $e){
			getMessages()->addError('Wystąpił błąd podczas pobierania rekordów');
			if (getConf()->debug) getMessages()->addError($e->getMessage());			
		}	
		
		// 4. wygeneruj widok
		getSmarty()->assign('searchForm',$this->form); // dane formularza (wyszukiwania w tym wypadku)
		getSmarty()->assign('people',$this->records);  // lista rekordów z bazy danych

		getSmarty()->assign('calcform',$this->calcform);
		getSmarty()->assign('res',$this->result);
		
		getSmarty()->display('CalcList.tpl');
	}
	
	
	
}
