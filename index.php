function getEmailforRegion($iblockId)
	{
		$arSelect = Array("ID","IBLOCK_ID", "NAME", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>IntVal($iblockId), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

		$elements = array();
		
		while($ob = $res->GetNextElement())
		{
			$arProps = $ob->GetProperties();
			$elements[] = array(
				"REGION" => $arProps['REGION']['VALUE'],
			 	"EMAIL" => $arProps['EMAIL']['VALUE']
			);
		}

		return $elements;
		}
CModule::includeModule('crm');
$rootActivity = $this->GetRootActivity();
$Result = getEmailforRegion(16);
foreach ($Result as $key => $value) {
	if ($value['REGION'] === "{{Регион}}"){
		$rootActivity->SetVariable("DefaultEmail",$value["EMAIL"]);
		$rootActivity->SetVariable("CheckWork","true");
		}
	}
