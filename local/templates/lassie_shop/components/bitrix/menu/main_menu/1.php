<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
<ul class="header__menu menu menu_width_full">

    <?
    $previousLevel = 0;
    foreach ($arResult

    as $arItem): ?>

    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
        <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? endif ?>

    <? if ($arItem["IS_PARENT"]): ?>

    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
    <li class="menu__item"><a href="<?= $arItem["LINK"] ?>" class="menu__name"><?= $arItem["TEXT"] ?></a>
        <ul class="dropdown-menu">
            <li class="dropdown-menu__content">
                <div class="dropdown-menu__img">
                    <img src="" alt="девочка">
                </div>
                <div class="dropdown-menu__menu-col">
                    <ul class="vertical-menu"
            <? elseif ($arItem["DEPTH_LEVEL"] == 2): ?>
            <li class="vertical-menu__item"><span class="vertical-menu__name"><?= $arItem["TEXT"] ?></span>
                <ul class="vertical-menu__submenu">
                    <? endif ?>

                    <? else: ?>

                        <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                            <li class="menu__item"><a href="<?= $arItem["LINK"] ?>"
                                                      class="menu__name"><?= $arItem["TEXT"] ?></a>
                        <? elseif ($arItem["DEPTH_LEVEL"] == 2): ?>
                            <li class="vertical-menu__item"><a class="vertical-menu__name"><?= $arItem["TEXT"] ?></a>
                        <? elseif ($arItem["DEPTH_LEVEL"] == 3): ?>
                            <li class="vertical-menu__submenu-item"><a href="<?= $arItem["LINK"] ?>"
                                                                       class="link vertical-menu__submenu-name"><?= $arItem["TEXT"] ?></a>
                            </li>
                        <? endif ?>

                    <? endif ?>

                    <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                    <? endforeach ?>

                    <? if ($previousLevel > 1)://close last item tags?>
                        <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
                    <? endif ?>

                </ul>
                <? endif ?>
                <!--<li class="menu__item">
                    <a href=/catalog/kollektsii/ class="menu__name">Коллекции</a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__content">
                                <div class="dropdown-menu__img">
                                    <img src="include/header-submenu-1.jpg" alt="девочка">
                                </div>
                                <div class="dropdown-menu__menu-col">
                                    <ul class="vertical-menu"><li class="vertical-menu__item">
                      <span class="vertical-menu__name">Варежки</span>
                           <ul class="vertical-menu__submenu"><li class="vertical-menu__submenu-item">
                    <a href=/catalog/dlya_novorozhdennyh/ class="link vertical-menu__submenu-name">Для новорожденных</a>
                  </li>
              </ul>
          </li><li class="vertical-menu__item">
                        <a href=/catalog/gorlovina_i_sharfy/class="vertical-menu__name">Горловина и шарфы</a>
                  </li><li class="vertical-menu__item">
                        <a href=/catalog/noski/class="vertical-menu__name">Носки</a>
                  </li><li class="vertical-menu__item">
                      <span class="vertical-menu__name">Перчатки</span>
                           <ul class="vertical-menu__submenu"><li class="vertical-menu__submenu-item">
                    <a href=/catalog/zimnie/ class="link vertical-menu__submenu-name">Зимние</a>
                  </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>-->
