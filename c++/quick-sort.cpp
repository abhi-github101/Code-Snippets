#include<stdio.h>

void Quicksort(int arr[],int pivot,int last);
int Partition(int arr[], int pivot, int last);

int main(){
	int LEN=13;
	int arr[]={6,9,10,2,7,3,11,1,4,8,13,5,12};
	printf("Unsorted Array: ");
	for(int i=0;i<LEN;i++){
		printf("%d",arr[i]);
		if(i<LEN-1){
			printf(", ");
		}else{
			printf("\n");
		}
	}
	
	Quicksort(arr,0,LEN);
	printf("Sorted Array: ");
	for(int i=0;i<LEN;i++){
		printf("%d",arr[i]);
		if(i<LEN-1){
			printf(", ");
		}else{
			printf("\n");
		}
	}
	
	return 0;
	
}

void Quicksort(int arr[],int pivot, int last){
	if (pivot<last){
		int part=Partition(arr,pivot,last);
		Quicksort(arr,pivot,part-1);
		Quicksort(arr,part+1,last);
	}
		
}

int Partition(int arr[],int pivot, int last){
	int x=arr[last];
	int i=pivot-1;
	for(int j=pivot;j<last;j++){
		if(arr[j]<=x){
			i=i+1;
			int temp=arr[j];
			arr[j]=arr[i];
			arr[i]=temp;
		}
	}
	int temp=arr[last];
	arr[last]=arr[i+1];
	arr[i+1]=temp;
	return i+1;
}