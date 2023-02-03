<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
function printHtml1($array, $next)
{
    if ($next == 2) {
        echo "<li class=\"menu__item\">
                    <a href=" . $array["LINK"] . " class=\"menu__name\">" . $array["TEXT"] . "</a>
                        <ul class=\"dropdown-menu\">
                            <li class=\"dropdown-menu__content\">
                                <div class=\"dropdown-menu__img\">
                                    <img src=\"/include/header-submenu-1.jpg\" alt=\"девочка\">
                                </div>
                                <div class=\"dropdown-menu__menu-col\">
                                    <ul class=\"vertical-menu\">";
    } elseif ($next == 1) {
        echo "<li class=\"menu__item\">
                        <a href=" . $array["LINK"] . " class=\"menu__name\">" . $array["TEXT"] . "</a>
                   </li>";
    }
}

function printHtml2($array, $next)
{
    if ($next == 1) {
        echo "<li class=\"vertical-menu__item\">
                        <a href=" . $array["LINK"] . " class=\"vertical-menu__name\">" . $array["TEXT"] . "</a>
              </li>
              </ul>
										</div>
									</li>
								</ul>
							</li>
              ";
    } elseif ($next == 2) {
        echo "<li class=\"vertical-menu__item\">
                        <a href=" . $array["LINK"] . " class=\"vertical-menu__name\">" . $array["TEXT"] . "</a>
                  </li>";
    } elseif ($next == 3) {
        echo "<li class=\"vertical-menu__item\">
                      <span class=\"vertical-menu__name\">" . $array["TEXT"] . "</span>
                           <ul class=\"vertical-menu__submenu\">";
    }
}

function printHtml3($array, $next) {
    if ($next == 1) {
        echo "<li class=\"vertical-menu__submenu-item\">
                    <a href=".$array["LINK"]." class=\"link vertical-menu__submenu-name\">".$array["TEXT"]."</a>
                  </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>";
    } elseif ($next == 2) {
        echo "<li class=\"vertical-menu__submenu-item\">
                    <a href=".$array["LINK"]." class=\"link vertical-menu__submenu-name\">".$array["TEXT"]."</a>
                  </li>
              </ul>
          </li>";
    } elseif ($next == 3) {
        echo "<li class=\"vertical-menu__submenu-item\">
                    <a href=".$array["LINK"]." class=\"link vertical-menu__submenu-name\">".$array["TEXT"]."</a>
                  </li>";
    }
}?>
<div class="header__bottom">
    <div class="container">
        <nav class="header__nav navigation">
            <ul class="header__menu menu menu_width_full">
    <?php
    $count = count($arResult);
    for ($i = 0;
         $i < $count;
         $i++) {
        if ($arResult[$i]["DEPTH_LEVEL"] == 1 && $arResult[$i + 1]["DEPTH_LEVEL"] == 2) {
            printHtml1($arResult[$i], 2);
        } elseif ($arResult[$i]["DEPTH_LEVEL"] == 1 && ($arResult[$i + 1]["DEPTH_LEVEL"] == 1 || $arResult[$i + 1] == null)) {
            printHtml1($arResult[$i], 1);
        } elseif ($arResult[$i]["DEPTH_LEVEL"] == 2 && ($arResult[$i + 1]["DEPTH_LEVEL"] == 1 || $arResult[$i + 1] == null)) {
            printHtml2($arResult[$i], 1);
        } elseif ($arResult[$i]["DEPTH_LEVEL"] == 2 && $arResult[$i + 1]["DEPTH_LEVEL"] == 2) {
            printHtml2($arResult[$i], 2);
        } elseif ($arResult[$i]["DEPTH_LEVEL"] == 2 && $arResult[$i + 1]["DEPTH_LEVEL"] == 3) {
            printHtml2($arResult[$i], 3);
        } elseif ($arResult[$i]["DEPTH_LEVEL"] == 3 && ($arResult[$i + 1]["DEPTH_LEVEL"] == 1 || $arResult[$i + 1] == null)) {
            printHtml3($arResult[$i], 1);
        } elseif ($arResult[$i]["DEPTH_LEVEL"] == 3 && $arResult[$i + 1]["DEPTH_LEVEL"] == 2) {
            printHtml3($arResult[$i], 2);
        } elseif ($arResult[$i]["DEPTH_LEVEL"] == 3 && $arResult[$i + 1]["DEPTH_LEVEL"] == 3) {
            printHtml3($arResult[$i], 3);
        }
    }
    ?>
            </ul>
        </nav>
    </div>
</div>