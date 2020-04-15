<?php	
	require_once 'Banco.php';
	require_once 'Evento.php';

	class EventoDAO{				

		public function excluirPorId($codigo){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
				
				$sql = "DELETE FROM eventos WHERE id = :id";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':id', $codigo);			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;

		}					
        public function listar(){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "select * from eventos";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$evento = new Evento();
					$evento->setId($objeto['id']);
                    $evento->setTitle($objeto['title']);
                    $evento->setStart($objeto['start']);
					array_push($objetos, $evento);
				}		
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
	  public function listarEventos(){

			$objetos = array();

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "select * from eventos order by id desc limit 5";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();
                
            
				foreach ($resultado as $objeto){

					$evento = new Evento();
					$evento->setId($objeto['id']);
                    $evento->setTitle($objeto['title']);
                    $evento->setStart($objeto['start']);
                    
					array_push($objetos, $evento);
				}		
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}		
			
	}
?>
