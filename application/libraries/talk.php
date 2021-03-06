<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * [快速與交談]
 * 
 * 版本 v1.3
 * 快速呼叫你的 model 與 view 。當你需要model的時候，系統發現還沒有引用檔案，
 * 才會自動利用 $this->load->model() 讀取，效能較佳。
 *
 * 
 * --model 使用方法--
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
 *
 *
 * --view 使用方法--
 * 
 * $param->header 	=	"標題";
 * $param->main   	=	"變化位置";
 * $param->footer 	=	"底部";
 *
 * 直接輸出
 * $this->talk->view("frontend/header, frontend/main, frontend/footer", $param, false); 或
 * Talk::view("frontend/header, frontend/main, frontend/footer", $param, false);
 *
 * 組合回傳後輸出
 * $result = Talk::view("frontend/header, frontend/main, frontend/footer", $param, true);
 * echo $result;
 *
 * php 5.3 後支援 Anonymous callback
 * Talk::view("test/header, test/main, test/footer", $param, function ($string) 
 * {
 *      echo $string;
 * });
 *
 * 
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

	//讀取視圖的方法
	public function view()
	{
		$CI   =& get_instance();

		$param = func_get_args();

		//若第一個參數是字串, 第二個參數就是傳遞參數, 第三個是是否回傳
		$string 	= trim($param[0], ", ");
		$data      	= $param[1];
		$third 	= empty($param[2]) ? false : $param[2];

		$viewary    = explode(",", $string);

		
		foreach ($viewary as $file)
		{
			$file = trim($file, " ");

			//若是布林
			if (is_bool($third))
			{
				//若全部回傳，將依序放入陣列
				if ($third === true)
				{
					$join_ary[] = $CI->load->view($file, $data, true);
				}

				//若不是則輸出
				else 
				{
					$CI->load->view($file, $data);
				}
			}

			//若是 callback
			elseif (!is_bool($third))
			{
				$join_ary[] = $CI->load->view($file, $data, true);
			}
		}

		$join_string = implode(NULL, $join_ary);

		//回傳組合陣列
		if (is_bool($third) and $third === true)
		{
			return $join_string;
		}

		//callback
		else 
		{
			return call_user_func($param[2], $join_string);
		}		

		//若是 function 
		// call_user_func($param[2], $return_ary);

	}


}


/* End of file talk.php */
/* Location: ./application/libraries/talk.php */
