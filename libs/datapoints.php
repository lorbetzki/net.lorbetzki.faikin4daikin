<?php

//state/hostname/status
$DPStatus = [
//  Topicpath,           Description,                                                                                                                                             Type,   SymconProfile,        Action, hide
    ['protocol',         $this->Translate('used protocol'),                                                                                                                       'STRING', '', false, true],
    ['online',           $this->Translate('Faikin is Online'),                                                                                                                    'BOOL', '~Switch', false, false],
    ['home',             $this->Translate('Temperature at remote / measured'),                                                                                                    'FLOAT', '~Temperature', false, false],
    ['heat',             $this->Translate('in heating mode'),                                                                                                                     'BOOL', 'Switch', false, false],
    ['fanrpm',           $this->Translate('Fanspeed in RPM'),                                                                                                                     'INT', 'FAIKIN_rpm', false, false],
    ['comp',             $this->Translate('comp'),                                                                                                                                'INT', '', false, true],
    ['outside',          $this->Translate('Outside temperature'),                                                                                                                 'FLOAT', '~Temperature', false, false],
    ['liquid',           $this->Translate('Liquid coolant feed temperature'),                                                                                                     'FLOAT', '~Temperature', false, false],
    ['power',            $this->Translate('AC is powered on'),                                                                                                                    'BOOL', '~Switch', true, false],
    ['mode',             $this->Translate('Mode'),                                                                                                                                'INT', 'FAIKIN_Mode', true, false],
    ['temp',             $this->Translate('Set Roomtemperature'),                                                                                                                 'FLOAT', 'FAIKIN_Temp', true, false],
    ['fan',              $this->Translate('Fan Level'),                                                                                                                           'INT', 'FAIKIN_Fanlevel', true, false],
    ['swingh',           $this->Translate('horizontal louvre swing'),                                                                                                             'BOOL', '~Switch', true, false],
    ['swingv',           $this->Translate('vertical louvre swing'),                                                                                                               'BOOL', '~Switch', true, false],
    ['econo',            $this->Translate('Ecomode'),                                                                                                                             'BOOL', '~Switch', true, false],
    ['powerful',         $this->Translate('powerfull mode'),                                                                                                                      'BOOL', '~Switch', true, false],
    ['autor',            $this->Translate('Range for automation, 0.0 means off - this sets the autor setting to 10 times this value'),                                            'FLOAT', '', false, true],
    ['autot',            $this->Translate('Target temp for automation, This sets the autot setting to 10 times this value'),                                                      'FLOAT', '', false, true],
    ['auto0',            $this->Translate('Time to turn off HH:MM, 00:00 is dont turn off. This sets the auto0 setting'),                                                         'STRING', '', false, true],
    ['auto1',            $this->Translate('Time to turn off HH:MM, 00:00 is dont turn off. This sets the auto1 setting'),                                                         'STRING', '', false, true],
    ['autop',            $this->Translate('if we automatically turn on/off power based on temperature'),                                                                          'BOOL', '', false, true],
    ['comfort',           $this->Translate('comfort airflow mode'),                                                                                                            'BOOL', '~Switch', true, false],
    ['quiet',           $this->Translate('quiet outdoor unit'),                                                                                                              'BOOL', '~Switch', true, false],
    ['sensor',           $this->Translate('intelligent eye sensor'),                                                                                                             'BOOL', '~Switch', true, false],
    ['streamer',           $this->Translate('streamer'),                                                                                                           'BOOL', '~Switch', true, false],
    ['ts',              $this->Translate('Timestamp'),                                                                                                                            'INT', '', false, true],

    
];

//state/hostname
$DPState = [
    ['ts',              $this->Translate('Timestamp'),                                                                                                                            'INT', '', false, true],
    ['id',              $this->Translate('ID'),                                                                                                                                   'STRING', '', false, true],
    ['up',              $this->Translate('uptime'),                                                                                                                               'INT', '~UnixTimestampTime', false, true],
    ['app',             $this->Translate('App'),                                                                                                                                  'STRING', '', false, true],
    ['version',         $this->Translate('Version'),                                                                                                                              'STRING', '', false, true],
    ['build-suffix',    $this->Translate('Firmwarebuild Suffix'),                                                                                                                  'STRING', '', false, true],
    ['build',           $this->Translate('Firmwarebuild'),                                                                                                                        'STRING', '', false, true],
    ['flash',           $this->Translate('flash used'),                                                                                                                           'INT', '', false, true],
    ['rst',             $this->Translate('rst'),                                                                                                                                  'INT', '', false, true],
    ['mem',             $this->Translate('memory used'),                                                                                                                          'INT', '', false, true],
    ['spi',             $this->Translate('spi'),                                                                                                                                  'INT', '', false, true],
    ['ssid',            $this->Translate('connected to SSID'),                                                                                                                    'STRING', '', false, true],
    ['bssid',           $this->Translate('BBSid'),                                                                                                                                'STRING', '', false, true],
    ['rssi',            $this->Translate('RSSi'),                                                                                                                                 'INT', '', false, true],
    ['chan',            $this->Translate('Wifi Channel'),                                                                                                                         'INT', '', false, true],
    ['ipv4',            $this->Translate('IP Address'),                                                                                                                           'STRING', '', false, false],
];

// /info/hostname/upgrade
$DPInfo = [
    ['ts',              $this->Translate('Timestamp'),                                                                                                                            'INT', '',  false, true],
    ['url',             $this->Translate('URL to look for an Update'),                                                                                                            'STRING', '',  false, false],
    ['version',         $this->Translate('Version'),                                                                                                                              'STRING', '',  false, false],
    ['project',         $this->Translate('Projectname'),                                                                                                                          'STRING', '',  false, true],
    ['time',            $this->Translate('Time'),                                                                                                                                 'STRING', '',  false, true],
    ['date',            $this->Translate('Date'),                                                                                                                                 'STRING', '',  false, true],
    ['up-to-date',      $this->Translate('Firmware is up to date'),                                                                                                               'BOOL', '~Switch',  false, false],    

];

// setting/hostname hide all of them, cause we put them in the configurationform
$DPSetting = [
    ['webcontrol',	    $this->Translate('Webcontrol'),                                                                                                                           'INT', 'FAIKIN_Webcontrol', true, true],
    ['ha',              $this->Translate('send Home-Assistant message via MQTT'),                                                                                                 'BOOL', '~Switch', true, true],
    ['reporting',       $this->Translate('reporting state in seconds'),                                                                                                           'INT', '',  true, true],
    ['dark',            $this->Translate('Shutdown LED'),                                                                                                                         'BOOL', '~Switch', true, false],
    ['tmin',            $this->Translate('Min temperature'),                                                                                                                      'FLOAT', '~Temperature', true, true],
    ['tmax',            $this->Translate('Max temperature'),                                                                                                                      'FLOAT', '~Temperature', true, true],
    ['otahost',         $this->Translate('OTA URL'),                                                                                                                         'STRING', '', true, true],
    ['otaauto',     	$this->Translate('OTA Autoupdate'),                                                                                                                      'INT', '', true, true],
];

$DPError = [
    ['description',              $this->Translate('Error Description'),                                                                                                                    'STRING', '',  false, false],
    ['failed-set',              $this->Translate('Error by change setting'),                                                                                                                    'STRING', '',  false, false],

];