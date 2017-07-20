#需要配置的虚拟机
<VirtualHost  *:80>
	ServerName yii2shop.cn
	DocumentRoot "E:\project\yii2shop\frontend\web"
</VirtualHost>

<Directory "E:\project\yii2shop\frontend\web">
	Options FollowsymLinks ExecCGI
	AllowOverride all
	Require all granted
	DirectoryIndex index.php
</Directory>

<VirtualHost  *:80>
	ServerName admin.yii2shop.cn
	DocumentRoot "E:\project\yii2shop\backend\web"
</VirtualHost>

<Directory "E:\project\yii2shop\backend\web">
	Options FollowsymLinks ExecCGI
	AllowOverride all
	Require all granted
	DirectoryIndex index.php
</Directory>
#图片虚拟机
<VirtualHost  *:80>
	ServerName img.yii2shop.cn
	DocumentRoot "E:\project\yii2shop\data"
</VirtualHost>

<Directory "E:\project\yii2shop\data">
	Options FollowsymLinks ExecCGI
	AllowOverride all
	Require all granted
	DirectoryIndex index.php
</Directory>

#上传的图片保存在项目的data文件夹中 方便前后访问
