<template>
  <div class="container">
  	<div class="header">
	    <div class="header-center">
	        <h1>
	            <router-link to="/">ZMedia音乐</router-link>
	        </h1>
	        <ul class="nav">
	            <li><router-link to="/" class="active">发现音乐</a></li>
	            <li><router-link to="/login">我的音乐</a></li>
	            <li><router-link to="/login">热门歌曲</a></li>
	            <li><a href="../../">客户端下载</a></li>
	        </ul>
	        <div class="top-tool">
	            <div class="top-search">
	                <i class="icn-search"></i>
	                <input type="text" placeholder="单曲/歌手/专辑/歌单/用户">
	                <ul class="result"></ul>
	            </div>
	            <div class="top-user">
	                <a href="#/login" class="user-login">登录</a>
	                <a href="#/reg" class="user-login">注册</a>
	                <div class="user-memb">
	                    <h4>用户</h4>
	                    <ul class="slide-down">
	                        <li><a href="#/my">我的主页</a></li>
	                        <li><a href="#/my">资料设置</a></li>
	                        <li><a href="javascript:;" class="logout">退出</a></li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="sub-list">
	        <div class="center">
	            <ul class="sub-nav">
	                <li><a class="active" href="javascript:;">推荐</a></li>
	                <li><a href="javascript:;">排行榜</a></li>
	                <li><a href="javascript:;">歌单</a></li>
	                <li><a href="javascript:;">主播电台</a></li>
	                <li><a href="javascript:;">歌手</a></li>
	                <li><a href="javascript:;">新碟上架</a></li>
	            </ul>
	        </div>
	    </div>
	</div>
  </div>
</template>

<script>
module.exports = {
	data: function() {
		return {
			greeting: 'Hello'
		}
	}
}
</script>

<style lang="sass">
.header {
	width: 100%;
	height: 105px;
	min-width: 1000px;
	background: #F2FAF7;
	.header-center {
		width: 1000px;
		margin: 0 auto;
		height: 70px;
		h1 {
			width: 180px;
			height: 70px;
			overflow: hidden;
			font-weight: bolder;
			font-size: 24px;
			color: #0F6C3E;
			float: left;
			line-height: 70px;
		}
		ul {
			float: left;
			text-align: center;
			font-size: 16px;
			li {
				padding: 0 1px;
				float: left;
			}
		}
	}
}
</style>