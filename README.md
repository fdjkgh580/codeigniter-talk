codeigniter-talk
================



	[快速與交談]

	版本 v1.3
	快速呼叫你的 model 與 view 。當你需要model的時候，系統發現還沒有引用檔案，
	才會自動利用 $this->load->model() 讀取，效能較佳。


	--model 使用方法--

	1)
	controller 中添加
	$this->load->library('talk');

	若要全域添加可以在自訂的 MY_Controller 中使用，或是 confog/autoload.php 中使用自動載入
	$autoload['libraries'] = array('talk');


	2)
	在任何控制器(controller)或視圖(view)中使用你的model
	$this->talk->模組名稱->模組方法();
	$this->talk->album_model->getlist(102, 1);  或
	Talk::model("album_model")->getlist(102, 1);

	php 5.3 以後的版本可以這麼寫
	Talk::模組名稱()->模組方法();
	Talk::album_model()->getlist(102, 1);


	--view 使用方法--

	$param->header 	=	"標題";
	$param->main   	=	"變化位置";
	$param->footer 	=	"底部";

	直接輸出
	$this->talk->view("frontend/header, frontend/main, frontend/footer", $param, false); 或
	Talk::view("frontend/header, frontend/main, frontend/footer", $param, false);

	組合回傳後輸出
	$result = Talk::view("frontend/header, frontend/main, frontend/footer", $param, true);
	echo $result;

	php 5.3 後支援 Anonymous callback
	Talk::view("test/header, test/main, test/footer", $param, function ($string) 
	{
		echo $string;
	});


<a href="http://jsnwork.kiiuo.com/archives/1642/php-codeigniter-%E5%BF%AB%E9%80%9F%E8%87%AA%E5%8B%95%E8%BC%89%E5%85%A5%E4%BD%A0%E7%9A%84model%E6%96%B9%E6%B3%95">或可看我的部落格</a>
