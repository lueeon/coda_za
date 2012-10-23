<?php
class Coda_ZaOptions implements ArrayAccess {
	private static $instance;
	
	/**
	 * 所有设置
	 *
	 * @var array
	 */
	private $options_array = array();
	
	/**
	 * 从数据库中取得设置
	 *
	 * @return null
	 */
	private function __construct() {
		if($o = get_option(CODA_ZA_OPTIONS)) {
			$this->options_array = $o;
			unset($o);
		}
	}
	/**
	 * 重新取得设置
	 *
	 * @return null
	 */
	public function refresh() {
		$this->__construct();
	}
	/**
	 * 获取 PhilNaGetOpt 单一实例
	 *
	 * @return PhilNaGetOpt
	 */
	public static function getInstance() {
		if(self::$instance == null) {
			self::$instance = new Coda_ZaOptions();
		}
		return self::$instance;
	}
	/**
	 * 给定的偏移量是否存在?
	 *
	 * @return bool
	 */
	public function offsetExists($key) {
		return array_key_exists($key, $this->options_array);
	}
	/**
	 * 返回给定偏移量上的数据
	 *
	 * @return null|mix
	 */
	public function offsetGet($key) {
		if(array_key_exists($key, $this->options_array)) {
			if(is_string($this->options_array[$key])) {
				return stripslashes($this->options_array[$key]);
			} else {
				return $this->options_array[$key];
			}
		} else {
			return null;
		}
	}
	/**
	 * 设置给定偏移量上的数据
	 *
	 * @return bool|mix
	 */
	public function offsetSet($key, $val) {
		$this->options_array[$key] = $val;
	}
	/**
	 * 置空给定偏移量上的数据
	 *
	 * @return bool
	 */
	public function offsetUnset($key) {
		if(array_key_exists($key, $this->options_array)) {
			unset($this->options_array[$key]);
		}
	}
	public function merge_array($true_array, $override=true) {
		$result = $true_array;
		foreach($this->options_array as $key => $val) {
			if(!array_key_exists($key, $result) || $override)
				$result[$key] = $val;
		}
		return $result;
	}
	/*public function merge_array($true_array, $override=false) {
		foreach($true_array as $key => $val) {
			if(!array_key_exists($key, $this->options_array) || $override) {
				$this->options_array[$key] = $val;
			}
		}
		return $this->options_array;
	}
	*/
}

class Coda_ZaAdmin {
	private $string_options = array();
	private $bool_options = array();
	private $int_options = array();
	private $options = array();
	private static $options_default = array();
	public static function get_options_default() {
		return self::$options_default;
	}
	public static function init() {
		self::$options_default = array(
			'excerpt_length'		=> 220,
			'special_homepage'		=>1
		);
	}
	public function __construct(array $options) {
		if(!get_option(CODA_ZA_OPTIONS))
			update_option(CODA_ZA_OPTIONS, Coda_ZaOptions::getInstance()->merge_array(self::$options_default));
		$this->string_options = isset($options['string']) ? (array)$options['string'] : array();
		$this->bool_options = isset($options['bool']) ? (array)$options['bool'] : array();
		$this->int_options = isset($options['int']) ? (array)$options['int'] : array();
		add_action('admin_menu', array($this,'_admin'));
	}
	public function _admin() {
		$page = add_theme_page(__('Coda_Za 选项'), __('Coda_Za 选项'), 'administrator', 'Coda_ZaAdmin', array($this, '_admin_panel'));
		if ( function_exists('add_contextual_help') ) {
			$help = '<a href="http://isayme.com/" target="_blank">'.__('Check here for more information.').'</a>';
			add_contextual_help($page,$help);
		}
	}
	public function save($data) {
		foreach($data as $key=>$value) {
			if(in_array($key, $this->string_options)){
				$this->options[$key] = rtrim(preg_replace('/\n\s*\r/', '', $value));
				$this->options[$key] = str_replace('<!--', '', $this->options[$key]);
				$this->options[$key] = str_replace('-->', '', $this->options[$key]);
			} elseif(in_array($key, $this->bool_options)){
				$this->options[$key] = (bool)$value;
			} elseif(in_array($key, $this->int_options)){
				$this->options[$key] = (int)$value;
			}
		}
		update_option(CODA_ZA_OPTIONS, $this->options);
	}
	public function restore() {
		update_option(CODA_ZA_OPTIONS, self::$options_default);
	}
	public function _admin_panel() {
		include_once dirname(__FILE__).'/options.php';
	}
}
Coda_ZaAdmin::init();
if(is_admin()){
	$coda_za_default_option_types = array(
		'string'	=> array(
			'keywords',
			'description',
			'google_analytics_code',
			'rss_additional',
			'special_img',
			'me_tsina',
			'me_tqq',
			'me_renren',	
			'me_qzone',
			'me_douban',
			'me_kaixin',
			'me_twitter',
			'me_facebook',
			'me_googleplus',
			'me_netease',
			'me_sohu',
			'me_digu',
			'me_fanfou',
		),
		'bool'		=> array(
			'enable_google_analytics',
			'exclude_admin_analytics',
			'rss_additional_show',
			'special_homepage',
			'cacheavatar'		
		),
		'int'		=> array(
			'excerpt_length',	
		)
	);
	new Coda_ZaAdmin($coda_za_default_option_types);
}
?>
