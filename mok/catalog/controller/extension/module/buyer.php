<?php
class ControllerExtensionModuleBuyer extends Controller {
	public function index() {
		$this->load->language('extension/module/buyer');

        $this->load->model('weixin/buyer');

        $this->load->model('extension/module/buyer');

		$this->load->model('tool/image');

        $data['module_title'] = $this->language->get('module_title');

        $res = $this->model_extension_module_buyer->getAllBuyerBlogs();

        $data['buyers'] = array();
		if($res){

			foreach($res as $row){

                $buyer_info =  $this->model_extension_module_buyer->getBuyerInfo($row['buyer_info_id']);

                if ($this->customer->isLogged()) {
                    $is_attention =  $this->model_weixin_buyer->is_attention($row['user_id']);
                }else{
                    $is_attention = 2;
                }

                if(isset($buyer_info['head_image']) && $buyer_info['head_image']){
                    $head_image = $this->model_tool_image->resize($buyer_info['head_image'], 58, 58);
                }else{
                    $head_image =$this->model_tool_image->resize('no_image.png', 58, 58);
                }

                if(isset($buyer_info['nickname']) && $buyer_info['nickname']){
                    $nickname = $buyer_info['nickname'];
                }else{
                    $nickname = '';
                }

                if(isset($buyer_info['intro']) && $buyer_info['intro']){
                    $intro = $buyer_info['intro'];
                }else{
                    $intro = '';
                }

                if($row['image']){
                    $show_image = $this->model_tool_image->resize($row['image'], 750, 420);
                }else{
                    $show_image = $this->model_tool_image->resize('no_image.png', 750, 420);
                }

                $year_time = 60*60*24*365;

                $month_time = 60*60*24*30;

                $day_time = 60*60*24;

                $hour_time = 60*60;

                $minute_time = 60;

                $publish_time = strtotime( $row['add_date']);

                $now_time = time();

                if($now_time - $publish_time > $year_time){
                    $date = ($now_time - $publish_time)/$year_time;
                    $show_time = floor($date).$this->language->get('year_time');
                }else if($now_time - $publish_time > $month_time){
                    $date = ($now_time - $publish_time)/$month_time;
                    $show_time = floor($date).$this->language->get('month_time');
                }else if($now_time - $publish_time > $day_time){
                    $date = ($now_time - $publish_time)/$day_time;
                    $show_time = floor($date).$this->language->get('day_time');
                }else if($now_time - $publish_time >$hour_time){
                    $date = ($now_time - $publish_time)/$hour_time;
                    $show_time = floor($date).$this->language->get('hour_time');
                }else if($now_time - $publish_time >$minute_time){
                    $date = ($now_time - $publish_time)/$minute_time;
                    $show_time = floor($date).$this->language->get('minute_time');
                }else{
                    $show_time = $this->language->get('just_now_time');
                }


				$data['buyers'][] = array(
				    'is_attention' => $is_attention,
				    'buyer_id' => $row['buyer_info_id'],
                    'buyer_href' => $this->url->link('weixin/buyer', 'buyer_id=' .$row['buyer_info_id']),
				    'nickname' => $nickname,
                    'intro'    => $intro,
                    'head_image' => $head_image,
					'href' =>  $this->url->link('product/product', 'product_id=' .$row['product_id'] , true),
					'src' => $show_image,
					'title' => $row['title'],
                    'date' => $show_time
				);
			}
		}

		return $this->load->view('extension/module/buyer', $data);
	}
}