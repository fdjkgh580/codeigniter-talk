<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * [快速與 model 交談]
 *
 * 快速呼叫你的model。當你需要model的時候，系統發現還沒有引用檔案，
 * 才會自動利用 $this->load->model() 讀取，所以效能較佳。
 *
 * 
 * --使用方法--
 * 
 * 1)
 * controller 中添加
 * $this->load->library('talk');
 * 
 * 若要全域添加可以在自訂的 MY_Controller 中使用，或是 confog/autoload.php 中使用自動載入
 * $autoload['libraries'] = array('talk');
 * 
 *
 * 2)
 * 在任何控制器(controller)或視圖(view)中使用你的model
 * $this->talk->模組名稱->模組方法();
 * $this->talk->album_model->getlist(102, 1);  或
 * Talk::model("album_model")->getlist(102, 1);
 *
 * php 5.3 以後的版本可以這麼寫
 * Talk::模組名稱()->模組方法();
 * Talk::album_model()->getlist(102, 1);
 */
class Talk
{

	//5.2以前，把model當作屬性使用，如 $talk->album_model->getlist(103, 1);
	//與 __call 同，為了風格一致，使用屬性呼叫model不建議使用。
	function __get($name)
	{
		return self::comm("model", $name);
	}

	//5.2以前，把model當作方法使用，如 $talk->album_model()->getlist(103, 1);
	public function __call($name, $arguments)
	{
		return self::comm("model", $name);
	}


	//5.3以後可使用靜態方法如 talk::album_model()->getlist(102, 1);
	public static function __callStatic($name, $arguments) 
	{
		return self::comm("model", $name);
	}

	//溝通方式
	protected function comm($type, $name)
	{
		$CI   =& get_instance();

		$name = strtolower($name);

		if ($type == "model")
		{
			$CI->load->model($name);
		}



		return $CI->$name;
	}

	//讀取模組的方法
	public function model($name)
	{
		$CI   =& get_instance();
		$CI->load->model($name);

		return $CI->$name;
	}


}


/* End of file talk.php */
/* Location: ./application/libraries/talk.php */
