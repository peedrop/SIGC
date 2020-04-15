<?php
	class Evento{
        
        private  $id;
        private  $title;
        private  $start;
       
        function __construct() {
            $this->setId(0);
            $this->setTitle("");
            $this->setStart("");
        }
        function __toString(){
			return $this->getTitle();
		}
        public function getId(){
            return $this->id;
	    }
        public function setId($id){
            $this->id = $id;
        }

        public function getTitle(){
            return $this->title;
        }

        public function setTitle($title){
            $this->title = $title;
        }
        
        public function getStart(){
            return $this->start;
        }

        public function setStart($start){
            $this->start = $start;
        }
	}
?>
