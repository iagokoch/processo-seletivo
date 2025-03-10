//desafio fibonacci

#include <stdio.h>
#include <stdlib.h>
int main()
{
    int i, ant1 = 0, ant2 = 1, atual, n;

    printf("Quantos números da série Fibonacci você quer? ");
    scanf("%i", &n); //guarda a quantia que você pediu

    // Imprimir os primeiros valores manualmente
    printf("%i ", ant1);  
    
    if(n > 1) {
        printf("%i ", ant2); 
    }

    // Gera os números 
    for(i=2; i<n; i++){
        atual = ant1 + ant2;
        printf("%i ", atual);
        ant1 = ant2;
        ant2 = atual;
    }

    return 0;
}