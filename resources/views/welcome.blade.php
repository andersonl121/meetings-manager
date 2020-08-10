@extends('topbar')




@section('content')

@php

$now = date("d/m/Y");
$setor = App\User::where('login',Session::get('usuario'))->firstOrFail()->type;
$atualYear = explode("/",$now)[2];
$atualMonth = explode("/",$now)[1];
$atualDay = explode("/",$now)[0];

if($setor == 'DIREX'||$setor=='SECRETARIA'){
$path="storage/DIREX/".$atualYear."/".$atualMonth;
$reunioes = 36;
$rootPath = "storage/DIREX/";
}else if($setor == 'CONAD'){
$path="storage/CONAD/".$atualYear."/".$atualMonth;
$rootPath = "storage/CONAD/";
$reunioes = 12;
}else{
$path="storage/CONFIS/".$atualYear."/".$atualMonth;
$rootPath = "storage/CONFIS/";
$reunioes = 12;
}
$pathDirex="storage/DIREX/".$atualYear."/".$atualMonth;
$pathConad="storage/CONAD/".$atualYear."/".$atualMonth;
$pathConfis="storage/CONFIS/".$atualYear."/".$atualMonth;
$nomeSetor="";



if(!(Storage::exists(str_replace("storage/","",$pathDirex)))){

Storage::makeDirectory(str_replace("storage/","",$pathDirex));
}
if(!(Storage::exists(str_replace("storage/","",$pathConad)))){

Storage::makeDirectory(str_replace("storage/","",$pathConad));
}
if(!(Storage::exists(str_replace("storage/","",$pathConfis)))){

Storage::makeDirectory(str_replace("storage/","",$pathConfis));
}

//Rotina para próxima reunião
$diretorio=dir($path);


while($pastas = $diretorio -> read()){

if($pastas!="." && $pastas!=".." && $pastas>=(int)$atualDay){
$primeiroDia = $pastas;
break;
}else{
$primeiroDia = "";
}
}

$diretorio -> close();


//Rotina para última reunião

$dirYear = scandir($rootPath);
$lastYear = $dirYear[count($dirYear) - 1];
$dirMonth = scandir($rootPath."/".$lastYear);
$lastMonth = $dirMonth[count($dirMonth) - 1];

$diretorio = dir($rootPath."/".$lastYear."/".$lastMonth);

while($days = $diretorio->read()){


if($days!="." && $days!=".." && $days>=(int)$atualDay){

break;
}
$lastDay =$days;


}



$diretorio -> close();

//Contagem de reuniões esse ano
$countDays = 0;
$temp = dir($rootPath.$atualYear);
while($months = $temp->read()){
$temp2 = dir($rootPath.$atualYear."/".$months);
if($months!="." && $months!=".."){
while($daysMonth=$temp2->read()){
if($daysMonth!="." && $daysMonth!=".." ){
$countDays = $countDays + 1;
}
}
}
}

$temp -> close();
$temp2 -> close();

$diretorio=dir($path);

function subfolder($path){

  $nomePasta = explode("/",$path)[sizeof(explode("/",$path))-1];
  $diretorio = dir($path);
  $arquivos = "";
  $controlCard = explode(" ",$nomePasta)[sizeof(explode("/",$nomePasta))-1];


  while($fi = $diretorio -> read()){
    $way = $path."\\".$fi;
    if($fi!="." && $fi!=".." ){
      $arquivos = $arquivos."<a  href='documentView?document=".$way."'>".$fi."</a><br>";
    }
    
  }




  $retorno = '
  <br>
  <div class="row">
  <div class="col-lg-8">
              <div class="card border-left-danger border-right-danger shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#a'.$controlCard.'" class="d-block card-header py-3 collapsed" data-toggle="collapse" data-target="#a'.$controlCard.'" role="button" aria-expanded="true" aria-controls="'.$controlCard.'">
                  <h6 class="m-0 font-weight-bold text-danger">'.$nomePasta.'</h6>
                </a>
                
                <div class="collapse " id="a'.$controlCard.'">
                  <div class="card-body">
                    '.$arquivos.'
                  </div>
                </div>
              </div>
</div>
</div>';
$diretorio -> close();

  return $retorno;
}


function nextReunioes($setor){
global $pathConad;
global $pathConfis;
global $pathDirex;
global $nomesetor;


if(!(Storage::exists($setor))){

Storage::makeDirectory($setor);
}

$diretorio = dir($setor);
$ids = 0;
$now = date("d/m/Y");
$atualYear = explode("/",$now)[2];
$atualMonth = explode("/",$now)[1];
$atualDay = explode("/",$now)[0];

if($setor== $pathConad){
$nomeSetor="conad";
}else if($setor==$pathConfis){
$nomeSetor="confis";
}else{
$nomesetor="direx";
}

while($pastas = $diretorio -> read()){

if($pastas!="." && $pastas!=".." && $pastas>=(int) $atualDay){
$diretorioLeitura = dir($setor."/".$pastas);
while($pasta = $diretorioLeitura -> read()){
$idss = "T".(string)$ids."a";
$arquivos = "";
if($pasta!="." && $pasta!=".."){
$subdiretorio = dir($setor."/".$pastas."/".$pasta);
while($arquivo = $subdiretorio -> read()){
if($arquivo!="." && $arquivo!=".."){
  
  $way = $setor."/".$pastas."/".$pasta."/".$arquivo;
    if(is_dir($way)){
      $arquivos = $arquivos.subfolder($way);
    }else{
      $arquivos = $arquivos."<a href='documentView?document=".$way."'>".$arquivo."</a><br>";
    }

  


}
}

$retorno=
'<div id="'.$setor.'" class="row">
  <div class="col-lg-8">
    <!-- Collapsable Card Example -->
    <div id="card" class="card pasta shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#'.$idss.'" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button"
        data-target="#'.$idss.'" aria-expanded="true" aria-controls="'.$idss.'">

        <h6 class="pasta m-0 font-weight-bold text-primary">'.$pasta.' - '.$pastas."/".$atualMonth."/".$atualYear.'</h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse " id="'.$idss.'">
        <div class="card-body">'.$arquivos.

          '<br>
          <div class="row">';
            if(App\User::where('login',Session::get('usuario'))->firstorfail() -> type == "GERENCIA" || App\User::where('login',Session::get('usuario'))->firstorfail() -> type == "SECRETARIA"){
            $retorno = $retorno . '<div class="col-lg-5"><button type="button" class="botoes btn btn-secondary btn-icon-split">

                <span class="icon text-white-50">
                  <i class="fas fa-clone"></i>
                </span>
                <span class="text">Cadastrar Documento</span>
              </button></div>';
             }
              
             if(App\User::where('login',Session::get('usuario'))->firstorfail() -> type == "SECRETARIA"){
            $retorno = $retorno . 
              '<div class="col-lg-5"><button type="button" class="butArq btn btn-danger btn-icon-split">

                <span class="icon text-white-50">
                  <i class="fas fa-clone"></i>
                </span>
                <span class="text">Editar Documentos</span>
              </button></div>';
            }
            $retorno = $retorno .
              '

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>';
  return $retorno;
    $ids=$ids+1;
    }
    }
    }
    }
    };
    @endphp


    <!-- Begin Page Content -->
    <div class="container-fluid">



      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">Próximas Reuniões</h1>
      </div>

      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Próxima Reunião</div>
                  @if($primeiroDia == "")
                  <div class="h5 mb-0 font-weight-bold text-gray-800">Sem reuniões marcadas</div>
                  @else
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$primeiroDia."/".$atualMonth."/".$atualYear}}
                  </div>
                  @endif
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Última Reunião</div>
                  @if($lastDay != "..")
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$lastDay."/".$lastMonth."/".$lastYear}}</div>
                  @else
                  <div class="h5 mb-0 font-weight-bold text-gray-800">Nenhuma reunião esse mês</div>
                  @endif
                </div>
                <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Reuniões esse ano</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$countDays}}</div>
                    </div>
                    <div class="col">
                      <div class="progress progress-sm mr-2">
                        <div class="progress-bar bg-info" role="progressbar"
                          style="width: {{100*$countDays/$reunioes}}%" aria-valuenow={{$countDays}} aria-valuemin="0"
                          aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Reuniões pendentes esse ano
                  </div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$reunioes-$countDays}}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--Teste inicia aqui -->

      @php

      if($setor=="DIREX"||$setor=="GERENCIA"||$setor=="SECRETARIA"){
      echo
      '<div class="row">
        <div class="col-lg-12">
          <!-- Collapsable Card Example -->
          <div class="titleSect card border-left-success shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#conad" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button"
              data-target="#conad" aria-expanded="true" aria-controls="conad">
              <h6 class="setorTitle m-0 font-weight-bold text-success">CONAD</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse " id="conad">
              <div class="card-body">'
                .nextReunioes($pathConad);
                if(App\User::where('login',Session::get('usuario'))->firstorfail() -> type == "SECRETARIA"){
                echo '<button type="button" class="butReuniao btn btn-success btn-icon-split">

                  <span class="icon text-white-50">
                    <i class="fas fa-clone"></i>
                  </span>
                  <span class="text">Cadastrar Nova Reunião</span>
                </button>';
              }
              echo '
              </div>
            </div>
          </div>
        </div>
      </div>'.

      '<div class="row">
        <div class="col-lg-12">
          <!-- Collapsable Card Example -->
          <div class="titleSect card border-left-warning shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#confis" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button"
              data-target="#confis" aria-expanded="true" aria-controls="confis">
              <h6 class="setorTitle m-0 font-weight-bold text-warning">CONFIS</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse " id="confis">
              <div class="card-body">'
                .nextReunioes($pathConfis);
                if(App\User::where('login',Session::get('usuario'))->firstorfail() -> type == "SECRETARIA"){
                echo '<button type="button" class="butReuniao btn btn-warning btn-icon-split">

                  <span class="icon text-white-50">
                    <i class="fas fa-clone"></i>
                  </span>
                  <span class="text">Cadastrar Nova Reunião</span>
                </button>';
              }
                echo '</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <!-- Collapsable Card Example -->
          <div class="titleSect card border-left-info shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#direx" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button"
              data-target="#direx" aria-expanded="true" aria-controls="direx">
              <h6 class="setorTitle m-0 font-weight-bold text-info">DIREX</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse " id="direx">
              <div class="card-body">'
                .nextReunioes($pathDirex);
                if(App\User::where('login',Session::get('usuario'))->firstorfail() -> type == "SECRETARIA"){
                echo '<button type="button" class="butReuniao btn btn-info btn-icon-split">

                  <span class="icon text-white-50">
                    <i class="fas fa-clone"></i>
                  </span>
                  <span class="text">Cadastrar Nova Reunião</span>
                </button>';
              }
               echo ' </div>
            </div>
          </div>
        </div>
      </div>';
      }else if($setor=="CONAD"){
      echo '<div class="titleSect card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="setorTitle m-0 font-weight-bold text-primary">CONAD</h6>
        </div>
        <div class="card-body">'.
          nextReunioes($pathConad).
          '</div>
      </div>';
      }else{


      echo '

      <div class="titleSect card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="setorTitle m-0 font-weight-bold text-primary">CONFIS</h6>
        </div>
        <div class="card-body">'.
          nextReunioes($pathConfis)
          .'
        </div>
      </div>';
      }
      @endphp




    </div>
    <!-- /.container-fluid -->


  <!-- End of Main Content -->
  @endsection
