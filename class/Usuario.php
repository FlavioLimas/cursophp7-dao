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
				":ID"=>$id
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
	}
	/**Quem estanciar a classe Usuario poderá imprimir usando um echo devido a esse metodo
	 * Imprimindo dados dos atributos
	 */
	public function __toString(){
		return json_encode(
			array(
				"idusuario"=>$this->getIdUsuario(),
				"deslogin"=>$this->getDesLogin(),
				"dessenha"=>$this->getDesSenha(),
				"dtcadatro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
			)
		);
	}
	/**
	 * Lista Usuarios
	 Se vc não esta usando o $this no metodo compensa que ele seja static, pois assim vc não precisa estanciar para utiliza-lo
	 */
	public static function getLista(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}
	/**
	 * Metodo de pesquisa no banco de dados
	 */
	public static function search($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login."%"
			)
		);
	}
	/**
	 * Metodo de autenticação de usuarios
	 */
	public function login($login, $password){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN"=>$login,
				":PASSWORD"=>$password
			)
		);
		if(count($results) > 0){
			$row = $results[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}else{
			// Gerando exceção para falha de autenticação
			throw new Exception("Login e/ou Senha inválidos.");
		}
	}
	/**
	 * Insert
	 */
	public function insert(){
		$sql = new Sql();
		$results = $sql->select();
	}
}


 ?>