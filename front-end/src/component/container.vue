<template>
  <div class="container">
  	<div class="header">
	    <div class="header-banner center">
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
	<router-view></router-view>
	<div class="footer">
		
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
$imgUrlPrefix: 'http://localhost/NewWorld/sql-CloudMusic/FEBE-mysql/front-end/src/image/sprite/';
/* ---- header ------- */
.header {
	width: 100%;
	height: 105px;
	min-width: 1000px;
	background: #F2FAF7;
	.center {
		width: 1000px;
		margin: 0 auto;
	}
	div.header-banner {
		height: 70px;
		> h1 {
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
		> ul.nav li {
			line-height: 70px;
			a {
				padding: 0 14px;
				display: block;
				&:hover, &.active {
					background: #DBFAF0;
				}
			}
		}
		> .top-tool{
			height: 70px;
			float: right;
			padding: 0 35px;
			.top-search {
				width: 235px;
				height: 30px;
				float: left;
				background: #fcfcfc;
				margin: 20px;
				border: solid 1px #ccc;
				border-radius: 20px;
				position: relative;
				input {
					width: 185px;
					height: 30px;
					border: 0;
					float: left;
					background: #fcfcfc;
					line-height: 30px;
				    outline: none;
				    margin-left: 15px;
				}
				i {
					width: 30px;
					height: 20px;
					display: block;
					float: right;
					cursor: pointer;
					margin: 5px 5px 0 0;
					background: url($imgUrlPrefix + 'sprite.png');
					background-position: -440px -10px;
				}
				ul.result {
					width: 250px;
					background: #fff;
					position: absolute;
					padding: 5px 0;
					border: solid 1px #ccc;
					border-radius: 7px;
					display: none;
					top: 35px;
					left: 0;
					li {
						width: 99%;
						height: 30px;
						line-height: 30px;
						text-indent: 10px;
						a {
							overflow: hidden;
							display: block;
							font-size: 10px;
							&.active, &:hover {
								background: #f1f1f1;
							}
							.col {
								float: left;
								white-space: nowrap;
								overflow: hidden;
								text-overflow: ellipsis;
								&.result-master {
									max-width: 30%;
									color: #0C73C2;
								}
								&.col-str {
									max-width: 10%;
								}
								&.result-name {
									max-width: 60%;
								}
							}
						}
					}
				}
			}
			.top-user {
				float: left;
				color: #666;
				cursor: pointer;
				background: inherit;
				line-height: 70px;
				.user-memb{
					height: auto;
					line-height: 70px;
					display: none;
					float: left;
					position: relative;
					h4 {
						font-weight: normal;
					}
					ul.slide-down {
						width: 90px;
						padding: 5px 0;
						text-align: center;
						background: #fafafa;
						border: solid 1px #aaa;
						border-radius: 4px;
						position: absolute;
						top: 50px;
						left: -30px;
						display: none;
						li {
							width: 88px;
							height: 25px;
							line-height: 25px;
							a {
								display: block;
								&:hover {
									background: #F2FAF7;
								}
							}
						}
					}
				}
			}
		}
	}
	div.sub-list {
		width: 100%;
		height: 35px;
		overflow: hidden;
		background: #777;
		ul.sub-nav {
			margin-left: 190px;
			li {
				padding: 0 15px;
				color: #03DEDB;
				line-height: 35px;
				float: left;
				a {
					padding: 0 12px;
					border-radius: 10px;
					font-size: 12px;
					&:hover, &:focus, &.active {
						color: #F5CE03;
						background: #666;
					}
				}
			}
		}
	}
}
/* --------- end ------------ */

/* ------- 主页内容 --------- */
.wrap{
	width: 100%;
	min-width: 1100px;
	margin: 0 auto;
	background: #fafafa;
	.wrap-in{
		width: 1100px;
		margin: 0 auto;
		background: #FAFAF5;
	}
}
/* ---------- end ------------*/

/* --------- footer ---------*/
.footer{
	width: 100%;
	min-width: 1100px;
	background: #f9f9f9;
	border-top: solid 2px #ccc;
}
/* ---------- end ------------*/
</style>