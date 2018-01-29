#include <stdio.h>
#include <string.h>
#include <stdlib.h>

char* computeFlag() {
    char* c = malloc(31);
    *(c+30) = '\0';
    for(int i = 0; i < 30; ++i) {
        *(c+i) = ((i+1)*77 ^ 15) % 26 + 65;
    }
    return c;
}

int main(int argc, char** argv) {
    if(argc != 2) {
        printf("Usage %s <flag>\n", *argv);
        exit(1);
    }
    if(strcmp(computeFlag(), *(argv+1)) == 0) {
        printf("Nice job. XOXO\n");
    } else {
        printf("This is not the flag :)\n");
        exit(1);
    }

    return 0;
}
