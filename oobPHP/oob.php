<?php 
class darweesh {
    public $name ;
    public $father ;
    public $age ;
    public $son = 'no child' ;
    public $living = 'streat' ;
    public $ownerName='ali';
    //methods
   
    public function livingCountry($area){
        echo 'he lives in ' .$area. '<br> ';
    }

    public function test(){
        echo 'he lives in '  . $this->living . '<br>' ;
        echo 'he is  ' .$this->name. '<br>' ;
        echo 'he is  ' .$this->age. '<br>' ;
    }
    public function setOwnerName(){
        if (strlen($this->ownerName)<3){
            echo 'hello';
            
        }
        else {
            echo 'big than';
        }

        }
    
   
}

$hasan = new darweesh();
$hasan->name = 'hasan';
$hasan->father = 'mohammed';
$hasan->age = '27';
$hasan->son = 'jihad';
$hasan->livingCountry('iskan');
$hasan->test();
$hasan->setOwnerName();

echo '<pre>';
var_dump($hasan);
echo '</pre>';


$laith = new darweesh();
$laith->name = 'laith';
$laith->father = 'mohammed';
$laith->age = '30';
$laith->son = 'zaid';
$laith->livingCountry('zarqa');

echo '<pre>';
var_dump($laith);
echo '</pre>';

?>





<?php
// تعريف الفئة الأب (Parent Class)
class Animal {
    public $name; // خاصية لتخزين اسم الحيوان

    // المُنشئ (Constructor) لتعيين اسم الحيوان عند إنشاء الكائن
    public function __construct($name) {
        $this->name = $name;
    }

    // دالة لإصدار صوت (سيتم تعديلها في الفئة الابن)
    public function makeSound() {
        echo "This animal makes a sound.<br>"; // رسالة افتراضية
    }
}

// تعريف الفئة الابن (Child Class) التي ترث من Animal
class Dog extends Animal {
    // إعادة تعريف دالة makeSound() لتناسب الكلب
    public function makeSound() {
        echo "The dog's name is: $this->name 🐶<br>"; // طباعة اسم الكلب
    }
}

// إنشاء كائنين جديدين من الفئة Dog وتمرير اسم "Buddy" و "Max"
$dog1 = new Dog("Boche");
$dog2 = new Dog("Max");
$dog3 = new Dog("Buddy");

// استدعاء الدالة makeSound() لكل كلب
$dog1->makeSound();
$dog2->makeSound();
$dog3->makeSound();








// $dogNames = ["Buddy", "Max", "Charlie", "Rex"];

// // استخدام حلقة for لإنشاء كائنات الكلاب واستدعاء makeSound()
// for ($i = 0; $i < count($dogNames); $i++) {
//     $dog = new Dog($dogNames[$i]);  // إنشاء كائن جديد لكل اسم في المصفوفة
//     $dog->makeSound();  // استدعاء دالة makeSound()
// }
?>