@extends('topbar')




@section('content')



<!-- Begin Page Content -->
<div class="container-fluid">



    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Cadastrar Reunião - {{Session::get('setor')}}</h1>


    </div>
    <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="p-5">

                                <form class="user" action="cadReuniao" method="post" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="form-group row">
                                        <label for="example-date-input" class="col-4 col-form-label">Data da Reunião</label>
                                        <div class="col-5">
                                            <input required class="form-control" type="date" value={{date('Y-m-d')}}
                                                id="date" name="date">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="example-date-input" class="col-4 col-form-label">Descrição</label>
                                        <div class="col-8">
                                            <input required class="form-control" type="text" id="desc" name="desc">
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="form-group ">
                                        <input type="submit" style="background-color:#00ae9d;color:#fff" value="Cadastrar"
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
