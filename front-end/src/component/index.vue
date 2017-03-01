<template>
  <div class="wrap">
    <div class="wrap-in">
        <div class="cloumn main-top">
            <div class="btns">
                <a href="http://7xstax.com1.z0.glb.clouddn.com/Music-Effect.zip" download="http://7xstax.com1.z0.glb.clouddn.com/Music-Effect.zip" class="btn-down" title="客户端下载">客户端下载</a>
                <a href="javascript:;" class="btn-reg sm">注册帐号</a>
                <a class="tool-border"></a>
                <a href="javascript:;" class="btn-browse sm">站台一览</a>
                <a href="javascript:;" class="btn-gift sm">等级礼包</a>
            </div>
            <div class="slides">
                <ul class="points">
                    <li  v-for="item in imgSlide">
                    	<a href="javascript:;">
                    		<img :src="item" alt="图片"/>
                    	</a>
                    </li>
                </ul>
                <ul class="sub-tips">
                    <li class="active">●</li><li>●</li><li>●</li><li>●</li><li>●</li>
                </ul>
            </div>
            <div class="aside">
                <ul class="aside-tab">
                    <li><a href="javascript:;" class="active">最新</a></li>
                    <li><a href="javascript:;">活动</a></li>
                    <li><a href="javascript:;">公告</a></li>
                    <li><a href="javascript:;">焦点</a></li>
                    <li class="tab-tool">+</li>
                </ul>
                <ul class="aside-list"></ul>
            </div>
        </div>

        <div class="column main-hot">
            <div class="section">
                <h3>热门歌单<span>PLAYLIST</span></h3>
                <ul class="hot-list" id="hot-list">
                    <li>
                    	<img alt="">
                    </li>
                    <li class="active">
                    	<img alt=""/>
                    </li>
                    <li>
                    	<img alt="">
                    </li>
                </ul>
            </div>
        </div>

        <div class="column main-rank">
            <div class="section">
                <h3>排行榜<span>RANKLIST</span></h3>
                <div class="rank">
                    <dl class="rank-blk">
                        <dt class="top">
                            <a href="javascript:;" class="dt-img">
                            	<img alt="">
                            </a>
                            <div class="dt-txt">
                                <a href="javascript:;" class="title">云音乐飙升榜</a>
                                <a href="javascript:;" class="icon icon-play"></a>
                                <a href="javascript:;" class="icon icon-store" data-type="up"></a>
                            </div>
                        </dt>
                    </dl>
                    <div class="blk-border"></div>
                    <dl class="rank-blk">
                        <dt class="top">
                            <a href="javascript:;" class="dt-img">
                            	<img alt="">
                            </a>
	                        <div class="dt-txt">
	                            <a href="javascript:;" class="title">云音乐新歌榜</a>
	                            <a href="javascript:;" class="icon icon-play"></a>
	                            <a href="javascript:;" class="icon icon-store" data-type="new"></a>
	                        </div>
                        </dt>
                    </dl>
                    <div class="blk-border"></div>
                    <dl class="rank-blk">
                        <dt class="top">
                            <a href="javascript:;" class="dt-img">
                            	<img alt="">
                            </a>
	                        <div class="dt-txt">
	                            <a href="javascript:;" class="title">原创歌曲榜</a>
	                            <a href="javascript:;" class="icon icon-play"></a>
	                            <a href="javascript:;" class="icon icon-store" data-type="create"></a>
	                        </div>
                        </dt>
                    </dl>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>


<script>
module.exports = {
	data: function() {
		const Pic1 = require('../image/poster/player-1.jpg');
		const Pic2 = require('../image/poster/player-2.jpg');
		const Pic3 = require('../image/poster/player-3.jpg');
		const Pic4 = require('../image/poster/player-4.jpg');
		const Pic5 = require('../image/poster/player-5.jpg');
		const Pic6 = require('../image/poster/player-6.jpg');
		const Pic7 = require('../image/poster/player-7.jpg');
		const Pic8 = require('../image/poster/player-8.jpg');
		return {
			imgSlide: [Pic1, Pic2, Pic3, Pic4, Pic5] 
		}
	}
}

</script>

<style>
	
</style>