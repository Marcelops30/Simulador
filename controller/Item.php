<?php


class Item {

    public function __construct(){
        $this->item = new Item_model();
        $this->uri = new Uri();
        $this->template = new Template();
    }
    
    public function index(){
        echo $this->template->template('templates/template.tpl')->view('view/item/index.php')->render();
    }
    
    //Chamada para ver item de-edit
    public function editar(){
        $id = $this->uri->segment(4);
        $data = array('resultado' => $this->item->procurar($id));
        echo $this->template->template('templates/template.tpl')->view('view/item/editar.php')->data( $data )->render();
    
  }

   
    public function listar(){
        $data = array( 'listar' => $this->item->listarTodos());
        echo $this->template->template('templates/template.tpl')->view('view/item/listar.php')->data( $data )->render();
 }

    public function deletar(){
        $id = $this->uri->segment(4);
        if ( $this->item->deletar($id) ){ 
            setcookie('msg',"Deletado!"); 
        }

        redirect('Item/listar');
 }

    public function novo(){
        $nome = isset($_POST['nome_ias']) ? $_POST['nome_ias'] : ''; #Resgata variáveis do formulário
        $seguencia = isset($_POST['seguencia_ias']) ? $_POST['seguencia_ias'] : ''; #Resgata variáveis do formulário
        $id = isset($_POST['id_asm']) ? $_POST['id_asm'] : ''; #Resgata variáveis do formulário
        if (empty($nome)){ #Verifica se os campos estão preenchidos
            setcookie('msg','Dados em branco!'); #Se não tiver, armazena mensagem para mostrar.
            } else {
                    $nome  = htmlspecialchars(strip_tags($_POST['nome_ias'])); #O html special e strip_tags serve para evitar a tentativa de sql_eject no BD
                    $this->item->__set('nome_ias', $nome);
                    $this->item->__set('seguencia_ias', $seguencia);
                    $this->item->__set('id_asm', $id);

                    if ($this->item->adicionar()){ #Aqui faz o insert e seta um cookie para mostrar depois dependendo da situação (se deu certo ou não)
                        setcookie('msg','Novo item cadastrado!'); #Deu bom
                    } else {
                        setcookie('msg','Ocorreu algum erro..'); #Deu ruim
                    }

            }
        redirect('item');
    }
    
    public function atualizar(){
        
       $nome = isset($_POST['nome_ias']) ? $_POST['nome_ias'] : ''; #Resgata variáveis do formulário
        $seguencia = isset($_POST['seguencia_ias']) ? $_POST['seguencia_ias'] : ''; #Resgata variáveis do formulário
        $id = isset($_POST['id_asm']) ? $_POST['id_asm'] : ''; #Resgata variáveis do formulário
        $id = $this->uri->segment(4);
        
        if (empty($nome)){ #Verifica se os campos estão preenchidos
            setcookie('msg',"Dados em branco!"); #Se não tiver, armazena mensagem para mostrar.
            } else {
                    $nome  = htmlspecialchars(strip_tags($_POST['nome_ias'])); #O html special e strip_tags serve para evitar a tentativa de sql_eject no BD
                    $this->item->__set('nome_ias', $nome);
                    $this->item->__set('seguencia_ias', $seguencia);
                    $this->item->__set('id_asm', $id);
                    
                    if ($this->item->atualizar($id)){ #Aqui faz o insert e seta um cookie para mostrar depois, dependendo da situação (se deu certo ou não)
                        setcookie('msg','Dados atualizados!'); # Deu bom
                    } else {
                        setcookie('msg','Ocorreu algum erro..'); # Deu ruim
                    }

            }
        redirect('item/editar/' . $id);
    }
}

?>


