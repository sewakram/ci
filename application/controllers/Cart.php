<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller{
    
    function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        $this->load->library('paypal_lib');
        // Load product model
        $this->load->model('Cart_Model');
        $this->load->library('encrypt');
    }
    
    function index(){
        $data = array();
        
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
       $data['inner'] = true;
        $data['title'] = 'Cart Details';
        $data['page'] = 'cart/index';
        // Load the cart view
        // echo "<pre>";print_r($this->cart->contents());die();
        $this->load->view('templates/common', $data);
    }

    function billing_view(){
    if(!$this->session->userdata('login')) {
        redirect('users/register');
    }
    // Load "billing_view".
    
    // print_r($this->cart->total());die();
    $ordData = array(
            'user_id' => $this->session->userdata('user_id'),
            'amount' => $this->cart->total(),
            'recept_no' => time().mt_rand().$this->session->userdata('user_id')
        );
   
    if(!empty($this->cart->total())){
        $insertOrder = $this->Cart_Model->insertOrder($ordData); 
    }else{
        redirect('users/orders');
    }

   
    if($insertOrder){
            // Retrieve cart data from the session
            $cartItems = $this->cart->contents();
            
            // Cart items
            $ordItemData = array();
            $i=0;
            foreach($cartItems as $item){
                $ordItemData[$i]['order_id']     = $insertOrder;
                $ordItemData[$i]['product_id']     = $item['id'];
                $ordItemData[$i]['qty']     = $item['qty'];
                $ordItemData[$i]['sub_total']     = $item["subtotal"];
                $ordItemData[$i]['user_id']     = $this->session->userdata('user_id');
                $ordItemData[$i]['pricetype']     = $item["pricetype"];
                $i++;
            }
            if(!empty($ordItemData)){
                // Insert order items
                $insertOrderItems = $this->Cart_Model->insertOrderItems($ordItemData);
                
                if($insertOrderItems){
                    // Remove items from the cart
                    $this->cart->destroy();
                    
                    // Return order ID
                    //return $insertOrder;
                }
            }
        $data['order'] = $this->User_Model->print_order($insertOrder);
        }
    
    $data['title'] = 'Place Order';
    $data['inner'] = true;    
    $data['page'] = 'cart/placeorder';
    $data['userdata'] = $this->Administrator_Model->get_user($this->session->userdata('user_id'));
    // print_r($data['order']);die();
    $this->load->view('templates/common', $data);
     
    }

    function pending_billing_view($iden){
        $id=base64_decode($iden);
    if(!$this->session->userdata('login')) {
        redirect('users/register');
    }
    
    $data['order'] = $this->User_Model->print_order($id);
    $data['title'] = 'Place Order';
    $data['inner'] = true;
    $data['page'] = 'cart/placeorder';
    $data['userdata'] = $this->Administrator_Model->get_user($this->session->userdata('user_id'));
    // print_r($data['order']);die();
    $this->load->view('templates/common', $data);
     
    }

    function pending_order_delete($iden){
        $id=base64_decode($iden);
    if(!$this->session->userdata('login')) {
        redirect('users/register');
    }
    
    $data['userdata'] = $this->Administrator_Model->delete($id,'orders');
    $data['userdata'] = $this->Cart_Model->delete_transaction_by_oid($id);
    // print_r($data['order']);die();
    redirect('users/orders');
     
    }

    
    function buypaypal($id){
        $order=$this->User_Model->print_order($id);
        // Set variables for paypal formbase64_encode ( string $data )
        $returnURL = base_url().'users/vieworder/'.base64_encode($order['oid']).'?status="success"';
        $cancelURL = base_url().'cart/cancelpaypal/'.base64_encode($order['oid']).'?status="cancel"';
        $notifyURL = base_url().'cart/ipnpaypal/'.base64_encode($order['oid']).'?status="notify"';
        
        // Get product data from the database
               
        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $order['recept_no']);
        $this->paypal_lib->add_field('custom', $this->session->userdata('user_id'));
        $this->paypal_lib->add_field('item_number',  $order['oid']);
        $this->paypal_lib->add_field('amount',  $order['amount']);
        
        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }
   
     
     function cancelpaypal($iden){
        $id=base64_decode($iden);
        // Load payment failed view
        $this->session->set_flashdata("danger","We are sorry! Your transaction was canceled.You can reorder same from your account");
    
        if(!empty($_GET['status'])=='cancel'){
            $this->User_Model->update_order_status($id,3); 
            //////////////
                $this->load->library('email');
                $htmlContent = file_get_contents(APPPATH.'views/cart/emailtemplate/cancel.html');
                $this->email->from($this->config->item('admin_email'), 'Idondza Admin');
                $this->email->to($this->session->userdata('email'));
                $this->email->subject('Cancel order at Idondza');
                $variables = array();
                $variables['admin_user'] = $this->session->userdata('name');
                // data
                
                // footer
                $variables['post_copy_year'] = date('Y');
                $variables['post_sitename'] = 'Idondza';
                $variables['post_siteemail'] = $this->config->item('admin_email');
                $variables['site_logo_img1'] = $this->config->item('logo');
                foreach($variables as $x => $value) {

                $htmlContent=str_replace($x,$value,$htmlContent);

                }
                // print_r($htmlContent);die();
                $this->email->message($htmlContent);

                $this->email->send();
            /////////////// 
            }
        redirect('cart');
     }
     
     function ipnpaypal($iden){
        $id=base64_decode($iden);
        $this->session->set_flashdata("danger","Dont worry! Your transaction is in process.Need tobe verify by admin");
        if(!empty($_GET['status'])=='notify'){
            $test=$this->User_Model->update_order_status($id,2);
            // print_r( $test);die();
            //////////////
                $this->load->library('email');
                $htmlContent = file_get_contents(APPPATH.'views/cart/emailtemplate/notify.html');
                $this->email->from($this->config->item('admin_email'), 'Idondza Admin');
                $this->email->to($this->session->userdata('email'));
                $this->email->subject('Cancel order at Idondza');
                $variables = array();
                $variables['admin_user'] = $this->session->userdata('name');
                // data
                
                // footer
                $variables['post_copy_year'] = date('Y');
                $variables['post_sitename'] = 'Idondza';
                $variables['post_siteemail'] = $this->config->item('admin_email');
                $variables['site_logo_img1'] = $this->config->item('logo');
                foreach($variables as $x => $value) {

                $htmlContent=str_replace($x,$value,$htmlContent);

                }
                // print_r($htmlContent);die();
                $this->email->message($htmlContent);

                $this->email->send();
            /////////////// 
            }
        redirect('cart');
        // Paypal posts the transaction data
        // $paypalInfo = $this->input->post();
        
        // if(!empty($paypalInfo)){
        //     // Validate and get the ipn response
        //     $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

        //     // Check whether the transaction is valid
        //     if($ipnCheck){
        //         // Insert the transaction data in the database
        //         $data['user_id']        = $paypalInfo["custom"];
        //         $data['order_id']        = $paypalInfo["item_number"];
                // $data['txn_id']            = $paypalInfo["txn_id"];
        //         $data['payment_gross']    = $paypalInfo["mc_gross"];
        //         $data['currency_code']    = $paypalInfo["mc_currency"];
        //         $data['payer_email']    = $paypalInfo["payer_email"];
        //         $data['payment_status'] = $paypalInfo["payment_status"];

        //         $this->product->insertTransaction($data);
        //     }
        // }
    }

    function updateItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
            $update = $this->cart->update($data);
        }
        
        // Return response
        echo $update?'ok':'err';
    }
    
    // function removeItem($rowid){
    //     // Remove item from cart
    //     $remove = $this->cart->remove($rowid);
        
    //     // Redirect to the cart page
    //     redirect('cart/');
    // }
    public function addToCart($proID){

        // Fetch specific product by ID
        // $product = $this->product->getRows($proID);
        if($this->input->post('subscripplan')!='issue_price'){
          $price='add_magazines.'.$this->input->post('subscripplan');  
          $price_type="sp";
      }else{
        $price='issues.issue_price';
        $price_type="ip";
      }
        
        $product = $this->Cart_Model->get_single_magazin_byID($proID,$price);
        // echo "</pre>";print_r($product);die();
        // Add product to the cart
        $data = array(
            'id'    => $product['pid'],
            'qty'    => 1,
            'price'    => $product['price'],
            'name'    => $product['issue_name'],
            'image' => $product['cover'],
            'pricetype'=>$price_type
        );
        $this->cart->insert($data);

        // Redirect to the cart page
        redirect('cart/');
        }

    function update_cart(){

        // Recieve post values,calcute them and update
        $cart_info = $_POST['cart'] ;
        foreach( $cart_info as $id => $cart)
        {
        $rowid = $cart['rowid'];
        $price = $cart['price'];
        $amount = $price * $cart['qty'];
        $qty = $cart['qty'];

        $data = array(
        'rowid' => $rowid,
        'price' => $price,
        'amount' => $amount,
        'qty' => $qty
        );

        $this->cart->update($data);
        }
        redirect('cart/');
        }

        function remove($rowid) {
            // Check rowid value.
            if ($rowid==="all"){
            // Destroy data which store in session.
            $this->cart->destroy();
            }else{
            // Destroy selected rowid in session.
            $data = array(
            'rowid' => $rowid,
            'qty' => 0
            );
            // Update cart data, after cancel.
            $this->cart->update($data);
            }

            // This will show cancel data in cart.
            redirect('cart/');
        }
    
}