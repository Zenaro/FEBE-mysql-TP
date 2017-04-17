<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\MusicModel;
use Think\Upload;

class MusicController extends Controller {

	// 获取某首歌曲的信息
	public function getItem() {
		if (isset($_GET['id'])) {
			$music_id = $_GET['id'];
			$data = new MusicModel();
			$result = $data->getItem($music_id);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 获取一系列的歌曲信息，按照class_id条件查询
	public function getList() {
		if (isset($_GET['data'])) {
			$class_id = $GET['data'] + 1;
			$data = new MusicModel();
			$result = $data->getList($class_id);
			$this->ajaxReturn($result, 'JSON');

		} else if (isset($_GET['array'])) {
			$arr = $_GET['array'];
			$data = new MusicModel();
			$result = $data->getArray($arr);
			$json = ['msg'=>'', 'result'=>$result];
			$this->ajaxReturn($result, 'JSON');
		}
	}

	public function getAllList() {

		// 飙升榜歌单
		$array = array();
		$data = new MusicModel();
		$result = $data->getList(1);
		array_push($array, $result);

		$data = new MusicModel();
		$result = $data->getList(2);
		array_push($array, $result);

		$data = new MusicModel();
		$result = $data->getList(3);
		array_push($array, $result);

		$this->ajaxReturn($array, 'JSON');
	}

	// 获取某首歌曲的评论
	public function getComment() {
		if (isset($_GET['mid'])) {
			$music_id = $_GET['mid'];
			$data = new MusicModel();
			$result = $data->getComment($music_id);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 获取某首歌曲的歌词
	public function getLyric() {
		if (isset($_GET['mid'])) {
			$music_id = $_GET['mid'];
			$data = new MusicModel();
			$result = $data->getLyric($music_id);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 搜索歌曲，返回相似曲名或者歌手的歌曲信息数组
	public function searchMusic() {
		if (isset($_GET['str'])) {
			$str = $_GET['str'];
			$data = new MusicModel();
			$result = $data->searchMusic($str);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 上传音乐文件
	public function upload() {
		$upload = new Upload();// 实例化上传类
		$upload->maxSize = 31457280000;
		$upload->exts  = array('mp3', 'wav', 'jpg');// 设置附件上传类型
		$upload->rootPath =  './Public/Uploads/';// 设置附件上传目录
		$upload->savePath =  '';// 设置附件上传目录
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());

		} else {// 上传成功 获取上传文件信息
			$Music = M("Music"); // 实例化User对象
			$dataMusic['name'] = $_POST['name'];
			$dataMusic['lyric'] = $_POST['lrc'];
			$dataMusic['class_id'] = $_POST['type'];
			$dataMusic['src'] = '../../BackEnd/Public/Uploads/'.$info[0]['savename'];

			$dataSinger['name'] = $_POST['singer'];

			$result1 = $Music->add($dataMusic); // 写入用户数据到数据库
			$result2 = $Music->add($dataSinger); // 写入用户数据到数据库
			if ((int)$result > 0) {
				$this->success('上传成功');
			}
			// if ($Music)
		}
	}
}

?>