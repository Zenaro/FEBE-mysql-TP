<?php
namespace Home\Controller;
use Think\Controller;
// use Think\Model;
use Home\Model\UserModel;

class UserController extends Controller {

	// 登录验证
	public function checkLogin() {
		if (isset($_POST['user']) && isset($_POST['pwd'])) {
			$data = new UserModel();
			$email = $_POST['user'];
			$pwd = $_POST['pwd'];
			$result = $data->checkLogin($email, $pwd);
			$this->ajaxReturn($result, 'JSON');

		} else {
			$result = ['status'=>-1, 'msg'=>'参数缺失'];
			$this->ajaxReturn($result);
		}
	}

	// 注册操作，验证重复，插入新字段
	public function reg() {
		if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pwd'])) {
			$name = $_POST['name'];
			$email = $_POST['email'];
			$pwd = md5($_POST['pwd']);
			$data = new UserModel();
			$result = $data->reg($name, $email, $pwd);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 获取用户信息
	public function getInfo() {
		if (isset($_GET['id'])) {
			$uid = $_GET['id'];
			$data = new UserModel();
			$result = $data->getInfo($uid);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 获取用户的好友列表
	public function getFriends() {
		if (isset($_GET['uid'])) {
			$uid = $_GET['uid'];
			$data = new UserModel();
			$result = $data->getFriends($uid);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 添加好友
	public function setFriends() {
		if (isset($_GET['uid']) && isset($_GET['fid'])) {
			$uid = $_GET['uid'];
			$fid = $_GET['fid'];
			$data = new UserModel();
			$result = $data->setFriends($uid, $fid);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 添加评论
	public function setComment() {
		if (isset($_GET['uid']) && isset($_GET['mid']) && isset($_GET['comment'])) {
			$uid = $_GET['uid'];
			$mid = $_GET['mid'];
			$comment = $_GET['comment'];
			$data = new UserModel();
			$result = $data->setComment($uid, $mid, $comment);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 获取用户的歌曲收藏列表
	public function getMusicList() {
		if (isset($_GET['uid'])) {
			$uid = $_GET['uid'];
			$data = new UserModel();
			$result = $data->getMusicList($uid);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 删除某首歌曲
	public function delSingleMusic() {
		if (isset($_GET['uid']) && isset($_GET['mid'])) {
			$uid = $_GET['uid'];
			$mid = $_GET['mid'];
			$data = new UserModel();
			$result = $data->delSingleMusic($uid, $mid);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 收藏某首歌曲
	public function colSingleMusic() {
		if (isset($_GET['uid']) && isset($_GET['mid'])) {
			$uid = $_GET['uid'];
			$mid = $_GET['mid'];
			$data = new UserModel();
			$result = $data->colSingleMusic($uid, $mid);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 收藏某个类型的歌曲
	public function colClassMusic() {
		if (isset($_GET['uid']) && isset($_GET['type'])) {
			$uid = $_GET['uid'];
			$type = $_GET['type'];
			$data = new UserModel();
			$result = $data->colClassMusic($uid, $type);
			$this->ajaxReturn($result, 'JSON');
		}
	}
}


?>