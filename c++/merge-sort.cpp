#include<stdio.h>
#include<math.h> 

void Merge(int A[],int low, int mid, int high);
void Mergesort(int A[], int low, int high);

int main(){
	int LEN=12;
	int A[]={98,34,1,64,7,99,5,3,67,88,23,11};
	
	printf("Unsorted Array:");
	for(int i=0;i<LEN;i++){
		printf(" %d",A[i]);
	}
	
	Mergesort(A,0,LEN-1);
	
	printf("\nSorted Array:");
	for(int i=0;i<LEN;i++){
		printf(" %d",A[i]);
	}
	printf("\n");
	
	
return 0;
}

void Mergesort(int A[],int low,int high){
	if(low<high){
		int mid=0;
		if((low+high)%2==0){
			mid=(low+high)/2;
		}else{
			mid=(int)(low+high)/2;
		}
		Mergesort(A,low,mid);
		Mergesort(A,mid+1,high);
		Merge(A,low,mid,high);
	}
}

void Merge(int A[],int low,int mid,int high){
	int l1=mid-low+1;
	int l2=high-mid;
	int L[l1+1],R[l2+1];
	
	for(int i=0;i<l1;i++){
		L[i]=A[low+i];
	}
	for(int i=0;i<l2;i++){
		R[i]=A[mid+i+1];
	}
	L[l1]=111111111;
	R[l2]=111111111;
	
	int i=0,j=0;
	for(int k=low;k<=high;k++){
		if(L[i]<=R[j]){
			A[k]=L[i];
			i++;
		}else{
			A[k]=R[j];
			j++;
		}
	}
}
