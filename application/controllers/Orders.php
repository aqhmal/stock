<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Orders';

		$this->load->model('model_orders');
		$this->load->model('model_products');
		$this->load->model('model_company');
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Orders';
		$this->render_template('orders/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_orders->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_orders->countOrderItem($value['id']);
			$date = date('d-m-Y', $value['date_time']);
			$time = date('h:i A', $value['date_time']);

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewOrder', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('orders/printDiv/'.$value['id']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('orders/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteOrder', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$result['data'][$key] = array(
				$value['id'],
				$value['customer_name'],
				$value['customer_phone'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_orders->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('orders/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/create', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Order';

		$this->form_validation->set_rules('product[]', 'Product name', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_orders->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('orders/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;

        	$result = array();
        	$orders_data = $this->model_orders->getOrdersData($id);

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	

            $this->render_template('orders/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$order_data = $this->model_orders->getOrdersData($id);
			$orders_items = $this->model_orders->getOrdersItemData($id);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $order_data['date_time']);
			$date = date('d M Y', $order_data['date_time']);
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

			$html = '<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Invoice</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Custom Invoice Style -->
		<link rel="stylesheet" href="'.base_url('assets/invoice/css/style.css').'">
	</head>
	<body onload="window.print();">
		<div id="page_1">
			<div id="p1dimg1">
				<img src="'.base_url('assets/invoice/images/background.png').'">
			</div>
			<table cellpadding="0" cellspacing="0" class="t0">
				<tr>
					<td colspan="2" class="tr0 td0"><p class="p0 ft0">'.$company_info['company_name'].'</p></td>
				</tr>
				<tr>
					<td colspan="2" class="tr1 td0"><p class="p0 ft1"><nobr>3-3F,</nobr> JALAN SETIA PERDANA BC U13/BC,</p></td>
				</tr>
				<tr>
					<td colspan="2" class="tr2 td0"><p class="p0 ft1">SERIA 88 BUSINESS CENTER, SETIA ALAM,</p></td>
				</tr>
				<tr>
					<td class="tr3 td1"><p class="p0 ft1">40170 SHAH ALAM</p></td>
					<td class="tr3 td2"><p class="p0 ft2">&nbsp;</p></td>
				</tr>
				<tr>
					<td class="tr4 td1"><p class="p0 ft1">FB: Jawecom PC</p></td>
					<td class="tr4 td2"><p class="p0 ft1"><a href="mailto:jawecompc@gmail.com"> <span class="ft3">jawecompc@gmail.com</span></a> Phone: 0193009347</p></td>
				</tr>
			</table>
			<p class="p1 ft5">MAYBANK : 562843513537 (JAWECOM TRADING)
				<span style="padding-left:209px;">
					<span class="ft4">INVOICE NO. : '.$order_data['id'].'</span>
				</span>
			</p>
			<p class="p2 ft6">CUSTOMER INFORMATION</p>
			<table cellpadding="0" cellspacing="0" class="t1">
				<tr>
					<td class="tr5 td3"><p class="p0 ft1">Bill to</p></td>
					<td class="tr5 td4"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr5 td5"><p class="p0 ft2">&nbsp;</p></td>
				</tr>
				<tr>
					<td class="tr6 td3"><p class="p0 ft1">Customer</p></td>
					<td class="tr6 td4"><p class="p3 ft1">:</p></td>
					<td class="tr6 td5"><p class="p4 ft1">'.strtoupper($order_data['customer_name']).'</p></td>
				</tr>
				<tr>
					<td class="tr5 td3"><p class="p0 ft1">Contact</p></td>
					<td class="tr5 td4"><p class="p3 ft1">:</p></td>
					<td class="tr5 td5"><p class="p4 ft1">'.$order_data['customer_phone'].'</p></td>
				</tr>
				<tr>
					<td class="tr5 td3"><p class="p0 ft1">Payment</p></td>
					<td class="tr5 td4"><p class="p3 ft1">:</p></td>
					<td class="tr5 td5"><p class="p4 ft1">M2U</p></td>
				</tr>
				<tr>
					<td class="tr1 td3"><p class="p0 ft1">Date</p></td>
					<td class="tr1 td4"><p class="p3 ft1">:</p></td>
					<td class="tr1 td5"><p class="p4 ft7">'.$date.'</p></td>
				</tr>
			</table>
			<p class="p5 ft6">PRODUCT AND WARRANTY INFORMATION</p>
			<table cellpadding="0" cellspacing="0" class="t2">
				<tr>
					<td class="tr5 td6"><p class="p6 ft1">Qty.</p></td>
					<td class="tr5 td7"><p class="p7 ft1">Item / Service Type</p></td>
					<td colspan=2 class="tr5 td8"><p class="p8 ft1">Description</p></td>
					<td class="tr5 td9"><p class="p9 ft1">Price (RM)</p></td>
				</tr>';

				foreach($orders_items as $v) {
					$product_data = $this->model_products->getProductData($v['product_id']);
					$html .= '<tr>
						<td class="tr5 td10"><p class="p10 ft1">'.$v['qty'].'</p></td>
						<td class="tr5 td11"><p class="p11 ft1">'.$product_data['name'].'</p></td>
						<td colspan=2 class="tr5 td12"><p class="p11 ft1">'.$product_data['description'].'</p></td>
						<td class="tr5 td13"><p class="p11 ft1">'.$v['amount'].'</p></td>
					</tr>';
				}

				$html .= '
				<tr>
					<td class="tr5 td14"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr5 td15"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr5 td16"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr7 td13"><p class="p11 ft8">PRICE</p></td>
					<td class="tr7 td13"><p class="p11 ft8">'.$order_data['gross_amount'].'</p></td>
				</tr>';
			$html .='
				<tr>
					<td class="tr5 td14"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr5 td15"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr5 td16"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr7 td13"><p class="p11 ft8">DISCOUNT</p></td>
					<td class="tr7 td13"><p class="p11 ft8">'.$order_data['discount'].'</p></td>
				</tr>
				<tr>
					<td class="tr5 td14"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr5 td15"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr5 td16"><p class="p0 ft2">&nbsp;</p></td>
					<td class="tr7 td13"><p class="p11 ft8">TOTAL AMOUNT</p></td>
					<td class="tr7 td13"><p class="p11 ft8">'.$order_data['net_amount'].'</p></td>
				</tr>
			</table>
			<p class="p12 ft6">POSTAGE DETAILS:</p>
			<p class="p13 ft1">'.strtoupper($order_data['customer_name']).'</p>
			<p class="p14 ft1">'.$order_data['customer_phone'].'</p>
			<p class="p13 ft1">'.$order_data['customer_address'].'</p>
			<p class="p13 ft6">TERMS AND CONDITIONS</p>
			<p class="p18 ft1"><span class="ft7">1.</span><span class="ft9">Goods sold are not returnable.</span></p>
			<p class="p19 ft1"><span class="ft7">2.</span><span class="ft9">Customer must bring this receipt to confirm the process of Return Merchandise Authorization (RMA)</span></p>
			<p class="p19 ft1"><span class="ft7">3.</span><span class="ft9">Postage fee and risk bear by buyer (if any)</span></p>
			<p class="p20 ft10">*For office use only</p>
		</div>
	</body>
</html>';

			  echo $html;
		}
	}

}