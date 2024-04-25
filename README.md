# Faikin 4 Daikin
Die ist ein Symcon Modul zur Ansteuerung einer Daikin Klimaanlage mithilfe eines [ESP32](https://github.com/revk/ESP32-Faikin) welches an die S21 Schnittstelle der Klimaanlage angeschlossen wird. Im Anschluss sendet und empfängt Faikin die Daten per MQTT

### Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)
6. [PHP-Befehlsreferenz](#6-php-befehlsreferenz)

### 1. Funktionsumfang

* empfangen von Ereignissen
* senden vieler Betriebsparameter 

### 2. Voraussetzungen

- IP-Symcon ab Version 6.0
- [Hardwaremodul EP32](https://github.com/revk/ESP32-Faikin)

### 3. Software-Installation

* Über den Module Store das 'Faikin 4 Daikin'-Modul installieren.
* Alternativ über das Module Control folgende URL [hinzufügen](https://github.com/lorbetzki/net.lorbetzki.faikin4daikin.git)

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' dann das 'Faikin 4 Daikin'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

__Konfigurationsseite__:

Name     | Beschreibung
-------- | ------------------
 Hostname des Moduls        | tragen Sie hier den Hostnamen des Faikin ein, der Hostname entspricht dem Topicname 
 Status emulieren        | wenn aktiviert, wird eine Änderung der Variable sofort gesetzt und nicht abgwartet bis die Rückmeldung erfolgt ist.
 
Erweiterte Einstellung

Name     | Beschreibung
-------- | ------------------
Intervall für Reporting update, 0 schaltet Intervall ab | Standard 60 sek. Wird nicht ausgewertet und kann auf 0 gestellt werden.
Nachrichten an HomeAssitant senden | Standard eingeschaltet. Das Hardwaremodul sendet spezielle MQTT Topic damit HomeAssistant direkt verwendet werden kann. ~~Das abschalten wird nicht empfohlen, da auch dieses Modul Statusmeldungen wie Außen- und Innentemperatur, Drehzahl usw. aus den Meldungen auswertet. Ein Abschalten bewirkt, das nur aktive Änderungen übertragen werden.~~ Dies kann abgeschaltet werden um MQTT-Traffic einzusparen und dafür "Live-Statusmeldungen" zu aktivieren
Live-Statusmeldungen von allen Variablen empfangen | aktualisiert ALLE Variablen bei Änderungen der Daikin
Sende Einstellung | sendet die Einstellung direkt an das Hardwaremodul

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name   | Typ     | Beschreibung
------ | ------- | ------------
AC ist eingeschaltet       | boolean        | Klimaanlage ein-/ausschalten
Außentemperatur | float | Außentemperatur in °C
Eco Modus | boolean | schaltet den Eco Modus ein oder aus
Faikin ist Online | boolean | Rückmeldung ob die Hardware online ist
horizontale Lamellenschwenkung | boolean | horizontale Lamellenschwenkung ein bzw ausschalten
im Heizmodus | boolean | zeigt an, ob sich die Anlage im Heizmodus befindet
Leistungsstarker Modus | boolean | de/aktiviert den Powermodus
Lüftergeschwindigkeit in rpm | integer | zeigt die Lüftergeschwindigkeit an
Lüfterstufe | integer | -1 = Geräuscharm, 0 = Automatik Modus, 1-5 = Lüfterstufe 1-5
Modus | integer | 1=heizen, 2=kühlen, 3=automatik modus, 4=lüften, 5=trocknen
Setze Solltemperatur | float | setze die Solltemperatur
IST-Temperatur | float | zeigt die IST Temperatur an
vertikale Lamellenschwenkung | boolean |vertikale Lamellenschwenkung ein bzw ausschalten
Vorlauftemperatur des Kühlmittels | float | Vorlauftemperatur des Kühlmittels wird angezeigt
IP Adresse | string | zeigt die IP Adresse des Hardwaremoduls an
Schalte Betriebsled am Faikin aus | boolean | schaltet die LED am Hardwaremodul an/aus, die ist verdammt hell
Fehler Beschreibung | string | Fehlerbeschreibung, leider wird diese nur auf Englisch dargestellt
versetze beim Start die Lüfterstufe auf Geräuscharm | boolean | Das Hardwaremodul merkt sich den zuletzt eingestellten Modus, leider gilt das nicht für den Geräuscharmen Modus, da es seitens der Klimaanlage keine Rückmeldung gibt. Wenn diese Variable auf WAHR gesetzt wird, wird immer beim aktivieren der Klimaanlage in den Geräuscharmen Modus geschaltet. 
Intelligent Eye Sensor | boolean | schaltet die 3D Sensor funktion ein oder aus.
Komfort Modus | booelan | schaltet den Komfortmodus ein oder aus.
Außengerät im Flüstermodus | boolean | schaltet das Außengerät in den Flüstermodus ein oder aus

#### Profile

Name   | Typ
------ | -------
FAIKIN_rpm     | Integer
FAIKIN_Mode       | Integer
FAIKIN_Fanlevel | Integer
FAIKIN_Webcontrol | Integer
FAIKIN_Temp | Float

### 6. PHP-Befehlsreferenz

`boolean FAIKIN_SetFaikinLed(integer $InstanzID, boolean $State);`
Schaltet die Betriebsled auf dem Faikin aus. Kann zum Beispiel in einem Script verwendet werden um Tagsüber im Kinderzimmer den Status zu sehen, nachts hingegegen abzuschalten.

Beispiel:
`FAIKIN_SetLed(12345, true);`

`boolean FAIKIN_RestartDevice(integer $InstanzID);`
Startet das Faikin neu,

Beispiel:
`FAIKIN_RestartDevice(12345);`

`boolean FAIKIN_ReloadSettings(integer $InstanzID);`
ladet die aktuellen Systemeinstellungen neu

Beispiel:
`FAIKIN_ReloadSettings(12345);`

`FAIKIN_SetSilentModeOnStart(integer $InstanzID, boolean $State);`
Das Hardwaremodul merkt sich den zuletzt eingestellten Modus, leider gilt das nicht für den Geräuscharmen Modus, da es seitens der Klimaanlage keine Rückmeldung gibt. Wenn diese Funktion auf WAHR gesetzt wird, wird immer beim aktivieren der Klimaanlage in den Geräuscharmen Modus geschaltet. Kann verwendet werden, wenn Tagsüber bspw immer manuell die Lüfterstufe umgestellt wird, aber nachts in den Geräuscharmen Modus geschaltet werden soll.

Beispiel:
`FAIKIN_SetSilentModeOnStart(12345, true);`