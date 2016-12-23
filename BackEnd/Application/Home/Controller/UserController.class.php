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
			// // $data.checklogin($map['email'], $map['pwd']);
			// $result = $data->where($map)->select();
			// var_dump($result);

		} else {
			$result = ['status'=>-1, 'msg'=>'参数缺失'];
			$this->ajaxReturn($result);
		}
	}

	// 注册操作
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

	// 获取好友列表
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

	// 评论
	public function setComment() {

	}

	// 获取用户的歌曲收藏列表
	public function gettMusicList() {

	}

	// 删除歌曲
	public function delSingleeMusic() {
		
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