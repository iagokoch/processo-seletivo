puts "Escolha um número: \n"
n = gets.to_i

def perfeito(n)
    soma = 0
    for i in 1..n-1 #nao inclui o proprio numero
        if n % i == 0
        soma += i
        end
    end
    
    if soma == n
        puts "#{n} é um número perfeito."
    else
        puts "#{n} não é um número perfeito."
    end
    return soma
    end

perfeito(n)
   