<?php
/**
 * Created by PhpStorm.
 * User: xcc
 * Date: 09/10/2017
 * Time: 8:52 PM
 */
if (cs_get_option('i_article_share_switcher')): ?>
    <div class="article-share">
                                    <span class="article-share-title">
                                        分享到：
                                    </span>
        <span class="bdsharebuttonbox d-inline-block">
                                        <a href="#" class="bds_weixin czs-weixin" data-cmd="weixin" title="分享到微信"></a>
                                        <a href="#" class="bds_tsina czs-weibo" data-cmd="tsina" title="分享到新浪微博"></a>
                                        <a href="#" class="bds_sqq czs-qq" data-cmd="sqq" title="分享到QQ"></a>
                                        <a href="#" class="bds_more czs-add" data-cmd="more"></a>
                                    </span>
        <script>
            window._bd_share_config={
                "common":{
                    "bdSnsKey":{},
                    "bdText":"",
                    "bdMini":"1",
                    "bdMiniList":false,
                    "bdPic":"",
                    "bdStyle":"0"
                },
                "share":{
                    bdCustomStyle: themeUrl + '/assets/css/share.css'
                }
            };
            with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src=themeUrl + '/assets/js/bdshare/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
        </script>
    </div>
<?php endif; ?>