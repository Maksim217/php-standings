<?php 

class Sort {
    
    private $data = [];
    private $sort_data = [];
    private $sort_type = '';
    
    public function __construct($data, $sort_type)
    {
        $this->data = $data;
        $this->sort_type = $sort_type;
    }
    
    public function sort_data() {
        switch ($this->sort_type) {
            case 'total_amount':
                usort($this->data, function($item1, $item2) {
                    return $item2['total_result'] <=> $item1['total_result'];
                });
                break;
            case 'attempt_1':
                usort($this->data, function($item1, $item2) {
                    return $item2['attempts'][1] <=> $item1['attempts'][1];
                });
                break;
            case 'attempt_2':
                usort($this->data, function($item1, $item2) {
                    return $item2['attempts'][2] <=> $item1['attempts'][2];
                });
                break;
            case 'attempt_3':
                usort($this->data, function($item1, $item2) {
                    return $item2['attempts'][3] <=> $item1['attempts'][3];
                });
                break;
            case 'attempt_4':
                usort($this->data, function($item1, $item2) {
                    return $item2['attempts'][4] <=> $item1['attempts'][4];
                });
                break;
            default:
                usort($this->data, function($item1, $item2) {
                    return $item2['total_result'] <=> $item1['total_result'];
                });
        }
        $this->sort_data = $this->data;
        return $this->sort_data;
    }
}