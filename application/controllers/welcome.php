<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function cobra_cliente(){

		require_once("lib/Conekta.php");
		Conekta::setApiKey("key_uexJEsPgPzz55V4HzYugow");// Llave Privada Conekta

		try {
		  $charge = Conekta_Charge::create(array(
		    "amount"=> 31000,
		    "currency"=> "MXN",
		    "description"=> "Pizza Delivery",
		    "reference_id"=> "orden_de_id_interno",
		    "card"=> "tok_test_visa_4242",// $_POST['conektaTokenId'],
		    "details"=> array(
		      "email"=>"logan@x-men.org",
		      "line_items"=> array(
		        array(
		          "name"=>"Box of Cohiba S1s",
		          "sku"=>"cohb_s1",
		          "unit_price"=> 31000,
		          "description"=>"Imported from Mex.",
		          "quantity"=> 2,
		          "type"=>"pizza-purchase"
		        )
		      )
		    )
		  ));
		} catch (Conekta_Error $e){
		  echo $e->getMessage(); //el pago no pudo ser procesado
		}

		$this->consultas();


	}

	// Consulta de Cargos
	public function consultas(){

		require_once("lib/Conekta.php");
		Conekta::setApiKey("key_uexJEsPgPzz55V4HzYugow");// Llave Privada Conekta

		$charges = Conekta_Charge::where(array(
		  	'status.ne' => 'paid',
		  	'sort' => 'created_at.desc'
		  ));
		
		echo $charges;


	}	



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */