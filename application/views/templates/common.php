<?php
    $this->load->model('Administrator_Model');
    $data['country'] = $this->Administrator_Model->getcountry();
	if(isset($inner)){
		$this->load->view('templates/header-front-inner', $data);
	}else{

		$this->load->view('templates/header-front', $data);
	}?>
    <style type="text/css">
    
    .page {
    margin-bottom: 5% !important;
    margin-top: -5% !important;
    width: 300px;
    margin: 0 auto;
}
.errorbox{
    margin-bottom: 5% !important;
    margin-top: -5% !important;
    width: 800px;
    margin: 0 auto;
}
.fade.in {
    opacity: 1;
}
.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.alert-danger {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.alert-dismissable, .alert-dismissible {
    padding-right: 35px;
}
.alert {
    padding: 15px;
        padding-right: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
        border-top-color: transparent;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
    border-radius: 4px;
}
.fade {
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear;
}

</style>
    <?php
	if($this->session->flashdata('success')): 
       echo '<div class="alert alert-success icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Success! &nbsp;&nbsp;</strong>'.$this->session->flashdata('success').'</p></div>'; 
    endif; 
  if($this->session->flashdata('danger')):
      echo '<div class="alert alert-danger icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Error! &nbsp;&nbsp;</strong>'.$this->session->flashdata('danger').'</p></div>'; 
     endif; 
    
	 if(validation_errors() != null):
      echo '<div class="alert alert-warning icons-alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="icofont icofont-close-line-circled"></i>
                </button>
                <p><strong>Alert! &nbsp;&nbsp;</strong>'.validation_errors().'</p></div>';
     endif; 
	$this->load->view($page);
	$this->load->model('Pages_Model');
    $data['country'] = $this->Administrator_Model->getcountry();
	$data['customepage'] = $this->Pages_Model->get_categories(); 
	$data['contact'] = $this->Administrator_Model->get_siteconfiguration(1); 
	$this->load->view('templates/footer-front',$data);
?>

