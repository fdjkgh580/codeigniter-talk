codeigniter-talk
================

[快速與 model 交談]

快速呼叫你的model。當你需要model的時候，系統發現還沒有引用檔案，
才會自動利用 $this->load->model() 讀取，所以效能較佳。

--使用方法--
1)
controller 中添加
$this->load->library('talk');
若要全域添加可以在自訂的 MY_Controller 中使用，或是 confog/autoload.php 中使用自動載入
$autoload['libraries'] = array('talk');

2)
在任何控制器(controller)或視圖(view)中使用你的model
$this->talk->模組名稱->模組方法();
$this->talk->album_model->getlist(102, 1);

php 5.3 以後的版本可以這麼寫
talk::模組名稱()->模組方法();
talk::album_model()->getlist(102, 1);
