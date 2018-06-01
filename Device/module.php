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

        // Profil für Schwellwerte


        // Profil für Beschattung aktivieren / deaktivieren

        $this->ConnectParent("{C3EA1EE4-670B-46E8-856C-076C58AAE686}"); //DominoSwiss eGate

        $this->RegisterVariableString("eGateData", "Rohdaten eGate");
        $this->RegisterVariableInteger("eGateID", "Speicherplatz", "", "1");
        $this->RegisterVariableBoolean("eGateCommand", "Kommando", "", "2");
        $this->RegisterVariableString("ArrayID", "ArrayID", "", "3");
        $this->RegisterVariableString("ArrayCommand", "ArrayCommand", "", "4");
        $this->RegisterVariableString("ArrayValue", "ArrayValue", "", "5");
        $this->RegisterVariableString("ArrayPriority", "ArrayPriority", "", "6");

        $this->RegisterVariableInteger("ArrayIDNumber", "ArrayIDNumber", "", "7");
        $this->RegisterVariableInteger("ArrayCommandNumber", "ArrayCommandNumber", "", "8");
        $this->RegisterVariableInteger("ArrayValueNumber", "ArrayValueNumber", "", "9");
        $this->RegisterVariableInteger("ArrayPriorityNumber", "ArrayPriorityNumber", "", "10");

      }

      public function ApplyChanges() {

        parent::ApplyChanges();

      }

      public function RequestAction($Ident, $Value) {

        switch($Ident) {
              case "eGateData":
              //Neuen Wert in die Statusvariable schreiben
                SetValue($this->GetIDForIdent($Ident), $Value);
              break;
              }
      }


      public function ReceiveData($JSONString) {

        // Empfangene Daten vom Gateway/Splitter
        $data = json_decode($JSONString);
        IPS_LogMessage("ReceiveData", utf8_decode($data->Buffer));

        // Datenverarbeitung und schreiben der Werte in die Statusvariablen

        SetValue($this->GetIDforIdent("eGateData"), $data->Buffer);
        $arrayeGate = explode(";", $data->Buffer);

        SetValue($this->GetIDForIdent("ArrayID"), $arrayeGate[1]);
        SetValue($this->GetIDForIdent("ArrayCommand"), $arrayeGate[2]);
        SetValue($this->GetIDForIdent("ArrayValue"), $arrayeGate[3]);
        SetValue($this->GetIDForIdent("ArrayPriority"), $arrayeGate[4]);

        $valueArray = Array();
        foreach($arrayeGate as $eGateNumbers) {
            $eGateValue = explode("=", $eGateNumbers);
            $valueArray[$value[0]] = $value[1];
        }

        SetValue($this->GetIDForIdent("ArrayIDNumber"), $eGateValue[1]);
        SetValue($this->GetIDForIdent("ArrayCommandNumber"), $eGateValue[2]);
        SetValue($this->GetIDForIdent("ArrayValueNumber"), $eGateValue[3]);
        SetValue($this->GetIDForIdent("ArrayPriorityNumber"), $eGateValue[4]);

      }

}

?>
