/**
 * Created by zenaro on 16-6-17.
 */
define(function(require, exports, module) {

    var URLPrefix = '../../BackEnd/index.php/Home';

    module.exports = {
        _lrc: null,
        _mid: 0,
        render: function() {
            this.init();
            this.bind();
        },
        init: function() {
            var self = this,
                url = location.href;
            if (url.indexOf("?") !== -1) {
                var subStr1 = url.indexOf("="),
                    data_id = url.substring(subStr1 + 1, url.length);
                this._mid = data_id;
                $.get(URLPrefix + '/Music/getItem?id=' + data_id, function(res) { //get歌曲信息
                    var json = res.result[0];
                    $('.main .main-title h3').html(json.name);
                    $('.main .main-title span').html(json.singer_name);
                    if ($('audio')[0].src == '') {
                        $('.play-ing .ptitle a.title').html(json.name);
                        $('.play-ing .ptitle a.singer').html(json.singer_name);
                        $('.fix-bottom audio')[0].src = json.src;
                    }
                });

                $.get(URLPrefix + '/Music/getLyric', {
                    mid: data_id
                }, function(res) { //get歌词
                    var html = '',
                        lyric = res.result[0].lyric;
                    if (lyric.length > 6) {
                        self._lrc = self._util.parseLrc(lyric);
                        for (var i = 0, length = self._lrc.length; i < length; i++) {
                            html += '<p>' + self._lrc[i][1] + '</p>';
                        }
                    } else {
                        self._lrc = lyric;
                        html = '<p>' + self._lrc + '</p>';
                    }
                    $('.content').append(html);
                });
                $.get(URLPrefix + '/Music/getComment', {
                    mid: data_id
                }, function(res) { // get 评论
                    var html = '';
                    if (res.result.length > 0) {
                        var json = res.result;
                        $.each(json, function(index, value) {
                            html += '<div class="cell" data-id="' + value.user_id + '">' +
                                '<p>' +
                                '<span class="user-name">' + value.name + '：</span>' +
                                '<span class="user-comment">' + value.content + '</span>' +
                                '</p>' +
                                '<i class="btn-add"> + 加为好友</i>' +
                                '</div>';
                        });
                        $('.comment').append(html);

                    } else {
                        html = '<p>暂无评论</p>'
                        $('.comment').append(html);
                    }

                })
            }
        },
        bind: function() {
            var self = this,
                lrc_i = 0; // 第i行歌词

            $('body').on('click', '.main a.toggle', function() {

                if ($('.main .content').hasClass('txtOF')) {
                    $(this).html('收起');
                    $('.main .content').removeClass('txtOF');

                } else {
                    $(this).html('展开');
                    $('.main .content').addClass('txtOF');
                }

            }).on('focus', 'textarea', function() {

                $(this).text('');

            }).on('click', '.comment input[type=submit]', function() {
                if (!cookie('unique') || cookie('unique') == '') {
                    alert('您尚未登录');
                    return;
                }
                var html = '',
                    user_id = cookie('unique'),
                    txt = $.trim($('textarea').val());
                $.get(URLPrefix + '/User/setComment', {
                    uid: user_id,
                    mid: self._mid,
                    comment: txt
                }, function(res) {
                    console.log(res);
                    if (res.result === 1) {
                        html += '<div class="cell" data-id="' + user_id + '">' +
                            '<p>' +
                            '<span class="user-name">' + $('.user-memb h4').text() + '：</span>' +
                            '<span class="user-comment">' + txt + '</span>' +
                            '</p>' +
                            '<i class="btn-add"> + 加为好友</i>' +
                            '</div>';
                    }
                    $('.comment p').empty();
                    $('.comment .cell').eq(0).after(html);
                    $('textarea').val('');
                });

            }).on('click', '.comment .cell i.btn-add', function() {
                var my_id = cookie('unique'),
                    f_id = $(this).parent('.cell').attr('data-id');
                $.get(URLPrefix + '/User/setFriends', {
                    uid: my_id,
                    fid: f_id
                }, function(res) {
                    alert(res.msg);
                });
            });

            $('audio').on('timeupdate', function() { // 歌词滚动
                if (self._lrc && self._lrc.length > 0) {
                    var length = self._lrc.length;
                    if (this.currentTime &&
                        self._lrc[lrc_i] &&
                        this.currentTime >= self._lrc[lrc_i][0]) {

                        $('.main .content p').removeClass('active').eq(lrc_i).addClass('active');
                        lrc_i++;
                    }
                }

            }).on('seeked', function() {
                var temp = 0;

                while (this.currentTime > self._lrc[temp][0]) {
                    temp++;
                }
                lrc_i = temp;
                $('.main .content p').removeClass('active').eq(lrc_i).addClass('active');
            });
        },
        _util: {
            parseLrc: function(text) { // lrc字符串的处理函数

                //将文本分隔成一行一行，存入数组
                var lines = text.split('\n'),
                    //用于匹配时间的正则表达式，匹配的结果类似[xx:xx.xx]
                    pattern = /\[\d{2}:\d{2}.\d{2}\]/g,
                    //保存最终结果的数组
                    result = [];
                //去掉不含时间的行
                while (!pattern.test(lines[0])) {
                    lines = lines.slice(1);
                };
                //上面用'\n'生成生成数组时，结果中最后一个为空元素，这里将去掉
                lines[lines.length - 1].length === 0 && lines.pop();
                lines.forEach(function(v /*数组元素值*/ , i /*元素索引*/ , a /*数组本身*/ ) {
                    //提取出时间[xx:xx.xx]
                    var time = v.match(pattern),
                        //提取歌词
                        value = v.replace(pattern, '');
                    //因为一行里面可能有多个时间，所以time有可能是[xx:xx.xx][xx:xx.xx][xx:xx.xx]的形式，需要进一步分隔
                    time.forEach(function(v1, i1, a1) {
                        //去掉时间里的中括号得到xx:xx.xx
                        var t = v1.slice(1, -1).split(':');
                        //将结果压入最终数组
                        result.push([parseInt(t[0], 10) * 60 + parseFloat(t[1]), value]);
                    });
                });
                //最后将结果数组中的元素按时间大小排序，以便保存之后正常显示歌词
                result.sort(function(a, b) {
                    return a[0] - b[0];
                });
                return result;
            }
        }
    }
});