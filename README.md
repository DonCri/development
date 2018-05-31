# Modul zum vergleichen der Schwellwerte für die Sonnenfunktion.

### Version
1.3

### Was wird hinzugefügt?

Beim einfügen wird ein Modul mit 3 Variablen hinzugefügt.
  * Variable 1 = Aktiver Schwellwert Sonne
  * Variable 2 = oberer Schwellwert Sonne
  * Variable 3 = unterer Schwellwert Sonne
  * Variable 4 = Aktiver Schwellwert Wind
  * Variable 5 = oberer Schwellwert Wind
  * Variable 6 = unterer Schwellwert Wind
  * Variable 7 = Ein Ausschalten Beschattungsereignisse

### Beschreibung der einzelne Variable

Variable Aktiver Schwellwert: Wird der ein Wert 0 für den unteren Schwellwert oder 1 für den oberen Schwellwert geschrieben.
Variable oberer Schwellwert: Kann im WebFront der obere Wert (integer) eingegeben werden.
Variable unterer Schwellwert: Kann im WebFront der untere Wert (integer) eingegeben werden.
Ein / Ausschalten der Ereignisse: Auswählen von zwei Ereignisse die Ein und Ausgeschaltet werden können (Boolean)

### Funktionsweise

Beim überschreiten des oberen Wert, wird in der "Aktiver Schwellwert" Variable den Wert 1 geschrieben.
Beim unterschreiten des unteren Wert, wird in der "Aktiver Schwellwert" Variable den Wert 0 geschrieben.
Diese beide Werte (oben, unten) können benutzt werden um ein Ereignis (Bei bestimmten Wert) auszuführen.
Der Wert "oben" bleibt solange bestehen bis die Variable den Wert "unten" hat, andersrum das selbe. So wird die Variable nicht verändert
wen sich der Lichtsensor Wert zwischen den oberen und unteren SchwellWert befinden. Somit wird auch kein Ereignis ausgelöst.

Für den oberen Schwellwert zu aktivieren muss der Regensensor auf "false" gestellt sein, ansonsten wird kein Befehl ausgeführt.

Mit der Ein / Ausschalten Variable, können zwei Ereignisse gewählt werden die aktiviert oder deaktiviert werden sollen.

### Eigenschaftenformular

Einstellmöglichkeiten:
  * Lichtsensor: Variable des Lichtsensor welcher für den Vergleich notwendig ist.
  * Regensensor: Variable des Regensensor welcher überprüft werden soll.
  * Ereignis für oberen Schwellwert
  * Ereignis für unteren Schwellwert
  * oberen Schwellwert: Variable wo der obere Schwellwert eingegeben wird.
  * untere Schwellwert: Variable wo der untere Schwellwert eingegeben wird.
