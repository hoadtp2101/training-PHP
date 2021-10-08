<?php
trait Active
{
	public function defindYourSelf()
    {
        return get_class($this);
    }
}

interface Boss {
    public function checkValidSlogan();
}

abstract class Country 
{
    use Active;

    protected $slogan;  
          
    abstract public function sayHello();

    function setSlogan($slogan){
        $this->slogan = $slogan;
    }

    public function getSlogan()
    {
        return $this->slogan;
    }
}

class EnglandCountry extends Country implements Boss
{
    public function checkValidSlogan()
    {
        $slogan = $this->getSlogan();
        $kt1 = strpos(strtolower($slogan), "england");
        $kt2 = strpos(strtolower($slogan), "english");
        if ($kt1 !== false || $kt2 !== false) {
            return true;
        }
        return $kt1;
    }

    public function sayHello()
    {
        return "Hello";
    }
}

class VietnamCountry extends Country implements Boss
{
    public function checkValidSlogan()
    {
        $slogan = $this->getSlogan();
        $kt1 = strpos(strtolower($slogan), "vietnam");
        $kt2 = strpos(strtolower($slogan), "hust");
        if ($kt1 !== false && $kt2 !== false) {
            return true;
        }
        return false;
    }

    public function sayHello()
    {
        return "Xin chào";
    }
}

$englandCountry = new EnglandCountry();
$vietnamCountry = new VietnamCountry();

$englandCountry->setSlogan('England is a country that is part of the United Kingdom. It shares land borders with Wales to the west and Scotland to the north. The Irish Sea lies west of England and the Celtic Sea to the southwest.');

$vietnamCountry->setSlogan('Vietnam is the easternmost country on the Indochina Peninsula. With an estimated 94.6 million inhabitants as of 2016, it is the 15th most populous country in the world.');

$hello = $englandCountry->sayHello(); // Hello
echo $hello . "<br>";
$chao = $vietnamCountry->sayHello(); // Xin chao
echo $chao . "<br>";

var_dump($englandCountry->checkValidSlogan()); // true
echo "<br>";
var_dump($vietnamCountry->checkValidSlogan()); // false

echo '<br>I am ' . $englandCountry->defindYourSelf(); 
echo "<br>";
echo 'I am ' . $vietnamCountry->defindYourSelf();
