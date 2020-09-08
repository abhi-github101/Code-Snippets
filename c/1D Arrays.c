#include <stdio.h>
#include <string.h>
#include <math.h>
#include <stdlib.h>

int main() {

    int len;
    
    scanf("%d",&len);
    int sum=0;
    int last=len*2-1;

    for(int i=0;i<len;i++){
        int temp;
        scanf("%d ",&temp);
        sum+=temp;    
    }

    printf("%d",sum);

    return 0;
}