<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\MusicModel;

class MusicController extends Controller {

	// 获取某首歌曲的信息
	public function getItem() {
		if (isset($_GET['id'])) {
			$music_id = $_GET['id'];
			// $map['music_id'] = $_GET['id'];
			$data = new MusicModel();
			$result = $data->getItem($music_id);
			$this->ajaxReturn($result, 'JSON');
		}
	}

	// 获取一系列的歌曲信息
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
			$this->ajaxReturn($result, 'JSON');
		}
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

	// 搜索歌曲，返回相似歌曲数组
	public function searchMusic() {
		if (isset($_GET['str'])) {
			$str = $_GET['str'];
			$data = new MusicModel();
			$result = $data->searchMusic($str);
			$this->ajaxReturn($result, 'JSON');
		}
	}
}

?>