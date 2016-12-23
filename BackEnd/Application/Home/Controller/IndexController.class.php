<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;

class IndexController extends Controller {

	/* 
	* 首页接口
	*/

	// 获取最新推送
	public function getNews() {
		$data = M('News');
		$result = $data->limit(7)->select();
		$this->ajaxReturn($result, 'JSON');
	}

	
    public function index(){
        $setting = M('music');
        $map['music_id'] = 2;
        $data = $setting->where($map)->select();
        $this->ajaxReturn($data, 'JSON');
    }
}