<?php

class Content {
    private $data = [];
    private $data_json = '';
    private $path = '';
    private $file_name = '';
    
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }
    
    private function get_path() {
        $this->path = $_SERVER['DOCUMENT_ROOT']."/data/$this->file_name";
    }
    
    private function get_json_content() {
        $this->get_path();
        $this->data_json = file_get_contents($this->path);
    }
    
    private function decode() {
        $this->data = json_decode($this->data_json, true);
    }
    
    public function get_data() {    
        $this->get_json_content();
        $this->decode();
        return $this->data;
    }
}