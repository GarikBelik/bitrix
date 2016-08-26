<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Автозаполнение формы");

$arChema = array(
	"1c" => "– подачу заявителем в орган по сертификации продукции заявки на проведение сертификации с прилагаемой технической документацией;
– рассмотрение заявки и принятие по ней решения органом по сертификации продукции;
– отбор органом по сертификации продукции образцов для проведения испытаний;
– проведение испытаний образцов продукции – аккредитованной испытательной лабораторией;
– проведение органом по сертификации продукции анализа состояния производства;
– обобщение органом по сертификации продукции результатов испытаний и анализа состояния производства и выдачу заявителю сертификата соответствия;
– нанесение единого знака обращения;
– инспекционный контроль за сертифицированной продукцией
			",
	"2c" => "– подачу заявителем в орган по сертификации продукции заявки на проведение сертификации с прилагаемой технической документацией, в состав которой в обязательном порядке включается сертификат на систему менеджмента (копия сертификата), выданный органом по сертификации систем менеджмента, подтверждающий соответствие системы менеджмента требованиям, определенным в техническом регламенте;
– рассмотрение заявки и принятие органом по сертификации продукции решения о проведении сертификации продукции;
– отбор органом по сертификации продукции образцов для проведения испытаний;
– проведение испытаний образцов продукции аккредитованной испытательной лабораторией;
– обобщение органом по сертификации продукции результатов анализа представленной заявителем технической документации, результатов испытаний образцов продукции и выдачу заявителю сертификата соответствия;
– нанесение единого знака обращения;
– инспекционный контроль за сертифицированной продукцией, контроль за стабильностью функционирования системы менеджмента.
			",
	"3c" => "– подачу заявителем в орган по сертификации продукции заявки на проведение сертификации с прилагаемой технической документацией;
– рассмотрение заявки и принятие органом по сертификации продукции решения о проведении сертификации продукции;
– отбор органом по сертификации продукции образцов для проведения испытаний;
– проведение испытаний образцов продукции аккредитованной испытательной лабораторией;
– анализ результатов испытаний и выдачу заявителю сертификата соответствия;
– маркировка партии продукции единым знаком обращения.
			"
);

$arLabs = array(
	"1l" => "Протокола испытаний № , выданного Испытательной лабораторией Общества с ограниченной ответственностью «ГЕЛИОС», аттестат аккредитации RA.RU.21АБ91 действителен с 08.07.2015.",
	"2l" => "Протокола испытаний № , выданного Испытательной лабораторией Общества с ограниченной ответственностью «Центр Испытаний и Сертификации АЛЬТЕРНАТИВА», аттестат аккредитации № RA.RU.21ЛТ78 от 13.01.2016.",
	"3l" => "Протокола испытаний № , выданного Аккредитованным Испытательным центром Орехово-Зуевского филиала Федерального бюджетного учреждения «Государственный региональный центр стандартизации, метрологии и испытаний в Московской области», аттестат аккредитации № RA.RU.21БУ02, действителен с 17.03.2016.",
	"4l" => "Протокола испытаний № ХХХХХХ, выданного Испытательной лабораторией «ИЛ БТ» Общества с ограниченной ответственностью «Испытательная лаборатория электротехнической продукции ЭМС», аттестат аккредитации № RA.RU.21МЛ31, действителен с 04.04.2016.",
	"5l" => "Протокола испытаний № ХХХХХХ, выданного Испытательной лабораторией электротехнической продукции ЭМС Общества с ограниченной ответственностью «Испытательная лаборатория электротехнической продукции ЭМС», аттестат аккредитации № POCC RU.0001.21МЭ48, действителен с 19.11.2014.",
	"6l" => "Протокола испытаний № ХХХХХХ, выданного Испытательной лабораторией Общества с ограниченной ответственностью «ТестИспытания», аттестат аккредитации № РОСС RU.04ИДЭ0.001, действителен с 14.04.2016 по 13.04.2019.",
	"7l" => "Протокола испытаний № ХХХХХХ, выданного Испытательной лабораторией Общества с ограниченной ответственностью «Инвестиционная корпорация», аттестат аккредитации № RA.RU.21МЭ64, действителен с 07.12.2015",
	"8l" => "Протокола испытаний № ХХХХХХ, выданного Испытательной лабораторией Общества с ограниченной ответственностью «Испытательная лаборатория ручных и переносных электрических машин», аттестат аккредитации № РОСС RU.0001.21МО54, действителен с 14.12.2015."
);

$arTech = array(
	"1t" => "Технического Регламента Таможенного Союза ТР ТС 010/2011 «О безопасности машин и оборудования», утвержденного Решением Комиссии Таможенного Союза от 18.10.2011 № 823;",
	"2t" => "Технического Регламента Таможенного Союза ТР ТС 004/2011 «О безопасности низковольтного оборудования», утвержденного Решением Комиссии Таможенного Союза от 16.08.2011 № 768;",
	"3t" => "Технического Регламента Таможенного Союза ТР ТС 020/2011 «Электромагнитная совместимость технических средств», утвержденного Решением Комиссии Таможенного Союза от 09.12.2011 № 879",
	"4t" => "Технического Регламента Таможенного Союза ТР ТС 008/2011 «О безопасности игрушек», утвержденного Решением Комиссии Таможенного Союза от 23.09.2011 № 798",
	"5t" => "Технического Регламента Таможенного Союза ТР ТС 007/2011 «О безопасности продукции, предназначенной для детей и подростков», утвержденного Решением Комиссии Таможенного Союза от 23.09.2011 № 797",
	"6t" => "Технического Регламента Таможенного Союза ТР ТС 017/2011 «О безопасности продукции легкой промышленности», утвержденного Решением Комиссии Таможенного Союза от 09.12.2011 № 876",
	"7t" => "Технического регламента Таможенного союза ТР ТС 009/2011 «О безопасности парфюмерно-косметической продукции», утвержденного Решением Комиссии Таможенного Союза от 23.09.2011 № 799",
	"8t" => "Технического Регламента Таможенного Союза ТР ТС 005/2011 «О безопасности упаковки», утвержденного Решением Комиссии Таможенного союза от 16.08.2011 № 769"
);
?>
<?

class Unoconv {

    public static function convert($outputFile, $toFormat)
    {
        $command = 'unoconv -f %s %s';
        $command = sprintf($command, $toFormat, $outputFile);
        system($command, $output);

        return $output;
    }

	public static function convertToPdf($outputFile)
    {
        return self::convert($outputFile, 'pdf');
    }

	public static function convertToDOCX($outputFile)
    {
        return self::convert($outputFile, 'docx');
    }
	
	function spaceToTranslit($string) {
		$converter = array(
			' ' => '_'
		);
		return strtr($string, $converter);
	}
}

if(!empty($_REQUEST["af"])){
	$btnName = "Архив СС ТР ТС";
	$file = $_REQUEST['selectfile'].'.doc';
}elseif(!empty($_REQUEST["ms"])){
	$btnName = "Макет СС ТР ТС";
	switch ($_REQUEST["sert"]){
		case "1s":
			$btnName .= ". Приложение по продукции.";
			$file = $_REQUEST['selectfile'].'_ms_1s.doc';
			break;
		case "2s":
			$btnName .= ". Приложение по филиалам";
			$file = $_REQUEST['selectfile'].'_ms_2s.doc';
			break;
		case "3s":
			$btnName .= ". Приложение свободная форма";
			$file = $_REQUEST['selectfile'].'_ms_3s.doc';
			break;
	}
}elseif(!empty($_REQUEST["md"])){
	$btnName = "Макет ДС ТР ТС";
	$file = $_REQUEST['selectfile'].'_md.doc';
}elseif(!empty($_REQUEST["ad"])){
	$btnName = "Архив ДС ТР ТС";
	$file = $_REQUEST['selectfile'].'_ad.doc';
}

$fullPath = '/home/bitrix/www/auto/af/';
$format = explode('.', $fullPath.$file);
if(!empty($_REQUEST) && $_REQUEST['file_name'] != ''){
	
	$_REQUEST['file_name'] = Unoconv::spaceToTranslit($_REQUEST['file_name']);
	
	//Unoconv::convertToDOCX($fullPath.$file);
	$path = md5(uniqid(rand(),true));
	exec('mkdir /tmp/'.$path);
	exec('mkdir '.$fullPath.$path);
	
	//rename($fullPath.$file.'x', $format[0].'.zip');
	exec('unzip -o '.$format[0].'.zip -d /tmp/'.$path); 
	$template = file_get_contents('/tmp/'.$path.'/word/document.xml');
	 
	foreach($_REQUEST as $id => $name){
		if($id == "cc"){
			$template = str_replace( 'xxcctextxx', $arChema[$name], $template);
		}
		if($id == "trts"){
			$template = str_replace( 'xxtrtsxx', $arTech[$name], $template);
		}
		if($id == "ll"){
			$template = str_replace( 'xxllxx', $arLabs[$name], $template);
		}
		$template = str_replace( 'xx'.$id.'xx', $name, $template);
	}

	$url = explode('index.php',$_SERVER['SCRIPT_URI']);
	
	$fp = fopen('/tmp/'.$path.'/word/document.xml', 'w');
	// записываем в файл текст
	fwrite($fp, $template);
	// закрываем
	fclose($fp);
	chdir('/tmp/'.$path);
	exec('zip -r '.$_REQUEST["file_name"].' ./*');
	copy('/tmp/'.$path.'/'.$_REQUEST["file_name"].'.zip',$fullPath.$path.'/'.$_REQUEST["file_name"].'.docx');
	Unoconv::convertToPdf($fullPath.$path.'/'.$_REQUEST["file_name"].'.docx');
	
	$el = new CIBlockElement;
	$PROP = array();
	$site = ($_REQUEST['selectfile'] == 'souz') ? "СоюзТест. ".$btnName : "МилТест. ".$btnName;
	
	if($_REQUEST['selectfile'] == "souz"){
		$PROP[114] = CFile::MakeFileArray($url[0].$path.'/'.$_REQUEST["file_name"].".docx");
		$PROP[115] = CFile::MakeFileArray($url[0].$path.'/'.$_REQUEST["file_name"].".pdf");
		$PROP[116] = $_SESSION["SESS_AUTH"]["NAME"];

		$arLoadProductArray = Array(
			"MODIFIED_BY"    => $USER->GetID(),
			"IBLOCK_SECTION_ID" => false,
			"IBLOCK_ID"      => 31,
			"PROPERTY_VALUES"=> $PROP,
			"NAME"           => $_REQUEST["file_name"],
			"ACTIVE"         => "Y",
			"PREVIEW_TEXT"   => $site
		);

		if(!$PRODUCT_ID = $el->Add($arLoadProductArray))
			echo "Error: ".$el->LAST_ERROR;
		else{
			$db_element = $el->GetList(array(), array("IBLOCK_ID" => 31,"ID" => $PRODUCT_ID), false, false, array("ID", "NAME", "PROPERTY_FILE_DOC", "PROPERTY_FILE_PDF","PROPERTY_USER_NAME"));;
			if($element = $db_element->Fetch()){
				$doc = CFile::GetFileArray($element["PROPERTY_FILE_DOC_VALUE"]);
				$pdf = CFile::GetFileArray($element["PROPERTY_FILE_PDF_VALUE"]);
			}
		}
	}else{
		$PROP[117] = CFile::MakeFileArray($url[0].$path.'/'.$_REQUEST["file_name"].".docx");
		$PROP[118] = CFile::MakeFileArray($url[0].$path.'/'.$_REQUEST["file_name"].".pdf");
		$PROP[119] = $_SESSION["SESS_AUTH"]["NAME"];

		$arLoadProductArray = Array(
			"MODIFIED_BY"    => $USER->GetID(),
			"IBLOCK_SECTION_ID" => false,
			"IBLOCK_ID"      => 33,
			"PROPERTY_VALUES"=> $PROP,
			"NAME"           => $_REQUEST["file_name"],
			"ACTIVE"         => "Y",
			"PREVIEW_TEXT"   => $site
		);

		if(!$PRODUCT_ID = $el->Add($arLoadProductArray))
			echo "Error: ".$el->LAST_ERROR;
		else{
			$db_element = $el->GetList(array(), array("IBLOCK_ID" => 33,"ID" => $PRODUCT_ID), false, false, array("ID", "NAME", "PROPERTY_FILE_DOC", "PROPERTY_FILE_PDF","PROPERTY_USER_NAME"));;
			if($element = $db_element->Fetch()){
				$doc = CFile::GetFileArray($element["PROPERTY_FILE_DOC_VALUE"]);
				$pdf = CFile::GetFileArray($element["PROPERTY_FILE_PDF_VALUE"]);
			}
		}
	}
	
	echo "Нажмите если скачивание не началось <a class='download' href='".$doc['SRC']."' download>Скачать ".$_REQUEST["file_name"].".docx</a> или <a class='download' href='".$pdf['SRC']."' download>Скачать ".$_REQUEST["file_name"].".pdf</a><br /><br />";
	
	exec('rm -r /tmp/'.$path);
	exec('rm -r '.$fullPath.$path);
}
?>

<form action="" class="autoform">
	<div style="display: inline-block;">
		<div>
			Имя генерируемого файла:
			<input name="file_name" id="file_name" type="text" value="<?if(!empty($_REQUEST["file_name"])) echo $_REQUEST["file_name"];?>" />
		</div>
		<div>
			Орган по сертификации:
			<select name="selectfile" id="selectfile">
				<option <?if($_REQUEST["selectfile"] == "souz") echo "selected";?> value="souz">СоюзТест</option>
				<option <?if($_REQUEST["selectfile"] == "mil") echo "selected";?> value="mil">МилТест</option>
			</select>
		</div>
		<div>
			Заявитель:
			<input name="applicant" id="applicant" type="text" value="<?if(!empty($_REQUEST["applicant"])) echo $_REQUEST["applicant"];?>" />
		</div>
		<div>
			Местонахождение заявителя:
			<input name="amest" id="amest" type="text" value="<?if(!empty($_REQUEST["amest"])) echo $_REQUEST["amest"];?>" />
		</div>
		<div>
			Фактический адрес заявителя:
			<input name="aaddress" id="aaddress" type="text" value="<?if(!empty($_REQUEST["aaddress"])) echo $_REQUEST["aaddress"];?>" />
		</div>
		<div>
			Изготовитель:
			<input name="manufacturer" id="manufacturer" type="text" value="<?if(!empty($_REQUEST["manufacturer"])) echo $_REQUEST["manufacturer"];?>" />
		</div>
		<div>
			Адрес изготовителя:
			<input name="maddress" id="maddress" type="text" value="<?if(!empty($_REQUEST["maddress"])) echo $_REQUEST["maddress"];?>" />
		</div>
		<div>
			Типовая схема:
			<select name="cc" id="cc">
				<option <?if($_REQUEST["cc"] == "1c") echo "selected";?> value="1c">1c</option>
				<option <?if($_REQUEST["cc"] == "2c") echo "selected";?> value="2c">2c</option>
				<option <?if($_REQUEST["cc"] == "3c") echo "selected";?> value="3c">3c</option>
			</select>
		</div>
		<div>
			Декларация принята на основании:
			<select name="ll" id="ll">
				<option <?if($_REQUEST["ll"] == "1l") echo "selected";?> value="1l">ГЕЛИОС</option>
				<option <?if($_REQUEST["ll"] == "2l") echo "selected";?> value="2l">Центр Испытаний и Сертификации АЛЬТЕРНАТИВА</option>
				<option <?if($_REQUEST["ll"] == "3l") echo "selected";?> value="3l">Государственный региональный центр стандартизации, метрологии и испытаний в Московской области</option>
				<option <?if($_REQUEST["ll"] == "4l") echo "selected";?> value="4l">ИЛ БТ</option>
				<option <?if($_REQUEST["ll"] == "5l") echo "selected";?> value="5l">Испытательная лаборатория электротехнической продукции ЭМС</option>
				<option <?if($_REQUEST["ll"] == "6l") echo "selected";?> value="6l">ТестИспытания</option>
				<option <?if($_REQUEST["ll"] == "7l") echo "selected";?> value="7l">Инвестиционная корпорация</option>
				<option <?if($_REQUEST["ll"] == "8l") echo "selected";?> value="8l">Испытательная лаборатория ручных и переносных электрических машин</option>
			</select>
		</div>
		<div>
			Наименование продукции:
			<input name="nomination" id="nomination" type="text" value="<?if(!empty($_REQUEST["nomination"])) echo $_REQUEST["nomination"];?>" />
		</div>
		<div>
			<select class="type-org"name="type" id="type">
				<option <?if($_REQUEST["type"] == "ОГРН") echo "selected";?> >ОГРН</option>
				<option <?if($_REQUEST["type"] == "БИН") echo "selected";?> >БИН</option>
				<option <?if($_REQUEST["type"] == "УНП") echo "selected";?> >УНП</option>
				<option <?if($_REQUEST["type"] == "ОГРНИП") echo "selected";?> >ОГРНИП</option>
			</select>
			<input name="ogrn" id="ogrn" type="text" value="<?if(!empty($_REQUEST["ogrn"])) echo $_REQUEST["ogrn"];?>" />
		</div>
		<div>
			Телефон:
			<input name="phone" id="phone" type="tel" value="<?if(!empty($_REQUEST["phone"])) echo $_REQUEST["phone"];?>" />
		</div>
		<div>
			Факс:
			<input name="fax" id="fax" type="text" value="<?if(!empty($_REQUEST["fax"])) echo $_REQUEST["fax"];?>" />
		</div>
		<div>
			Адрес электронной почты:
			<input name="email" id="email" type="email" value="<?if(!empty($_REQUEST["email"])) echo $_REQUEST["email"];?>" />
		</div>
		<div>
			Код ТН ВЭД:
			<input name="tnved" id="tnved" type="text" value="<?if(!empty($_REQUEST["tnved"])) echo $_REQUEST["tnved"];?>" />
		</div>
		<div>
			Технические регламенты:
			<select name="trts" id="trts">
				<option <?if($_REQUEST["trts"] == "1t") echo "selected";?> value="1t">О безопасности машин и оборудования</option>
				<option <?if($_REQUEST["trts"] == "2t") echo "selected";?> value="2t">О безопасности низковольтного оборудования</option>
				<option <?if($_REQUEST["trts"] == "3t") echo "selected";?> value="3t">Электромагнитная совместимость технических средств</option>
				<option <?if($_REQUEST["trts"] == "4t") echo "selected";?> value="4t">О безопасности игрушек</option>
				<option <?if($_REQUEST["trts"] == "5t") echo "selected";?> value="5t">О безопасности продукции, предназначенной для детей и подростков</option>
				<option <?if($_REQUEST["trts"] == "6t") echo "selected";?> value="6t">О безопасности продукции легкой промышленности</option>
				<option <?if($_REQUEST["trts"] == "7t") echo "selected";?> value="7t">О безопасности парфюмерно-косметической продукции</option>
				<option <?if($_REQUEST["trts"] == "8t") echo "selected";?> value="8t">О безопасности упаковки</option>
			</select>
		</div>
		<div>
			Приложение к макету сертификата:
			<select name="sert" id="sert">
				<option <?if($_REQUEST["sert"] == "1s") echo "selected";?> value="1s">Приложение по продукции</option>
				<option <?if($_REQUEST["sert"] == "2s") echo "selected";?> value="2s">Приложение по филиалам</option>
				<option <?if($_REQUEST["sert"] == "3s") echo "selected";?> value="3s">Приложение свободная форма</option>
			</select>
		</div>
	</div>
	<div class="inicials" style="display: inline-block;">
		<h3>Инициалы и фамилия:</h3>
		<div>
			Руководитель организации:
			<input name="ruk" id="ruk" type="text" value="<?if(!empty($_REQUEST["ruk"])) echo $_REQUEST["ruk"];?>" />
		</div>
		<div>
			Главный бухгалтер:
			<input name="buh" id="buh" type="text" value="<?if(!empty($_REQUEST["buh"])) echo $_REQUEST["buh"];?>" />
		</div>
		<div>
			Эксперт:
			<input name="ecsp" id="ecsp" type="text" value="<?if(!empty($_REQUEST["ecsp"])) echo $_REQUEST["ecsp"];?>" />
		</div>
		<div>
			Исполнитель:
			<input name="isp" id="isp" type="text" value="<?if(!empty($_REQUEST["isp"])) echo $_REQUEST["isp"];?>" />
		</div>
	</div>
	<br />
	<br />
	<br />
	<input class="btn" type="submit" name="af" id="af" value="Создать архив СС ТР ТС" >
	<input class="btn" type="submit" name="ms" id="ms" value="Создать макет СС ТР ТС" >
	<input class="btn" type="submit" name="ad" id="ad" value="Создать архив ДС ТР ТС" >
	<input class="btn" type="submit" name="md" id="md" value="Создать макет ДС ТР ТС" >
</form>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>