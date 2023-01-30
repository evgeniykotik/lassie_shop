<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Забыли Ваш пароль?");
$APPLICATION->IncludeComponent(
	"bitrix:main.auth.changepasswd",
	"",
Array()
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>