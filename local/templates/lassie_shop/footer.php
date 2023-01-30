
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
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "leftbottom",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "bottom_left",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "ROOT_MENU_TYPE" => "bottom_left",
                    "USE_EXT" => "N"
                )
            );?>
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
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "leftbottom",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "bottom_center",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "ROOT_MENU_TYPE" => "bottom_center",
                    "USE_EXT" => "N"
                )
            );?>
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
            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "leftbottom",
                Array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "bottom_right",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "1",
                    "MENU_CACHE_GET_VARS" => array(""),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "N",
                    "ROOT_MENU_TYPE" => "bottom_right",
                    "USE_EXT" => "N"
                )
            );?>
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