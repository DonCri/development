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



      }

      public function RequestAction($Ident, $Value) { }


      public function ReceiveData($JSONString) {

        // Empfangene Daten vom Gateway/Splitter
        $data = json_decode($JSONString);
        IPS_LogMessage("ReceiveData", utf8_decode($data->Buffer));

        // Datenverarbeitung und schreiben der Werte in die Statusvariablen
        SetValue($this->GetIDForIdent("Value"), $data->Buffer);

}



}

?>
