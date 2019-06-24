<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.10.2016
 * Time: 15:33
 */
?>
<?php if (Yii::$app->request->getUserIP() != '127.0.0.1'): ?>
    <!— Yandex.Metrika counter —>
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(53307079, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/53307079" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!— /Yandex.Metrika counter —>

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-85668241-1', 'auto');
        ga('send', 'pageview');

    </script>
<!--    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>-->
<!--    <script>-->
<!--        (adsbygoogle = window.adsbygoogle || []).push({-->
<!--            google_ad_client: "ca-pub-5402379949049940",-->
<!--            enable_page_level_ads: true-->
<!--        });-->
<!--    </script>-->

    <script type='text/javascript'>
        (function () {
            window['yandexChatWidgetCallback'] = function () {
                try {
                    window.yandexChatWidget = new Ya.ChatWidget({
                        guid: '4d63921d-9970-4c04-81d2-1989cb0236cc',
                        buttonText: 'Ответим на ваши вопросы!',
                        title: 'Помощник DaInfoPro',
                        theme: 'dark',
                        collapsedDesktop: 'never',
                        collapsedTouch: 'always'
                    });
                } catch (e) {
                }
            };
            var n = document.getElementsByTagName('script')[0],
                s = document.createElement('script');
            s.async = true;
            s.src = 'https://chat.s3.yandex.net/widget.js';
            n.parentNode.insertBefore(s, n);
        })();
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-7346523585639786",
            enable_page_level_ads: true
        });
    </script>

<?php endif; ?>