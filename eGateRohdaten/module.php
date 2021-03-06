<?
    // Klassendefinition
class eGateRohdaten extends IPSModule {
 
        // Der Konstruktor des Moduls
        // Überschreibt den Standard Kontruktor von IPS
        public function __construct($InstanceID) {
            // Diese Zeile nicht löschen
            parent::__construct($InstanceID);
 
	    // Selbsterstellter Code

	   

        }
 
        // Überschreibt die interne IPS_Create($id) Funktion
        public function Create() {
            // Diese Zeile nicht löschen.
		parent::Create();

		 $this->RegisterVariableString("eGate", "eGate Werte", "", "0");
		 
 
        }
 
        // Überschreibt die intere IPS_ApplyChanges($id) Funktion
        public function ApplyChanges() {
            // Diese Zeile nicht löschen
            parent::ApplyChanges();
        }
 
        /**
        * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
        * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
        *
        * ABC_MeineErsteEigeneFunktion($id);
        *
        */
        public function MeineErsteEigeneFunktion() {
            // Selbsterstellter Code
        }


	public function ReceiveData($JSONString) {
 
	    // Empfangene Daten vom Gateway/Splitter
	    $data = json_decode($JSONString);
 
	    // Datenverarbeitung und schreiben der Werte in die Statusvariablen
	    SetValue($this->GetIDForIdent("eGate"), print_r($data->Values, true));
 
	}

    }


?>
