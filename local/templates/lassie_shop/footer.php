
<footer class="footer">
    <div class="container footer__container">
        <div class="footer__col">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/purchase.php"),
                false
            );?>
            <ul class="list">
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Как купить</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Пользовательское соглашение</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Контакты</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Способы оплаты заказа</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Доставка</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Возврат товара</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Таблица размеров</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Часто задаваемые вопросы</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Как правильно одевать ребенка</a>
                </li>
            </ul>
        </div>
        <div class="footer__col">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/lassie.php"),
                false
            );?>
            <ul class="list">
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">О компании lassie</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">История</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Качество</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Уход за вещами</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Категории Lassie<sup>®</sup></a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Символы Lassie<sup>®</sup></a>
                </li>
            </ul>
        </div>
        <div class="footer__col">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR."include/lassieclub.php"),
                false
            );?>
            <ul class="list">
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Зарегистрироваться</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Войти в личный кабинет</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Забыли Ваш пароль?</a>
                </li>
                <li class="list__item"><a href="javascript:void(0);" class="footer__text">Защита персональной информации</a>
                </li>
            </ul>
        </div>
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_DIR."include/socialmedia.php"),
            false
        );?>
    </div>
    <?$APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        array(
            "AREA_FILE_SHOW" => "file",
            "PATH" => SITE_DIR."include/footer_bottom.php"),
        false
    );?>
</footer>
<script src="assets/js/app.min.js"></script>
</body>

</html>