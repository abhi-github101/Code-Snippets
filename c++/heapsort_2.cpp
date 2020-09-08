#include<iostream>

using namespace std;

void Max_Heapify(int A[],int i);
void Build_Max_Heap(int A[],int len);
void Heapsort(int A[],int len);

int heapsize=0;

int main(){
	int arrays=0;
	cin >> arrays;
	for(int i=0;i<arrays;i++){
		int len=0;	
		cin >> len;
		
		int A[]=new int[len];
		for(int l=0;l<len;l++){
			cin >> A[len];
		}
		
		cout << i+". ------------------------------\n";
		
		cout << "Unsorted: ";
		for(int j=0;j<len;j++){
			cout << A[j]+" ";
		}
		Heapsort(A,len);
		cout << "\nSorted: ";
		for(int j=0;j<len;j++){
			cout << A[j]+" ";
		}
		cout << "\n\n";	
	}
	return 0;	
}

void Build_Max_Heap(int A[],int len){
	heapsize=len-1;
	int i=((int)len/2)-1;
	for(;i>=0;i--){
		Max_Heapify(A,i);
	}
}

void Max_Heapify(int A[],int i){
	int l=2*i+1;
	int r=2*i+2;
	int largest;
	if(l<=heapsize&&A[l]>A[i]){
		largest=l;
	}else{
		largest=i;	
	}
	if(r<=heapsize&&A[r]>A[largest]){
		largest=r;
	}
	if(largest!=i){
		int temp=A[largest];
		A[largest]=A[i];
		A[i]=temp;
		Max_Heapify(A,largest);
	}
	
}

void Heapsort(int A[],int len){
	Build_Max_Heap(A,len);
	for(int i=len-1;i>0;i--){
		int temp=A[i];
		A[i]=A[0];
		A[0]=temp;
		heapsize--;
		Max_Heapify(A,0);
	}
}
