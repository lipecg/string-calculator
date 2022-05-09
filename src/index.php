<?php 
class Calculator {
	
    /**
     * This method takes a string numbers, validates and filter it 
     * after some conditions and returns sum of the numbers
     *  
     * @param string $numbers
     * @return int
     */ 
    public function add(string $numbers) : int
    { 
        if(empty($numbers)){
            return 0;
        }
        $validateNum    = $this->validateNumbers($numbers); 
        $filterNum      = $this->filterNumbers($validateNum); 

        $total = array_sum($filterNum);
        return $total;
    }

    /**
     * This method validates the string numbers 
     * by removing unwanted string and spliting by common delimiter
     * and returning only numbers from the string
     *  
     * @param string $numbers
     * @return array
     */
    private function validateNumbers(string $numbers) : array
    {   
        $sanitizeNumbers        = preg_replace('/[\\\a-z\/s]/', '', $numbers);  
        $splitNumberByDelimiter = preg_split("/[!#$%&*+,.:;=?@^_`|~]/" , $sanitizeNumbers);  
        $numbers                = preg_grep( '/[0-9]/' , $splitNumberByDelimiter);  

        return $numbers;
    }  

    /**
     * This method filters the validated numbers by
     * checking if the numbers are not negative and 
     * under thousand range
     *  
     * @param array $numbers
     * @return array
     */
    private function filterNumbers(array $numbers) : array
    {
        $negativeNumbers    = [];
        $filterNumbers      = [];
         
        foreach($numbers as $num)
        {
            if($num < 0){
                $negativeNumbers[]  = $num;
            } 
            if($num < 1000){
                $filterNumbers[]    = $num;
            }
        } 
        $this->checkNegativeNumbers($negativeNumbers);
        return $filterNumbers;
    }
    
    /**
     * This method throws an exception if there are any negative numbers
     *  
     * @param array $negativeNumbers
     * @return Exception
     */
    private function checkNegativeNumbers(array $negativeNumbers){
       
        if(count($negativeNumbers) > 0)
        {  
            $negativeNumbers = implode(',', $negativeNumbers);
            throw new Exception(
                $negativeNumbers.' Negatives not allowed'
            );
        }
    }
}

?>