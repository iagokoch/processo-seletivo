puts "Insira o valor que deseja sacar: \n"
valor = gets.chomp.to_i

def caixa(valor)
  # Definindo notas e moeda
  notas = [100, 50, 20, 10, 5, 2]
  moedas = [1]  # Corrigido para plural para corresponder ao uso abaixo

  # Armazena a quantidade de nota e moeda (usar hash)
  resultado = {}  # Alterado para hash {}

  # Processo das notas 
  notas.each do |nota|
    if valor >= nota 
      quantidade = valor / nota
      resultado[nota] = quantidade  # Correto uso do hash
      valor -= quantidade * nota
    end
  end

  # Processo da moeda
  moedas.each do |moeda|  # Agora corresponde à variável definida acima
    if valor >= moeda 
      quantidade = valor / moeda
      resultado[moeda] = quantidade  # Correto uso do hash
      valor -= quantidade * moeda
    end
  end

  # Saída de dados 
  resultado.each do |valor_nota, quantidade|
    if valor_nota >= 2 
      puts "#{quantidade} #{quantidade == 1 ? "nota" : "notas"} de #{valor_nota}"  # Corrigido o ternário
    else 
      puts "#{quantidade} #{quantidade == 1 ? 'moeda' : 'moedas'} de #{valor_nota}"
    end
  end
end

caixa(valor)