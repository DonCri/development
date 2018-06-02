<?

// Klassendefinition
class Device extends IPSModule {
        /**
        * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
        * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
        *
        * ABC_MeineErsteEigeneFunktion($id);
        *
        */

        // Überschreibt die interne IPS_Create($id) Funktion
      public function Create() {
        // Diese Zeile nicht löschen.
        parent::Create();

        // Profil für Modul
        if(!IPS_VariableProfileExists("Device.Switch")) {
    			IPS_CreateVariableProfile("Device.Switch", 0);
    			IPS_SetVariableProfileIcon("Device.Switch", "Power");
    			IPS_SetVariableProfileAssociation("Device.Switch", 0, $this->Translate("Off"), "", -1);
    			IPS_SetVariableProfileAssociation("Device.Switch", 1, $this->Translate("On"), "", -1);
    		}

        // Sorgt dafür das der eGate Socket und Splitter immer automatisch hergestellt wird.
        $this->ConnectParent("{C3EA1EE4-670B-46E8-856C-076C58AAE686}"); //DominoSwiss eGate

        // Test Variablen um die Verbindung zu testen, werden nicht benötigt für die Funktion
        $this->RegisterVariableString("eGateData", "Rohdaten eGate");
        $this->RegisterVariableInteger("eGateID", "Speicherplatz", "", "1");
        $this->RegisterVariableBoolean("eGateCommand", "Kommando", "Device.Switch", "2");
        $this->EnableAction("eGateCommand");

        $this->RegisterVariableString("ArrayID", "ArrayIDText", "", "3");
        $this->RegisterVariableInteger("ArrayIDNumber", "ArrayID", "", "4");
        $this->RegisterVariableString("ArrayCommand", "ArrayCommandText", "", "5");
        $this->RegisterVariableInteger("ArrayCommandNumber", "ArrayCommand", "", "6");
        $this->RegisterVariableString("ArrayValue", "ArrayValueText", "", "7");
        $this->RegisterVariableInteger("ArrayValueNumber", "ArrayValue", "", "8");
        $this->RegisterVariableString("ArrayPriority", "ArrayPriorityText", "", "9");
        $this->RegisterVariableInteger("ArrayPriorityNumber", "ArrayPriority", "", "10");

        // Property und beim Modul die ID (eGate Speicherplatz) zu wählen
        $this->RegisterPropertyInteger("ID", "1");



    }

    public function ApplyChanges() {

        parent::ApplyChanges();

    }

    public function RequestAction($Ident, $Value) {

      switch($Ident) {
      case "eGateCommand":
          //Hier würde normalerweise eine Aktion z.B. das Schalten ausgeführt werden
          //Ausgaben über 'echo' werden an die Visualisierung zurückgeleitet

          //Neuen Wert in die Statusvariable schreiben
          SetValue($this->GetIDForIdent($Ident), $Value);
          $this->TestSchalter($True, $False);
          break;

        }
    }


    public function ReceiveData($JSONString) {

        // Empfangene Daten vom Gateway/Splitter
        $data = json_decode($JSONString);
        IPS_LogMessage("ReceiveData", utf8_decode($data->Buffer));

        // Datenverarbeitung und schreiben der Werte in die Statusvariablen

        // Speichert die Empfangene Daten in die Variable mit der ID eGateData
        SetValue($this->GetIDForIdent("eGateData"), $data->Buffer);

        // Macht aus dem empfangenen string ein array (Liste), Trennzeichen sind ; und =
        $arrayeGate = preg_split("/[';''=']/", $data->Buffer);

        //Speichert die Daten aus dem array in die Variablen, wird für die Funktion nicht benötigt
        SetValue($this->GetIDForIdent("ArrayID"), $arrayeGate[2]);
        SetValue($this->GetIDForIdent("ArrayIDNumber"), $arrayeGate[3]);
        SetValue($this->GetIDForIdent("ArrayCommand"), $arrayeGate[4]);
        SetValue($this->GetIDForIdent("ArrayCommandNumber"), $arrayeGate[5]);
        SetValue($this->GetIDForIdent("ArrayValue"), $arrayeGate[6]);
        SetValue($this->GetIDForIdent("ArrayValueNumber"), $arrayeGate[7]);
        SetValue($this->GetIDForIdent("ArrayPriority"), $arrayeGate[8]);
        SetValue($this->GetIDForIdent("ArrayPriorityNumber"), $arrayeGate[9]);

        $ID = $arrayeGate[3];
        $Command = $arrayeGate[5];

        switch($ID) {
          case $this->ReadPropertyInteger("ID");
              switch($Command) {
                case 3:
                  SetValue($this->GetIDForIdent("eGateCommand"), true);
                  $this->TestSchalter();
                break;

                case 4:
                  SetValue($this->GetIDForIdent("eGateCommand"), false);
                  $this->TestSchalter();
                break;
              }
          break;
        }


    }

    public function TestSchalter(int $True, int $False) {
      $State = GetValue($this->GetIDforIdent("eGateCommand"));

      switch ($State) {
        case true:
            SetValue($this->GetIDForIdent("eGateID"), $True);
          break;

        case false:
            SetValue($this->GetIDForIdent("eGateID"), $False);
        break;
      }
    }

}

?>
