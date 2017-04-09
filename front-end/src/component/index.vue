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
                <ul class="points" :style="{left: -slideUtil.index*583+'px'}">
                    <li v-for="item in slideUtil.imgSlide">
                    	<a href="javascript:;">
                    		<img :src="item" alt="banner"/>
                    	</a>
                    </li>
                </ul>
                <ul class="sub-tips">
                    <li v-for="(item, index) in slideUtil.imgSlide" 
                    	:class="[slideUtil.index == index ? 'active' : '']"
                    	v-on:click="slider(index)">
                    	●
                    </li>
                </ul>
            </div>
            <div class="aside">
                <ul class="aside-tab">
                    <li><a href="javascript:;" class="active">最新</a></li>
                    <li><a href="javascript:;">活动</a></li>
                    <li><a href="javascript:;">公告</a></li>
                    <li><a href="javascript:;">焦点</a></li>
                    <i class="tab-tool">+</i>
                </ul>
                <ul class="aside-list"></ul>
            </div>
        </div>

        <div class="column main-hot">
            <div class="section">
                <h3>热门歌单<span>PLAYLIST</span></h3>
                <ul class="hot-list" id="hot-list">
                    <li v-for="item in imgHover">
                    	<img :src="item" alt="">
                    </li>
                </ul>
            </div>
        </div>

        <div class="column main-rank">
            <div class="section">
                <h3>排行榜<span>RANKLIST</span></h3>
                <div class="rank">
                    <dl class="rank-blk" v-for="item in rank">
                        <dt class="top">
                            <a href="javascript:;" class="dt-img">
                            	<img :src="item.logo" alt="">
                            </a>
                            <div class="dt-txt">
                                <a href="javascript:;" class="title" v-text="item.title"></a>
                                <a href="javascript:;" class="icon icon-play"></a>
                                <a href="javascript:;" class="icon icon-store" :data-type="item.dataType"></a>
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
		let imgSlide = [],
			imgHover = [],
			imgUrlPrefix = 'http://om6mucew9.bkt.clouddn.com/',
			ajaxUrlPrefix = '../back-end/index.php/Home/';

		for (let i = 1; i <= 5; i++) {
			imgSlide.push(imgUrlPrefix + 'player-'+i+'.jpg');
		}
		for (let i = 6; i <= 8; i++) {
			imgHover.push(imgUrlPrefix + 'player-'+i+'.jpg');
		}

		this.$http.get(ajaxUrlPrefix + 'Index/getNews').then(res => {
			this.$set('news', [1, 2]);
			// console.log(res.body);
		}, res => {
			// console.log(error)
		});
		this.slider();
		return {
			"slideUtil": {
				"imgSlide": imgSlide,
				"cell": 583,
				"index": 0
			},
			"imgHover": imgHover,
			"news": [],
			"rank": [{
				"title": '云音乐飙升榜',
				"logo": imgUrlPrefix + 'musicUp.jpg',
				"dataType": 'up'
			}, {
				"title": '云音乐新歌榜',
				"logo": imgUrlPrefix + 'musicNew.jpg',
				"dataType": 'new'
			}, {
				"title": '原创歌曲榜',
				"logo": imgUrlPrefix + 'musicCreate.jpg',
				"dataType": 'create'
			}]
		}
	},
	ready: function() {
		console.log('test')
	},
	methods: {
		slider: function(i, imgCount) { // 滑动banner图
			let length = imgCount || 5;

			this.timer && clearInterval(this.timer);
			if (typeof i === 'number' && i >= 0 && i < length) {
				this.slideUtil.index = i;
				this.timer = setInterval(() => {
					this.slideUtil.index < length - 1 ?
						this.slideUtil.index += 1 :
						this.slideUtil.index = 0;
				}, 6000);

			} else {
				this.timer = setInterval(() => {
					this.slideUtil.index < length - 1 ?
						this.slideUtil.index += 1 :
						this.slideUtil.index = 0;
				}, 6000);
			}
		}
	}
}
</script>

<style lang="sass">
$imgUrlPrefix: 'http://om6mucew9.bkt.clouddn.com/';
.wrap {
	padding-top: 380px;
	background: #fafafa url($imgUrlPrefix + 'wrap.jpg') no-repeat center top;
	background-size: 1400px;
	.column {
		width: 100%;
		margin: auto;
		margin-top: 20px;
		clear: both;
	}
	.main-top {
		height: 265px;
		.btns {
			width: 19%;
		    height: 100%;
		    float: left;
		    a {
				color: #ddd;
				text-align: center;
			    display: block;
			    &.btn-down{
			    	color: #fff;
					height: 150px;
				    line-height: 150px;
				    font-size: 20px;
				    background: #31C27C;
				}
				&.btn-reg, &.btn-browse {
				    width: 50%;
				    float: left;
				    font-size: 13px;
				    text-indent: 10px;
				    line-height: 55px;
				    background: #0D673B;
				    &:hover {
						background: #467662;
					}
				}
				&.btn-gift {
					clear: both;
					font-size: 16px;
					line-height: 60px;
				    text-indent: 10px;
					background: #0A4B2C;
					&:hover {
						background: #0AA55A;
					}
				}
			}
		}
		.slides {
			width: 53%;
			height: 100%;
			float: left;
			position: relative;
			overflow: hidden;
			ul.points {
				width: 3000px;
				position: absolute;
				transition: left 0.5s;
				li {
					width: 583px;
					float: left;
				}
			}
			ul.sub-tips{
			    width: 100%;
				position: absolute;
			    color: #ddd;
			    padding: 5px 0;
			    text-align: center;
			    bottom: 0;
			    right: 0;
			    li {
					cursor: pointer;
				    width: 25px;
				    float: left;
				    &:first-child {
						margin-left: 230px;
					}
					&:hover, &.active {
						color: #0F3C8D;
					}
				}
			}
			ul.sub-bg {
				background: linear-gradient(rgba(0,0,0,0),rgba(30,30,30,0.8));
			}
		}
		.aside {
			width: 26%;		/*总宽度28% */
			padding: 0 1%;  /*26+1+1 = 28% */
			height: 100%;
			float: left;
			overflow: hidden;
			background: #fff;
			ul.aside-tab {
				width: 100%;
			    height: 40px;
			    font-size: 18px;
			    line-height: 40px;
			    border-bottom: 1px solid #999;
			    li {
					width: 18%;
					margin: 0 1.5%;
					float: left;
					text-align: center;
					a {
						color: #333;
					    display: block;
					    &:hover, &.active {
							color: blue;
							border-bottom: solid 2px blue;
						}
					}
					.tab-tool {
						width: 6%;
						font-size: 20px;
					    float: right;
					    cursor: pointer;
					}
				}
			}
			ul.aside-list {
				clear: both;
				padding: 5% 0;
				font-size: 14px;
				li {
					line-height: 28px;
					a {
						width: 80%;
						color: #333;
						display: block;
						float: left;
						white-space: nowrap;
						overflow: hidden;
						text-overflow: ellipsis;
						&:hover, &.active{
							color: red;
						}
					}
					span {
						display: block;
						float: right;
					}
				}
			}
		}
	}
	.section {
		width: 100%;
		height: 100%;
		float: left;
		background: #fff;
		overflow: hidden;
		position: relative;
		h3 {
			font-size: 18px;
			margin: 0 2%;
			padding: 1% 4%;
			border-bottom: solid 1px #ccc;
			span {
				color: #ddd;
				font-size: 10px;
				padding: 2%;
			}
		}
	}
	.main-hot {
		height: 300px;
		ul {
			width: 2400px;
			overflow: hidden;
			position: absolute;
			top: 80px;
			background: #000;
			li {
				width: 367px;
				height: 100%;
				float: left;
				background: #000;
				position: relative;
				img {
					transition: opacity 0.5s;
					opacity: 0.4;
					cursor: pointer;
				}
				&:hover img {
					opacity: 0.8;
				}
				&:hover:after {
					width: 36px;
					height: 36px;
					background: green;
					content: "";
					position: absolute;
					opacity: 1;
					bottom: 20px;
					left: 20px;
					background: url($imgUrlPrefix + 'playbar.png');
					background-position: 0 -204px;
				}
			}
		}
	}
	.main-rank {
		width: 100%;
		height: 600px;
		.section {
			width: 100%;
			.rank {
				width: 97%;
				margin: 15px;
				height: 493px;
				background: #f4f4f4;
				border: solid 1px #ccc;
				display: table;
				dl {
					display: table-cell;
					width: 33.3%;
					&:nth-child(2) {
						position: relative;
						width: 33.4%;
						&:before, &:after {
							content: "";
							position: absolute;
							width: 1px;
							height: 100%;
							background: #ddd;
							top: 0;
						}
						&:before {
							left: 0;
						}
						&:after {
							right: 0;
						}
					}
					a {
						color: #333;
						&:hover {
							text-decoration: underline;
						}
					}
					dt {
						padding: 20px;
						height: 80px;
						.dt-img {
							width: 80px;
							height: 80px;
							overflow: hidden;
							display: block;
							float: left;
						}
						.dt-txt {
							width: 50%;
							height: 80px;
							float: left;
							margin-left: 10px;
							font-size: 16px;
							a.title {
								width: 100%;
								line-height: 30px;
								font-weight: bold;
								display: block;
								float: left;
							}
							a.icon {
								width: 22px;
								height: 22px;
								float: left;
								display: block;
								margin: 5px;
								background: url($imgUrlPrefix + 'index.png') no-repeat;
							}
							a.icon-play {
								background-position: -267px -205px;
								&:hover {
									background-position: -267px -235px;
								}
							}
							a.icon-store {
								background-position: -300px -206px;
								&:hover {
									background-position: -300px -236px;
								}
							}
						}
					} 
					dd {
						width: 100%;
						height: 34px;
						float: left;
						overflow: hidden;
						line-height: 32px;
						span {
							color: red;
							font-size: 16px;
							display: block;
							width: 20px;
							text-align: center;
							float: left;
							text-align: center;
							padding: 0 10px 0 20px;
						}
						a.title {
							display: block;
							max-width: 110px;
							white-space: nowrap;
							text-overflow: ellipsis;
							overflow: hidden;
							float: left;
						}
						.dd-oper {
							width: 90px;
							float: right;
							display: none;
							a {
								width: 17px;
								height: 17px;
								margin: 8px 5px;
								display: block;
								float: left;
								&.icon-play {
									background: url($imgUrlPrefix+'index.png');
									background-position: -267px -268px;
									&:hover {
										background-position: -267px -288px;
									}
								}
								&.icon-add {
									width: 15px;
									background: url($imgUrlPrefix+'iconplay.png');
									background-position: 0 -698px;
									&:hover {
										background-position: -22px -698px;
									}
								}
								&.icon-store {
									background: url($imgUrlPrefix+'index.png');
									background-position: -297px -268px;
									&:hover {
										background-position: -297px -288px;
									}
								}
							}
						}
					}
				} 
			}
		}
	}
}
</style>