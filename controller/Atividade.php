<?php

class Atividade {

    public function __construct(){
        $this->atividade = new Atividade_model();
        $this->uri = new Uri();
        $this->template = new Template();
    }
    
    public function index(){
        $data = array('titulo' => 'Painel usuario');
        echo $this->template->template('templates/template.tpl')->view('view/atividade/index.php')->data( $data )->render();
    }


    public function listar(){
        $data = array('titulo' => 'Painel usuario',
                      'listar' => $this->atividade->listarTodos());
        echo $this->template->template('templates/template.tpl')->view('view/atividade/listar.php')->data( $data )->render();
    }
    
    public function editar(){
        $id = $this->uri->segment(4);
        $data = array('resultado' => $this->atividade->procurar($id));
        echo $this->template->template('templates/template.tpl')->view('view/atividade/editar.php')->data( $data )->render();
    }
    
   

    public function novo(){
        
        $nome_asm = isset($_POST['nome_asm']) ? $_POST['nome_asm'] : ''; #Resgata variáveis do formulário
        $tempo_asm = isset($_POST['tempo_asm']) ? $_POST['tempo_asm'] : ''; #Resgata variáveis do formulário
        $pontuacao_asm = isset($_POST['pontuacao_asm']) ? $_POST['pontuacao_asm'] : ''; #Resgata variáveis do formulário
        $imagem_asm = isset($_FILE['imagem_asm']) ? $_FILE['imagem_asm'] : ''; #Resgata variáveis do formulário
        $id_csm = isset($_POST['id_csm']) ? $_POST['id_csm'] : ''; #Resgata variáveis do formulário
        
		
		$imagem_asm 	= $_FILES['imagem_asm']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = 'foto/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100*9999999; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = true;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['imagem_asm']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['imagem']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao = strtolower(end(explode('.', $_FILES['imagem_asm']['name'])));
			if(array_search($extensao, $_UP['extensoes'])=== false){		
				echo "
					<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
					<script type=\"text/javascript\">
						alert(\"A imagem não foi cadastrada extesão inválida.\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['imagem_asm']['size']){
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
					$nome_final = time(). '.jpg'; #$_FILES['imagem_asm']['name'];
				}
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['imagem_asm']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
					
					/* echo "
						<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://localhost/Aula/upload_imagem.php'>
						<script type=\"text/javascript\">
							alert(\"Imagem cadastrada com Sucesso.\");
						</script>
					";	*/
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
		
        
        $this->atividade->__set('nome_asm', $nome_asm);
        $this->atividade->__set('tempo_asm', $tempo_asm);
        $this->atividade->__set('pontuacao_asm', $pontuacao_asm );
        $this->atividade->__set('imagem_asm', $_UP['pasta']. $nome_final);
        $this->atividade->__set('id_csm', $id_csm);
        
        $this->atividade->adicionar();

        redirect('Atividade');
    }

    public function atualizar(){
        $id = $this->uri->segment(4);
        $this->atividade->__set('nome_asm', $_POST['nome_asm']);
        $this->atividade->__set('tempo_asm', $_POST['tempo_asm']);
        $this->atividade->__set('pontuacao_asm', $_POST['pontuacao_asm']);
        $this->atividade->__set('imagem_asm',$_POST['imagem_asm']);
        $this->atividade->__set('id_csm', $_POST['id_csm']);
        

        $this->atividade->atualizar($id);

        redirect('atividade/editar/' . $id);
    }
    
     public function deletar(){
        $id = $this->uri->segment(4);
        if ($this->atividade->deletar($id)){ 
               setcookie('msg','Dados Deletado!'); #Deu bom
        }
        redirect('atividade/listar');
    }
    

    //public function Eliminar(){
        //$this->model->Eliminar($_REQUEST['id_asm']);
       // header('Location: index.php');
   // }
}
