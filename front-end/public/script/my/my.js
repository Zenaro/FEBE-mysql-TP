define(function(require, exports, module) {

	var URLPrefix = '../../BackEnd/index.php/Home';

	function My() {
		this.user = '.main-title .title-info h3 span'; //用户名
		this.mul = '.main-mlist ul'; //歌曲列表
		this.mlist = '.main-mlist ul li'; //li单元
		this.listBtnPlay = '.main-mlist ul li a.icon-play'; //播放按钮
		this.listBtnAdd = '.main-mlist ul li .col-2 a.icn-add'; //添加按钮
		this.listBtnDel = '.main-mlist ul li .col-2 a.icn-del'; //删除按钮
	}

	module.exports = My;

	My.prototype.render = function() {
		this._init();
		this._bind();
	}

	My.prototype._init = function() {

		var self = this;

		if (!cookie('unique') || cookie('unique') == '') {
			history.go(-1);

		} else {
			$.post(URLPrefix + '/User/getInfo', {
				id: cookie('unique')
			}, function(res) {
				$(self.user).html(res);
			});
			$.get(URLPrefix + '/User/getMusicList', {
				uid: cookie('unique')
			}, function(res) {
				var html = '';
				$.each(res.result, function(index, value) {
					html += '<li data-id="' + value.music_id + '">' +
						'<a href="javascript:;" class="icon-play"></a>' +
						'<div class="col col-1">' +
						'<h4>' + value.name + '</h4>' +
						'<div class="master"> - ' + value.singer_name + '</div>' +
						'</div>' +
						'<div class="col col-2">' +
						'<a href="javascript:;" class="icn-add" title="添加"></a>' +
						'<a href="javascript:;" class="icn-col" title="收藏"></a>' +
						'<a href="javascript:;" class="icn-del" title="删除"></a>' +
						'<a href="javascript:;" class="icn-dwn" title="下载"></a>' +
						'</div>' +
						'</li>';
				});

				$(self.mul).append(html);
			});

			$.get(URLPrefix + '/User/getFriends', {
				uid: cookie('unique')
			}, function(res) {
				console.log(res);
				var html = '';
				$.each(res.result, function(index, value) {
					html += '<li data-id="' + value.friend_id + '">' +
						value.name +
						'</li>';
				});

				$('.main-mfriend ul').append(html);
			});
		}



	}

	My.prototype._bind = function() {

		var self = this;

		var Index = require('../index/index');
		var I = new Index();

		$('.wrap-in').on({

			mouseover: function() {
				$(this).find('.col-2 a').show();
			},
			mouseleave: function() {
				$(this).find('.col-2 a').hide();
			},

		}, this.mlist).on('click', this.listBtnPlay, function() {

			var mid = $(this).parents('li').attr('data-id');
			var Music = require('../common/music');
			var MList = require('../common/mlist');
			Music.appendEle(mid);
			Music.init(mid);
			MList.update();

		}).on('click', this.listBtnAdd, function() {

			var addID = $(this).parents('li').attr('data-id');
			I._appendMusic(addID);

		}).on('click', this.listBtnDel, function() {

			if (!!cookie('unique')) {
				var obj = $(this).parents('li');
				var delID = $(obj).attr('data-id');
				$.get(URLPrefix + '/User/delSingleMusic', {
					'uid': cookie('unique'),
					'mid': delID
				});
				$(obj).remove();
			}

		});
	}
});