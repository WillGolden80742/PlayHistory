<?php 
    include 'Model/MonumentosModel.php';

    class MonumentosController {

        function __construct() {
            $this->conFactoryPDO = new ConnectionFactoryPDO();
            $this->monumentos = new MonumentosModel();
        }

        function listadeMonumentos () {
            $result = $this->monumentos->listadeMonumentos();
            $json = array();
            $json_str = "";
            foreach ($result as $r) {
                $json_str.="\n\n\"".$r['nome']."\": {\"idMonumento\" : ".$r['idMonumento'].", \"latitude\" : ".$r['latitude'].",\"longitude\" : ".$r['longitude'].", \"descricao\" : \"".$r['descricao']."\"},\n";
            }
            $json_str = rtrim($json_str,",\n");
            $json = "{\"Monumentos\" : {".$json_str."\n\n}}";
            echo $json;
        }

        function listadeMonumentosByNome ($nome) {
            $result = $this->monumentos->listadeMonumentosByNome($nome);
            $json = array();
            $json_str = "";
            foreach ($result as $r) {
                $json_str.="\n\n\"".$r['nome']."\": {\"idMonumento\" : ".$r['idMonumento'].", \"latitude\" : ".$r['latitude'].",\"longitude\" : ".$r['longitude'].", \"descricao\" : \"".$r['descricao']."\"},\n";
            }
            $json_str = rtrim($json_str,",\n");
            $json = "{\"Monumentos\" : {".$json_str."\n\n}}";
            echo $json;
        }

        function audioDescricao ($id) {
            $result = $this->monumentos->audioDescricao($id);
            foreach ($result as $r) {
                $audioDescricao = $r['audioDescricao'];
            }
            if (isset($audioDescricao)) {
                return $audioDescricao;
            } else {
                return $this->arquivoNaoEncontrado();
            }
    
        }

        function audioDescricaoNome ($id) {
            $result = $this->monumentos->audioDescricaoNome($id);
            foreach ($result as $r) {
                $audioDescricao = $r['nomeAudioDescritto'];
            }
            if (isset($audioDescricao)) {
                return $audioDescricao;
            } else {
                return $this->arquivoNaoEncontrado();
            }
    
        }

        function arquivoNaoEncontrado () {
            $result = $this->monumentos->arquivoNaoEncontrado();
            foreach ($result as $r) {
                return $r['arquivo'];
            }  
        }

        function permissoesNecessarias () {
            $result = $this->monumentos->permissoesNecessarias();
            foreach ($result as $r) {
                return $r['arquivo'];
            }  
        }

        function baixandoDados ($status) {
            $result = $this->monumentos->baixandoDados($status);
            foreach ($result as $r) {
                return $r['arquivo'];
            }  
        }
    }