#include <stdio.h>
#include <string.h>
#include <math.h>
#include <stdlib.h>

int main()
{
	int a,b;
    float fa,fb;
    scanf("%d %d\n%f %f",&a,&b,&fa,&fb);
    printf("%d %d\n%.1f %.1f",(a+b),(a-b),(fa+fb),(fa-fb));

    return 0;
}