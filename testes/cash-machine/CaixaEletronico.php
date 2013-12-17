class NoteUnavailableException extends \Exception{}

class CaixaEletronico{
	
	public $notas_validas = array(100,50,20,10);
	public $notas_saque   = array();
	
	public function restante($valor,$divisor){		
		return $valor % $divisor;		
	}
	
	public function saque($valor){		
		$restante = 0;	
		if( is_null($valor) ){
			throw new InvalidArgumentException("throw InvalidArgumentException");			
		}else if( $valor < 0 || empty($valor) ){
			throw new Exception("[Empty Set]");
		}else if(!is_int($valor)){
			throw new InvalidArgumentException("throw InvalidArgumentException");
		}else if( is_numeric($valor) ){
			$total_notas = count($this->notas_validas);
			for($i=0;$i<$total_notas;$i++){
				if( $valor >= $this->notas_validas[$i] ){
					$restante = $this->restante($valor,$this->notas_validas[$i]);
					$soma_nota_atual = 0;
					while($valor >= $soma_nota_atual){						
						$soma_nota_atual += $this->notas_validas[$i];
						if($valor >= $soma_nota_atual){
							$this->notas_saque[] = $this->notas_validas[$i];
						}
					}				
					$valor = ($restante);					
					if($restante == 0){
						break;
					}
				}
			}
			
			if($restante > 0){
				$this->notas_saque = array();
				throw new NoteUnavailableException("throw NoteUnavailableException");
			}
		}		
	}	
}

try{
	$caixa = new CaixaEletronico();
	$caixa->saque(30.00);
	print_r($caixa->notas_saque);
	echo "<hr/>";
}catch(Exception $e){
	echo $e->getMessage();
	echo "<hr/>";
}


try{
	$caixa = new CaixaEletronico();
	$caixa->saque(80.00);
	print_r($caixa->notas_saque);
	echo "<hr/>";
}catch(Exception $e){
	echo $e->getMessage();
	echo "<hr/>";
}


try{
	$caixa = new CaixaEletronico();
	$caixa->saque(125.00);
	print_r($caixa->notas_saque);
	echo "<hr/>";
}catch(Exception $e){
	echo $e->getMessage();
	echo "<hr/>";
}


try{
	$caixa = new CaixaEletronico();
	$caixa->saque(-130.00);
	print_r($caixa->notas_saque);
	echo "<hr/>";
}catch(Exception $e){
	echo $e->getMessage();
	echo "<hr/>";
}

try{
	$caixa = new CaixaEletronico();
	$caixa->saque(NULL);
	var_dump($caixa->notas_saque);
	echo "<hr/>";
}catch(Exception $e){
	echo $e->getMessage();
	echo "<hr/>";
}

try{
	$caixa = new CaixaEletronico();
	$caixa->saque(770);
	var_dump($caixa->notas_saque);
	echo "<hr/>";
}catch(Exception $e){
	echo $e->getMessage();
	echo "<hr/>";
}
