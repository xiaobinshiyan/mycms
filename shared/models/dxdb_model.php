<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * model类
 * @author xiaobin
 * @link xiaobin@gemdesign.cn
 */
class Dxdb_model extends CI_Model
{
	private $table;
	public function __construct($table = '')
	{
		parent::__construct();	
		$this->table = $table;
	}

	/**
     * 获取单条信息
     *@access	public
     *@param $condition 选择条件  
     *@param $flag 返回信息标识
     *@return subject or array
     */	
	public function one($condition = array(),$flag = true)
	{
		if($flag)
		{
			$data = $this->db->get_where($this->table,$condition)->row_array();
		}
		else
		{
			$data = $this->db->get_where($this->table,$condition)->row();
		}
		return $data;
	}

	/**
	 * 获取所有信息
	 * select * from dd where sdfs=e order limit
	 * $slug  起始 $offset  间隔
	 */
	public function all($condition = array(),$order = array(), $select = '',$limit = NULL,$slug=NULL,$offset=NULL)
	{
		! empty($select)     &&  $this->db->select($select);
		! empty($condition)  &&  $this->db->where($condition);
         if(count($order) != 1)
         {
           foreach ($order as $v) {
           	$this->db->order_by($v);
           }
         }
         else
         {
         	$this->db->order_by($order[0]);
         }
        ! empty($limit)      &&  $this->db->limit($limit);
        if($slug != NULL && $offset != NULL)
        {
           $data = $this->db->get($this->table,$slug,$offset)->result_array();
        }
        else
        {
		  $data = $this->db->get($this->table)->result_array();
        }
		return $data;
	}
  
   /**
    * 添加信息
    *$data  需要添加的数据 返回 id  错误返回false
    */
   public function dx_insert($data = array())
   {
   	$this->db->insert($this->table, $data);
      return ($this->db->affected_rows()==1) ? $this->db->insert_id() : false;
   }

	/**
	 * 更新信息
	 *  条件  和数据
	 */
	public function dx_update($data = array(),$condition = array(),$limit = 1)
	{
       $flag =  $this->db->update($this->table, $data, $condition,$limit);
       return $flag;
	}

  /**
   * 删除信息
   * 条件 唯一标识
  */
  public function dx_delete($condition = array())
  {
    if(empty($condition))
    {
      return false;
    }
  	$this->db->where($condition)->delete($this->table);
  	return ($this->db->affected_rows()==1) ? $this->db->affected_rows() : false;
  }

}