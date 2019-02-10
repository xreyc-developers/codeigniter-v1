<?php
class Faqs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('faqs_model');
        $this->load->helper('url_helper');
    }

    public function index(){

        /* $data['ss'] = 'ss'; is scope */
        $data['faqs'] = $this->faqs_model->get_faqs();
        $data['title'] = 'Faqs archive';
        
        $this->load->view('templates/header', $data);
        $this->load->view('faqs/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL) {
        $data['faqs_item'] = $this->faqs_model->get_faqs($slug);
        if (empty($data['faqs_item'])){
            show_404();
        }
        $data['title'] = $data['faqs_item']['title'];

        $this->load->view('templates/header', $data);
        $this->load->view('faqs/view', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Create a FAQ item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('faqs/create');
            $this->load->view('templates/footer');
        } else {
            $this->faqs_model->set_faqs();
            $this->load->view('templates/header', $data);
            $this->load->view('faqs/success');
            $this->load->view('templates/footer');
        }
    }


    public function edit() {
        $id = $this->uri->segment(3);
        if (empty($id)) {
            show_404();
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'Edit a faqs item';
        $data['faqs_item'] = $this->faqs_model->get_faqs_by_id($id);

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('faqs/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->faqs_model->set_faqs($id);
            redirect( base_url() . 'index.php/faqs');
        }
    }


    public function delete() {
        $id = $this->uri->segment(3);
        if (empty($id)) {
            show_404();
        }
        $faqs_item = $this->faqs_model->get_faqs_by_id($id);
        $this->faqs_model->delete_faqs($id);
        redirect( base_url() . 'index.php/faqs');
    }
}