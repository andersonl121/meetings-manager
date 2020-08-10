<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;
use Session;
use Redirect;
use App\Meeting;
use App\User;
use App\Doc;
use Carbon\Carbon;

class Documents extends Controller
{

    
   

    public function incluirDocumento(Request $request)
    {
        
        
        $caminho = Session::get('caminho');
        $pasta = Session::get('subpasta');
        


        //Tratamento de requisição ajax
        Log::info("3-".$caminho);
        Log::info("4-".$pasta);
        
        $jsonArray = json_decode($request->input('dados'),true);

        
        
        $index=0;

        foreach($jsonArray as $linhas){

            $anexo = array_values($jsonArray[$index])[0];
            $item = array_values($jsonArray[$index])[1];
            $arquivo = array_values($jsonArray[$index])[2];
            

            //$upload = $files[0]->storeAs('DIREX',"Anexo "+$anexo+" - "+$item+" - ".$files[0]->getClientOriginalName());
            if($pasta==""){
                Storage::move('temp/'.$index."-".$arquivo,$caminho."/Anexo ".$item." - Item ".$anexo." - ".$arquivo);
            }else{
                Storage::move('temp/'.$index."-".$arquivo,$caminho."/".$pasta."/Anexo ".$item." - Item ".$anexo." - ".$arquivo);
            }
            
            
            $index = $index + 1;

            $user = User::where('login',Session::get('usuario'))->firstOrFail();
            $meeting = Meeting::where('dsc',explode('\\',$caminho)[4])->firstOrFail();

            $doc = new Doc();
            $doc -> dsc = $arquivo;

            $doc -> type = "ANEXO";

            $meeting->docs()->save($doc);
            $doc->users()->attach($user->id,['datetime' => Carbon::now(),'type' => 'CREATION']);
            



        }
        
        
        //Item
        //Log::info(array_values($jsonArray[0])[0]);

        //Anexo
        //Log::info(array_values($jsonArray[0])[1]);

        
    }

    public function upFiles(Request $request){
         
         
        $files = $request->arquivos;
        
        
        $nomes = array();
        $index=0;
        $anexo = $request->anexoSubpasta;
        $item = $request->itemSubpasta;
        if($anexo < 10){
            $anexo = "0".$anexo;
        }
        if($item < 10){
            $item = "0".$item;
        } 
        $subpasta = "Anexo ".$anexo." - Item ".$item." - ".$request->subPasta;
        Session::put('subpasta',$subpasta);
        
        foreach($files as $file){
            //$file->storeAs('temp',$index."-".$file->getClientOriginalName());
            
            $nameFile = str_replace("-","_",$file->getClientOriginalName());
            $file->storeAs('temp/',$index."-".$nameFile);
            
            
            
            array_push($nomes,$nameFile);
            
            $index=$index+1;
            
        }       

        return redirect('cadDocs')->with('arquivos',$nomes);
        
    }
    
    public function cadastrarDocumento(Request $request){
        $caminho = $request->caminho;
        //Log::info("1-".$caminho);
        Session::put('caminho',$caminho);
        //Log::info("2-".Session::get('caminho'));
        return ['success' => true];
    }

    public function cadastrarReuniao(Request $request){
        $setor = $request->setor;
        
        Session::put('setor',$setor);
        Log::info("1-".Session::get('setor'));
        return ['success' => true];
        
    }

    public function cadReuniao(Request $request){
        $date = $request->date;
        $desc = $request->desc;

        $brDate = explode("-",$date);
        $setor = Session::get('setor');
        $caminhoPasta = $setor."/".$brDate[0]."/".$brDate[1]."/".$brDate[2]."/".$desc;
        Log::info($caminhoPasta);
        Log::info($setor);
        Storage::makeDirectory($caminhoPasta);

        
        $user = User::where('login',Session::get('usuario'))->firstOrFail();
        $reuniao = new Meeting;
        $reuniao->dsc = $desc;
        $reuniao->date = $date;
        $reuniao->type = $setor;
        $user->meetings()->save($reuniao);
        

        return redirect('index');
    }

    public function editDocs(Request $request){
        $caminho = $request->caminho;
        $files = array();
        $files = Storage::files($caminho);
        
        
        Session::flash('editingFiles',$files);
        Session::put('caminho',$caminho);

        $itens = explode("/",$caminho);

        

        
        
        return ['success' => true];
    }

    public function procEditDocs(Request $request){
        $caminho = Session::get('caminho');

        //Tratamento de requisição ajax
        //Log::info("3-".$caminho);
        
        $jsonArray = json_decode($request->input('dados'),true);

        
        
        
        //alterado aqui
        $diretorio = dir("storage/".$caminho);
        $oldfiles = array();

        while($arquivo = $diretorio -> read()){
            if($arquivo!="." && $arquivo!=".."){
                $oldfiles[] = $arquivo;
            }
        }
        //Log::info("3a-".$oldfiles[0]);
        


        //ate aqui
        
        //$oldFiles = Storage::files($caminho);
        //$oldFiles = Storage::directories($caminho);

        
        
        

        for($index=0;$index<sizeof($jsonArray);$index++){
            
            $anexo = array_values($jsonArray[$index])[0];
            $item = array_values($jsonArray[$index])[1];
            $arquivo = array_values($jsonArray[$index])[2];
            
            $novoNome = "Anexo ".$anexo." - Item ".$item." - ".$arquivo;
            //Log::info("4-".$novoNome);
            //Log::info("5-".$oldfiles[$index]);

            $novoNomeCompleto = str_replace("\\","/",$caminho)."/".$novoNome;
            

            //Log::info("6-".$novoNomeCompleto);
            if($oldfiles[$index]!=$novoNome){
                Storage::move($caminho."/".$oldfiles[$index],$caminho."/".$novoNome);
            }
            

            //$upload = $files[0]->storeAs('DIREX',"Anexo "+$anexo+" - "+$item+" - ".$files[0]->getClientOriginalName());
            
            
        }
    }

    public function openFolder(Request $request){
        $caminho = Session::get('caminho');
        $caminho = $caminho."/".$request->folder;
        $caminho = str_replace("\\","/",$caminho);
        //Log::info("10-".$caminho);
        $files = array();
        $files = Storage::files($caminho);
        //Log::info("11-".$files[0]);
        
        Session::put('editingFiles',$files);
        Session::put('caminho',$caminho);

        $itens = explode("/",$caminho);

        

        
        
        return ['success' => true];
    }

    public function deleteFolder(Request $request){
        $caminho = Session::get('caminho');
        $caminho = $caminho."\\".$request->folder;

        


        
        Storage::delete($caminho);        
        Storage::deleteDirectory($caminho);        
        
        return ['success' => true];
    }

}
