codeigniter-talk
================
<h3>[快速與 model 交談，讓你省下繁瑣的打字時間]</h3>
<br>
快速呼叫你的model。當你需要model的時候，系統發現還沒有引用檔案，<br>
才會自動利用 $this->load->model() 讀取，所以效能較佳。<br>
<br>
在任何控制器(controller)或視圖(view)中使用你的model<br>
$this->talk->模組名稱->模組方法();<br>
$this->talk->album_model->getlist(102, 1);<br>
<br>
php 5.3 以後還可以這麼用<br>
talk::模組名稱()->模組方法();<br>
talk::album_model()->getlist(102, 1);<br>
<br>
就這麼簡單。<br>
<a href="http://jsnwork.kiiuo.com/archives/1642/php-codeigniter-%E5%BF%AB%E9%80%9F%E8%87%AA%E5%8B%95%E8%BC%89%E5%85%A5%E4%BD%A0%E7%9A%84model%E6%96%B9%E6%B3%95">說明可看我的部落格</a>
