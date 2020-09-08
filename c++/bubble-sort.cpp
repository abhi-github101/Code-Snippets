#include<stdio.h>

void Bubble_Sort(int A[],int len);

int main(){

	int LEN=12;
	int A[]={89,6,45,9,21,11,43,980,213,67,8,2};
	
	printf("Unsorted Array:");
	for(int i=0;i<LEN;i++){
		printf(" %d",A[i]);
	}
	
	Bubble_Sort(A,LEN);
	
	printf("\nSorted Array:");
	for(int i=0;i<LEN;i++){
		printf(" %d",A[i]);
	}
	
	printf("\n");
	return 0;
}

void Bubble_Sort(int A[],int len){
	int swap=0;
	for(int stage=len;stage>0;stage--){
		for(int i=0,j=1;j<stage;j++,i++){
			if(A[i]>A[j]){
				int temp=A[j];
				A[j]=A[i];
				A[i]=temp;
				swap++;
			}
		}
		if(swap==0){
			return;
		}
	}	
}