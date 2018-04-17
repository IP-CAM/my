<?php
/**
 * Created by PhpStorm.
 * User: me
 * Date: 2016/12/7
 * Time: 9:38
 */
class ControllerApiUploadify extends Controller {
    public function video(){
        // Define a destination
        $this->load->language('api/uploadify');

        //$verifyToken = md5('unique_salt' . $_POST['timestamp']);

        $targetFolder = '/resource/videos'; // Relative to the root

        $allowSize = 200*1024*1024;

        $ini_post_size = (int)ini_get('post_max_size')*1024*1024;

        $ini_upload_size = (int)ini_get('upload_max_filesize')*1024*1024;

        $ini_is_upload = ini_get('file_uploads');

        $fileTypes =  array('flv' , 'wmv' , 'rmvb' , 'mp4' , 'avi' , 'wma' , 'rm' , 'flash' ,'3GP'); // File extensions

        if (!empty($_FILES)) {

            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $fileName = str_replace('.','-'.time().'.',$_FILES['Filedata']['name']);
            $targetFile = rtrim($targetPath,'/') . '/' . $fileName;

            $fileParts = pathinfo($_FILES['Filedata']['name']);

            if($_FILES['Filedata']['size'] > $allowSize){
                echo $this->language->get('error_size');exit;
            }

            if (in_array($fileParts['extension'],$fileTypes)) {

                if(move_uploaded_file($tempFile,$targetFile)){

                    echo '/resource/videos/'.$fileName;

                }else{
                    
                    echo 'move failed';
                }

            } else {
                echo $this->language->get('error_type');
            }
        }
    }

    public function delete_video(){
        $this->load->language('api/uploadify');

        $type = $this->request->post['type'];

        $information_id = $this->request->post['information_id'];

        $video_info = $this->request->post['video_info'];

        if($type == 'blog'){
            $this->load->model('cms/blog');

            $res=$this->model_cms_blog->removeVideo($information_id);
        }
        if($type == 'information'){
            $this->load->model('catalog/information');
            $res=$this->model_catalog_information->delete_information_video($information_id,$video_info);
        }
        if($res){
            $return_res = $this->language->get('error_success');
        }else{
            $return_res = $this->language->get('error_fail');
        }
        echo json_encode($return_res);
    }

}