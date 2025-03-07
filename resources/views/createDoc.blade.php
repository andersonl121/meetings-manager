@extends('topbar')




@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">



  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">

    <h1 class="h3 mb-0 text-gray-800">Cadastrar Documentos</h1>


  </div>
  <div class="row justify-content-center">

    <div class="col-xl-6 col-lg-6 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">

            <div class="col-lg-12">
              <div class="p-5">

                <form class="user" action="upFiles" method="post" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <div class="form-group ">
                    <div id="fileDrag">

                      <input required type="file" id="arquivos" name="arquivos[]" multiple>

                      <p>Arraste seus arquivos aqui ou clique nessa área.</p>

                    </div>

                  </div>
                  <hr>
                      <p>Inserir na pasta: 
                      <p>Anexo
                      <input  class="col-lg-2" type="number" id="anexoSubpasta" name="anexoSubpasta">
                      - Item 
                      <input class="col-lg-2" type="number" id="itemSubpasta" name="itemSubpasta">
                      -
                      <input  type="text" id="subPasta" name="subPasta">
                      </p>
                  <hr>
                  <div class="form-group ">
                    <input  type="submit" style="background-color:#00ae9d;color:#fff" value="Avançar"
                      class="btn  btn-user btn-block">
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>






</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection