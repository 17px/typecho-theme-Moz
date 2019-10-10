<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 主题配置
 */
function themeConfig($form)
{
    // 头像图
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('头像图'), _t('这里填写 URL 地址,最好能走cdn或者oss,毕竟带宽小'));
    $form->addInput($logoUrl);

    // ICP备案号
    $icpNum = new Typecho_Widget_Helper_Form_Element_Text('icpNum', NULL, NULL, _t('ICP备案号'), _t('管局爸爸很严厉,备案过程中最好关闭站点,如：苏ICP备19008833号'));
    $form->addInput($icpNum);

    // 座右铭好
    $motto = new Typecho_Widget_Helper_Form_Element_Text('motto', NULL, NULL, _t('座右铭'), _t('座右铭会默认显示在首页'));
    $form->addInput($motto);

    // 友情链接
    $guy_link = new Typecho_Widget_Helper_Form_Element_Textarea('guy_link', null, null, _t('友情链接'), _t('格式：{头像url=>名字=>网址=>骚话}'));
    $form->addInput($guy_link);

    // 百度统计
    $baiduAnlysis = new Typecho_Widget_Helper_Form_Element_Text('baiduAnlysis', null, null, _t('百度统计'), _t('注册百度统计账号->新增网站->代码获取->找到 hm.src = "https://hm.baidu.com/hm.js?f045130eebcf5750255929de04bd5bff"; ->复制(问号后面的一串)'));
    $form->addInput($baiduAnlysis);

    // 实验室
    $labs = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'labs',
        array(
            'showCopyright' => _t('文章底部版权'),
            'showYiyan' => _t('一言(会替代座右铭显示内容)'),
        ),
        array('showYiyan', 'showCopyright'),
        _t('实验室'),
        _t('探索未来科技,骚东西,还有Bug')
    );
    $form->addInput($labs->multiMode());

    // 侧边栏
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'sidebarBlock',
        array(
            'ShowRecentPosts' => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowCategory' => _t('显示分类'),
            'ShowArchive' => _t('显示归档'),
            'ShowOther' => _t('显示其它杂项(必选)')
        ),
        array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'),
        _t('侧边栏显示')
    );
    $form->addInput($sidebarBlock->multiMode());
}


/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/


/**
 * 文章缩略图
 * <?php echo showThumb($this, true, w, h); ?>
 */
function showThumb($obj, $link = false, $w, $h)
{
    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches);
    $thumb = '';
    $attach = $obj->attachments(1)->attachment;
    if (isset($attach->isImage) && $attach->isImage == 1) {
        $thumb = $attach->url;   //附件是图片 输出附件
    } elseif (isset($matches[1][0])) {
        $thumb = $matches[1][0];  //文章内容中抓到了图片 输出链接
    }
    $thumb = empty($thumb) ? 'https://unsplash.it/' . $w . '/' . $h . '/' : $thumb; //再没有 就用随机图片
    if ($link) {
        echo $thumb;
    } else {
        $thumb = '<img src="' . $thumb . '">';
        echo $thumb;
    }
}

/**
 * 文章创建日期转 xx前
 */
function diffTime($time = NULL)
{
    $text = '';
    $time = $time === NULL || $time > time() ? time() : intval($time);
    $t = time() - $time; //时间差 （秒）
    $y = date('Y', $time) - date('Y', time()); //是否跨年

    switch ($t) {
        case $t == 0:
            $text = '刚刚';
            break;
        case $t < 60:
            // $text = $t . '秒前'; // 一分钟内
            $text = $t . 's'; // 一分钟内
            break;
        case $t < 60 * 60:
            // $text = floor($t / 60) . '分钟前'; //一小时内
            $text = floor($t / 60) . 'min'; //一小时内
            break;
        case $t < 60 * 60 * 24:
            // $text = floor($t / (60 * 60)) . '小时前'; // 一天内
            $text = floor($t / (60 * 60)) . 'h';
            break;
        case $t < 60 * 60 * 24 * 30:
            // $text = floor($t / 86400) . '天前';
            $text = floor($t / 86400) . 'd';
            break;
        case $t < 60 * 60 * 24 * 365 && $y == 0:
            // $text = date('m月d日', $time); //一年内
            $text = date('m月', $time); //一年内
            break;
        default:
            // $text = date('Y年m月d日', $time); //一年以前
            $text = date('Y年', $time); //一年以前
            break;
    }
    echo $text;
}

/**
 * 处理字符串超长问题
 */
function subText($text, $maxlen)
{
    if (mb_strlen($text) > $maxlen) {
        echo mb_substr($text, 0, $maxlen) . '...';
    } else {
        echo $text;
    }
}

/**
 * 字符串截取的百分比
 */
function perText($text, $maxlen)
{
    if (mb_strlen($text) > $maxlen) {
        echo ceil($maxlen / mb_strlen($text)) . '%';
    } else {
        echo '100%';
    }
}

/**
 * 名字首字作头像
 */
function nameToImg($text)
{
    echo mb_substr($text, 0, 1);
}


/**
 * 文章数量控制
 */
function themeInit($archive)
{
    // 分类
    if ($archive->is('category', 'default')) { //jobs为你的分类的slug名称
        $archive->parameter->pageSize = 10; // 自定义条数
    }
    // 首页
    if ($archive->is('index')) {
        $archive->parameter->pageSize = 10;
    }
}


/**
 * 文章阅读数量
 * <?php get_post_view($this) ?>
 */
function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
    }
    echo $row['views'];
}

/**
 * 字数统计
 * <?php art_count($this->cid); ?>
 */
function  art_count($cid)
{
    $db = Typecho_Db::get();
    $rs = $db->fetchRow($db->select('table.contents.text')->from('table.contents')->where('table.contents.cid=?', $cid)->order('table.contents.cid', Typecho_Db::SORT_ASC)->limit(1));
    echo mb_strlen($rs['text'], 'UTF-8');
}


/**
 * 预计阅读时间
 */
function readTime($cid)
{
    $db = Typecho_Db::get();
    $rs = $db->fetchRow($db->select('table.contents.text')->from('table.contents')->where('table.contents.cid=?', $cid)->order('table.contents.cid', Typecho_Db::SORT_ASC)->limit(1));
    echo ceil(mb_strlen($rs['text'], 'UTF-8') / 300) . '分钟';
}

/**
 * ip获得地址
 */
function getLocation($ip)
{
    $res = '';
    if (preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $ip)) {
        $API = 'http://ip.taobao.com/service/getIpInfo.php?ip=';
        $re = json_decode(file_get_contents($API . $ip));
        $res = $re->data->country . ' ' . $re->data->region . ' ' . $re->data->city;
    } else {
        $res = '未知';
    }

    echo $res;
}


/**
 * 修复pjax评论
 */
function fixPjaxComment($archive)
{
    echo "<script type=\"text/javascript\">
    (function () {
        window.TypechoComment = {
            dom : function (id) {
                return document.getElementById(id);
            },
        
            create : function (tag, attr) {
                var el = document.createElement(tag);
            
                for (var key in attr) {
                    el.setAttribute(key, attr[key]);
                }
            
                return el;
            },
    
            reply : function (cid, coid) {
                var comment = this.dom(cid), parent = comment.parentNode,
                    response = this.dom('" . $archive->respondId . "'), input = this.dom('comment-parent'),
                    form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                    textarea = response.getElementsByTagName('textarea')[0];
                    
                if (null == input) {
                    input = this.create('input', {
                        'type' : 'hidden',
                        'name' : 'parent',
                        'id'   : 'comment-parent'
                    });
    
                    form.appendChild(input);
                }
    
                input.setAttribute('value', coid);
    
                if (null == this.dom('comment-form-place-holder')) {
                    var holder = this.create('div', {
                        'id' : 'comment-form-place-holder'
                    });
    
                    response.parentNode.insertBefore(holder, response);
                }
    
                comment.appendChild(response);
                this.dom('cancel-comment-reply-link').style.display = '';
    
                if (null != textarea && 'text' == textarea.name) {
                    textarea.focus();
                }
    
                return false;
            },
    
            cancelReply : function () {
                var response = this.dom('{$archive->respondId}'),
                holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');
    
                if (null != input) {
                    input.parentNode.removeChild(input);
                }
    
                if (null == holder) {
                    return true;
                }
    
                this.dom('cancel-comment-reply-link').style.display = 'none';
                holder.parentNode.insertBefore(response, holder);
                return false;
            }
        };
    })();
    </script>
    ";
}


/**
 * 格式化友情链接
 */
function formateGuys($str)
{
    $res = [];
    preg_match_all("/\[(.*)\]/", $str, $match);
    if (count($match) > 1) {
        foreach ($match[1] as $m) {
            $temp = explode("=>", $m);
            array_push($res, array('a' => $temp[0], 'b' => $temp[1], "c" => $temp[2], "d" => $temp[3]));
        }
    }
    return $res;
}
