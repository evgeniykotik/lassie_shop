<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Забыли Ваш пароль?");?>
	<h1 class="heading"><span class="heading__text"><? $APPLICATION->ShowTitle(); ?></span></h1>
<?php
$APPLICATION->IncludeComponent(
	"bitrix:main.auth.changepasswd", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"AUTH_AUTH_URL" => "/voyti-v-lichnyy-kabinet/",
		"AUTH_REGISTER_URL" => "/zaregistrirovatsya/"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>