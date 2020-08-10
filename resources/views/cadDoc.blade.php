@extends('topbar')




@section('content')




<!-- Begin Page Content -->
<div class="container-fluid">



  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Cadastrar Documentos</h1>


      <!-- DataTales Example -->
      <div class="card shadow mb-4">

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <th>Anexo</th>
                <th>Item</th>
                <th>Nome do Arquivo</th>
              </thead>

              <tbody>
                @php
                for($i=0;$i<sizeof(Session::get('arquivos'));$i++){ echo "<tr>
                  <td><input id='anexo" .$i."' name='anexo".$i."' type='number' min='0' max='50'>
                  </td>
                  <td><input id='item".$i."' name=' item".$i."' type='number' min='0' max='50'></td>
                  <td id='arquivo".$i."'>".Session::get('arquivos')[$i]."</td>
                  </tr>";}
                  @endphp
              </tbody>
            </table>

          </div>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 align-items-center justify-content-center">
              <input type="submit" value="Processar" class="btn  btn-user btn-block"
                style="background-color:#00ae9d;color:#fff" onClick=saveDoc()>
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