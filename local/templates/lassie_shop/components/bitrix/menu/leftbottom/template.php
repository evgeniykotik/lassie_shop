<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="list">
    <? foreach ($arResult as $arItem):?>
        <li class="list__item"><a href="<?= $arItem["LINK"] ?>" class="footer__text"><?= $arItem["TEXT"] ?></a>
    </li>
    <? endforeach ?>
</ul>
<?endif;?>
