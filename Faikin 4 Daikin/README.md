# Faikin 4 Daikin
Die ist ein Symcon Modul zur Ansteuerung einer Daikin Klimaanlage mithilfe eines [ESP32](https://github.com/revk/ESP32-Faikin) welches an die S21 Schnittstelle der Klimaanlage angeschlossen wird. Im Anschluss sendet und empfängt Faikin die Daten per MQTT

### Inhaltsverzeichnis

1. [Funktionsumfang](#1-funktionsumfang)
2. [Voraussetzungen](#2-voraussetzungen)
3. [Software-Installation](#3-software-installation)
4. [Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
5. [Statusvariablen und Profile](#5-statusvariablen-und-profile)
6. [WebFront](#6-webfront)
7. [PHP-Befehlsreferenz](#7-php-befehlsreferenz)

### 1. Funktionsumfang

* empfangen von befehlen zur Ansteuerung der Kklimaanlage
* senden vieler Betriebsparameter 

### 2. Voraussetzungen

- IP-Symcon ab Version 7.0
- [Hardwaremodul EP32](https://github.com/revk/ESP32-Faikin)

### 3. Software-Installation

* Über den Module Store das 'Faikin 4 Daikin'-Modul installieren.
* Alternativ über das Module Control folgende URL hinzufügen

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'Faikin 4 Daikin'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

__Konfigurationsseite__:

Name     | Beschreibung
-------- | ------------------
 Hostname des Moduls        | tragen Sie hier den Hostnamen des Faikin ein, der Hostname entspricht dem Topicname 
         |

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name   | Typ     | Beschreibung
------ | ------- | ------------
       |         |
       |         |

#### Profile

Name   | Typ
------ | -------
FAIKIN_rpm     | Integer
FAIKIN_Mode       | Integer
FAIKIN_Fanlevel | Integer
FAIKIN_Webcontrol | Integer
FAIKIN_Temp | Float

### 6. WebFront

Die Funktionalität, die das Modul im WebFront bietet.

### 7. PHP-Befehlsreferenz

`boolean FAIKIN_SetLed(integer $InstanzID, boolean $State);`
Schaltet die Betriebsled auf dem Faikin aus. Beispielsweise für das Schlafzimmer ideal.

Beispiel:
`FAIKIN_SetLed(12345, true);`

`boolean FAIKIN_SetHA(integer $InstanzID, boolean $State);`
Sendet Daten über MQTT passend für Home-Assistant instanzen. Kann deaktiviert werden, wenn HA nicht benutzt wird, da sonst nur unnötig Daten gesendet werden.

Beispiel:
`FAIKIN_SetHA(12345, false);`

`boolean FAIKIN_RestartDevice(integer $InstanzID);`
Startet das Faikin neu,

Beispiel:
`FAIKIN_RestartDevice(12345);`

`boolean FAIKIN_ReloadSettings(integer $InstanzID);`
ladet die aktuellen Systemeinstellungen neu

Beispiel:
`FAIKIN_ReloadSettings(12345);`