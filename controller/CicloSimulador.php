<?php

class CicloSimulador {
    
    
    public function __construct(){
        $this->cicloSimulador = new CicloSimulador_Model();
        $this->uri = new Uri();
        $this->template = new Template();
    }
    
    public function index(){
        $data = array('titulo' => 'Painel usuario');
        echo $this->template->template('templates/template.tpl')->view('view/cicloSimulador/index.php')->data( $data )->render();
    }
    
    public function listar(){
        $data = array('titulo' => 'Painel usuario',
                      'listar' => $this->cicloSimulador->listarTodos());
        echo $this->template->template('templates/template.tpl')->view('view/cicloSimulador/listar.php')->data( $data )->render();
    }
    
    public function editar(){
        $id = $this->uri->segment(4);
        $data = array('resultado' => $this->cicloSimulador->procurar($id));
        echo $this->template->template('templates/template.tpl')->view('view/cicloSimulador/editar.php')->data( $data )->render();
    }
    
    public function deletar(){
        $id = $this->uri->segment(4);
        if ( $this->cicloSimulador->deletar($id) ){ 
            setcookie('msg',"Deletado!"); 
        }
        redirect('cicloSimulador/listar');
    }
    
    public function adicionar(){
        // resgata variáveis do formulário
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : ''; #Resgata variáveis do formulário
        $imagem_csm = isset($_FILES['imagem_csm']) ? $_FILES['imagem_csm'] : ''; #Resgata variáveis do formulário
        $id_ccr = isset($_POST['id_ccr']) ? $_POST['id_ccr'] : ''; #Resgata variáveis do formulário
        $id_sml = isset($_POST['id_sml']) ? $_POST['id_sml'] : ''; #Resgata variáveis do formulário
        
		
		$imagem_csm 	= $_FILES['imagem_csm']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = 'foto2/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = false;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['imagem_csm']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['imagem_csm']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['imagem_csm']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
					<script type=\"text/javascript\">
						alert(\"A imagem não foi cadastrada extesão inválida.\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['imagem_csm']['size']){
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				if($UP['renomeia'] == true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = time().'.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['imagem_csm']['name'];
				}
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['imagem_csm']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
					
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem cadastrada com Sucesso.\");
						</script>
					";	
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem não foi cadastrada com Sucesso.\");
						</script>
					";
				}
			}
		
		
        if (empty($descricao)){ #Verifica se os campos estão preenchidos
            setcookie('msg','Dados em branco!'); #Se não tiver, armazena mensagem para mostrar.
            } else {
                    #$nome  = htmlspecialchars(strip_tags($_POST['nome'])); #O html special e strip_tags serve para evitar a tentativa de sql_eject no BD
                    
                    $this->cicloSimulador->__set('descricao_csm', $descricao);
                    $this->cicloSimulador->__set('imagem_csm', $imagem_csm);
                    $this->cicloSimulador->__set('id_ccr', $id_ccr);
                    $this->cicloSimulador->__set('id_sml', $id_sml);
                    
                    if ( $this->cicloSimulador->adicionar() ){ #Aqui faz o insert e seta um cookie para mostrar depois dependendo da situação (se deu certo ou não)
                        setcookie('msg','Novo curso cadastrado!'); #Deu bom
                    } else {
                        setcookie('msg','Ocorreu algum erro..'); #Deu ruim
                    }
            }
        redirect('cicloSimulador/listar');
    }
    
    public function atualizar(){
       // $simulador = new Simulador_model(); #Cria novo objeto
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : ''; #Resgata variáveis do formulário
        $imagem_csm = isset($_POST['imagem_csm']) ? $_POST['imagem_csm'] : ''; #Resgata variáveis do formulário
        $id_ccr = isset($_POST['id_ccr']) ? $_POST['id_ccr'] : ''; #Resgata variáveis do formulário
        $id_sml = isset($_POST['id_sml']) ? $_POST['id_sml'] : ''; #Resgata variáveis do formulário
        //$id = $_GET['id'];
        $id = $this->uri->segment(4);
        if (empty($descricao)){ #Verifica se os campos estão preenchidos
            setcookie('msg',"Dados em branco!"); #Se não tiver, armazena mensagem para mostrar.
            } else {
                    $descricao  = htmlspecialchars(strip_tags($_POST['descricao'])); #O html special e strip_tags serve para evitar a tentativa de sql_eject no BD
                    $this->cicloSimulador->__set('descricao_csm', $descricao);
                    $this->cicloSimulador->__set('imagem_csm', $imagem_csm);
                    $this->cicloSimulador->__set('id_ccr', $id_ccr);
                    $this->cicloSimulador->__set('id_sml', $id_sml);
                    //$id = $_GET['id']; #Pega o ID para localizar no Banco de dados
                    if ($this->cicloSimulador->atualizar($id)){ #Aqui faz o insert e seta um cookie para mostrar depois, dependendo da situação (se deu certo ou não)
                        setcookie('msg','Dados atualizados!'); # Deu bom
                    } else {
                        setcookie('msg','Ocorreu algum erro..'); # Deu ruim
                    }

            }
        redirect('cicloSimulador/editar/' . $id);
    }
}

?>
