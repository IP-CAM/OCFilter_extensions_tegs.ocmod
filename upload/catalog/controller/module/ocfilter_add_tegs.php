<?php

class ControllerModuleOcfilterAddTegs extends Controller {

    protected $registry;
    protected $data = array();
    private $debug = false;

    public function index() {

        $data = [];

        if (isset($this->request->get['filter_ocfilter']) && isset($this->request->get['path'])) {
            
            $data['filter_category_id'] = $this->path = $this->request->get['path'];            
            
            $this->load->model('catalog/ocfilter');
            $this->load->model('module/ocfilter_add_tegs');
            
            $product_sql = $this->model_catalog_ocfilter->getSearchSQL($this->request->get['filter_ocfilter']);
            
            $sql = "SELECT p.product_id FROM " . DB_PREFIX . 
            "product p LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (p.product_id = p2c.product_id)";

            if ($this->config->get('ocfilter_sub_category')) {
                $sql .= " LEFT JOIN " . DB_PREFIX . "category_path cp ON (p2c.category_id = cp.category_id)";
            }

            if ($product_sql && $product_sql->join) {
                $sql .= $product_sql->join;
            }

            $sql .= " WHERE p.status = '1'";

            if ($this->config->get('ocfilter_sub_category')) {
                $sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";
            } else {
                $sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";
            }

            if ($product_sql && $product_sql->where) {
                $sql .= $product_sql->where;
            }

            $sql .= " GROUP BY p.product_id";
            
            $_data_ = [];
            $_data_['sql'] = $sql;
            
            if($data['filter_category_id'] == 59){
                $_data_['option_id1'] = 10012;
                $_data_['option_id2'] = 10013;
                $_data_['option_id3'] = 10014;                
            }else{                
                $_data_['option_id1'] = 10043;
                $_data_['option_id2'] = 10044;
                $_data_['option_id3'] = 10045;
            }
            
            $data['ocfilter_tegs'] = [];
            
            $rows = $this->model_module_ocfilter_add_tegs->getListTags($_data_);
            
            $this->getHref($data['ocfilter_add_tegs_groups'], $rows, $data['filter_category_id']);
            
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/ocfilter_add_tegs.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/module/ocfilter_add_tegs.tpl', $data);
            } else {
                return $this->load->view('default/template/module/ocfilter_add_tegs.tpl', $data);
            }
        }
    }

    public function sitemaps() {
        
        $this->load->language('information/sitemap');

        //Title
		$this->document->setTitle('Все размеры шин');
        
        //Description
        $this->document->setDescription('Карта сайта - все размеры шин. Большой выбор производителей с гарантией. Вежливое обслуживание. Доставка по всей Украине (Киев, Харьков, Днепр, Одесса) &#128666; Возможна рассрочка. &#9742; Звони уже сейчас (093) 002-95-16; (099) 097-86-70; (068) 111-03-54');
        
        //H1
		$data['heading_title'] = 'Карта сайта - все размеры шин';
        
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/sitemap')
		);

		$data['text_special'] = $this->language->get('text_special');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_history'] = $this->language->get('text_history');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_cart'] = $this->language->get('text_cart');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_search'] = $this->language->get('text_search');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_contact'] = $this->language->get('text_contact');
        
        $data['ocfilter_add_tegs_groups'] = [];
        
        $this->load->model('module/ocfilter_add_tegs');
        
        $ocfilter_add_tegs = [];
        
        $ocfilter_add_tegs = $categories=$this->cache->get('ocfilter_add_tegs');
        
        if($ocfilter_add_tegs){
            
            $data['ocfilter_add_tegs_groups'] = $ocfilter_add_tegs;
            
        }else{
        
            $rows = $this->model_module_ocfilter_add_tegs->sitemaps([10012,10013,10014]);

            $this->getHref($data['ocfilter_add_tegs_groups'], $rows, 59);

//            $rows = $this->model_module_ocfilter_add_tegs->sitemaps([10043,10044,10045]);
//
//            $this->getHref($data['ocfilter_add_tegs_groups'], $rows, 64);
            
            $categories = $this->cache->set('ocfilter_add_tegs', $data['ocfilter_add_tegs_groups']);
            
        }
        
        $data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/ocfilter_add_tegs_sitemap.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/ocfilter_add_tegs_sitemap.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/module/ocfilter_add_tegs_sitemap.tpl', $data));
		}
        
    }
    
    protected function getHref(&$ocfilter_add_tegs_groups, $rows, $category_id) { 
        
        $href = $this->url->link('product/category', 'path='.$category_id , true);
        
        $row1 =[];
        $row3 =[];
        foreach ($rows as $row) {
            if($row['qw12Name'] != '' && $row['qw13Name'] != '' && $row['qw14Name'] != ''){
                $row1[] = $row['qw14Name'];
                
                $name = 
                    (($row['qw12keyword'] != "0")?$row['qw12Name']:"").
                    (($row['qw13keyword'] != "0")?'/'.$row['qw13Name']:"").
                    (($row['qw12keyword'] != "0")?' R'.$row['qw14Name']:"");
                
                $row3[$row['qw14Name']][$name] = $name;
                
                $params =   (($row['qw12keyword'] != "0")?'shirina/'.$row['qw12keyword']:"").
                            (($row['qw13keyword'] != "0")?'/vysota/'.$row['qw13keyword']:"").
                            (($row['qw14keyword'] != "0")?'/diametr/'.$row['qw14keyword']:"");
                
                if($params1 = $this->model_module_ocfilter_add_tegs->ocfilter_page($params, $category_id)){
                    $params = $params1['keyword'];
                }
                
                $row2[$row['qw14Name']][$name] = [
                    'name' => $name,
                    'href' => $href . $params .'/'
                ];
            }
        }
        
        sort($row1);
        
        foreach ($row1 as $row1_) {
           
           sort($row3[$row1_]);
           
           foreach ($row3[$row1_] as $row3_) {
               
               $ocfilter_add_tegs_groups[$row1_][$row3_] = $row2[$row1_][$row3_];
               
           }
        }
        
    }

}
