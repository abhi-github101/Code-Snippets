#include <stdio.h>
#include <string.h>
#include <math.h>
#include <stdlib.h>

int main() 
{
    char c;
    char str[50];
    char sen[50];
    scanf("%c\n%s\n%[^\n]*%s",&c,str,sen);
   
    printf("%c\n%s\n%s",c,str,sen);
    return 0;
}