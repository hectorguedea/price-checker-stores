<?php 

define("USER_DATA", array("user" => "tiendas", "pwd" => "123456", 'name' => "Héctor Guedea" )); 

class User {
    public function __construct($user, $pwd){
        $this->user = $user;
        $this->pwd = $pwd; 
    }

    public function get_user(){
       if ($this->user == USER_DATA["user"] && $this->pwd ==  USER_DATA["pwd"]){
            echo 'ENTRO'; 
            $_SESSION["login"] = true; 
            $_SESSION["name_sistema"] = USER_DATA["name"];
            header('Location:compara.php'); die();
        }else{
            if(!$this->checkCookie()){
                $this->valueCookie(1);
            }else{
                $this->valueCookie($this->checkCookie()+1);
            }
          return false;
      }

    }

   public function valueCookie($value){
        setcookie("login_attemps", $value, time() + 3600, "/");
    }
    
   public function checkCookie($value = 0){
        if (!isset($_COOKIE['login_attemps'])){
            setcookie("login_attemps", 1, time() + 3600, "/");
        }else{
            return $_COOKIE['login_attemps']; 
        }
   }

}


class Sistema {
  public function __construct($show, $character) {
   
  }


}

?>