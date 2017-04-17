CloudMusic音乐网站（参考链接：V.4.0音频处理：http://zenaro.github.io/
Music-Effect/、V.3.0单前端展示：http://zenaro.github.io/FE-CloudMusic）

CloudMusic自主研发的个人项目，本人负责该项目的完全前端和基本的后台
实现。主要实现一个音乐网站的大部分功能，其功能上模仿了网易云音乐。项目
历时较长，经历了三次的迭代。

项目的1.0版本中实现了项目重构和基本的播放器；

2.0版本开始优化audio的事件轮询、新增播放列表、歌词滚动、播放顺序、数据库重整、引入seaJS来实现模块化开发；

3.0版本中开发了CloudMusic的nodeJS版本、引入pjax来处理跳转页面时音乐播放受影响的问题，再到最后使用AngularJS的路由和控制器实现重构代码的复用以及赋予了网站single page app的性质，更为优雅地解决了页面跳转与音乐播放的冲突问题，同时页面的载入在性能上得到提高（项目地址：https://github.com/Zenaro/CloudMusic-for-Angular）；

4.0版本中以web audio api 为研究方向，主要分析了空间环绕声、低通、高通滤波、人声增强/削弱、回声、混响等音效的底层原理和效果实现，采用React组件化开发的模式搭建具备一系列可观可感、增益明显的前端音效服务器（项目地址：https://github.com/Zenaro/web-audio-effect）。

### 3.0 版本主要实现功能：用户注册登录，收藏歌单，歌曲推荐，歌曲个性化播放，歌单随机循环播放，歌词滚动，主要针对web audio对象进行性能和用户体验的优化。

播放器的逻辑实现：
1. 点击“播放”按钮时，开始请求歌曲库数据并初始化播放器，ajax验证目标地址的MP3文件，触发http请求和加载远端MP3文件，整个过程采取边加载mp3边播放的模式，每当数据缓冲足以开始播放时，触发html5的oncanplay，缓冲不足时触发onloadstart事件。MP3加载的过程持续触发onprogress，通过buffered对象计算当前缓冲的百分比，实现缓冲数据的可视化。

2. 播放的过程持续触发ontimeupdate事件，通过该事件以及currentTime/duration的实时更新实现了红色进度条的前进，当播放到达终点时，触发onended，此时判断歌曲循环方式（列表循环或随机），前者可直接操作data_id，后者则产生一个随机id来实现随机播放。

3. 歌曲信息改变时，触发ondurationchange事件，以此触发修改歌曲信息操作。onvolume则可用来调整音量。当需要暂停播放时，使用audio对象的 pause() 方法，歌曲即暂停播放，红色进度条随之暂停。

优化：在播放器的早期版本中，使用了setInterval相关的定时器来实现轮询滚动，而且是用数组来存储的时间轴和歌词。在后期播放器的新版本中则是通过html5多媒体事件对轮询重新优化。后续开发了该项目的nodeJS版本和angularJS版本，其中angularJS同时解决了跳转页面时音乐播放器首影响的问题。Angular版本处于迭代中，相关项目的代码均可在https://github.com/Zenaro/上下载到。

### 4.0 版本为前端音频处理
项目架构：
 ```bash
- App
  - config   #项目配置文件
  - public   #默认文件
  - scripts   #服务器运行脚本
  - src      #主目录
- Lib         #自定义JS环境封装库
  - AudioCtx  #音频处理环境库
  - CanvasCtx #画布渲染环境库 
- Component  #组件库
  - EffectComponent #音效处理组件
  - ListComponent  #歌曲列表组件
  - MainComponent #canvas和album
  - PlayerComponent #播放器组件
- style        #样式  组件与封装库
 
  ```

#### 主要实现的功能：本地音频的加载与解码、音频可视化、空间环绕声、低通、高通滤波、人声增强/削弱、波形修改、回声和混响等音效。

####音频处理的逻辑实现：
<<<<<<< HEAD
浏览器监听拖拽事件，当用户添加新的本地音乐文件时，创建一个<source -> effect -> destination>的音频轨道以实现播放，同时在该轨道上连接一个audio Analyser来处理音频信号并通过傅里叶快速变换和canvas的渲染实现音频可视化。当选择某种音效时（如空间环绕声），则将原有的音频轨道修改为：<source -> panner3d -> destination>，通过panner节点来控制左右声道的音频衰减来模拟实现双耳的听觉差异，进而实现声音的立体化。
=======
浏览器监听拖拽事件，当用户添加新的本地音乐文件时，创建一个<source -> effect -> destination>的音频轨道以实现播放，同时在该轨道上连接一个audio Analyser来处理音频信号并通过傅里叶快速变换和canvas的渲染实现音频可视化。当选择某种音效时（如空间环绕声），则将原有的音频轨道修改为：<source -> panner3d -> destination>，通过panner节点来控制左右声道的音频衰减来模拟实现双耳的听觉差异，进而实现声音的立体化。
>>>>>>> 857685a0ad2077d35172fb6f88811b5c5a9a73d6
