<?php

declare(strict_types=1);
require_once __DIR__ . '/../libs/VariableProfileHelper.php';

	class Faikin4Daikin extends IPSModule
	{
		use VariableProfileHelper;
		public function Create()
		{
			//Never delete this line!
			parent::Create();

			$this->ConnectParent('{C6D2AEB3-6E1F-4B2E-8E69-3A1A00246850}'); //MQTT Server
			$this->RegisterPropertyString('Hostname', '');

			$this->RegisterProfileInteger("FAIKIN_rpm", "", "", " rpm", 0, 0, 0);

			$this->RegisterProfileIntegerEx("FAIKIN_Mode", "", "", "", [
				['1', $this->Translate('heat'),  '', 0xFFFF00],
				['2', $this->Translate('cool'),  '', 0x00FF00],
				['3', $this->Translate('auto'),  '', 0x00FF00],
				['4', $this->Translate('fan'),  '', 0x00FF00],
				['5', $this->Translate('dry'),  '', 0x00FF00]
			]);

			$this->RegisterProfileIntegerEx("FAIKIN_Fanlevel", "", "", "", [
				['-1', $this->Translate('Silent'),  '', 0x00FF00],
				['0', $this->Translate('Auto'),  '', 0x00FF00],
				['1', $this->Translate('Level 1'),  '', 0x00FF00],
				['2', $this->Translate('Level 2'),  '', 0x00FF00],
				['3', $this->Translate('Level 3'),  '', 0x00FF00],
				['4', $this->Translate('Level 4'),  '', 0x00FF00],
				['5', $this->Translate('Level 5'),  '', 0x00FF00]
			]);

			$this->RegisterProfileIntegerEx("FAIKIN_Webcontrol", "", "", "", [
				['0', $this->Translate('no web access'),  '', 0xFFFF00],
				['1', $this->Translate('just aircon settings not WiFI'),  '', 0x00FF00],
				['2', $this->Translate('all controls'),  '', 0x00FF00]
			]);

			$this->RegisterProfileFloat("FAIKIN_Temp", "Temperature", "", " °C", 10, 32, 0.5, 1);
		}

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			//$this->SetReceiveDataFilter('.*' . $MQTTTopic . '.*');
			
			$Hostname = $this->ReadPropertyString("Hostname");
			
			$this->SetReceiveDataFilter('.*' . $Hostname . '.*');
			$this->RequestAction('reload_setting','');
		}

		public function GetConfigurationForm()
		{
			$jsonForm = json_decode(file_get_contents(__DIR__ . "/form.json"), true);

			//$Hostname = $this->ReadPropertyString('Hostname');
			
			return json_encode($jsonForm);
		}

		public function ReceiveData($JSONString)
		{
			$data = json_decode($JSONString, true);
			
			$this->checkDPTable($JSONString);
		}

		private function checkDPTable($data)
		{			
			$Hostname = $this->ReadPropertyString("Hostname");

			require_once __DIR__ . '/../libs/datapoints.php';
			$data = json_decode($data, true);

			$encodePayload = $data['Payload'];
			$Payload = json_decode($encodePayload, true);

			$TopicReceived = $data['Topic'];
			$TopicInfo 			= "info/".$Hostname."/status";
			$TopicState			= "state/".$Hostname;
			$TopicStatus 		= "state/".$Hostname."/status";
			$TopicReporting 	= "Faikin/".$Hostname;
			$TopicError 		= "error/".$Hostname;
			$TopicSetting 		= "setting/".$Hostname;


			switch($TopicReceived)
			{
				case "$TopicInfo":
					$WorkTopic = $TopicInfo;
					$WorkDB = $DPInfo;
					$IdentPrefix = "info_";
					$this->SendDebug("known topic",$TopicReceived." with data ".$encodePayload,0);
					$DP_SORT = 30;
				break;

				case "$TopicState":
					$WorkTopic = $TopicState;
					$WorkDB = $DPState;
					$IdentPrefix = "state_";
					$this->SendDebug("known topic",$TopicReceived." with data ".$encodePayload,0);
					$DP_SORT = 20;
				break;
			
				case "$TopicStatus":
				case "$TopicReporting":
					$WorkTopic = $TopicStatus;
					$WorkDB = $DPStatus;
					$IdentPrefix = "status_";
					$this->SendDebug("known topic",$TopicReceived." with data ".$encodePayload,0);
					$DP_SORT = 10;
				break;

				case "$TopicError":
					$WorkTopic = $TopicError;
					$WorkDB = $DPError;
					$IdentPrefix = "error_";
					$this->SendDebug("known topic",$TopicError." with data ".$encodePayload,0);
					$DP_SORT = 90;
				break;

				case "$TopicSetting":
					$WorkTopic = $TopicSetting;
					$WorkDB = $DPSetting;
					$IdentPrefix = "setting_";
					$this->SendDebug("known topic",$TopicSetting." with data ".$encodePayload,0);
					$DP_SORT = 50;
				break;

				default:
					$this->SendDebug("Unknown topic",$TopicReceived." with data ".$encodePayload,0);
				return;
			}

			if ($WorkTopic){
				$this->SendDebug("checkDPTable:","Worktopic defined to ".$WorkTopic, 0);

				foreach($WorkDB as $Datapoint)
				{

					//  Topicpath,           Description, Type,   SymconProfile,        Action, hide

					$DP_Path = $Datapoint['0'];
					$DP_Desc = $Datapoint['1'];
					$DP_Type = $Datapoint['2'];
					$DP_Profile = $Datapoint['3'];
					$DP_Action = $Datapoint['4'];
					$DP_Hide = $Datapoint['5'];
					
					// for one setting i need to know if its value is false. in this case the value is not in the payload. we put it in
					if (($DP_Path == "dark") and (array_key_exists($DP_Path, $Payload) == false))
					{
						$Payload["dark"] = false;
					}
					// if DP_Path not in Payload stop. 
					if (array_key_exists($DP_Path, $Payload) == false) {
						$this->SendDebug("Not in Payload","Topic: ".$DP_Path." is not in Payload.", 0);
						return;
					}

					$DP_Value = $Payload[''.$DP_Path.''];

					// if the value is an array, (in some case used by home, temp or liquid) use the first one
					
					if(is_array($DP_Value))
					{
						$this->SendDebug("Value is an array:","Topic: ".$DP_Path." has more the one value, use the first one: ".$DP_Value[0], 0);
						$DP_Value = $DP_Value[0];
					}

					// make symcon happy to create idents
					$DP_Identname = str_replace("-","_",$IdentPrefix.$DP_Path);

					if (!$DP_Hide)
					{
						$this->SendDebug("Value:","Set ".$DP_Path." to Value ".$DP_Value, 0);
					}
					switch ($DP_Type)
					{
						case "BOOL":
							$DP_DataType = 0;
						break;
						case "INT":
							$DP_DataType = 1;
						break;
						case "FLOAT":
							$DP_DataType = 2;
						break;
						case "STRING":
							$DP_DataType = 3;
						break;
					}

					// for some values we need to change the type
					switch($DP_Path)
					{

						case "fan":
							switch($DP_Value)
							{
								case 1:
								case 2:
								case 3:
								case 4:
								case 5:
									$DP_Value = $DP_Value;
								break;
								case "A":
									$DP_Value = 0;
								break;
								case "B":
								case "Q":
									$DP_Value = -1;
								break;
							}
						break;
						case "mode":
							switch($DP_Value)
							{
								case "A":
									$DP_Value = 3;
									break;
								case "C":
									$DP_Value = 2;
									break;
								case "D":
									$DP_Value = 5;
									break;
								case "F":
									$DP_Value = 4;
								break;
								case "H":
									$DP_Value = 1;
								break;
							}
						break;
					}

					// in case the datatype is hidden, dont do anything
					if (!$DP_Hide)
					{

						if (!@$this->GetIDForIdent(''.$DP_Identname.''))
						{

							$this->MaintainVariable($DP_Identname, $this->Translate("$DP_Desc"), $DP_DataType, "$DP_Profile", $DP_SORT, true); 
							$this->SendDebug("MaintainVariable:","Create Variable with IDENT ".$DP_Identname, 0);

							if ($DP_Action)
							{
								$this->EnableAction($DP_Identname);
								$this->SendDebug("EnableAction:","Create Action for IDENT ".$DP_Identname, 0);
							}
						}
						
						// now we can set the value.... yeah!
						$this->SetValue($DP_Identname, $DP_Value);
					}

				}
			}

		}

		protected function sendMQTT($Topic, $Payload)
		{
			$mqtt['DataID'] = '{043EA491-0325-4ADD-8FC2-A30C8EEB4D3F}';
			$mqtt['PacketType'] = 3;
			$mqtt['QualityOfService'] = 0;
			$mqtt['Retain'] = false;
			$mqtt['Topic'] = $Topic;
			$mqtt['Payload'] = $Payload;
			$mqttJSON = json_encode($mqtt, JSON_UNESCAPED_SLASHES);
			$mqttJSON = json_encode($mqtt);
			$result = $this->SendDataToParent($mqttJSON);
		}	

		public function RequestAction($Ident, $Value)
		{
			$Hostname = $this->ReadPropertyString("Hostname");
			$this->LogMessage("RequestAction : $Ident, $Value",KL_NOTIFY);

			switch ($Ident) {
				case 'setting_dark':
					$Topic = 'setting/'.$Hostname;
					$a = array("dark" => $Value);
					$this->sendMQTT($Topic, json_encode($a));
					$this->SetValue('setting_dark', $Value);
				break;
				case 'setting_ha':
					$Topic = 'setting/'.$Hostname;
					$a = array("ha" => $Value);
					$this->sendMQTT($Topic, json_encode($a));
					$this->SetValue('ha', $Value);
				break;
				case 'status_power':
					if ($Value === false){$Status = "off";}
					if ($Value == true){$Status = "on";}
					$Topic = 'command/'.$Hostname.'/'.$Status;
					$this->sendMQTT($Topic, "");
				break;
				case 'status_mode':
					switch ($Value)
					{
						case 1:
							$Value = "H";
						break;
						case 2:
							$Value = "C";
						break;
						case 3:
							$Value = "A";
						break;
						case 4:
							$Value = "F";
						break;
						case 5:
							$Value = "D";
						break;
					}
					$Topic = 'command/'.$Hostname.'/mode';
					$this->sendMQTT($Topic, json_encode("$Value"));
				break;
				case 'status_fan':
					switch ($Value)
					{
						case -1:
							$a = "Q";
						break;
						case 0:
							$a = "A";
						break;
						case 1:
						case 2:
						case 3:
						case 4:
						case 5:
							$a = $Value;
						break;
					}
					$Topic = 'command/'.$Hostname.'/fan';
					$this->sendMQTT($Topic, json_encode("$a"));	
				break;
				case 'setting_reporting':
				break;
				case 'setting_tmin':
				break;
				case 'setting_tmax':
				break;				
				case 'setting_otahost':
				break;				
				case 'setting_otaauto':
				break;
				case 'status_econo':
					$Topic = 'command/'.$Hostname;
					$a = array("econo" => $Value);
					$this->sendMQTT($Topic, json_encode($a));	
				break;
				case 'status_swingh':
					$Topic = 'command/'.$Hostname;
					$a = array("swingh" => $Value);
					$this->sendMQTT($Topic, json_encode($a));
				break;
				case 'status_swingv':
					$Topic = 'command/'.$Hostname;
					$a = array("swingv" => $Value);
					$this->sendMQTT($Topic, json_encode($a));
				break;	
				case 'status_powerful':
					$Topic = 'command/'.$Hostname;
					$a = array("powerful" => $Value);
					$this->sendMQTT($Topic, json_encode($a));
				break;
				case 'status_temp':
					$Topic = 'command/'.$Hostname.'/temp';
					$this->sendMQTT($Topic, json_encode($Value));	
				break;
				case 'reload_setting':
					$Topic = 'setting/'.$Hostname;
					$this->sendMQTT($Topic, "");	
				break;	
				case 'manual_restart':
					$Topic = 'command/'.$Hostname."/restart";
					$this->sendMQTT($Topic, "");	
				break;		
			}
		}

		public function SetLed($state)
		{
			$this->RequestAction('setting_dark',$state);
		}
		
		public function SetHA($state)
		{
			$this->RequestAction('setting_ha',$state);
		}

		public function RestartDevice()
		{
			$this->RequestAction('manual_restart',"");
		}

		public function ReloadSettings()
		{
			$this->RequestAction('reload_setting',"");
		}
}