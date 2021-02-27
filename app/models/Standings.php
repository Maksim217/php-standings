<?php

class Standings {
    private $attempts_cars_result = [];
    private $result_data = [];
    private $cars = [];
    private $attempts = [];
    
    public function __construct($cars, $attempts)
    {
        $this->cars = $cars;
        $this->attempts = $attempts;
    }
    
    private function get_result_attempts() {
        foreach ($this->cars as $car_key => $car_val) {
            $attempt_number = 1;
            foreach ($this->attempts as $attemp_key => $attempt_val) {
                if($car_val['id'] === $attempt_val['id']) {
                    if($this->attempts_cars_result[$car_key]) {
                        $attempt_number++;
                        $this->attempts_cars_result[$car_key]['total_result'] += $attempt_val['result'];
                        $this->attempts_cars_result[$car_key]['attempts'] += array($attempt_number => $attempt_val['result']);
                    } else {
                       $this->attempts_cars_result[$car_key] = array(
                                'id' => $attempt_val['id'], 
                                'total_result' => $attempt_val['result'], 
                                'attempts' => array($attempt_number => $attempt_val['result'])
                            ); 
                    }
                }
                
            }
        }
    }
    
    private function merge_data() {
        $this->get_result_attempts();
        
        $cars_keys = array_column($this->cars, null, 'id');
        $attempts_keys = array_column($this->attempts_cars_result, null, 'id');
        
        $this->result_data = array_values(array_replace_recursive($cars_keys, $attempts_keys));
    }
    
    public function get_data() {
        $this->merge_data();
        return $this->result_data;
    }
    
}