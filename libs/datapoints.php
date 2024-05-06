<?php

//state/hostname/status
$DPStatus = [
//  Topicpath,           Description,                                                                                                                                             Type,   SymconProfile,        Action, hide
    ['protocol',         $this->Translate('used protocol'),                                                                                                                       VARIABLETYPE_STRING, '', false, true],
    ['online',           $this->Translate('Faikin is Online'),                                                                                                                    VARIABLETYPE_BOOLEAN, '~Switch', false, false],
    ['home',             $this->Translate('Temperature at remote / measured'),                                                                                                    VARIABLETYPE_FLOAT, '~Temperature', false, false],
    ['heat',             $this->Translate('in heating mode'),                                                                                                                     VARIABLETYPE_BOOLEAN, 'Switch', false, false],
    ['fanrpm',           $this->Translate('Fanspeed in RPM'),                                                                                                                     VARIABLETYPE_INTEGER, 'FAIKIN_rpm', false, false],
    ['comp',             $this->Translate('compressor utilization'),                                                                                                              VARIABLETYPE_INTEGER, '~Intensity.100', false, false],
    ['outside',          $this->Translate('Outside temperature'),                                                                                                                 VARIABLETYPE_FLOAT, '~Temperature', false, false],
    ['liquid',           $this->Translate('Liquid coolant feed temperature'),                                                                                                     VARIABLETYPE_FLOAT, '~Temperature', false, false],
    ['Wh',              $this->Translate('total consumption'),                                                                                                                    VARIABLETYPE_FLOAT, 'FAIKIN_kwh', false, false],
    ['power',            $this->Translate('AC is powered on'),                                                                                                                    VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['mode',             $this->Translate('Mode'),                                                                                                                                VARIABLETYPE_INTEGER, 'FAIKIN_Mode', true, false],
    ['temp',             $this->Translate('Set Roomtemperature'),                                                                                                                 VARIABLETYPE_FLOAT, 'FAIKIN_Temp', true, false],
    ['fan',              $this->Translate('Fan Level'),                                                                                                                           VARIABLETYPE_INTEGER, 'FAIKIN_Fanlevel', true, false],
    ['swingh',           $this->Translate('horizontal louvre swing'),                                                                                                             VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['swingv',           $this->Translate('vertical louvre swing'),                                                                                                               VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['econo',            $this->Translate('Ecomode'),                                                                                                                             VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['powerful',         $this->Translate('powerfull mode'),                                                                                                                      VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['autor',            $this->Translate('Range for automation, 0.0 means off - this sets the autor setting to 10 times this value'),                                            VARIABLETYPE_FLOAT, '', false, true],
    ['autot',            $this->Translate('Target temp for automation, This sets the autot setting to 10 times this value'),                                                      VARIABLETYPE_FLOAT, '', false, true],
    ['auto0',            $this->Translate('Time to turn off HH:MM, 00:00 is dont turn off. This sets the auto0 setting'),                                                         VARIABLETYPE_STRING, '', false, true],
    ['auto1',            $this->Translate('Time to turn off HH:MM, 00:00 is dont turn off. This sets the auto1 setting'),                                                         VARIABLETYPE_STRING, '', false, true],
    ['autop',            $this->Translate('if we automatically turn on/off power based on temperature'),                                                                          VARIABLETYPE_BOOLEAN, '', false, true],
    ['comfort',           $this->Translate('comfort airflow mode'),                                                                                                               VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['quiet',           $this->Translate('quiet outdoor unit'),                                                                                                                   VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['sensor',           $this->Translate('intelligent eye sensor'),                                                                                                              VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['streamer',           $this->Translate('streamer'),                                                                                                                          VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['ts',              $this->Translate('Timestamp'),                                                                                                                            VARIABLETYPE_INTEGER, '', false, true],    
    ['fanfreq',              $this->Translate('fanfreq'),                                                                                                                     VARIABLETYPE_FLOAT, '', false, true],    
];

//state/hostname
$DPState = [
    ['ts',              $this->Translate('Timestamp'),                                                                                                                            VARIABLETYPE_INTEGER, '', false, true],
    ['id',              $this->Translate('UniqueID'),                                                                                                                             VARIABLETYPE_STRING, '', false, true],
//    ['up',              $this->Translate('uptime'),                                                                                                                               VARIABLETYPE_INTEGER, '~UnixTimestampTime', false, true],
    ['up',              $this->Translate('online'),                                                                                                                               VARIABLETYPE_BOOLEAN, '~Switch', false, true],
    ['app',             $this->Translate('App'),                                                                                                                                  VARIABLETYPE_STRING, '', false, true],
    ['version',         $this->Translate('Version'),                                                                                                                              VARIABLETYPE_STRING, '', false, true],
    ['build-suffix',    $this->Translate('Firmwarebuild Suffix'),                                                                                                                 VARIABLETYPE_STRING, '', false, true],
    ['build',           $this->Translate('Firmwarebuild'),                                                                                                                        VARIABLETYPE_STRING, '', false, true],
    ['flash',           $this->Translate('flash used'),                                                                                                                           VARIABLETYPE_INTEGER, '', false, true],
    ['rst',             $this->Translate('rst'),                                                                                                                                  VARIABLETYPE_INTEGER, '', false, true],
    ['mem',             $this->Translate('memory used'),                                                                                                                          VARIABLETYPE_INTEGER, '', false, true],
    ['spi',             $this->Translate('spi'),                                                                                                                                  VARIABLETYPE_INTEGER, '', false, true],
    ['ssid',            $this->Translate('connected to SSID'),                                                                                                                    VARIABLETYPE_STRING, '', false, true],
    ['bssid',           $this->Translate('BBSid'),                                                                                                                                VARIABLETYPE_STRING, '', false, true],
    ['rssi',            $this->Translate('RSSi'),                                                                                                                                 VARIABLETYPE_INTEGER, '', false, true],
    ['chan',            $this->Translate('Wifi Channel'),                                                                                                                         VARIABLETYPE_INTEGER, '', false, true],
    ['ipv4',            $this->Translate('IP Address'),                                                                                                                           VARIABLETYPE_STRING, '', false, false],
];

// /info/hostname/upgrade
$DPInfo = [
    ['ts',              $this->Translate('Timestamp'),                                                                                                                            VARIABLETYPE_INTEGER, '',  false, true],
    ['url',             $this->Translate('URL to look for an Update'),                                                                                                            VARIABLETYPE_STRING, '',  false, false],
    ['version',         $this->Translate('Version'),                                                                                                                              VARIABLETYPE_STRING, '',  false, false],
    ['project',         $this->Translate('Projectname'),                                                                                                                          VARIABLETYPE_STRING, '',  false, true],
    ['time',            $this->Translate('Time'),                                                                                                                                 VARIABLETYPE_STRING, '',  false, true],
    ['date',            $this->Translate('Date'),                                                                                                                                 VARIABLETYPE_STRING, '',  false, true],
    ['up-to-date',      $this->Translate('Firmware is up to date'),                                                                                                               VARIABLETYPE_BOOLEAN, '~Switch',  false, false],    

];

// setting/hostname hide all of them, cause we put them in the configurationform
$DPSetting = [
    ['webcontrol',	    $this->Translate('Webcontrol'),                                                                                                                           VARIABLETYPE_INTEGER, 'FAIKIN_Webcontrol', true, true],
    ['ha',              $this->Translate('send Home-Assistant message via MQTT'),                                                                                                 VARIABLETYPE_BOOLEAN, '~Switch', true, true],
    ['reporting',       $this->Translate('reporting state in seconds'),                                                                                                           VARIABLETYPE_INTEGER, '',  true, true],
    ['dark',            $this->Translate('Shutdown LED'),                                                                                                                         VARIABLETYPE_BOOLEAN, '~Switch', true, false],
    ['livestatus',      $this->Translate('Live Status'),                                                                                                                         VARIABLETYPE_BOOLEAN, '~Switch', true, true],
    ['tmin',            $this->Translate('Min temperature'),                                                                                                                      VARIABLETYPE_FLOAT, '~Temperature', true, true],
    ['tmax',            $this->Translate('Max temperature'),                                                                                                                      VARIABLETYPE_FLOAT, '~Temperature', true, true],
    ['otahost',         $this->Translate('OTA URL'),                                                                                                                                VARIABLETYPE_STRING, '', true, true],
    ['otaauto',     	$this->Translate('OTA Autoupdate'),                                                                                                                      VARIABLETYPE_INTEGER, '', true, true],
    ['prefixhost',      $this->Translate('prefixhost'),                                                                                                 VARIABLETYPE_BOOLEAN, '~Switch', false, true],
    
];

$DPError = [
    ['description',              $this->Translate('Error Description'),                                                                                                                    VARIABLETYPE_STRING, '',  false, false],
    ['failed-set',              $this->Translate('Error by change setting'),                                                                                                                    VARIABLETYPE_STRING, '',  false, false],

];

$DPUID = [
    ['online',           $this->Translate('Faikin is Online'),                                                                                                                    VARIABLETYPE_BOOLEAN, '~Switch', false, true],
    ['target',           $this->Translate('target temperature'),                                                                                                                 VARIABLETYPE_FLOAT, 'FAIKIN_Temp', false, true],
    ['temp',             $this->Translate('Set Roomtemperature'),                                                                                                                 VARIABLETYPE_FLOAT, 'FAIKIN_Temp', false, true],
    ['outside',          $this->Translate('Outside temperature'),                                                                                                                 VARIABLETYPE_FLOAT, '~Temperature', false, true],
    ['liquid',           $this->Translate('Liquid coolant feed temperature'),                                                                                                     VARIABLETYPE_FLOAT, '~Temperature', false, true],
   // ['fanrpm',           $this->Translate('Fanspeed in RPM'),                                                                                                                     VARIABLETYPE_INTEGER, 'FAIKIN_rpm', false, true],
    ['mode',             $this->Translate('Mode'),                                                                                                                                VARIABLETYPE_INTEGER, 'FAIKIN_Mode', false, true],
    ['fan',              $this->Translate('Fan Level'),                                                                                                                           VARIABLETYPE_INTEGER, 'FAIKIN_Fanlevel', false, true],    
    ['swing',            $this->Translate('louvre swing'),                                                                                                                           VARIABLETYPE_INTEGER, '', false, true],    
    ['comp',            $this->Translate('compressor utilization'),                                                                                                                           VARIABLETYPE_INTEGER, '~Intensity.100', false, true],
    ['Wh',              $this->Translate('total consumption'),                                                                                                                     VARIABLETYPE_FLOAT, 'FAIKIN_kwh', false, true],    
    ['fanfreq',              $this->Translate('fanfreq'),                                                                                                                     VARIABLETYPE_FLOAT, '', false, true],    

];
