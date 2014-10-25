<?php
/**
* Item per package for OpenCart (ocStore) 1.5.x.x
* @author Ury Koss <yula.firm@gmail.com>
*
*/

class ControllerModuleBuypack extends Controller {

	public function index(){

		$this->language->load('module/buypack');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('buypack', $this->request->post);		

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}		

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_description'] = $this->language->get('text_description');
		
		$this->data['entry_status'] = $this->language->get('entry_status');		
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->request->post['buypack_status'])) {
			$this->data['buypack_status'] = $this->request->post['buypack_status'];
		} elseif ($this->config->get('buypack_status')) { 
			$this->data['buypack_status'] = $this->config->get('buypack_status');
		} else {
			$this->data['buypack_status'] = '';
		}		
		
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/buypack', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);
		
		$this->data['action'] = $this->url->link('module/buypack', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->template = 'module/buypack.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}	
	
	public function install() {
		$this->load->model('catalog/buypack');
		$this->load->model('setting/setting');
		
		$this->model_catalog_buypack->install();
		$setting = array(
			'buypack_status' => 1
		);
		$this->model_setting_setting->editSetting('buypack', $setting);
	}

	public function uninstall() {
		$this->load->model('catalog/buypack');
		$this->load->model('setting/setting');
		
		$this->model_catalog_buypack->uninstall();
		$this->model_setting_setting->deleteSetting('buypack');
	}
	
	protected function validate() {
		if (! $this->user->hasPermission('modify', 'module/buypack')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}	
}