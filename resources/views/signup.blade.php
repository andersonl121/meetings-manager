@extends('topbar')




@section('content')

<div class="container ">

  <div class="row justify-content-center">
    <div class="center col-xl-6 col-lg-12 col-md-9">
      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">

            <div class="col-lg-12">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Cadastrar Usuário</h1>
                </div>
                <form class="user" method="post" action="signup">
                  {!! csrf_field() !!}
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input required type="text" class="form-control form-control-user" id="fn" name="fn"
                        placeholder="Primeiro Nome">
                    </div>
                    <div class="col-sm-6">
                      <input required type="text" class="form-control form-control-user" id="ln" name="ln"
                        placeholder="Último Nome">
                    </div>
                  </div>
                  <div class="form-group">
                    <input required type="text" class="form-control form-control-user" id="login" name="login"
                      placeholder="Nome de Usuário">
                  </div>
                  <div class="form-group">
                    <input required type="email" class="form-control form-control-user" id="email" name="email"
                      placeholder="Email">
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <select class="form-control" id="tipo" name="tipo" style="border-radius:35rem">
                        <option selected disabled>Tipo:</option>
                        <option value="CONFIS" id="CONFIS">CONFIS</option>
                        <option value="CONAD" id="CONAD">CONAD</option>
                        <option value="DIREX" id="DIREX">DIREX</option>
                        <option value="GERENCIA" id="GERENCIA">GERENCIA</option>
                        <option value="SECRETARIA" id="SECRETARIA">SECRETARIA</option>
                      </select>
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input required type="password" class="form-control form-control-user" id="pwd" name="pwd"
                        placeholder="Senha">
                    </div>
                    <div class="col-sm-6">
                      <input required type="password" class="form-control form-control-user" id="rpwd" name="rpwd"
                        placeholder="Confirmar Senha">
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-sm-1 mb-3 mb-sm-0"></div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="isGestor">
                        <label class="custom-control-label" for="isGestor">É Gestor</label>
                      </div>
                    </div>
                  </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Criar Conta">


                </form>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

@endsection