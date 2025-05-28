<?php


namespace Austro\Crm;


class ServiceResponse
{
    public array $filter;
    public array $data;
    public int $page;
    public int $per_page;
    public int $total_records;
    public bool $has_more_pages;
    public string $message;
    public string $error;
    public bool $status;
    public int $status_code;
    public $type;
    public $meta_data;

    public function __construct(array $inputData = [])
    {
        $this->type = array_key_exists('type', $inputData) ? $inputData['type'] : null;
        $this->filter = array_key_exists('filter', $inputData) ? $inputData['filter'] : [];
        $this->data = array_key_exists('data', $inputData) ? $inputData['data'] : [];
        $this->page = array_key_exists('page', $inputData) ? $inputData['page'] : 1;
        $this->per_page = array_key_exists('per_page', $inputData) ? $inputData['per_page'] : -1;
        $this->total_records = array_key_exists('total_records', $inputData) ? $inputData['total_records'] : -1;
        $this->has_more_pages = array_key_exists('has_more_pages', $inputData) ? $inputData['has_more_pages'] : false;
        $this->message = array_key_exists('message', $inputData) ? $inputData['message'] : '';
        $this->error = array_key_exists('error', $inputData) ? $inputData['error'] : '';
        $this->status = array_key_exists('status', $inputData) ? $inputData['status'] : false;
        $this->status_code = array_key_exists('status_code', $inputData) ? $inputData['status_code'] : 500;
        $this->meta_data = array_key_exists('meta_data', $inputData) ? $inputData['meta_data'] : null;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }
}
