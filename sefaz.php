<?php

class Sefaz {

    public $urlEnvioNFe = "https://bpe.ns.eti.br/v1/bpe/issue";
    public $urlStatusProcessamento = "https://bpe.ns.eti.br/v1/bpe/issue/status";
    public $urlDownloadBPe = "https://bpe.ns.eti.br/v1/bpe/get";

    public function emitirNFe($token, $conteudo, $tpConteudo){
        //Envia json para url        
        $result = $this->enviaConteudoParaAPI($token, $conteudo, $this->urlEnvioNFe, $tpConteudo);
        return $result;
    }

    public function consultarStatusProcessamento($token, $CNPJ, $nsNRec){
        $json = '{"X-AUTH-TOKEN": "' . $token . '",
                "CNPJ": "' . $CNPJ . '",
                "nsNRec": "' . $nsNRec . '"
        }';
        $result = $this->enviaConteudoParaAPI($token, $json, $this->urlStatusProcessamento, "json");
        return $result;
    }

    function enviaConteudoParaAPI($token, $conteudoAEnviar, $url, $tpConteudo = "json"){
        try{
            //Inicializa cURL para uma URL.
            $ch = curl_init($url);
            //Marca que vai enviar por POST(1=SIM).
            curl_setopt($ch, CURLOPT_POST, 1);
            //Passa um json para o campo de envio POST.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $conteudoAEnviar);
            //Marca como tipo de arquivo enviado json
            if ($tpConteudo == "json")
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'X-AUTH-TOKEN: ' . $token));
            else if ($tpConteudo == "xml")
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml', 'X-AUTH-TOKEN: ' . $token));
            else
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain', 'X-AUTH-TOKEN: ' . $token));
            
            //Marca que vai receber string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            /*
            CASO NÃO ESTEJAS RECEBENDO O RETORNO DA API, PODES ESTAR COM
            PROBLEMAS NA VERIFICAÇÃO SSL. PARA TESTES PODES RETIRAR O COMENTÁRIO
            DA LINHA ABAIXO PARA DESABILITAR A VERIFICAÇÃO.
            */
            //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //Inicia a conexão
            $result = curl_exec($ch);
            //Fecha a conexão
            curl_close($ch);
        }catch(Exception $e){
            return $e->getMessage();
        }
        return $result;
    }

    public function downloadNFeAndSave($token, $chNFe, $tpDown, $caminho, $isShow){
        $result = $this->downloadNFe($token, $chNFe, $tpDown);
        
        $jsonRetorno = (array) json_decode($result);
        $status = $jsonRetorno['status'];
        
        if (strlen($caminho) > 0){
            if (substr_compare($caminho, '\\', -strlen(1))) $caminho = $caminho . '\\';
            if (!file_exists($caminho)) mkdir($caminho);
        }
        
        $downloadXML = stripos($tpDown, 'x');
        $downloadPDF = stripos($tpDown, 'p');
        $downloadJSON = stripos($tpDown, 'j');

        if($status == 200){ //Checa se a requisição funcionou
                if($downloadXML !== false)  //verifica se deve baixar o XML
                    $this->salvaXML($jsonRetorno, $caminho, $chNFe);
                else{
                    if($downloadJSON !== false) //verifica se deve baixar o JSON
                        $this->salvaJSON($jsonRetorno, $caminho, $chNFe);
                }
                if($downloadPDF !== false){ //verifica se deve baixar o PDF
                    $this->salvaPDF($jsonRetorno, $caminho, $chNFe);
                    if($downloadPDF !== false)  //verifica se deve exibir o PDF
                        $this->exibePDF($jsonRetorno, $caminho, $chNFe);
            }
        }
        return $result;
    }


    function downloadNFe($token, $chNFe, $tpDown){
        $json = '{"X-AUTH-TOKEN": "' . $token . '",
                "chNFe": "' . $chNFe . '",
                "tpDown": "' . $tpDown . '"
        }';
        
        $result = $this->enviaConteudoParaAPI($token, $json, $this->urlDownloadNFe, "json");
        return $result;
    }

    public function downloadBPe($token, $chBPe, $tpDown, $tpAmb){
        $json = '{"X-AUTH-TOKEN": "' . $token . '",
                "chBPe": "' . $chBPe . '",
                "tpAmb": "' . $tpAmb . '",
                "tpDown": "' . $tpDown . '"
        }';
        
        $result = $this->enviaConteudoParaAPI($token, $json, $this->urlDownloadBPe, "json");
        return $result;
    }

}

?>