<?php

class ModelModuleOcfilterAddTegs extends Model {

    public function sitemaps($param) {
        
        return $this->db->query("select 
            (select p1.value_id from oc_ocfilter_option_value_to_product p1 where p1.product_id=ppp.product_id and p1.option_id={$param[0]} limit 1) as qw12,

            (select ocvd.`name` 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value_description ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param[0]} and ocvd.language_id=1 limit 1) as qw12Name,
            (select ocvd.keyword 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param[0]} limit 1) as qw12keyword,

            (select p1.value_id from oc_ocfilter_option_value_to_product p1 where p1.product_id=ppp.product_id and p1.option_id={$param[1]} limit 1) as qw13,
            (select ocvd.`name` 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value_description ocvd on p1.value_id=ocvd.value_id  
                where p1.product_id=ppp.product_id and p1.option_id={$param[1]} and ocvd.language_id=1 limit 1) as qw13Name,
            (select ocvd.keyword 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param[1]} limit 1) as qw13keyword,

            (select p1.value_id from oc_ocfilter_option_value_to_product p1 where p1.product_id=ppp.product_id and p1.option_id={$param[2]} limit 1) as qw14,
            (select ocvd.`name` 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value_description ocvd on p1.value_id=ocvd.value_id  
                where p1.product_id=ppp.product_id and p1.option_id={$param[2]} and ocvd.language_id=1 limit 1) as qw14Name,
            (select ocvd.keyword 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param[2]} limit 1) as qw14keyword

            from oc_product ppp 
            group by qw12,qw13,qw14 
            order by qw14,qw12,qw13")->rows;
        
    }
    
    public function getListTags($param) {
        
        return $this->db->query("select 
            (select p1.value_id from oc_ocfilter_option_value_to_product p1 where p1.product_id=ppp.product_id and p1.option_id={$param['option_id1']} limit 1) as qw12,

            (select ocvd.`name` 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value_description ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param['option_id1']} and ocvd.language_id=1 limit 1) as qw12Name,
            (select ocvd.keyword 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param['option_id1']} limit 1) as qw12keyword,

            (select p1.value_id from oc_ocfilter_option_value_to_product p1 where p1.product_id=ppp.product_id and p1.option_id={$param['option_id2']} limit 1) as qw13,
            (select ocvd.`name` 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value_description ocvd on p1.value_id=ocvd.value_id  
                where p1.product_id=ppp.product_id and p1.option_id={$param['option_id2']} and ocvd.language_id=1 limit 1) as qw13Name,
            (select ocvd.keyword 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param['option_id2']} limit 1) as qw13keyword,

            (select p1.value_id from oc_ocfilter_option_value_to_product p1 where p1.product_id=ppp.product_id and p1.option_id={$param['option_id3']} limit 1) as qw14,
            (select ocvd.`name` 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value_description ocvd on p1.value_id=ocvd.value_id  
                where p1.product_id=ppp.product_id and p1.option_id={$param['option_id3']} and ocvd.language_id=1 limit 1) as qw14Name,
            (select ocvd.keyword 
                from oc_ocfilter_option_value_to_product p1 
                left join oc_ocfilter_option_value ocvd on p1.value_id=ocvd.value_id  
                where  p1.product_id=ppp.product_id and p1.option_id={$param['option_id3']} limit 1) as qw14keyword

            from oc_product ppp 
            where ppp.product_id in ({$param['sql']}) 
            group by qw12,qw13,qw14 
            order by qw14,qw12,qw13")->rows;
        
    }
    
    public function ocfilter_page($params,$category_id) {
        
        return $this->db->query("SELECT * FROM " . DB_PREFIX . "ocfilter_page where 
                params='".$this->db->escape($params)."' and status=1 and category_id='".$category_id."'")->row;    

    }

}
