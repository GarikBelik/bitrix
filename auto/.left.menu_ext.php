<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

	$arMenuCrm = Array();
	
	$arMenuCrm[] = Array(
		"Макеты и Архивы",
		"/auto/af/",
		Array(),
		Array(),
		""
	);
	$arMenuCrm[] = Array(
		"Файлы СоюзТест",
		"/auto/history/",
		Array(),
		Array(),
		""
	);
	$arMenuCrm[] = Array(
		"Файлы МилТест",
		"/auto/mhistory/",
		Array(),
		Array(),
		""
	);
/*	$arMenuCrm[] = Array(
		"Макет декларации",
		"/auto/md/",
		Array(),
		Array(),
		""
	);
	$arMenuCrm[] = Array(
		"Макет сертификата",
		"/auto/ms/",
		Array(),
		Array(),
		""
	);
/*$arMenuCrm[] = Array(
		"Типовые схемы",
		"/auto/ts/",
		Array(),
		Array(),
		""
);*/

	$aMenuLinks = array_merge($arMenuCrm, $aMenuLinks);

?>