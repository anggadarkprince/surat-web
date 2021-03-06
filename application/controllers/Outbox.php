<?php

/**
 * Created by PhpStorm.
 * User: Angga
 * Date: 10/25/2015
 * Time: 11:25 AM
 */
class Outbox extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model("Outbox_model", "outbox_model");
        $this->load->model("User_model", "user_model");
        $this->load->model("Label_model", "label_model");
        if(!User_model::is_authorize(User_model::$TYPE_ADM) && !User_model::is_authorize(User_model::$TYPE_DEV))
        {
            redirect("login");
        }
        if($this->session->userdata(User_model::$SESSION_LOCK) != null){
            redirect("lockscreen");
        }
    }

    public function index()
    {
        $data = [
            'title' => "Outbox",
            'page' => "outbox/outbox",
            'inbox' => $this->outbox_model->read()
        ];
        $this->load->view('templates/template', $data);
    }

    public function create()
    {
        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->form_validation->set_rules('no_agenda', 'No Agenda', 'trim|required');
            $this->form_validation->set_rules('no_mail', 'No Surat', 'trim|required');
            $this->form_validation->set_rules('subject', 'Perihal', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('mail_date', 'Tanggal Surat', 'trim|required');
            $this->form_validation->set_rules('from', 'Dari', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('to', 'Kepada', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('description', 'Description', 'min_length[0]');
            $this->form_validation->set_rules('label', 'Label', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $data = [
                    "operation" => "warning",
                    "message" => validation_errors()
                ];
            }
            else
            {
                $data = [
                    'subject' => $this->input->post('subject'),
                    'agenda_number' => $this->input->post('no_agenda'),
                    'mail_number' => $this->input->post('no_mail'),
                    'mail_date' => date_format(date_create($this->input->post('mail_date')), "Y-m-d"),
                    'from' => $this->input->post('from'),
                    'to' => $this->input->post('to'),
                    'description' => $this->input->post('description'),
                    'label_id' => $this->input->post('label'),
                    'user_id' => $this->session->userdata(User_model::$SESSION_ID),
                ];

                $result = $this->outbox_model->create($data);
                if(isset($result["upload"]) && !$result["upload"]){
                    $data = [
                        "operation" => "warning",
                        "message" => $result["message"]
                    ];
                }
                else if($result["query"]){
                    $this->session->set_flashdata("operation", "success");
                    $this->session->set_flashdata("message", "<strong>In-mail</strong> successfully created");
                    redirect("outbox");
                    return;
                }
                else{
                    $data = [
                        "operation" => "warning",
                        "message" => "Something is getting wrong",
                    ];
                }
            }
        }
        $data['title'] = "Create Out-mail";
        $data['page'] = "outbox/create";
        $data['next'] = $this->outbox_model->next_id();
        $data['labels'] = $this->label_model->read();
        $this->load->view('templates/template', $data);
    }

    public function edit($id = null)
    {
        $data = [
            'title' => "Edit Out-mail",
            'page' => "outbox/edit",
            'labels' => $this->label_model->read(),
            'mail' => $this->outbox_model->read($id),
            'attachment_original' => $this->outbox_model->read_attachment($id, 'ORIGINAL')
        ];
        $this->load->view('templates/template', $data);
    }

    public function update($id)
    {
        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->form_validation->set_rules('id', 'Mail ID unavailable', 'trim|required');
            $this->form_validation->set_rules('no_agenda', 'No Agenda', 'trim|required');
            $this->form_validation->set_rules('subject', 'Perihal', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('mail_date', 'Tanggal Surat', 'trim|required');
            $this->form_validation->set_rules('from', 'Dari', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('to', 'Kepada', 'trim|required|max_length[300]');
            $this->form_validation->set_rules('description', 'Description', 'min_length[0]');
            $this->form_validation->set_rules('label', 'Label', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $data = [
                    "operation" => "warning",
                    "message" => validation_errors()
                ];
            }
            else
            {
                $data = [
                    'subject' => $this->input->post('subject'),
                    'agenda_number' => $this->input->post('no_agenda'),
                    'mail_number' => $this->input->post('no_mail'),
                    'mail_date' => date_format(date_create($this->input->post('mail_date')), "Y-m-d"),
                    'from' => $this->input->post('from'),
                    'to' => $this->input->post('to'),
                    'description' => $this->input->post('description'),
                    'label_id' => $this->input->post('label'),
                    'user_id' => $this->session->userdata(User_model::$SESSION_ID),
                ];

                $result = $this->outbox_model->update($data, $this->input->post("id"));
                if(isset($result["upload"]) && !$result["upload"]){
                    $data = [
                        "operation" => "warning",
                        "message" => $result["message"]
                    ];
                }
                else if($result["query"]){
                    $this->session->set_flashdata("operation", "success");
                    $this->session->set_flashdata("message", "<strong>Out-mail</strong> successfully updated");
                    redirect("outbox");
                    return;
                }
                else{
                    $data = [
                        "operation" => "warning",
                        "message" => "Something is getting wrong",
                    ];
                }
            }
        }
        $data['title'] = "Edit Out-mail";
        $data['page'] = "outbox/edit";
        $data['labels'] = $this->label_model->read();
        $data['mail'] = $this->outbox_model->read($id);
        $this->load->view('templates/template', $data);
    }

    public function show($id = null)
    {
        $data = [
            'title' => "Detail Out-mail",
            'page' => "outbox/show",
            'mail' => $this->outbox_model->read($id),
            'attachment_original' => $this->outbox_model->read_attachment($id, 'ORIGINAL')
        ];
        $this->load->view('templates/template', $data);
    }

    public function delete($id, $redirect = null)
    {
        $result = $this->outbox_model->delete($id);
        if($result){
            $this->session->set_flashdata("operation", "warning");
            $this->session->set_flashdata("message", "Out-mail successfully deleted");
        }
        else{
            $this->session->set_flashdata("operation", "danger");
            $this->session->set_flashdata("message", "Something is getting wrong");
        }
        if($redirect != null){
            redirect($redirect);
        }
        else{
            redirect("outbox");
        }
    }

    public function delete_attachment($id, $mail)
    {
        $result = $this->outbox_model->delete_attachment($id);
        if($result){
            $this->session->set_flashdata("operation", "warning");
            $this->session->set_flashdata("message", "<strong>Attachment</strong> successfully deleted");
        }
        else{
            $this->session->set_flashdata("operation", "danger");
            $this->session->set_flashdata("message", "Something is getting wrong");
        }
        redirect("outbox/edit/".$mail);
    }
}