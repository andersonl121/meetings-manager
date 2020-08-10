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
                  <h1 class="h4 text-gray-900 mb-4">Alterar Senha</h1>
                </div>
                <form class="user" method="post" action="cpwd">
                  {!! csrf_field() !!}

                  <div class="row form-group">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <input required type="password" class="form-control form-control-user" id="oldPwd" name="oldPwd"
                        placeholder="Senha Atual">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-sm-12 mb-3 mb-sm-0">
                      <input required type="password" class="form-control form-control-user" id="pwd" name="pwd"
                        placeholder="Nova Senha">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-sm-12">
                      <input required type="password" class="form-control form-control-user" id="rpwd" name="rpwd"
                        placeholder="Confirmar Senha">
                    </div>
                  </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Alterar">
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