<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="imagetoolbar" content="no">
    <meta name="msthemecompatible" content="no">
    <meta name="cleartype" content="on">
    <meta name="HandheldFriendly" content="True">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="google" value="notranslate">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="application-name" content="">
    <meta name="msapplication-tooltip" content="">
    <title><?php $APPLICATION->ShowTitle() ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&amp;subset=latin,cyrillic" rel="stylesheet">
    <link href="assets/css/app.min.css" rel="stylesheet">
    <?php $APPLICATION->ShowHead(); ?>
</head>

<body>
<?php $APPLICATION->ShowPanel(); ?>
<header class="header">
    <div class="header__top">
        <div class="container header__container header__container_top">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "subscribe",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/subscribe.php"),
                false
            );?>
            <div class="header__col header__col_top-right">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "topmenu",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "top",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "N",
                        "ROOT_MENU_TYPE" => "top",
                        "USE_EXT" => "N"
                    )
                );?>
                <? $APPLICATION->IncludeComponent("bitrix:search.title", "search", array(
                        "SHOW_INPUT" => "Y",
                        "INPUT_ID" => "title-search-input",
                        "CONTAINER_ID" => "title-search",
                        "PRICE_CODE" => array("BASE", "RETAIL"),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "150",
                        "SHOW_PREVIEW" => "Y",
                        "PREVIEW_WIDTH" => "75",
                        "PREVIEW_HEIGHT" => "75",
                        "CONVERT_CURRENCY" => "Y",
                        "CURRENCY_ID" => "RUB",
                        "PAGE" => "#SITE_DIR#search/index.php",
                        "NUM_CATEGORIES" => "3",
                        "TOP_COUNT" => "10",
                        "ORDER" => "date",
                        "USE_LANGUAGE_GUESS" => "Y",
                        "CHECK_DATES" => "Y",
                        "SHOW_OTHERS" => "Y",
                        "CATEGORY_0_TITLE" => "Новости",
                        "CATEGORY_0" => array("iblock_news"),
                        "CATEGORY_0_iblock_news" => array("all"),
                        "CATEGORY_1_TITLE" => "Форумы",
                        "CATEGORY_1" => array("forum"),
                        "CATEGORY_1_forum" => array("all"),
                        "CATEGORY_2_TITLE" => "Каталоги",
                        "CATEGORY_2" => array("iblock_books"),
                        "CATEGORY_2_iblock_books" => "all",
                        "CATEGORY_OTHERS_TITLE" => "Прочее"
                    )
                ); ?>
            </div>
        </div>
    </div>
    <div class="header__middle">
        <div class="container header__container header__container_middle">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "logo",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/company_logo.php"),
                false
            );?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/contacts.php"),
                false
            );?>
            <? $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"basket", 
	array(
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => "zaregistrirovatsya/",
		"PATH_TO_PROFILE" => "personal/",
		"COMPONENT_TEMPLATE" => "basket",
		"PATH_TO_ORDER" => "personal/order/make/",
		"SHOW_EMPTY_VALUES" => "Y",
		"PATH_TO_AUTHORIZE" => "voyti-v-lichnyy-kabinet/",
		"SHOW_REGISTRATION" => "N",
		"HIDE_ON_BASKET_PAGES" => "N"
	),
	false
); ?>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bootstrap_v4", 
	array(
		"ROOT_MENU_TYPE" => "main",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "36000000",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_THEME" => "blue",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "main",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "bootstrap_v4"
	),
	false
);?>
    <div class="header__bottom">
        <div class="container">
            <nav class="header__nav navigation">
                <ul class="header__menu menu menu_width_full">
                    <li class="menu__item"><a href="#" class="menu__name">Коллекции</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Верхняя одежда</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Игра слоями</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Для прогулки и спорта</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Сумки и
                                                рюкзаки</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Солнцезащитные
                                                очки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Головные уборы</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка-шлем</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка-бини</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Повязка
                                                        на голову</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Вязаные
                                                        шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапки
                                                        с козырьком</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Непромокаемые
                                                        шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка
                                                        на завязках</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка
                                                        с помпоном </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Летняя одежда</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Обувь</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Аксессуары</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Сумки и
                                                рюкзаки</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Солнцезащитные
                                                очки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Головные уборы</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка-шлем</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка-бини</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Повязка
                                                        на голову</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Вязаные
                                                        шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапки
                                                        с козырьком</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Непромокаемые
                                                        шапки</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка
                                                        на завязках</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Шапка
                                                        с помпоном </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="menu__item"><a href="javascript:void(0);" class="menu__name">Для новорожденных</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="header menu__item"><a href="javascript:void(0);" class="header__sale-wrapper menu__name"><span
                                    class="header__sale">Распродажа</span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="assets/images/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu">
                                        <li class="vertical-menu__item"><span class="vertical-menu__name">Варежки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Для
                                                        новорождённых</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Горловина и
                                                шарфы</a>
                                        </li>
                                        <li class="vertical-menu__item"><a href="javascript:void(0);"
                                                                           class="vertical-menu__name">Носки</a>
                                        </li>
                                        <li class="vertical-menu__item"><span
                                                    class="vertical-menu__name">Перчатки</span>
                                            <ul class="vertical-menu__submenu">
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Демисезонные</a>
                                                </li>
                                                <li class="vertical-menu__submenu-item"><a href="javascript:void(0);"
                                                                                           class="link vertical-menu__submenu-name">Зимние</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <button class="burger-btn header__nav-btn js-nav-btn"><span
                            class="burger-btn__switch">Развернуть меню </span>
                </button>
                <div class="navigation__collapse">
                    <ul class="navigation__collapse-menu vertical-menu">
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Распродажа</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Для
                                новорожденных</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Аксессуары</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Обувь</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Летняя
                                одежда</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Для
                                прогулки и спорта</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Игра
                                слоями</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Верхняя
                                одежда</a>
                        </li>
                        <li class="navigation__collapse-item vertical-menu__item"><a href="javascript:void(0);"
                                                                                     class="vertical-menu__name">Коллекции</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<main class="content index">
<?
if ($APPLICATION->GetCurPage() == '/'):
?>
    <?php $APPLICATION->IncludeComponent("bitrix:news.list", "slider", array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
        "AJAX_MODE" => "N",    // Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
        "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
        "CACHE_GROUPS" => "Y",    // Учитывать права доступа
        "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
        "CACHE_TYPE" => "A",    // Тип кеширования
        "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
        "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
        "DISPLAY_DATE" => "N",    // Выводить дату элемента
        "DISPLAY_NAME" => "Y",    // Выводить название элемента
        "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
        "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
        "FIELD_CODE" => array(    // Поля
            0 => "",
            1 => "",
        ),
        "FILTER_NAME" => "",    // Фильтр
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
        "IBLOCK_ID" => "4",    // Код информационного блока
        "IBLOCK_TYPE" => "other",    // Тип информационного блока (используется только для проверки)
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
        "INCLUDE_SUBSECTIONS" => "N",    // Показывать элементы подразделов раздела
        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
        "NEWS_COUNT" => "10",    // Количество новостей на странице
        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
        "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
        "PAGER_TITLE" => "Новости",    // Название категорий
        "PARENT_SECTION" => "",    // ID раздела
        "PARENT_SECTION_CODE" => "",    // Код раздела
        "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
        "PROPERTY_CODE" => array(    // Свойства
            0 => "",
            1 => "",
        ),
        "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
        "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
        "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
        "SET_STATUS_404" => "N",    // Устанавливать статус 404
        "SET_TITLE" => "N",    // Устанавливать заголовок страницы
        "SHOW_404" => "N",    // Показ специальной страницы
        "SORT_BY1" => "SORT",    // Поле для первой сортировки новостей
        "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
        "SORT_ORDER1" => "ASC",    // Направление для первой сортировки новостей
        "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
        "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
    ),
        false
    ); ?>
    <section class="popular">
        <div class="container">
            <h1 class="heading"><span class="heading__text">Популярные товары</span></h1>
            <? endif; ?>
