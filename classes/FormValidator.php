<?php 


// klasa walidująca uzupełnione pola w formularzu

class FormValidator {

  private $data;
  private $errors = [];
  private static $fields = ['imie','nazwisko','email','telefon', 'tresc'];

  public function __construct($post_data){
    $this->data = $post_data;
  }

  public function validateForm(){

    foreach(self::$fields as $field){
      if(!array_key_exists($field, $this->data)){
        trigger_error("brak zmiennej o nazwie - '$field'");
        return;
      }
    }

    $this->validateImie();
    $this->validateNazwisko();
    $this->validateTelefon();
    $this->validateEmail();
    $this->validateTresc();

    return $this->errors;

  }

  private function validateImie(){

    $val = trim($this->data['imie']);

    if(empty($val)){
      $this->addError('imie', 'Pole imię nie może być puste');
    } 

  }

  private function validateNazwisko(){

    $val = trim($this->data['nazwisko']);

    if(empty($val)){
      $this->addError('nazwisko', 'Pole nazwisko nie może być puste');
    } 

  }

  private function validateTelefon(){

    $val = trim($this->data['telefon']);

    if(empty($val)){
      $this->addError('telefon', 'Pole telefon nie może być puste');
    }  else {
      if(!preg_match('/^[0-9]{9}$/', $val)){
        $this->addError('telefon','Telefon musi zawierać 9 cyfr');
      }
    } 

  }

  private function validateEmail(){

    $val = trim($this->data['email']);

    if(empty($val)){
      $this->addError('email', 'Pole email nie może być puste');
    } else {
      if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
        $this->addError('email', 'Nieprawidłowy format adresu email');
      }
    }

  }

  private function validateTresc(){

    $val = trim($this->data['tresc']);

    if(empty($val)){
      $this->addError('tresc', 'Pole treść nie może być puste');
    } 

  }

  private function addError($key, $val){
    $this->errors[$key] = $val;
  }

}

?>