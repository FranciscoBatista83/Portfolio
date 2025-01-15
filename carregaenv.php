<?php 

// Função para carregar variáveis de ambiente a partir de um arquivo .env
function carregarEnv($caminho = __DIR__ . '/.env') {
    
    // Verifica se o arquivo .env existe no caminho especificado
    if (!file_exists($caminho)) {
        // Se o arquivo não for encontrado, lança uma exceção com a mensagem de erro
        throw new Exception('Arquivo .env não encontrado');
    }
    
    // Lê o arquivo linha por linha, ignorando linhas vazias ou comentadas
    $linhas = file($caminho, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // Itera sobre cada linha do arquivo
    foreach ($linhas as $linha) {
        // Divide a linha na primeira ocorrência do caractere '='
        list($chave, $valor) = explode('=', $linha, 2);
        
        // Remove espaços em branco e define a variável de ambiente
        putenv(trim($chave) . '=' . trim($valor));
    }
}
?>