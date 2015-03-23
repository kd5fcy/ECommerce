<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('products');
	}
	public function buy($id)
	{
		$item = array('qty' => $this->input->post('qty'), 'id' => $id);
		$tmp = $this->session->userdata('cart');
		if($this->session->userdata('cart'))
		{
			$counter = 0;
			foreach ($tmp as $key => $value) 
			{
				if($value['id'] == $item['id'])
				{
					$counter++;
					$item['qty'] = $value['qty'] + $item['qty'];
					$tmp[$key] = $item;
				}
			}
			if ($counter === 0)
			{
				$tmp[] = $item;
			}
		}
		else
		{
			$tmp = array();
			$tmp[] = $item;
		}
		$this->session->set_userdata('cart', $tmp);
		redirect('/products');
	}
	public function cart()
	{
		$this->load->view('cart');
	}
	public function order()
	{
		$this->load->view('order');
	}
	public function delete($id)
	{
		$tmp = $this->session->userdata('cart');
		foreach ($tmp as $key => $value) 
		{
			if($value['id'] == $id)
			{
				unset($tmp[$key]);
			}
		}
		$this->session->set_userdata('cart', $tmp);
		redirect('/products/cart');
	}
}