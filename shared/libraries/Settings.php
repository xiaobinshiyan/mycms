<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Settings
{
	/**
	 * CI超级类句柄
	 *  @access private
	 **/
	private $_ci = NULL;

	/**
	 * 设置数组
	 */
	private $setting = array();

	//已经加载的配置文件的集合
	private $is_loaded = array();

	/**
     * _setting_paths
     * 加载源所在的文件夹的集合
     *
     * @var array
     * @access  private
     **/
	private $_setting_paths = array();

	/**
     * 构造函数
     *
     * @access  public
     * @return  void
     */
	public function __construct()
	{
		$this->_ci = &get_instance();
		$this->_setting_paths = array(DX_SHARE_PATH . 'settings/');
		$this->load('site', FALSE, TRUE);
	}
	
	/**
	 * 加载配置文件
	 *
	 * @access  public
	 * @param   string
	 * @param   bool
	 * @param   bool
	 * @return  bool
	 */
	public function load($file = '',$use_sections = false,$fail_gracefully = false)
	{
		$file = ($file == '') ?'site' : str_replace('.php', '', $file);
		$loaded = false;

    	foreach($this->_setting_paths as $path)
    	{
    		$file_path = $path . $file . '.php';

    		if (in_array($file_path, $this->is_loaded, TRUE))
    		{
    			$loaded = TRUE;
    			continue;
    		}

    		if ( ! $this->_ci->platform->cache_exists($path . $file . '.php'))
    		{
    			continue;
    		}
    		//形成两队php标签
    		eval('?>' . $this->_ci->platform->cache_read($file_path));
    		if ( ! isset($setting) OR ! is_array($setting))
    		{
    			if ($fail_gracefully === TRUE)
    			{
    				return FALSE;
    			}
    			show_error('配置文件：'.$file_path.' 格式不正确.');
    		}

    		if ($use_sections === TRUE)
    		{
    			if (isset($this->setting[$file]))
    			{
    				$this->setting[$file] = array_merge($this->setting[$file], $setting);
    			}
    			else
    			{
    				$this->setting[$file] = $setting;
    			}
    		}
    		else
    		{
    			$this->setting = array_merge_recursive($this->setting, $setting);
    		}

    		$this->is_loaded[] = $file_path;
    		unset($setting);

    		$loaded = TRUE;
    	}

    	if ($loaded === FALSE)
    	{
    		if ($fail_gracefully === TRUE)
    		{
    			return FALSE;
    		}
    		show_error('配置文件: '.$file.'.php 不存在.');
    	}

    	return TRUE;
    }
    /**
     * 获取配置值
     *
     * @access  private
     * @param   string
     * @param   string
     * @return  mixed
     */
	public function item($item, $index = '')
	{
		if ($index == '')
		{
			if ( ! isset($this->setting[$item]))
			{
				return FALSE;
			}

			$pref = $this->setting[$item];
		}
		else
		{
			if ( ! isset($this->setting[$index]))
			{
				return FALSE;
			}

			if ( ! isset($this->setting[$index][$item]))
			{
				return FALSE;
			}

			$pref = $this->setting[$index][$item];
		}

		return $pref;
	}

	// ------------------------------------------------------------------------

	/**
     * 设置配置值
     *
     * @access  public
     * @param   string
     * @param   mixed
     * @return  void
     */
	function set_item($item, $value)
	{
		$this->setting[$item] = $value;
	}
}