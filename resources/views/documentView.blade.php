@extends('topbar')




@section('content')
    

<!--<embed src= width="100%" height="600" type='application/pdf'>
    -->
    
    
    <div id="pdf" >
        
        <iframe id="documento"  width="100%" height="550"  src=" ViewerJS/index.html#../{{$_GET['document']}}">
            <p>Erro ao carregar documento. Favor entrar em contato com o suporte.</p>
        </iframe>
    </div>
 
@endsection