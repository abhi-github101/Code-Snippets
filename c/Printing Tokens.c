#include <stdio.h>
#include <string.h>
#include <math.h>
#include <stdlib.h>

int main() {

    char *s;
    s = malloc(1024 * sizeof(char));
    scanf("%[^\n]", s);
    s = realloc(s, strlen(s) + 1);
    s[strlen(s)]='\n';
    int i=0;
    while(s[i]!='\n'){
        if(s[i]==' '){
			printf("\n");
			i++;	
			continue;
        }
        printf("%c",s[i]);
        
        i++;
    }
    
	return 0;
}