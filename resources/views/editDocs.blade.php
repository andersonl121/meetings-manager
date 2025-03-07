@extends('topbar')




@section('content')




<!-- Begin Page Content -->
<div class="container-fluid">



  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Editar Documentos</h1>


      <!-- DataTales Example -->
      <div class="card shadow mb-4">

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <th>Anexo</th>
                <th>Item</th>
                <th>Nome do Arquivo</th>
                <th>Opções</th>
              </thead>

              <tbody>
                @php

                if(null !== Session::get('caminho2')){
                  $caminho = Session::get('caminho2');
                }else{
                  $caminho = Session::get('caminho');
                }
                
                

                $caminho = "storage\\".$caminho;
                $caminho = str_replace("\\","/",$caminho);
                $diretorio = dir($caminho);
                $i = 0;

                while($arquivo = $diretorio -> read()){
                  if($arquivo != "." && $arquivo != ".."){
                  echo "<tr>
                  <td><input class='anexo' id='anexo" .$i."' name='anexo".$i."' type='number' min='0' max='50' minlength='2' value='".explode(" ",explode(" - ",$arquivo)[0])[1]."'>
                  </td>
                  <td><input class='item' id='item".$i."' name=' item".$i."' type='number' min='0' max='50' minlength='2' value='".explode(" ",explode(" - ",$arquivo)[1])[1]."'></td>
                  <td class='arquivo' id='arquivo".$i."'>".explode(" - ",$arquivo)[2]."</td>
                  <td id='options".$i."'>"
                  ;

                  echo "<div>";

                  if(is_dir($caminho."/".$arquivo)){
                    
                      echo 
                      
                      "<a href='#' class='editFolder'>
                          <i class='fas fa-folder-open text-gray-300'></i>
                        </a>
                      ";
                  }
                  echo "
                        <a href='#' class='deleteFolder'>
                          <i class='fas fa-trash-alt text-gray-300'></i>
                        </a>
                      ";
                   echo "
                   </div>   
                  </td>
                  </tr>";
                $i = $i + 1;
                  }
                }
                $diretorio -> close();






                
                  @endphp
              </tbody>
            </table>

          </div>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 align-items-center justify-content-center">
              <input type="submit" value="Processar" class="btn  btn-user btn-block"
                style="background-color:#00ae9d;color:#fff" onClick=editDoc()>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->



</div>
</div>
<!-- End of Main Content -->
@endsection
