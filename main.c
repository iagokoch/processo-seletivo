#include <stdio.h>
#include <stdlib.h>
// Função para comparar dois inteiros 
int comparar(const void *a, const void *b) {
    return (*(int*)a - *(int*)b);
}

int busca_binaria_primeira_ocorrencia(int arr[], int tamanho, int alvo) {
    int esquerda = 0;
    int direita = tamanho - 1;
    int resultado = -1;  // Para armazenar a primeira ocorrência

    while (esquerda <= direita) {
        int meio = esquerda + (direita - esquerda) / 2;  // Evita overflow

        if (arr[meio] == alvo) {
            resultado = meio;  // Armazenamos a posição atual
            direita = meio - 1;  // Faz a procura à esquerda
        } 
        else if (arr[meio] < alvo) {
            esquerda = meio + 1;  // O alvo está à direita
        } 
        else {
            direita = meio - 1;  // O alvo está à esquerda
        }
    }

    return resultado;
}

// Função principal
int main() {
    
    int lista[] = {5, 12, 18, 23, 33, 45, 47, 56, 70, 89, 98};
    int tamanho = sizeof(lista) / sizeof(lista[0]);
    
    qsort(lista, tamanho, sizeof(int), comparar);
    
    // Mostrar a lista ordenada na tela
    printf("Lista ordenada: [");
    for (int i = 0; i < tamanho; i++) {
        printf("%d", lista[i]);
        if (i < tamanho - 1) {
            printf(", ");
        }
    }
    printf("]\n");
    
    // Pede o número alvo
    int alvo;
    printf("Digite o número que deseja buscar: ");
    scanf("%d", &alvo);
    
    int resultado = busca_binaria_primeira_ocorrencia(lista, tamanho, alvo);
    
    //Mostra o resultado
    if (resultado != -1) {
        printf("O número %d foi encontrado no indice: %d\n", alvo, resultado);
    } else {
        printf("%d\n", resultado);  // Mostra o -1 se o número não for encontrado
    }
    
    return 0;
}