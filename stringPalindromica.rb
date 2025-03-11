puts "Escreva uma palavra: \n"
palavra = gets.chomp

substring = palavra[0..8]

def palindromo(palavra)

  if string == substring.reverse
    puts "#{substring} é um palíndromo."
  else
    puts "#{substring} não é um palíndromo."
  end

  return substring

end

palindromo(palavra)