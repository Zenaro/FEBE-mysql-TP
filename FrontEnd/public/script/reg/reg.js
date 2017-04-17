define(function(require, exports, module) {

	var URLPrefix = '../../BackEnd/index.php/Home';

	function Reg() {
		this.name = 'form[name=reg] input[name=name]';
		this.email = 'form[name=reg] input[name=email]';
		this.pwd = 'form[name=reg] input[name=pwd]';
		this.repwd = 'form[name=reg] input[name=repwd]';
		this.submit = 'form[name=reg] input[type=submit]';
		this.tips = 'form[name=reg] .tips';
	}

	module.exports = Reg;

	Reg.prototype.render = function() {
		this._init();
		this._bind();
	}

	Reg.prototype._init = function() {

	}

	Reg.prototype._bind = function() {

		var self = this;

		$('.wrap-in').on('focus', this.name, function() {

			$(self.tips).html('');

		}).on('focus', this.email, function() {

			$(self.tips).html('');

		}).on('focus', this.pwd, function() {

			$(self.tips).html('');

		}).on('focus', this.repwd, function() {

			$(self.tips).html('');

		}).on('submit', 'form[name=reg]', function(e) {
			e = e || event;
			e.preventDefault();
			if ($.trim($(self.name).val()).length < 2 ||
				$.trim($(self.pwd).val()).length < 6) {
				$(self.tips).html('密码由字母，数字组成，不少于6位');
				return;
			}

			if ($.trim($(self.pwd).val()) !== $.trim($(self.repwd).val())) {
				$(self.tips).html('两次输入的密码不匹配');
				return;
			}

			if (!!$.trim($(self.name).val()) &&
				!!$.trim($(self.email).val()) &&
				!!$.trim($(self.pwd).val()) &&
				!!$.trim($(self.repwd).val())) {

				$.ajax({
					url: URLPrefix + '/User/reg',
					type: 'POST',
					data: $('form').serialize(),
					beforeSend: function() {
						$(self.submit).val('loading...').attr('disabled', '');
					},
					success: function(res) {
						console.log(res);
						if (res.result > 0) {
							cookie('unique', res.result);
							window.location.href = './frame.html';

						} else {
							$(self.tips).html(res.msg);
							$(self.submit).val('注册').removeAttr('disabled');
						}
					}

				});

			} else {
				$(self.tips).html('表单未完成，请继续填写');
			}

		});
	}
});