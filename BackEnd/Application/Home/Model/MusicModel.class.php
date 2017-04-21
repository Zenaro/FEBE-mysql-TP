<?php
namespace Home\Model;
use Think\Model;

class MusicModel extends Model {
	protected $MusicClassSinger;	// 歌曲 + 分类 + 关系表 -> 3表连接 
	protected $MusicSinger; // 歌曲 + 歌手 + 关系表 -> 3表连接
	protected $MusicColle;	// 歌曲 + 评论 + 用户信息表 -> 3表连接
	public function __construct() {
		$MusicClassSinger = new Model();
		$musicSinger = new Model();
		$musicColle = new Model();

		$this->MusicClassSinger = $MusicClassSinger->table(array(
			C('DB_PREFIX').'music'=>'music',
			C('DB_PREFIX').'musicrclass'=>'mrc',
			C('DB_PREFIX').'class'=>'class',
			C('DB_PREFIX').'singer'=>'singer',
			C('DB_PREFIX').'singerrmusic'=>'srm'
		));

		$this->MusicSinger = $musicSinger->table(array(
			C('DB_PREFIX').'music'=>'music',
			C('DB_PREFIX').'singerrmusic'=>'mrs',
			C('DB_PREFIX').'singer'=>'singer'
		));

		$this->MusicColle = $musicColle->table(array(
			C('DB_PREFIX').'music'=>'music',
			C('DB_PREFIX').'comment'=>'comment',
			C('DB_PREFIX').'info'=>'info'
		));
	}

	/*
	* 获取某首歌曲的信息
	* @param 
	* $music_id:歌曲id
	*/
	public function getItem($music_id) {
		$result = $this->MusicSinger
			->where('music.music_id=mrs.music_id and mrs.singer_id=singer.singer_id and music.music_id='.$music_id)
			->field('music.music_id, music.name, singer.singer_name, music.src')
			->select();
		if (count($result) > 0) {
			return ['msg'=>'succ', 'result'=>$result];

		} else {
			return ['msg'=>'empty', 'status'=>-1, 'result'=>[]];
		}
	}

	/*
	* 获取某一类型的歌曲信息
	* @param
	* $class_id:歌曲类型的id
	*/
	public function getList($class_id) {
		$result = $this->MusicClassSinger
			->where('music.music_id=mrc.music_id and mrc.class_id=class.class_id and singer.singer_id=srm.singer_id and music.music_id=srm.music_id and class.class_id='.$class_id.'')
			->field('music.music_id, music.name, singer.singer_name')
			->limit(10)
			->order('listeners')
			->select();
		return $result;
	}

	/*
	* 获取一系列歌曲的信息
	* @param
	* $arr: 歌曲id组成的数组
	*/
	public function getArray($arr) {
		$result = $this->MusicSinger
			->where("music.music_id=mrs.music_id and mrs.singer_id=singer.singer_id and music.music_id IN (".$arr.")")
			->select();

		return ['msg'=>'', 'result'=>$result];
	}

	/*
	* 获取某首歌曲的评论
	* @param
	* $music_id:歌曲id
	*/
	public function getComment($music_id) {
		$result = $this->MusicColle
			->where('music.music_id=comment.music_id and comment.user_id=info.user_id and music.music_id='.$music_id)
			->field('info.name, image, content, time, info.user_id')
			->order('time')
			->select();
		if (count($result) > 0) {
			return ['msg'=>'succ', 'result'=>$result];

		} else {
			return ['msg'=>'empty', 'result'=>-1];
		}
	}

	/*
	* 获取某首歌曲的歌词
	* @param
	* $music_id:歌曲id
	*/
	public function getLyric($music_id) {
		$data = M('Music');
		$map['music_id'] = $music_id;
		$result = $data->where($map)->select();

		return ['msg'=>'', 'result'=>$result];
	}

	/*
	* 搜索相似歌曲
	* @param 
	* $str:目标文本
	*/
	public function searchMusic($str) {
		$musicSinger = M();
		$a = 'you';
		$result = $this->MusicSinger
			->where("music.music_id = mrs.music_id and mrs.singer_id=singer.singer_id and (music.name LIKE'%".$str."%' or singer_name LIKE '%".$str."%')")
			->field('music.music_id, name, singer_name')
			->select();

		if (count($result) > 0) {
			return ['msg'=>'succ', 'result'=>$result];
			
		} else {
			return ['msg'=>'empty', 'result'=>-1];
		}
	}
}
?>