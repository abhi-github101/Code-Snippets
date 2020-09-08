#include<stdio.h>

void Insertion_Sort(int A[],int len);

int main(){
	int LEN=12;
	int A[]={89,6,45,9,21,11,43,980,213,67,8,2};
	
	printf("Unsorted Array:");
	for(int i=0;i<LEN;i++){
		printf(" %d",A[i]);
	}
	
	Insertion_Sort(A,LEN);
	
	printf("\nSorted Array:");
	for(int i=0;i<LEN;i++){
		printf(" %d",A[i]);
	}
	printf("\n");
	
	return 0;
}

void Insertion_Sort(int A[],int len){
	for(int j=1;j<len;j++){
		int d=A[j];
		int i=j-1;
		while(i>=0&&A[i]>d){
			A[i+1]=A[i];
			i--;
		}
		A[i+1]=d;		
	}
}