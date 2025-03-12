puts "Escreva uma palavra: \n"
palavra = gets.chomp

def substrings_palindromas(palavra)
  palindromos_encontrados = []
  
  # Verifica todas as substrings possíveis
  (0...palavra.length).each do |inicio|
    (inicio...palavra.length).each do |fim|
      substring = palavra[inicio..fim]
      
      # Ve se tem mais de uma letra e se é palíndroma
      if substring.length > 1 && substring == substring.reverse
        palindromos_encontrados << substring
      end
    end
  end
  
  if palindromos_encontrados.empty?
    puts "Não tem nenhuma substring palíndroma em '#{palavra}'."
  else
    puts "Substrings palíndromas encontradas em '#{palavra}':"
    palindromos_encontrados.uniq.each do |palindromo|
      puts "- #{palindromo}"
    end
  end
end

substrings_palindromas(palavra)