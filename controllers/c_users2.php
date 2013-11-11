<?php
class users2_controller extends base_controller {

    public function test1() {
        echo "This is the test page";
        $imageObj = new Image('http://placekitten.com/500/500');
		
		$imageObj->resize(100,100);
		
		$imageObj->display();
    }
    
    public function test2(){
    
    echo Time::now();
    
    }

    
} # end of the class
?>