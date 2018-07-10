<?php
include("admin/Classes/Scheme.php");
$schm = new Scheme();

$activeSelectedSchemes=$schm->getAllActiveSelectedScheme();

if($activeSelectedSchemes)
{
	while($arr=$activeSelectedSchemes->fetch_assoc())
	{
		if(date("Y-m-d") > $arr["deactivation_date"])
		{
			$selectedSchemeId = $arr["selected_scheme_id"];
			$userId = $arr["user_id"];

			$updateTables=$schm->updateOnSelectedSchemeExpired($selectedSchemeId,$userId);
		}
	}
}



?>