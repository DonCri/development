<?

class eGateG1 extends IPSModule {

private $Host = "";

public function Create(){
  //Never delete this line!
  parent::Create();

  //These lines are parsed on Symcon Startup or Instance creation
  //You cannot use variables here. Just static values.
  $this->RegisterPropertyInteger("MessageDelay", 250);

  $this->RequireParent("{3CFF0FD9-E306-41DB-9B5A-9D06D38576C3}"); //ClientSocket


}



public function Destroy(){
  //Never delete this line!
  parent::Destroy();
}



public function ApplyChanges(){
  //Never delete this line!
  parent::ApplyChanges();

}

public function ReceiveData($JSONString) {

    // Empfangene Daten vom I/O
    $data = json_decode($JSONString);
    IPS_LogMessage("ReceiveData", utf8_decode($data->Buffer));

    // Hier werden die Daten verarbeitet

    // Weiterleitung zu allen Gerät-/Device-Instanzen
    $this->SendDataToChildren(json_encode(Array("DataID" => "{4200DA47-E6B9-4257-8D1F-5C0549D81793}", "Buffer" => $data->Buffer)));
}

}

?>
