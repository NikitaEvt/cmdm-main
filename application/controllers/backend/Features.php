<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Features extends BackEndController
{
    protected $add;
    protected $index_title;
    protected $title;
    protected $success_add;
    protected $success_update_order;
    protected $success_edit;
    protected $success_delete;

    public function __construct()
    {
        parent::__construct(__CLASS__);

        // if($this->data['admin']->type == 'manager') throw_on_404();

        $this->add = 'Добавить текстовую страницу';
        $this->index_title = 'Верхнее меню';
        $this->success_add = 'Вы успешно добавили новую текстовую страницу!';
        $this->success_update_order = 'Вы успешно обновили порядок отображения!';
        $this->success_edit = 'Вы успешно обновили текстовую страницу!';
        $this->success_delete = 'Вы успешно удалили текстовую страницу!';

        $this->data['title'] = $this->index_title;
        $this->data['add'] = $this->add;

    }

    public function index() {
        $this->load->model('shop_type_model');
        // $this->data['types'] = $this->shop_type_model->find();
        $this->data['types'] = $this->db->order_by('id DESC')->get('shop_type')->result();
        $this->data['type'] = null;
        $type_id = null;

        $get = $this->input->get();
        $active = isset($get['type']) ? $get['type'] : false;
        if(is_numeric($active)) {
            if(!$this->shop_type_model->findFirst($active)) {
                throw_on_404();
            }
        }

        foreach($this->data['types'] as &$type) {
            if(isset($active) && !$active) {
                $type->active = 1;
                $this->data['type'] = $type;
                $type_id = $type->id;
                unset($active);
            } else {
                if(isset($active) && $active == $type->id) {
                    $type->active = 1;
                    $this->data['type'] = $type;
                    $type_id = $type->id;
                } else {
                    $type->active = 0;
                }
            }
        }

        //***********  get features ************//
        $this->load->model('shop_feature_model');
        $this->data['features'] = $this->shop_feature_model->features($type_id, true);

        $this->data['inner_view'] = $this->index_view;
        $this->data['objects'] = null;//$objects;

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function update_order()
    {
        check_if_POST();

        try {
            $post = $this->input->post('so');

            if (empty($post) || !is_array($post)) {
                throw new Exception('Ошибка в полученных данных!');
            }

            if (!$this->example_model->update_sorder($post)) {
                throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
            }

            $_SESSION['success'] = $this->success_update_order;
        } catch (Exception $e) {
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }

    public function item($id = 0)
    {
        $id = (int)$id;

        init_load_img($this->main_page);

        $item = $this->example_model->findFirst($id);

        if (empty($item)) throw_on_404();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                foreach ($_POST as $index => $post_data) {
                    $post[$index] = $this->input->post($index);
                }

                if (!empty($_FILES['img']['name'])) {
                    unlink_img($this->main_page, $item->img);
                    $this->upload->do_upload('img');
                    $file_data = $this->upload->data();
                    $file = $file_data['file_name'];

                    $file_types = array('.jpg', '.jpeg', '.gif', '.png');

                    if (in_array(strtolower($file_data['file_ext']), $file_types)) {
                        $post['img'] = $file;
                    }
                }

                if (!$this->example_model->update($post, $id)) {
                    throw new Exception('Ошибка записи данных в таблицу: ' . $this->main_page);
                }

                $_SESSION['success'] = $this->success_edit;
            } catch (Exception $e) {
                log_message('error', $e->getMessage());
                $errors[] = 'Выброшено исключение : ' . $e->getMessage();
                $_SESSION['error'] = $errors;
            }

            $item = $this->example_model->findFirst($id);
        }

        $this->data['inner_view'] = $this->item_view;
        $this->data['title'] = 'Редактирование ' . $item->titleRU;
        $this->data['parent_url'] = $this->path;
        $this->data['parent_title'] = $this->index_title;
        $this->data['item'] = $item;

        $this->load->vars($this->data);
        $this->load->view($this->main_layout);
    }

    public function delete($id = false)
    {
        $id = (int)$id;

        $item = $this->example_model->findFirst($id);
        unlink_img($this->main_page, $item->img);

        if (empty($item)) throw_on_404();

        try {
            if (!$this->example_model->delete($id)) {
                throw new Exception('Ошибка удаления данных из таблицы: ' . $this->main_page);
            }
            $_SESSION['success'] = $this->success_delete;
        } catch (Exception $e) {
            $errors[] = 'Выброшено исключение : ' . $e->getMessage();
            $_SESSION['error'] = $errors;
        }

        redirect($this->path);
    }
}