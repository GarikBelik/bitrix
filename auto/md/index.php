<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Макет декларации");

$arLabs = array(
	"c1" => "",
	"c2" => "",
	"c3" => ""
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

}
	
$file = 'md.doc';

$fullPath = '/home/bitrix/www/auto/md/';
$format = explode('.', $fullPath.$file);

if(!empty($_REQUEST)){
	Unoconv::convertToDOCX($fullPath.$file);
	exec('rm -f /tmp/md/zip/*');
	rename($fullPath.$file.'x', $format[0].'.zip');
	exec('unzip -o '.$format[0].'.zip -d /tmp/md/zip/'); 
	$template = file_get_contents('/tmp/md/zip/word/document.xml');

	//echo "<pre>";
	//print_r($template);
	//echo "<pre>";

	foreach($_REQUEST as $id => $name){
		$template = str_replace( 'xx'.$id.'xx', $name, $template);
	}

	$fp = fopen("/tmp/md/zip/word/document.xml", "w");
	// записываем в файл текст
	fwrite($fp, $template);
	// закрываем
	fclose($fp);
	chdir('/tmp/md/zip/');
	exec('zip -r '.$_REQUEST["file_name"].' ./*');
	//rename('/tmp/zip/'.$_REQUEST["name"].'.zip', '/tmp/zip/'.$_REQUEST["name"].'.docx');
	//copy('/tmp/zip/'.$_REQUEST["file_name"].'.zip',$fullPath.'file/'.$_REQUEST["file_name"].'.docx');
	copy('/tmp/md/zip/'.$_REQUEST["file_name"].'.zip',$fullPath.'file/'.$_REQUEST["file_name"].'.docx');
	Unoconv::convertToPdf($fullPath.'file/'.$_REQUEST["file_name"].'.docx');
	//Unoconv::convertToDOCX($fullPath.'file/'.$_REQUEST["file_name"].'.pdf');
	echo "Нажмите если скачивание не началось <a class='download' href='".$_SERVER['SCRIPT_URI']."file/".$_REQUEST["file_name"].".docx' download>Скачать ".$_REQUEST["file_name"].".docx</a> или <a class='download' href='".$_SERVER['SCRIPT_URI']."file/".$_REQUEST["file_name"].".pdf' download>Скачать ".$_REQUEST["file_name"].".pdf</a><br /><br />";
}
?>

<form action="" class="autoform">
	<div style="display: inline-block;">
		<div>
			Имя генерируемого файла:
			<input name="file_name" id="file_name" type="text" />
		</div>
		<div class="textarea">
			Заявитель:
			<textarea  name="applicant" id="applicant"></textarea>
		</div>
		<div class="textarea">
			ОГРН(БИН):
			<textarea  name="ogrn" id="ogrn"></textarea>
		</div>
		<div>
			Место нахождения:
			<input name="aaddress" id="aaddress" type="text" />
		</div>
		<div>
			Фактический адресс:
			<input name="maddress" id="maddress" type="text" />
		</div>
		<div>
			В лице:
			<input name="face" id="face" type="text" />
		</div>
		<div class="textarea">
			Заявляет что:
			<textarea  name="what" id="what"></textarea >
		</div>
		<div class="textarea">
			Изготовитель:
			<textarea  name="manufacturer" id="manufacturer"></textarea >
		</div>
		<div>
			Код ТН ВЭД ТС:
			<input name="tnved" id="tnved" type="text" />
		</div>
		<div class="textarea">
			Серийный выпуск:
			<textarea name="serial" id="serial"></textarea>
		</div>
		<div>
			Декларация принята на основании:
			<select name="cc" id="cc">
				<option value="c1">ГЕЛИОС</option>
				<option value="c2">Центр Испытаний и Сертификации АЛЬТЕРНАТИВА</option>
				<option value="c3">Государственный региональный центр стандартизации, метрологии и испытаний в Московской области</option>
				<option value="c3">ИЛ БТ</option>
				<option value="c3">Испытательная лаборатория электротехнической продукции ЭМС</option>
				<option value="c3">ТестИспытания</option>
				<option value="c3">Инвестиционная корпорация</option>
				<option value="c3">Испытательная лаборатория ручных и переносных электрических машин</option>
			</select>
		</div>
		<div class="textarea">
			Дополнительная информация:
			<textarea name="dopinfo" id="dopinfo"></textarea>
		</div>
	</div>
	<div class="inicials" style="display: inline-block;">
		Инициалы и Фамилия:
		<input name="inicials" id="inicials" type="text" />
	</div>
	<br />
	<br />
	<input class="btn" type="submit" name="gen-applicant" id="gen-applicant" value="Макет декларации" >
</form>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>