<?php 

class Sql extends PDO {
	
	private $conn;
	/**
	 * Metodo construct com a string de conexão com banco de dados
	 */
	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
	}
	/**
	 * Metodo para setar oconjunto de dados (parametros) no banco
	 */
	private function setParams($sql, $parametres = array()){
			foreach ($parametres as $key => $value) {
			
			$this->setParam($sql,$key,$value);
		}
	}
	/**
	 * Metodo que vai receber a string SQL e chave valor percorrido no foreach do metodo acima e associar com bindParam() cada linha
	 */
	private function setParam($sql,$key,$value){
		$sql->bindParam($key,$value);
	}
	/**
	 * Metodo que recebe a query sql e os parametros chama outro metodo set params para acossciar as chaves e os valores recebidos como parametros e retorna um objeto para quem chamar
	 */
	public function query($rawQuery,$params = array()){
		$sql = $this->conn->prepare($rawQuery);

		$this->setParams($sql,$params);
		$sql->execute();
		return $sql;
	}
	/**
	 * Metodo que seleciona os dados que precisa e recebe como parametro o comando SQL e os parametros num array por padrão e que tem o retorno como um array
	 */
	public function select($sql, $params = array()):array{

		$sql = $this->query($sql, $params);
		return $sql->fetchAll(PDO::FETCH_ASSOC);
	}

}



 ?>