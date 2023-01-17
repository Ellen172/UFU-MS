function allDays(){
    data = new Date();
    data.setDate(1);
    data.setMonth(0);

    datas = [];
    for(var i=0; i<12; i++){
        for(var j=0; j<32; j++){
            dataAtual = new Date();
            if(i==1){
                dataAtual.setDate(j);
                dataAtual.setMonth(i);
                if(j==28){
                    j==32;
                }
            }
            if(i==0 || i==3 || i==4 || i==6 || i==7 || i==9 || i==11){
                dataAtual.setDate(j);
                dataAtual.setMonth(i);
            } 
            else {
                dataAtual.setDate(j);
                dataAtual.setMonth(i);
                if(j==30){
                    j==32;
                }
            }
            datas.push(dataAtual);
        }
    }
}

var local =[ {
    id_local: 1, 
    datas_disponiveis: allDays(), 
    endereco: {
        cep: '123123123',
        logradouro: 'rua 1',
        nro: 23,
        bairro: 'bairro 1',
        cidade: 'Uberlândia', 
        estado: 'MG'
    }, 
    custo_venda_local: 100.00,
    image: "./img/local1.jpg"
}, {
    id_local: 2, 
    datas_disponiveis: allDays(), 
    endereco: {
        cep: '123123456',
        logradouro: 'rua 2',
        nro: 45,
        bairro: 'bairro 2',
        cidade: 'Uberlândia', 
        estado: 'MG'
    }, 
    custo_venda_local: 120.00, 
    image: "./img/local2.jpg"
}, {
    id_local: 3, 
    datas_disponiveis: allDays(), 
    endereco: {
        cep: '123456456',
        logradouro: 'rua 3',
        nro: 78,
        bairro: 'bairro 3',
        cidade: 'Uberlândia', 
        estado: 'MG'
    }, 
    custo_venda_local: 350.00, 
    image: "./img/local3.jpg"
}]

function buscarLocais(){
    
    var element = document.querySelector("#opcoesLocais");
    for(var k=0; k<local.length; k++){
        htmlAtual = element.innerHTML;

        opcaoHtml = `<input type="radio" name="opcaoLocal"><img src="${local[k].image}" class="imageRadio">`;

        element.innerHTML = htmlAtual + opcaoHtml;
    }
    
}

var fornecedor1 = {
    id_fornecedor: 1,
    fornece_local: true, 
    fornece_servico: true, 
    fornece_produto: true, 
    razaoSocial: "Loja da esquina", 
    cnpj: "123.123/0001-56", 
    enderecoPrincipal: {
        cep: '456456456',
        logradouro: 'rua 5',
        nro: 97,
        bairro: 'bairro 5',
        cidade: 'Uberlândia', 
        estado: 'MG'
    }
}

var tema = [{
    id_tema: 1,
    nome: "Baile de mascaras",
    custo_venda_tema: 200.00,
    itemProduto: {
        id_item_produto: 1, 
        produto: {
            id_produto: 1, 
            nome_produto: "mascara", 
            decoracao: true, 
            custo_venda_produto: 2.00
        }, 
        fornecedor: fornecedor1, 
        qtd_compra: 100, 
        custo_compra_produto: 1.50
    }, 
    custo_compra_tema: 150.00, 
    image: "./img/tema1.jpg"
}, {
    id_tema: 2,
    nome: "Festa neon",
    custo_venda_tema: 350.00,
    itemProduto: {
        id_item_produto: 2, 
        produto: {
            id_produto: 2, 
            nome_produto: "pulseiras neon", 
            decoracao: true, 
            custo_venda_produto: 1.00
        }, 
        fornecedor: fornecedor1, 
        qtd_compra: 100, 
        custo_compra_produto: 0.50
    }, 
    itemProduto: {
        id_item_produto: 3, 
        produto: {
            id_produto: 3, 
            nome_produto: "tinta facil neon", 
            decoracao: true, 
            custo_venda_produto: 2.00
        }, 
        fornecedor: fornecedor1, 
        qtd_compra: 100, 
        custo_compra_produto: 1.50
    }, 
    custo_compra_tema: 300.00, 
    image: "./img/tema2.jpeg"
}]

function buscarTemas(){
    
    var element = document.querySelector("#opcoesTemas");
    for(var k=0; k<local.length; k++){
        htmlAtual = element.innerHTML;

        opcaoHtml = `<input type="radio" name="opcaoTema"><img src="${tema[k].image}" class="imageRadio">`;

        element.innerHTML = htmlAtual + opcaoHtml;
    }
    
}


buscarLocais();
buscarTemas();