// Receber o seletor do campo preço
let inputPrice = document.getElementById('price');

// Verificar se existe o seletor no HTML
if(inputPrice) {
    // Aguardar o usuário digitar valor no campo
    inputPrice.addEventListener('input', function () {
        // Obter o valor atual removendo qualquer caractere que não seja número
        let valuePrice = this.value.replace(/[^\d]/g, '');

        // Adicionar os separadores de milhares
        /* Explicação:
           valuePrice.slice(0, -2) extrai todos os caracteres da string valuePrice, exceto os dois últimos.
           .replace(/\B(?=(\d{3})+(?!\d))/g, ".") substitui cada grupo de três dígitos consecutivos
            (representados pela expressão regular \d{3}) por um ponto, para formatar o número como um valor monetário.
           , valuePrice.slice(-2) adiciona os dois últimos caracteres de valuePrice de volta à string.
        */

        var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + valuePrice.slice(-2);

        // Adicionar a vírgula e até dois dígitos se houver centavos
        if(formattedPrice.length > 2) {
            formattedPrice = formattedPrice.slice(0, -2) + ',' + formattedPrice.slice(-2);
        }

        // Atualizar o campo com o valor formatado
        this.value = formattedPrice;
    });
}
