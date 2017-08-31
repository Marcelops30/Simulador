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

     public function novo(){
        
        $nome_ias = isset($_POST['nome_ias']) ? $_POST['nome_ias'] : ''; #Resgata variáveis do formulário
        $seguencia_ias = isset($_POST['seguencia_ias']) ? $_POST['seguencia_ias'] : ''; #Resgata variáveis do formulário
        $id_asm = isset($_POST['id_asm']) ? $_POST['id_asm'] : ''; #Resgata variáveis do formulário
       
        
        
        
        
        
        $this->item->__set('nome_ias', $nome_ias);
        $this->item->__set('seguencia_ias', $seguencia_ias);
        $this->item->__set('id_asm', $id_asm);
        
        $this->item->adicionar();

        redirect('item');
    }

    public function atualizar(){
        $id = $this->uri->segment(4);
        $this->item->__set('nome_ias', $nome_ias);
        $this->item->__set('seguencia_ias', $seguencia_ias);
        $this->item->__set('id_asm', $_POST['id_asm']);
        

        $this->item->atualizar($id);

        redirect('item/editar/' . $id);
    }
    
     public function deletar(){
        $id = $this->uri->segment(4);
        if ($this->item->deletar($id)){ 
               setcookie('msg','Dados Deletado!'); #Deu bom
        }
        redirect('item/listar');
    }
    

    //public function Eliminar(){
        //$this->model->Eliminar($_REQUEST['id_asm']);
       // header('Location: index.php');
   // }
}


