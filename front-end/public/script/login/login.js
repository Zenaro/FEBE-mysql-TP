/*
 * 	登录、注册框
 */
define(function(require, exports, module) {

	var URLPrefix = '../../BackEnd/index.php/Home';

	function Login() {
		this.user = '.wrap form input[name=user]';
		this.pwd = '.wrap form input[name=pwd]';
		this.submit = '.wrap form input[type=submit]';

		this.tips = '.wrap form .tips';
	}

	module.exports = Login;

	Login.prototype.render = function() {
		this._bindUI();
	};

	Login.prototype._bindUI = function() {
		var self = this;
		$('body').on('focus', this.user, function() {

			$(self.tips).html('');

		}).on('focus', this.pwd, function() {

			$(self.tips).html('');

		}).on('submit', 'form[name=login]', function(e) {
			e = e || event;
			e.preventDefault();

			if ($.trim($(self.user).val()) != '' && $.trim($(self.pwd).val()) != '') {
				$.ajax({
					url: URLPrefix + '/User/checkLogin',
					type: 'POST',
					data: $('form[name=login]').serialize(),
					beforeSend: function() {
						$(self.submit).val('loading...').attr('disabled', '');
					},
					success: function(res) {
						if (res.status > 0) {
							cookie('unique', res.result[0].id);
							window.location.href = './frame.html';

						} else {
							$(self.tips).html('帐号与密码不匹配，请重新输入');
							$(self.submit).val('登录').removeAttr('disabled');
						}
					}

				});

			} else {
				$(self.tips).html('请输入帐号和密码');
			}
		});
	}
});