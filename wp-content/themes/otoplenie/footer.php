	<div id="footer">
      <div id="infooter">
		        <div class="left-col">
			       <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" alt="Отопление дома" title="Отопление дома" height="55" />
			       <p>Отопление дома - это просто</p>    
                  <p>© «Otoplenie-Doma.org», <?= date ('Y');?></p>
		        </div>
		        <!--noindex-->
                <div class="left-col2">
                <p>© <?= date ('Y');?> Копирование материалов возможно только с указанием активной, не закрытой от индексации ссылки, на источник.</p>
                <?php if( is_front_page() ){?>
                     <ul>
                        <li><a href="/reklama-na-sajte" title="Реклама на сайте">Рекламодателям</a></li>
                        <li><a href="/kontakty" title="Контакты">Контакты</a></li>
                        <!--<li><a href="#" title="Каталог организаций">Каталог организаций</a></li>-->                         
                    </ul>
                
                <?php } else { ?>
                     <div id="footer-links"></div>
                    
                <?php } ?>
                   <?php
                   if ($_SERVER['REQUEST_URI'] != '/karta-sajta-otoplenie-doma-org') {
                     ?>
                     <ul>
                        <li><a href="/karta-sajta-otoplenie-doma-org" title="Карта сайта">Карта сайта</a></li>
                   </ul>
                   <?php  
                   }    
                   ?>
                 
		        </div>
                <!--/noindex-->
		        <div class="right-col">
                  <!-- begin of Top100 code -->

                    <script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?4435349"></script>
                    <noscript>
                    <a href="http://top100.rambler.ru/navi/4435349/">
                    <img src="http://counter.rambler.ru/top100.cnt?4435349" alt="Rambler's Top100" border="0" />
                    </a>

                    </noscript>
                  <!-- end of Top100 code -->
             </div>   
		        
               
		        <hr class="clear" />
        <div id="metrika">
            <!-- Yandex.Metrika counter -->
            <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter24704465 = new Ya.Metrika({id:24704465,
                                webvisor:true,
                                clickmap:true,
                                trackLinks:true,
                                accurateTrackBounce:true});
                    } catch(e) { }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () { n.parentNode.insertBefore(s, n); };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else { f(); }
            })(document, window, "yandex_metrika_callbacks");
            </script>
            <noscript><div><img src="//mc.yandex.ru/watch/24704465" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
            <!-- /Yandex.Metrika counter -->
        </div>
        <div id="mailru">
        <!-- Rating@Mail.ru counter -->
        <script type="text/javascript">
        var _tmr = _tmr || [];
        _tmr.push({id: "2503645", type: "pageView", start: (new Date()).getTime()});
        (function (d, w) {
           var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true;
           ts.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//top-fwz1.mail.ru/js/code.js";
           var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
           if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
        })(document, window);
        </script><noscript><div style="position:absolute;left:-10000px;">
        <img src="//top-fwz1.mail.ru/counter?id=2503645;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
        </div></noscript>
        <!-- //Rating@Mail.ru counter -->
        </div> 
        <div id="ga">
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-50126187-1', 'auto');
          ga('send', 'pageview');

        </script>
        </div>   
       
                
               </div><!--/infooter --> 
              
	        </div><!--/footer -->

<?php wp_footer(); ?>    
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ajax.js"></script>
<script src="//yandex.st/share/cnt.share.js"></script>
<?php	
echo '</div>
<!--/page -->
</body>
</html>' ?>
