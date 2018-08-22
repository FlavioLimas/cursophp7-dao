<?php 

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario(){
		return $this->idusuario;
	}

	public function setIdUsuario($idusuario){
		$this->idusuario = $idusuario;
	}

	public function getDesLogin(){
		return $this->deslogin;
	}

	public function setDesLogin($deslogin){
		$this->deslogin = $deslogin;
	}

	public function getDesSenha(){
		return $this->dessenha;
	}

	public function setDesSenha($dessenha){
		$this->dessenha = $dessenha;
	}

	public function getDtCadastro(){
		return $this->dtcadastro;
	}

	public function setDtCadastro($dtcadastro){
		$this->dtcadastro = $dtcadastro;
	}

	/**
	 * Listar Usuarios pelo ID
	 */
	public function loadById($id){
		$sql = new Sql();
		/**
		 * A classe PDO sempre vai te retornar um array mesmo se o retorno conter somente uma linha
		 */
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID"=>$id;
		));
		// Verificando se existe pelo menos um registro
		// if(isset($results[0])){
		if(count($results) > 0){
			$row = $results[0];
			// setando os dados
			$this->setIdUsuario($row['idusuario']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
		/**
		 * Imprimindo dados dos atributos
		 */
		public function __toString(){
			return echo json_encode(
				array(
					"idusuario"=>$this->getIdUsuario(),
					"deslogin"=>$this->getDesLogin(),
					"dessenha"=>$this->getDesSenha(),
					"dtcadatro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
				));
		}

	}
}


 ?>