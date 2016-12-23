<?php
namespace Home\Model;
use Think\Model;

class UserModel extends Model {
	protected $MusicClass;
	protected $FriendsInfo;
	public function __construct() {
		$musicClass = new Model();
		$friendsInfo = new Model();

		$this->MusicClass = $musicClass->table(array(
			C('DB_PREFIX').'music'=>'music',
			C('DB_PREFIX').'musicrclass'=>'mrc',
			C('DB_PREFIX').'class'=>'class'
		));

		$this->FriendsInfo = $friendsInfo->table(array(
			C('DB_PREFIX').'friends'=>'friends',
			C('DB_PREFIX').'info'=>'info'
		));
	}

	/*
	* 用户登录验证
	* @param
	* $email:邮箱账号;	$pwd:密码
	*/
	public function checklogin($email, $pwd) {

		$data = M('User');
		$map['email'] = $email;
		$map['pwd'] = md5($pwd);
		$result = $data->where($map)->select();
		if (count($result) > 0) {
			return ['msg'=>'succ', 'status'=>1, 'result'=>$result];
		} else {
			return ['msg'=>'false', 'status'=>-1, 'result'=>[]];
		}
		
	}

	/*
	* 用户注册方法
	* @param
	* $name:昵称;	$email:邮箱账号;	$pwd:密码
	*/
	public function reg($name, $email, $pwd) {
		$user = M('User');
		$info = M('Info');
		$mapUser['email'] = $email;
		$query = $user->where($mapUser)->select();

		if (count($query) > 0) {
			return ['msg'=>'账号已存在，请输入其他账号', 'result'=>-1];
		} else {
			$mapUser['pwd'] = $pwd;
			$mapUser['regDate'] = date("Y-m-d", time());
			$mapUser['root'] = 0;
			$result = $user->add($mapUser);
			if ($result > 0) {
				$mapInfo['user_id'] = $result;
				$mapInfo['name'] = $name;
				$mapInfo['image'] = '../public/image/poster/profile.jpg';
				$update = $info->add($mapInfo);
				return ['msg'=>'注册成功', 'result'=>$result];
			} else {
				// 新增失败
				return ['msg'=>'网络错误，请稍后重试', 'result'=>-1];
			}
		}
	}

	/*
	* 获取用户信息
	* @param
	* $uid:用户id
	*/
	public function getInfo($uid) {
		$data = M('Info');
		$map['user_id'] = $uid;
		$result = $data->where($map)->select();
		return ['msg'=>'succ', 'result'=>$result];
	}

	/*
	* 获取好友列表
	* @param
	* $uid:用户id
	*/
	public function getFriends($uid) {
		$map['user_id'] = $uid;
		$result = $this->FriendsInfo
			->where("friends.user_id=".$uid." and friends.friends_id=info.user_id")
			->select();
		return ['msg'=>'succ', 'result'=>$result];
	}

	/*
	* 添加好友
	* @param
	* $uid:用户id;	$fid:好友id
	*/
	public function setFriends($uid, $fid) {
		$data = M('Friends');
		$map['user_id'] = $uid;
		$map['friends_id'] = $fid;
		$query = $data->where($map)->select();
		if (count($query) > 0) {
			return ['msg'=>'对方已是您的好友', 'result'=>-1];

		} else {
			$result = $data->add($map);
			return ['msg'=>'添加成功', 'result'=>$result];
		}
	}

	/*
	* 评论歌曲
	* @param
	* $uid:用户id;	
	*/
	public function setComment($uid) {
		// $data = M('Info');
		// $map['user_id'] = $uid;
		// $result = $data->where($map)->select();
		// return ['msg'=>'succ', 'result'=>$result];
	}

	/*
	* 获取用户的歌曲收藏列表
	* @param
	* $uid:用户id
	*/
	public function getMusicList($uid) {
		// $data = M('Info');
		// $map['user_id'] = $uid;
		// $result = $data->where($map)->select();
		// return ['msg'=>'succ', 'result'=>$result];
	}

	/*
	* 用户收藏某首歌曲
	* @param
	* $uid:用户id;	@$mid:歌曲id 
	*/
	public function colSingleMusic($uid, $mid) {
		$map['user_id'] = $uid;
		$map['music_id'] = $mid;
		$data = M('Collection');
		$result = $data->where($map)->select();
		if ($result > 0) {
			return ['msg'=>'已收藏过该歌曲', 'result'=>-1];

		} else {
			$map['colDate'] =  date("Y-m-d", time());
			$update = $data->add($map);
			return ['msg'=>'收藏成功', 'result'=>1];
		}
	}

	/*
	* 用户收藏某个类型的前10首歌曲, 即新歌排行版的“收藏全部”功能接口
	* @param
	* $uid: 用户id;	$type:歌曲类型的id
	*/
	public function colClassMusic($uid, $type) {
		$map['user_id'] = $uid;
		$class_id = $type;
		// $data = M('Class');
		$model = new Model();
		$query = $this->MusicClass
			->where('music.music_id=mrc.music_id and class.class_id=mrc.class_id and class.class_id='.$class_id)
			->limit(10)
			->field('music.music_id')
			->select();
		// var_dump($query);

		$data = M('Collection');
		foreach ($query as $key => $value) {
			// array_push($arr, $value['music_id']);
			$map['music_id'] = $value['music_id'];
			$data->where($map)->select();
			if ($data <= 0) {
				$data->add();
			}
		}
		return ['msg'=>'收藏成功', 'result'=>1];
		// var_dump($arr);
		
		// return $query;
	}

	/*
	* 用户删除某首歌曲
	* @param
	* $uid:用户id;	$mid:歌曲id
	*/
	public function delSingleMusic($uid, $mid) {
		$map['uid'] = $uid;
		$map['mid'] = $mid;
		$data = M('Collection');
		$result = $data->where($map)->delete();
		if ($result > 0) {
			return ['msg'=>'删除成功', 'result'=>$result];
		} else {
			return ['msg'=>'删除失败，请重试', 'result'=>$result];
		}
	}
}
?>