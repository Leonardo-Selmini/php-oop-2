<?php

// 00000000 CLASSES
  class User {
    protected $username;
    protected $password;
    protected $email;
    protected $creditCards = [];
    public $shoppingCart = [];

    public function __construct($_username, $_password, $_email){
      $this -> username = $_username;
      $this -> password = $_password;
      $this -> email = $_email;
    }

    public function addToCart($_product){
      array_push($this -> shoppingCart, $_product);
    }

    public function addCard($_card){
      if (in_array($_card, $this -> creditCards)) {
        throw new Exception('Duplicate Card');
      } else { 
        array_push($this -> creditCards, $_card);
      }
    }
  }

  class UserPremium extends User {
    protected $premium = true;
    protected $level = 0;
    protected $discount = 0;

    public function __construct($_username, $_password, $_email){
      $this -> username = $_username;
      $this -> password = $_password;
      $this -> email = $_email;
    }

    public function setLevelAndDiscount($_lvl){
      $this -> level = $_lvl;
      $this -> discount = $_lvl * 10;
    }
  }

  class Product {
    public $name;
    public $price;

    public function __construct($_name, $_price){
      $this -> name = $_name;
      $this -> price = $_price;
    }
  }

  class CreditCard {
    private $circuit;
    private $number;
    private $date;
    private $cvv;

    public function __construct($_circuit){
      $this -> circuit = $_circuit;
    }

    public function setCard($_num, $_date, $_cvv){
      if(strlen((string)abs($_num)) == 16){
        $this -> number = $_num;
      } else {
        $this -> number = null;
      }
      if(strlen((string)abs($_cvv)) == 3){
        $this -> cvv = $_cvv;
      } else {
        $this -> cvv = null;
      }
      $this -> date = $_date;
    }
  }


  $firstUser = new User('firstUser', 'firstBoolean47', 'first.user@boolean.com');

  $secondUser = new UserPremium('secondUser', 'secondBoolean47', 'second.user@boolean.com');
  $secondUser -> setLevelAndDiscount(2);
  
  $iPad = new Product('IPad', 899);
  $firstUser -> addToCart($iPad);
  $secondUser -> addToCart($iPad);

  $masterCard = new CreditCard('masterCard');
  $masterCard -> setCard(1234123412341234, '12/05', 834);
  $masterCard2 = new CreditCard('masterCard');
  $masterCard2 -> setCard(1234123412341234, '12/05', 834);
  

  $firstUser -> addCard($masterCard);

  // se aggiungi una carta duplicata va in fatal error
  // $firstUser -> addCard($masterCard2);

  var_dump($firstUser);
  var_dump($secondUser);
?>