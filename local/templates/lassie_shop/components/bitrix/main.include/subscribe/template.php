<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>
<div class="header__col header__col_top-left"><span class="header__icon icon-mail"></span>
    <a href="https://www.youtube.com/channel/UCGBUT1sUy-98e7nIgw5K2-w" target="_blank" class="link">
        <? if ($arResult["FILE"] <> '')
            include($arResult["FILE"]); ?></a></div>
