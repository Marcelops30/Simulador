<?php


class RealizarCiclo {
    
    
    public function __construct(){
        $this->reali_ciclo = new RealizarCiclo_model();
        $this->uri = new Uri();
        $this->template = new Template();
    }
    
    public function index(){
        echo $this->template->template('templates/template.tpl')->view('view/realizar_ciclo/index.php')->render();
    }
    
    public function listar(){
        $data = array('titulo' => 'Painel usuario',
                      'listar' => $this->reali_ciclo->listarTodos());
        echo $this->template->template('templates/template.tpl')->view('view/realizar_ciclo/listar.php')->data( $data )->render();
    }
    
    public function editar(){
        $id = $this->uri->segment(4);
        $data = array( 'resultado' => $this->reali_ciclo->procurar($id) );
        echo $this->template->template('templates/template.tpl')->view('view/realizar_ciclo/editar.php')->data( $data )->render();
    }
    
    public function deletar(){
        $uri = new Uri();
        $id = $uri->segment(4);
        if ( $this->reali_ciclo->deletar($id) ){ 
            setcookie('msg',"Deletado!"); 
        }
        redirect('realizarciclo/listar');
    }
    
    public function novo(){
        $pontuacaoAlcancadaRcc = isset($_POST['pontuacaoAlcancadaRcc']) ? $_POST['pontuacaoAlcancadaRcc'] : ''; #Resgata variáveis do formulário
		$id_csm = isset($_POST['id_csm']) ? $_POST['id_csm'] : ''; #Resgata variáveis do formulário
		$id_usu = isset($_POST['id_usu']) ? $_POST['id_usu'] : ''; #Resgata variáveis do formulário
        if (empty($pontuacaoAlcancadaRcc)){ #Verifica se os campos estão preenchidos
            setcookie('msg','Dados em branco!'); #Se não tiver, armazena mensagem para mostrar.
            } else {
                    $pontuacaoAlcancadaRcc  = htmlspecialchars(strip_tags($_POST['pontuacaoAlcancadaRcc'])); #O html special e strip_tags serve para evitar a tentativa de sql_eject no BD
                    $this->reali_ciclo->__set('pontuacaoAlcancadaRcc', $pontuacaoAlcancadaRcc);
					$this->reali_ciclo->__set('id_csm', $id_csm);
					$this->reali_ciclo->__set('id_usu', $id_usu);

                    if ($this->reali_ciclo->adicionar()){ #Aqui faz o insert e seta um cookie para mostrar depois dependendo da situação (se deu certo ou não)
                        setcookie('msg','Novo curso cadastrado!'); #Deu bom
                    } else {
                        setcookie('msg','Ocorreu algum erro..'); #Deu ruim
                    }

            }
        redirect('realizarciclo/listar');
    }
    
    public function atualizar(){
        $pontuacaoAlcancadaRcc = isset($_POST['pontuacaoAlcancadaRcc']) ? $_POST['pontuacaoAlcancadaRcc'] : ''; #Resgata variáveis do formulário
		$id_csm = isset($_POST['id_csm']) ? $_POST['id_csm'] : ''; #Resgata variáveis do formulário
		$id_usu = isset($_POST['id_usu']) ? $_POST['id_usu'] : ''; #Resgata variáveis do formulário
		$id = $this->uri->segment(4);
        //$id = $_GET['id'];
        if (empty($pontuacaoAlcancadaRcc)){ #Verifica se os campos estão preenchidos
            setcookie('msg',"Dados em branco!"); #Se não tiver, armazena mensagem para mostrar.
            } else {
                    $pontuacaoAlcancadaRcc  = htmlspecialchars(strip_tags($_POST['pontuacaoAlcancadaRcc'])); #O html special e strip_tags serve para evitar a tentativa de sql_eject no BD
                    $this->reali_ciclo->__set('pontuacaoAlcancadaRcc', $pontuacaoAlcancadaRcc); #Pega o que foi digitado e muda seu valor no objeto
					$this->reali_ciclo->__set('id_csm', $id_csm);
					$this->reali_ciclo->__set('id_usu', $id_usu);
                    //$id = $_GET['id']; #Pega o ID para localizar no Banco de dados
                    if ($this->reali_ciclo->atualizar($id)){ #Aqui faz o insert e seta um cookie para mostrar depois, dependendo da situação (se deu certo ou não)
                        setcookie('msg','Dados atualizados!'); # Deu bom
                    } else {
                        setcookie('msg','Ocorreu algum erro..'); # Deu ruim
                    }

            }
			redirect('realizarciclo/editar/' . $id);
        //redirect('?pag=curso&acao=editar&id=' . $_GET['id']);
    }
}

?>
