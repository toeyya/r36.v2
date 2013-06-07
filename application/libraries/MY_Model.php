<?php
/*
 * Author: Yotsakon Pitinanon
 * Website: www.siamwebcare.com
 * Email: yotmanu@hotmail.com
 * Version: 0.6
 */
class MY_Model extends Model{
	
	public $table = '';
	public $primary_key = 'id';
	public $mode = '';
	public $select = '*';
	public $where = '';
	public $join = '';
	public $sort = '';
	public $order = 'asc';
	public $target = '';
	public $limit = 20;
	public $pagination = '';
	public $current_page = '';
	public $record_count = '';
	public $handle;
	public $groupby;
	
	function __construct()
	{
		parent::__construct();
		$this->sort($this->primary_key);
		$this->target();
		$this->current_page = number_format(@$_GET['page']);	
	}
	
	function free_result()
	{
		$this->mode = '';
		$this->select = '*';
		$this->where = '';
		$this->sort = 'order by ' . $this->primary_key;
		$this->order = 'asc';
		$this->target = '';
		$this->join = '';
		$this->limit = 20;
		$this->current_page = '';
		$this->__construct();
	}
	
	function primary_key($field)
	{
		$this->primary_key = $field;
		return $this;
	}
	
	function table($table)
	{
		$this->table = $table;
		return $this;
	}
	
	function target($target = FALSE)
	{
		if($target)
		{
			$this->target = $target;	
		}
		else
		{
			$string = $_SERVER['REQUEST_URI'];
			$pattern = '/(&page=[0-9]+)/i';
			$replacement = '';
			$this->target = preg_replace('/([&?]+page=[0-9]+)/i', '',  $_SERVER['REQUEST_URI']);
		}
		return $this;
	}
	
	function current_page($param)
	{
		$this->current_page = $param;
		return $this;
	}
	
	function select($field = ' * ')
	{
		$this->select = $field;
		return $this;
	}
	function groupby($field)
	{
		$this->groupby= $field;
		return $this;
	}
	
	function where($condition)
	{
		if($condition)
		{
			$this->where = ' where ' . $condition;
		}
		return $this;
	}
	
	function join($condition)
	{
		$this->join = $condition;
		return $this;
	}
	
	function sort($sort)
	{
		$this->sort = 'order by ' . $sort;
		return $this;
	}
	
	function order($order)
	{
		$this->order = $order;
		return $this;
	}
	
	function limit($limit)
	{
		$this->limit = $limit;
		return $this;
	}
	
	function get($sql = FALSE,$limit=FALSE)
	{
			//	$sql = $sql ? $sql : 'select '.$this->select.' from '.$this->table.' '.$this->join.' '.$this->where.' '.$this->sort.' '.$this->order;
			if($sql){
				$sql=$sql;			
			}else{
				if($this->groupby){
					$sql='select '.$this->select.' from '.$this->table.' '.$this->join.' '.$this->where.' group by '.$this->groupby.' '.$this->sort.' '.$this->order;
				}else{
					$sql='select '.$this->select.' from '.$this->table.' '.$this->join.' '.$this->where.' '.$this->sort.' '.$this->order;
				}
			}
			$this->load->library('pagination');
			$page = new pagination();
			$page->target($this->target);
			if($limit)
			{
				$rs = $this->db->PageExecute($sql,$page->limit,$page->page);
			}else
			{
				$rs = $this->db->Execute($sql);	
			}
			$page->limit($this->limit);
			@$page->currentPage($this->current_page);
			$rs = $this->db->PageExecute($sql,$page->limit,$page->page);
			$page->Items($rs->_maxRecordCount);
			$page->showCounter(true);
			$this->pagination = $page->show();
			$this->free_result();	
			//echo "recoudcount".$rs->_maxRecordCount;
			return $rs->GetArray();
		

	}
	
	function get_one($field,$id,$value = FALSE,$group=FALSE)
	{
		if($value)
		{
			if($group){
				$result = $this->db->getone('select '.$field.' from '.$this->table.' '.$this->join.' group by '.$this->groupby.' having '.$id.' = ?',$value);
			}else{
				$result = $this->db->getone('select '.$field.' from '.$this->table.' where '.$id.' = ?',$value);
			}	
			
		}
		else
		{
			$result = $this->db->getone('select '.$field.' from '.$this->table.' where '.$this->primary_key.' = ?',$id);
		}
		$this->free_result();
		return $result;
	}
	
	function get_row($id,$value = FALSE,$group=FALSE)
	{
		if($value)
		{
			if($group){
				$result = $this->db->getrow('select '.$this->select.' from '.$this->table.' '.$this->join.' group by '.$this->groupby.' having '.$id.' = ?',$value);	
			}else{
				$result = $this->db->getrow('select '.$this->select.' from '.$this->table.' '.$this->join.' where '.$id.' = ?',$value);	
			}							
		}
		else
		{	
				$result = $this->db->getrow('select '.$this->select.' from '.$this->table.' '.$this->join.' where '.$this->primary_key.' = ?',$id);
									
			
			
		}	
		$this->free_result();
		return $result;
	}
	
	function pagination()
	{
		return $this->pagination;
	}
	
	function save($data)
	{	
		@$mode = ($data[$this->primary_key]) ? 'UPDATE' : 'INSERT';
		@$where = ($data[$this->primary_key]) ? $this->primary_key.' = '.$data[$this->primary_key] : FALSE;
		$this->db->AutoExecute($this->table,$data,$mode,$where);
		return ($mode == 'UPDATE') ? $data[$this->primary_key] : $this->db->insert_id();
	}
	
	function delete($id,$value = FALSE)
	{
		if($value)
		{
			$this->db->Execute('delete from '.$this->table.' where '.$id.' = ?',$value);
		}
		else
		{
			$this->db->Execute('delete from '.$this->table.' where id = ?',$id);
		}
		
	}
	
	function get_option($value,$text,$table = FALSE)
	{
		$table = $table ? $table : $this->table;
		return $this->db->getassoc('select '.$value.','.$text.' from '.$table);
	}

	function is_available($field,$data,$table = FALSE)
	{
		$table = $table ? $table : $this->table;
		$result = $this->db->getone('select '.$field.' from '.$table.' where '.$field.' = ?',$data);
		return $result ? FALSE : TRUE;	
	}
	
	function counter($id,$field = 'counter',$table = FALSE)
	{
		$table = $table ? $table : $this->table;
		$this->db->execute('update '.$table.' set '.$field.' = '.$field.' + 1 where id = ?',$id);
	}
	function decounter($id,$field = 'counter',$table = FALSE)
	{
		$table = $table ? $table : $this->table;
		$this->db->execute('update '.$table.' set '.$field.' = '.$field.' - 1 where id = ?',$id);
	}
	function upload(&$file,$path = 'uploads/',$resize = FALSE,$width = FALSE,$height = FALSE,$ratio = FALSE)
	{
		if($file['name'])
		{
			ini_set("max_execution_time","60000");
			ini_set("memory_limit","100M");
			ini_set("post_max_size","64M");
			ini_set("upload_max_filesize","64M");


			$this->load->library('uploader');
			$handle = new Uploader();
			$handle->Upload($file);
			$this->handle =& $handle;
			if($resize)
			{
				return $this->thumb($path, $width, $height, $ratio);
			} 
			else
			{
				$this->handle->process($path);
				if($this->handle->processed) 
				{
					return $this->handle->file_dst_name;
				}
			}	
		}	
	}
	
	function thumb($path,$width,$height,$ratio = FALSE)
	{
		if($this->handle)
		{
			$this->handle->image_resize = TRUE;
			if($ratio)
			{
				if($ratio == 'x')
				{
					$this->handle->image_y = $height;
					$this->handle->image_ratio_x = TRUE;			
				}
				if($ratio == 'y')
				{
					$this->handle->image_x = $width;
					$this->handle->image_ratio_y = TRUE;			
				}
			}
			else
			{
				$this->handle->image_x = $width;	
				$this->handle->image_y = $height;
			}
			$this->handle->process($path);
			if($this->handle->processed) 
			{
				return $this->handle->file_dst_name;
			}
		}
	}
	
	function delete_file($id,$path,$field = 'image')
	{
		$file = $this->get_one($field, $id);
		@unlink($path.$file);
	}

}
?>