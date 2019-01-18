<?php

require_once '../dao/ArchivoUploadDAO.php';
require_once 'DocumentoEntradaModel.php';

class ArchivoUploadModel{
    
    public function insertar_archivos($id_documento,$urls)
    {
        try
        {
            $dao = new ArchivoUploadDAO();
            // echo $urls;
            foreach($urls as $url)
            {
                // $rec = 
                $dao->insertar_archivos($id_documento,$url);
            }
            // return $rec;
        }catch(Exception $e)
        {
            throw $e;
        }
    }
    public function obtener_urls($id_documento)
    {
        try
        {
            $dao = new ArchivoUploadDAO();
            $lista = $dao->listar_archivos($id_documento);
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
        }
    }
    public function eliminar_archivo($id_documento,$nombre_archivo)
    {
        try
        {
            $dao = new ArchivoUploadDAO();
            $res = $dao->eliminar_archivo($id_documento,$nombre_archivo);
            return $res;
        }catch(Exception $ex)
        {
            throw $ex;
        }
    }
    public function eliminar_archivoFisico($url)
    {
        // if($data==true)
        // {
            // $model=new DocumentoEntradaModel();
            // $value;
            // $id_cumplimientos = $model->getIdCumplimiento($id_documento);
            // foreach($id_cumplimientos as $value)
            // {}
//            $url = 'C:xampp/htdocs/enerin-omg/archivos/files/'.$value.'/'.$id_documento.'/'.$nombre_archivo;//Cambiar ruta del servidor a local y viceversa
            //   $url = '/home/fpa9q09nzhnx/public_html/omgcum/archivos/files/'.$value.'/'.$id_documento.'/'.$nombre_archivo;
           
//
            // echo "mostrando url: ".$url;
            // $url = $_REQUEST["URL"];
            $data = unlink($url);
        // }
        return $data;
    }

    public function listar_urls($CONTRATO,$URL)//LA URL YA DEBE VENIR CON EL ID A BUSCAR
    {
        if($CONTRATO==-1)
			$url = $URL;
		else
		{
			// $contrato = Session::getSesion("s_cont");
			$url = $CONTRATO."/".$URL;	
		}
                $url = Session::getSesion("tipo")."/".$url;
		$carpetaDestino = "../../archivos/".$url;
//                $carpetaDestino = "../../archivos/".Session::getSesion("tipo")."/".$url;
		$creado=true;
		if(!file_exists($carpetaDestino))
		{
			$creado = mkdir($carpetaDestino,0777,true);
		}
		
		if($creado == true)
		{
			if($CONTRATO==-1)
			{
//				$url = $_REQUEST['URL'];
				$urls = Session::getSesion("URLS");
				$urlIR = $urls["fisica"].$url;
                                $urlLogica = $urls["logica"].$url;
				$files = scandir($urlIR);//Se forma la url fisica
			}
			else
			{
				// $contrato = Session::getSesion("s_cont");
//				$url = $URL;
				$urls = Session::getSesion("URLS");
				$urlIR = $urls["fisica"].$url;
                $urlLogica = $urls["logica"].$url;
				$files = scandir($urlIR);//Se forma la url fisica
			}
			$archivosNames = array();
			foreach($files as $index=>$value)
			{
				if($index>=2)
				{
					$archivosNames[$index-2] = $value;
				}
			}
			$todo[0] = $archivosNames;
			$todo[1] = $urlLogica;
            return $todo;
		}
    }
}
?>
