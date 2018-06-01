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
        $this->RegisterVariableString("ArrayTest", "ArrayTest", "", "3");

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

        $eGateDataArray = $this->GetIDforIdent("eGateData");
        $arrayeGate = explode(";", $eGateDataArray);
        var_dump($arrayeGate);

        SetValue($this->GetIDForIdent("ArrayTest"), $arrayeGate[0]);

      }

}

?>
