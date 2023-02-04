<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);


$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => array(
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
        'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
        'JS_OFFERS' => $arResult['JS_OFFERS']
    )
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DESCRIPTION_ID' => $mainId . '_description',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers) {
    $actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
?>

    <main class="content product-page">
        <div class="container">
            <div class="card product-page__card">
                <div class="card__top">
                    <div class="card__photos gallery">
                        <div class="gallery__display">
                            <img src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" width="570" height="525" alt=""
                                 class="gallery__display-img">
                        </div>
                    </div>
                    <div class="card__info">
                        <header class="card__info-header">
                            <h1 class="card__name"><?= $arResult["NAME"] ?></h1>
                            <div class="card__id text"><?= $arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"] ?></div>
                        </header>
                        <div class="card__content-block">
                            <div class="card__content-row">
                                <div class="card__price card__price_new"
                                     id="<?= $itemIds['OLD_PRICE_ID'] ?>"><?= $arResult["ITEM_PRICES"][0]["BASE_PRICE"] ?></div>
                                <div class="card__price card__price_old"
                                     id="<?= $itemIds['PRICE_ID'] ?>"><?= $arResult["ITEM_PRICES"][0]["PRICE"] ?></div>
                            </div>
                            <div class="card__discount text" id="<?= $itemIds["DISCOUNT_PERCENT_ID"] ?>">
                                Скидка: <?= $arResult["ITEM_PRICES"][0]["DISCOUNT"] ?>
                            </div>
                        </div>
                        <div class="card__content-block">
                            <div class="card__subtitle text">Материал:</div>
                            <div class="text"><?= $arResult["PROPERTIES"]["MATERIAL"]["VALUE"][0] ?></div>
                        </div>
                        <form method="post" action="" class="form">
                            <div class="card__content-block card__content-block_margin_30">
                                <div class="card__subtitle text">Количество:</div>
                                <div class="card__content-row">
                                    <div class="card__number input-number">
                                        <input id="card-num" name="Card[number]" type="number" step="1" min="1" required
                                               class="input-number__elem">
                                        <div class="input-number__counter"><span
                                                    class="input-number__counter-spin input-number__counter-spin_more">Больше</span><span
                                                    class="input-number__counter-spin input-number__counter-spin_less">Меньше</span>
                                        </div>
                                    </div>
                                    <div class="card__avaible text">Есть в наличии</div>
                                </div>
                            </div>
                            <div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>"
                                 style="display: <?= ($actualItem['CAN_BUY'] ? '' : 'none') ?>;">
                                <button type="submit" id="<?= $itemIds['BUY_LINK'] ?>" data-popup="good"
                                        class="btn form__btn js-popup-open">Добавить в корзину
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card__tabs tabs">
                    <ul class="tabs__nav">
                        <li data-tab='1' class="tabs__nav-item tabs__nav-item_active"><a href="javascript:void(0);"
                                                                                         class="tabs__nav-link">Описание</a>
                        </li>
                        <li data-tab='2' class="tabs__nav-item"><a href="javascript:void(0);"
                                                                   class="tabs__nav-link">Состав</a>
                        </li>
                        <li data-tab='3' class="tabs__nav-item"><a href="javascript:void(0);"
                                                                   class="tabs__nav-link">Уход</a>
                        </li>
                        <li data-tab='4' class="tabs__nav-item"><a href="javascript:void(0);" class="tabs__nav-link">Отзывы
                                <span class="card__reviews-num"><?= $arResult["PROPERTIES"]["BLOG_COMMENTS_CNT"]['VALUE'] ?></span></a>
                        </li>
                    </ul>
                    <div class="tabs__content-wrapper">
                        <div data-tab='1' class="tabs__content tabs__content_active">
                            <?= $arResult["DETAIL_TEXT"] ?>
                        </div>
                        <div data-tab='2' class="tabs__content">
                            <ul class="list list_markers">
                                <? foreach ($arResult["DISPLAY_PROPERTIES"]["MATERIAL"]["VALUE"] as $value): ?>
                                    <li class="list__item list__item_marker_orange text"><?= $value
                                        ?></li>
                                <?
                                endforeach
                                ?>
                            </ul>
                        </div>
                        <div data-tab='3' class="tabs__content">
                            <p class="text"><?= $arResult["PROPERTIES"]["CARE"]["VALUE"]["TEXT"] ?></p>
                        </div>
                        <div data-tab='4' class="tabs__content">
                            <?
                            if ($arParams['USE_COMMENTS'] === 'Y') {
                                ?>

                                <?php
                                $componentCommentsParams = array(
                                    'ELEMENT_ID' => $arResult['ID'],
                                    'ELEMENT_CODE' => '',
                                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                    'SHOW_DEACTIVATED' => $arParams['SHOW_DEACTIVATED'],
                                    'URL_TO_COMMENT' => '',
                                    'WIDTH' => '',
                                    'COMMENTS_COUNT' => '5',
                                    'BLOG_USE' => $arParams['BLOG_USE'],
                                    'FB_USE' => $arParams['FB_USE'],
                                    'FB_APP_ID' => $arParams['FB_APP_ID'],
                                    'VK_USE' => $arParams['VK_USE'],
                                    'VK_API_ID' => $arParams['VK_API_ID'],
                                    'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                    'CACHE_TIME' => $arParams['CACHE_TIME'],
                                    'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                    'BLOG_TITLE' => '',
                                    'BLOG_URL' => $arParams['BLOG_URL'],
                                    'PATH_TO_SMILE' => '',
                                    'EMAIL_NOTIFY' => $arParams['BLOG_EMAIL_NOTIFY'],
                                    'AJAX_POST' => 'Y',
                                    'SHOW_SPAM' => 'Y',
                                    'SHOW_RATING' => 'N',
                                    'FB_TITLE' => '',
                                    'FB_USER_ADMIN_ID' => '',
                                    'FB_COLORSCHEME' => 'light',
                                    'FB_ORDER_BY' => 'reverse_time',
                                    'VK_TITLE' => '',
                                    'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME']
                                );
                                if (isset($arParams["USER_CONSENT"])) {
                                    $componentCommentsParams["USER_CONSENT"] = $arParams["USER_CONSENT"];
                                }
                                if (isset($arParams["USER_CONSENT_ID"])) {
                                    $componentCommentsParams["USER_CONSENT_ID"] = $arParams["USER_CONSENT_ID"];
                                }
                                if (isset($arParams["USER_CONSENT_IS_CHECKED"])) {
                                    $componentCommentsParams["USER_CONSENT_IS_CHECKED"] = $arParams["USER_CONSENT_IS_CHECKED"];
                                }
                                if (isset($arParams["USER_CONSENT_IS_LOADED"])) {
                                    $componentCommentsParams["USER_CONSENT_IS_LOADED"] = $arParams["USER_CONSENT_IS_LOADED"];
                                }
                                $APPLICATION->IncludeComponent('bitrix:catalog.comments', '', $componentCommentsParams,
                                    $component, array(
                                        'HIDE_ICONS' => 'Y'
                                    ));
                                ?>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<div class="bx-catalog-element bx-<?= $arParams['TEMPLATE_THEME'] ?>" id="<?= $itemIds['ID'] ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="product-item-detail-slider-container" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">
                    <span class="product-item-detail-slider-close" data-entity="close-popup"></span>
                    <div class="product-item-detail-slider-block
						<?= ($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '') ?>"
                         data-entity="images-slider-block">
                        <?php
                        ?>
                        <div class="product-item-detail-slider-images-container" data-entity="images-container">
                            <?php
                            foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                ?>
                                <div class="product-item-detail-slider-image<?= ($key == 0 ? ' active' : '') ?>"
                                     data-entity="image" data-id="<?= $photo['ID'] ?>">
                                    <img title="<?= $title ?>"<?= ($key == 0 ? ' itemprop="image"' : '') ?>>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="product-item-detail-info-section">
                            <?php
                            foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName) {
                                switch ($blockName) {
                                    case 'sku':
                                        if ($haveOffers && !empty($arResult['OFFERS_PROP'])) {
                                            ?>
                                            <div id="<?= $itemIds['TREE_ID'] ?>">
                                                <?php
                                                foreach ($arResult['SKU_PROPS'] as $skuProperty) {
                                                    if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
                                                        continue;

                                                    $propertyId = $skuProperty['ID'];
                                                    $skuProps[] = array(
                                                        'ID' => $propertyId,
                                                        'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                                        'VALUES' => $skuProperty['VALUES'],
                                                        'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                                                    );
                                                    ?>
                                                    <div class="product-item-detail-info-container"
                                                         data-entity="sku-line-block">
                                                        <div class="product-item-detail-info-container-title"><?= htmlspecialcharsEx($skuProperty['NAME']) ?></div>
                                                        <div class="product-item-scu-container">
                                                            <div class="product-item-scu-block">
                                                                <div class="product-item-scu-list">
                                                                    <ul class="product-item-scu-item-list">
                                                                        <?php
                                                                        foreach ($skuProperty['VALUES'] as &$value) {
                                                                            $value['NAME'] = htmlspecialcharsbx($value['NAME']);

                                                                            if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                                                                ?>
                                                                                <li class="product-item-scu-item-color-container"
                                                                                    title="<?= $value['NAME'] ?>"
                                                                                    data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                                                    data-onevalue="<?= $value['ID'] ?>">
                                                                                    <div class="product-item-scu-item-color-block">
                                                                                        <div class="product-item-scu-item-color"
                                                                                             title="<?= $value['NAME'] ?>"
                                                                                             style="background-image: url('<?= $value['PICT']['SRC'] ?>');">
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <li class="product-item-scu-item-text-container"
                                                                                    title="<?= $value['NAME'] ?>"
                                                                                    data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                                                    data-onevalue="<?= $value['ID'] ?>">
                                                                                    <div class="product-item-scu-item-text-block">
                                                                                        <div class="product-item-scu-item-text"><?= $value['NAME'] ?></div>
                                                                                    </div>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                    <div style="clear: both;"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }

                                        break;

                                    case 'props':
                                        if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                                            ?>
                                            <div class="product-item-detail-info-container">
                                                <?php
                                                if (!empty($arResult['DISPLAY_PROPERTIES'])) {
                                                    ?>
                                                    <dl class="product-item-detail-properties">
                                                        <?php
                                                        foreach ($arResult['DISPLAY_PROPERTIES'] as $property) {
                                                            if (isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']])) {
                                                                ?>
                                                                <dt><?= $property['NAME'] ?></dt>
                                                                <dd><?= (is_array($property['DISPLAY_VALUE'])
                                                                        ? implode(' / ', $property['DISPLAY_VALUE'])
                                                                        : $property['DISPLAY_VALUE']) ?>
                                                                </dd>
                                                                <?php
                                                            }
                                                        }
                                                        unset($property);
                                                        ?>
                                                    </dl>
                                                    <?php
                                                }

                                                if ($arResult['SHOW_OFFERS_PROPS']) {
                                                    ?>
                                                    <dl class="product-item-detail-properties"
                                                        id="<?= $itemIds['DISPLAY_MAIN_PROP_DIV'] ?>"></dl>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }

                                        break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="product-item-detail-pay-block">
                            <?php
                            foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName) {
                                switch ($blockName) {
                                    case 'rating':
                                        if ($arParams['USE_VOTE_RATING'] === 'Y') {
                                            ?>
                                            <?php
                                        }

                                        break;

                                    case 'price':
                                        ?>
                                        <?php
                                        break;

                                    case 'priceRanges':
                                        if ($arParams['USE_PRICE_COUNT']) {
                                            $showRanges = !$haveOffers && count($actualItem['ITEM_QUANTITY_RANGES']) > 1;
                                            $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';
                                            ?>
                                            <div class="product-item-detail-info-container"
                                                <?= $showRanges ? '' : 'style="display: none;"' ?>
                                                 data-entity="price-ranges-block">
                                                <div class="product-item-detail-info-container-title">
                                                    <?= $arParams['MESS_PRICE_RANGES_TITLE'] ?>
                                                    <span data-entity="price-ranges-ratio-header">
														(<?= (Loc::getMessage(
                                                            'CT_BCE_CATALOG_RATIO_PRICE',
                                                            array('#RATIO#' => ($useRatio ? $measureRatio : '1') . ' ' . $actualItem['ITEM_MEASURE']['TITLE'])
                                                        )) ?>)
													</span>
                                                </div>
                                                <dl class="product-item-detail-properties"
                                                    data-entity="price-ranges-body">
                                                    <?php
                                                    if ($showRanges) {
                                                        foreach ($actualItem['ITEM_QUANTITY_RANGES'] as $range) {
                                                            if ($range['HASH'] !== 'ZERO-INF') {
                                                                $itemPrice = false;

                                                                foreach ($arResult['ITEM_PRICES'] as $itemPrice) {
                                                                    if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
                                                                        break;
                                                                    }
                                                                }

                                                                if ($itemPrice) {
                                                                    ?>
                                                                    <dt>
                                                                        <?php
                                                                        echo Loc::getMessage(
                                                                                'CT_BCE_CATALOG_RANGE_FROM',
                                                                                array('#FROM#' => $range['SORT_FROM'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'])
                                                                            ) . ' ';

                                                                        if (is_infinite($range['SORT_TO'])) {
                                                                            echo Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                                                                        } else {
                                                                            echo Loc::getMessage(
                                                                                'CT_BCE_CATALOG_RANGE_TO',
                                                                                array('#TO#' => $range['SORT_TO'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'])
                                                                            );
                                                                        }
                                                                        ?>
                                                                    </dt>
                                                                    <dd><?= ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) ?></dd>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </dl>
                                            </div>
                                            <?php
                                            unset($showRanges, $useRatio, $itemPrice, $range);
                                        }

                                        break;

                                    case 'quantityLimit':
                                        if ($arParams['SHOW_MAX_QUANTITY'] !== 'N') {
                                            if ($haveOffers) {
                                                ?>
                                                <div class="product-item-detail-info-container"
                                                     id="<?= $itemIds['QUANTITY_LIMIT'] ?>" style="display: none;">
                                                    <div class="product-item-detail-info-container-title">
                                                        <?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:
                                                        <span class="product-item-quantity"
                                                              data-entity="quantity-limit-value"></span>
                                                    </div>
                                                </div>
                                                <?php
                                            } else {
                                                if (
                                                    $measureRatio
                                                    && (float)$actualItem['PRODUCT']['QUANTITY'] > 0
                                                    && $actualItem['CHECK_QUANTITY']
                                                ) {
                                                    ?>
                                                    <div class="product-item-detail-info-container"
                                                         id="<?= $itemIds['QUANTITY_LIMIT'] ?>">
                                                        <div class="product-item-detail-info-container-title">
                                                            <?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:
                                                            <span class="product-item-quantity"
                                                                  data-entity="quantity-limit-value">
																<?php
                                                                if ($arParams['SHOW_MAX_QUANTITY'] === 'M') {
                                                                    if ((float)$actualItem['PRODUCT']['QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR']) {
                                                                        echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
                                                                    } else {
                                                                        echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
                                                                    }
                                                                } else {
                                                                    echo $actualItem['PRODUCT']['QUANTITY'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'];
                                                                }
                                                                ?>
															</span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        }

                                        break;

                                    case 'quantity':
                                        if ($arParams['USE_PRODUCT_QUANTITY']) {
                                            ?>
                                            <div class="product-item-detail-info-container"
                                                 style="<?= (!$actualItem['CAN_BUY'] ? 'display: none;' : '') ?>"
                                                 data-entity="quantity-block">
                                                <div class="product-item-detail-info-container-title"></div>
                                                <div class="product-item-amount">
                                                    <div class="product-item-amount-field-container" style="display: none">
                                                            <span class="product-item-amount-field-btn-minus no-select"
                                                                  id="<?= $itemIds['QUANTITY_DOWN_ID'] ?>"></span>
                                                        <input class="product-item-amount-field"
                                                               id="<?= $itemIds['QUANTITY_ID'] ?>" >                                                              value="<?= $price['MIN_QUANTITY'] ?>">
                                                        <span class="product-item-amount-field-btn-plus no-select"
                                                              id="<?= $itemIds['QUANTITY_UP_ID'] ?>"></span>
                                                        <span class="product-item-amount-description-container">
															<span id="<?= $itemIds['QUANTITY_MEASURE'] ?>">
																<?= $actualItem['ITEM_MEASURE']['TITLE'] ?>
															</span>
															<span id="<?= $itemIds['PRICE_TOTAL'] ?>"></span>
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }

                                        break;

                                    case 'buttons':
                                        ?>
                                        <div data-entity="main-button-container">
                                            <div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>">
                                                <?php
                                                if ($showAddBtn) {
                                                    ?>
                                                    <div class="product-item-detail-info-container">
                                                        <a id="<?= $itemIds['ADD_BASKET_LINK'] ?>"
                                                           href="javascript:void(0);">
                                                        </a>
                                                    </div>
                                                    <?php
                                                }

                                                if ($showBuyBtn) {
                                                    ?>
                                                    <div class="product-item-detail-info-container">
                                                        <a id="<?= $itemIds['BUY_LINK'] ?>"
                                                           href="javascript:void(0);">
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div>
                                                <a
                                                        id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>"
                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                        break;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <?php
                if ($haveOffers) {
                    if ($arResult['OFFER_GROUP']) {
                        foreach ($arResult['OFFER_GROUP_VALUES'] as $offerId) {
                            ?>
                            <span id="<?= $itemIds['OFFER_GROUP'] . $offerId ?>" style="display: none;">
								<?php
                                $APPLICATION->IncludeComponent(
                                    'bitrix:catalog.set.constructor',
                                    '.default',
                                    array(
                                        'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
                                        'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
                                        'ELEMENT_ID' => $offerId,
                                        'PRICE_CODE' => $arParams['PRICE_CODE'],
                                        'BASKET_URL' => $arParams['BASKET_URL'],
                                        'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                                        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                        'CACHE_TIME' => $arParams['CACHE_TIME'],
                                        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                        'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                        'CURRENCY_ID' => $arParams['CURRENCY_ID']
                                    ),
                                    $component,
                                    array('HIDE_ICONS' => 'Y')
                                );
                                ?>
							</span>
                            <?php
                        }
                    }
                } else {
                    if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP']) {
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.set.constructor',
                            '.default',
                            array(
                                'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
                                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                'ELEMENT_ID' => $arResult['ID'],
                                'PRICE_CODE' => $arParams['PRICE_CODE'],
                                'BASKET_URL' => $arParams['BASKET_URL'],
                                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                'CACHE_TIME' => $arParams['CACHE_TIME'],
                                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID']
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!--Small Card-->
    <?php
    if ($haveOffers) {
        $offerIds = array();
        $offerCodes = array();

        $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

        foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
            $offerIds[] = (int)$jsOffer['ID'];
            $offerCodes[] = $jsOffer['CODE'];

            $fullOffer = $arResult['OFFERS'][$ind];
            $measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

            $strAllProps = '';
            $strMainProps = '';
            $strPriceRangesRatio = '';
            $strPriceRanges = '';

            if ($arResult['SHOW_OFFERS_PROPS']) {
                if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                    foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
                        $current = '<dt>' . $property['NAME'] . '</dt><dd>' . (
                            is_array($property['VALUE'])
                                ? implode(' / ', $property['VALUE'])
                                : $property['VALUE']
                            ) . '</dd>';
                        $strAllProps .= $current;

                        if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
                            $strMainProps .= $current;
                        }
                    }

                    unset($current);
                }
            }

            if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
                $strPriceRangesRatio = '(' . Loc::getMessage(
                        'CT_BCE_CATALOG_RATIO_PRICE',
                        array('#RATIO#' => ($useRatio
                                ? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
                                : '1'
                            ) . ' ' . $measureName)
                    ) . ')';

                foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
                    if ($range['HASH'] !== 'ZERO-INF') {
                        $itemPrice = false;

                        foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
                            if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
                                break;
                            }
                        }

                        if ($itemPrice) {
                            $strPriceRanges .= '<dt>' . Loc::getMessage(
                                    'CT_BCE_CATALOG_RANGE_FROM',
                                    array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
                                ) . ' ';

                            if (is_infinite($range['SORT_TO'])) {
                                $strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                            } else {
                                $strPriceRanges .= Loc::getMessage(
                                    'CT_BCE_CATALOG_RANGE_TO',
                                    array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
                                );
                            }

                            $strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
                        }
                    }
                }

                unset($range, $itemPrice);
            }

            $jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
            $jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
            $jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
            $jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
        }

        $templateData['OFFER_IDS'] = $offerIds;
        $templateData['OFFER_CODES'] = $offerCodes;
        unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

        $jsParams = array(
            'CONFIG' => array(
                'USE_CATALOG' => $arResult['CATALOG'],
                'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                'SHOW_PRICE' => true,
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
                'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
                'OFFER_GROUP' => $arResult['OFFER_GROUP'],
                'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
                'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
                'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
                'USE_STICKERS' => true,
                'USE_SUBSCRIBE' => $showSubscribe,
                'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
                'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
                'ALT' => $alt,
                'TITLE' => $title,
                'MAGNIFIER_ZOOM_PERCENT' => 200,
                'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
                'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
                'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                    ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                    : null,
                'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
                'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
            ),
            'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
            'VISUAL' => $itemIds,
            'DEFAULT_PICTURE' => array(
                'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
                'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
            ),
            'PRODUCT' => array(
                'ID' => $arResult['ID'],
                'ACTIVE' => $arResult['ACTIVE'],
                'NAME' => $arResult['~NAME'],
                'CATEGORY' => $arResult['CATEGORY_PATH'],
                'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
                'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
                'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
                'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
            ),
            'BASKET' => array(
                'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                'BASKET_URL' => $arParams['BASKET_URL'],
                'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
                'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
            ),
            'OFFERS' => $arResult['JS_OFFERS'],
            'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
            'TREE_PROPS' => $skuProps
        );
    } else {
        $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
        if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
            ?>
            <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
                <?php
                if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                    foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
                        ?>
                        <input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                               value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                        <?php
                        unset($arResult['PRODUCT_PROPERTIES'][$propId]);
                    }
                }

                $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
                if (!$emptyProductProperties) {
                    ?>
                    <table>
                        <?php
                        foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
                            ?>
                            <tr>
                                <td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
                                <td>
                                    <?php
                                    if (
                                        $arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
                                        && $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
                                    ) {
                                        foreach ($propInfo['VALUES'] as $valueId => $value) {
                                            ?>
                                            <label>
                                                <input type="radio"
                                                       name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                                                       value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
                                                <?= $value ?>
                                            </label>
                                            <br>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
                                            <?php
                                            foreach ($propInfo['VALUES'] as $valueId => $value) {
                                                ?>
                                                <option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
                                                    <?= $value ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                }
                ?>
            </div>
            <?php
        }

        $jsParams = array(
            'CONFIG' => array(
                'USE_CATALOG' => $arResult['CATALOG'],
                'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
                'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
                'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
                'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
                'USE_STICKERS' => true,
                'USE_SUBSCRIBE' => $showSubscribe,
                'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
                'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
                'ALT' => $alt,
                'TITLE' => $title,
                'MAGNIFIER_ZOOM_PERCENT' => 200,
                'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
                'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
                'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                    ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                    : null
            ),
            'VISUAL' => $itemIds,
            'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
            'PRODUCT' => array(
                'ID' => $arResult['ID'],
                'ACTIVE' => $arResult['ACTIVE'],
                'PICT' => reset($arResult['MORE_PHOTO']),
                'NAME' => $arResult['~NAME'],
                'SUBSCRIPTION' => true,
                'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
                'ITEM_PRICES' => $arResult['ITEM_PRICES'],
                'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
                'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
                'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
                'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
                'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
                'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
                'SLIDER' => $arResult['MORE_PHOTO'],
                'CAN_BUY' => $arResult['CAN_BUY'],
                'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
                'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
                'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
                'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
                'CATEGORY' => $arResult['CATEGORY_PATH']
            ),
            'BASKET' => array(
                'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
                'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                'EMPTY_PROPS' => $emptyProductProperties,
                'BASKET_URL' => $arParams['BASKET_URL'],
                'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
            )
        );
        unset($emptyProductProperties);
    }

    if ($arParams['DISPLAY_COMPARE']) {
        $jsParams['COMPARE'] = array(
            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
            'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
            'COMPARE_PATH' => $arParams['COMPARE_PATH']
        );
    }

    $jsParams["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"] =
        $arResult["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"];

    ?>
    <script>
        BX.message({
            ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
            TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
            TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
            BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
            BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
            BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
            BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
            BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
            TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
            COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
            COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
            COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
            PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
            PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
            RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
            RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
            SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
        });

        var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
    </script>
<?php
unset($actualItem, $itemIds, $jsParams);
