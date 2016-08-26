<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Типовые схемы");
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

}
if(!empty($_REQUEST["gen-sertification"])){
	$file = 'sertform.doc';
}else{
	$file = 'newform.doc';
}

$fullPath = '/home/bitrix/www/crm/auto-form/';
$format = explode('.', $fullPath.$file);

if(!empty($_REQUEST)){
	//Unoconv::convertToDOCX($fullPath.$file);
	exec('rm -f /tmp/ms/zip/*');
	//rename($fullPath.$file.'x', $format[0].'.zip');
	exec('unzip -o '.$format[0].'.zip -d /tmp/ms/zip/'); 
	$template = file_get_contents('/tmp/ms/zip/word/document.xml');

	//echo "<pre>";
	//print_r($template);
	//echo "<pre>";

	foreach($_REQUEST as $id => $name){
		$template = str_replace( 'xx'.$id.'xx', $name, $template);
	}

	$fp = fopen("/tmp/ms/zip/word/document.xml", "w");
	// записываем в файл текст
	fwrite($fp, $template);
	// закрываем
	fclose($fp);
	chdir('/tmp/ms/zip/');
	exec('zip -r '.$_REQUEST["file_name"].' ./*');
	//rename('/tmp/zip/'.$_REQUEST["name"].'.zip', '/tmp/zip/'.$_REQUEST["name"].'.docx');
	//copy('/tmp/zip/'.$_REQUEST["file_name"].'.zip',$fullPath.'file/'.$_REQUEST["file_name"].'.docx');
	copy('/tmp/ms/zip/'.$_REQUEST["file_name"].'.zip',$fullPath.'file/'.$_REQUEST["file_name"].'.docx');
	Unoconv::convertToPdf($fullPath.'file/'.$_REQUEST["file_name"].'.docx');
	//Unoconv::convertToDOCX($fullPath.'file/'.$_REQUEST["file_name"].'.pdf');
	echo "Нажмите если скачивание не началось <a class='download' href='".$_SERVER['SCRIPT_URI']."file/".$_REQUEST["file_name"].".docx' download>Скачать ".$_REQUEST["file_name"].".docx</a> или <a class='download' href='".$_SERVER['SCRIPT_URI']."file/".$_REQUEST["file_name"].".pdf' download>Скачать ".$_REQUEST["file_name"].".pdf</a><br /><br />";
}
?>

<form action="" class="autoform">
	<div>
		Имя генерируемого файла:
		<input name="file_name" id="file_name" type="text" />
	</div>
	<div>
		Заявитель:
		<input name="applicant" id="applicant" type="text" />
	</div>
	<div>
		Адрес заявителя:
		<input name="aaddress" id="aaddress" type="text" />
	</div>
	<div>
		Изготовитель:
		<input name="manufacturer" id="manufacturer" type="text" />
	</div>
	<div>
		Адрес изготовителя:
		<input name="maddress" id="maddress" type="text" />
	</div>
	<div>
		Наименование продукции:
		<input name="nomination" id="nomination" type="text" />
	</div>
	<div>
		ОГРН(БИН):
		<input name="ogrn" id="ogrn" type="text" />
	</div>
	<div>
		Телефон:
		<input name="phone" id="phone" type="tel" />
	</div>
	<div>
		Факс:
		<input name="fax" id="fax" type="text" />
	</div>
	<div>
		Адрес электронной почты:
		<input name="email" id="email" type="email" />
	</div>
	<div>
		Код ТН ВЭД:
		<input name="tnved" id="tnved" type="text" />
	</div>
	<div>
		Технические регламенты:
		<input name="trts" id="trts" type="text" />
	</div>
	<input class="btn" type="submit" name="gen-applicant" id="gen-applicant" value="Генерировать Заявку" >
	<input class="btn" type="submit" name="gen-sertification" id="gen-sertification" value="Генерировать Сертификат" >
</form>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>