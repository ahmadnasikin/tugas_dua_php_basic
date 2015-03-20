<?php

class game{
/* property */
  
  public $name;
  public $blood=100;
  public $manna=40;
  public $option;
  public $status_player;
  public $main;
  public $game;
  public $value;
  public $data=[];
}

class object_game extends game{
  		public $n=0;
  		public $max_player=3;
  		public $name_player;
  		public $data_player;
  		public $player_input;
  		public $penyerang;
  		public $target;
  
  function start_game(){
      echo "# ========================================== #\n";
      echo "#            Welcome to Batle Area           #\n";     
      echo "# ------------------------------------------ #\n";
      echo "# Description :                              #\n";
      echo "# 1. Ketik New untuk membuat karakter baru   #\n";
      echo "# 2. Ketik Start untuk memulai pertarungan   #\n";
      echo "# ------------------------------------------ #\n";
      echo "# Current Player:                            #\n";

      		if($this->n > 0 && $this->n <= $this->max_player){
				$this->get_player();
			}   
 
      echo "\n";
      echo "# *Max Player 2 atau 3                       #\n";
      echo "# ------------------------------------------ #\n";
        
          $option= fgets (STDIN);
          
          if(trim($option) =="new") {
            $this->create_player();
          } elseif (trim($option) =="start") {
          	if($this->n < 2){
          		echo "Maaf data pemain belum cukup, silahkan inputkan pemain baru!\n";
          		$this->create_player();
          	}
            $this->fight();
          }else{
          echo "Inputan tidak sesuai, mohon dicek lagi!\n";
             
          }
         
              
    }

    function get_player(){
	     for($i=1;$i<=$this->n;$i++){
	     	echo "_________________________________________\n";
			echo "|".$i.".".$this->name_player[$i]->name."|\n";
			
	     }
  	}

  	function cek_player_active($name_active){
		for($i=1;$i<=$this->n;$i++){
			if($this->name_player[$i]->name == $name_active){
				return true;
			}
		}
	}

  	function cek_manna_player(){
	  	for($i=1;$i<=$this->n;$i++){
			if($this->name_player[$i]->manna == 0){
				return true;
			}
		}
	}

  function cek_condition_player(){

 	$index_penyerang=$this->cek_index_fight($this->penyerang);
	$index_target=$this->cek_index_fight($this->target);

	$this->name_player[$index_penyerang]->manna -= 20;
	$this->name_player[$index_target]->blood -= 20;

 	for($i=1;$i<=$this->n;$i++){
		echo "".$this->name_player[$i]->name." : manna = ".$this->name_player[$i]->manna.", blood = ".$this->name_player[$i]->blood."\n";
	}
  }

  function cek_index_fight($name_active){
  	for($i=1;$i<= $this->n;$i++){
		if($this->name_player[$i]->name == $name_active){
			return $i;
		}
	}
  }

  function game_over(){
  	echo "# ========================================== #\n";
	echo "#            Welcome to Batle Area           #\n";     
	echo "# ------------------------------------------ #\n";
	echo "#                 Game Over                  #\n";
	echo "# ========================================== #\n";
  }

  function end_game(){
  	echo "# ========================================== #\n";
	echo "#        The Batle Area Crew Present :       #\n";     
	echo "# ------------------------------------------ #\n";
	echo "#                 Thank You                  #\n";
	echo "# ========================================== #\n";
  }

  function reset(){
		$this->manna == 40;
		$this->blood == 100;
		$this->name == "";
  }

    
    /* Halaman Pembuatan Pemain baru */
  
  function create_player(){

  		if($this->n < $this->max_player){
			$this->n++;	
		}

	  if($this->n <= $this->max_player){

		  echo "\n";
		  echo "# ========================================== #\n";
		  echo "#            Welcome to Batle Area           #\n";     
		  echo "# ------------------------------------------ #\n";
		  echo "# Description :                              #\n";
		  echo "# 1. Ketik New untuk membuat karakter baru   #\n";
		  echo "# 2. Ketik Start untuk memulai pertarungan   #\n"; 
		  echo "# ------------------------------------------ #\n";
		  echo "# Masukkan Nama Player:                      #\n";
		  
		  $player_input= fgets (STDIN);
		  $player[$this->n]= new game;
		  $player[$this->n]->name=$player_input;
		  $this->name_player[$this->n]=$player[$this->n];  
		  
		  
		  echo "# *Max Player 2 atau 3                       #\n";
		  echo "# ------------------------------------------ #\n";
	  
	  	$this->start_game();
	  }else{
	  	$this->fight();
	  }

  }

        
  
  /* Halaman Peperangan */
  
  function fight(){
  	
  	if($this->cek_manna_player()){
  		$this->game_over();
  		echo "Try Again? (y/n)";
  		$alert = fgets(STDIN);
  		if(trim($alert) == "y"){
  			$this->reset();
  			$this->start_game();
  		}elseif (trim($alert) == "n") {
  			$this->end_game();
  		}
  	}else{
  		echo "# ========================================== #\n";
		echo "#            Welcome to Batle Area           #\n";     
		echo "# ------------------------------------------ #\n";
		echo "# Batle Start :                              #\n";
		echo "# Siapa yang akan menyerang? :               #\n";
	 
		$this->penyerang = fgets(STDIN);
		if($this->cek_player_active($this->penyerang)){
		  	echo "# Siapa yang akan diserang?  :               #\n";
		  	$this->target = fgets(STDIN);
		  	if($this->cek_player_active($this->target)){

	  	 	echo "# ========================================== #\n";
			echo "#            Welcome to Batle Area           #\n";     
			echo "# ------------------------------------------ #\n";
			echo "# Batle Start :                              #\n";
			echo "# Siapa yang menyerang? : ".$this->penyerang.     "#\n";
			echo "# Siapa yang diserang?  : ".$this->target.        "#\n";
			echo "# ------------------------------------------ #\n";
			echo "  Description :                               \n";
			echo "# ------------------------------------------ #\n";

			$this->cek_condition_player();		
			echo "# ========================================== #\n";
			$this->fight();
			
	  	 	}
	    }
  		
  	}
	
  }

 
}

$game=new object_game();
$game->start_game();

