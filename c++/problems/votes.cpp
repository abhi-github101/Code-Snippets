#include <iostream>
#include <string>

using namespace std;

int main(){
	int votes;ex
	cin >> votes;

	int candidate[100];
	for (int i=0;i<100;i++){
		candidate[i]=0;
	}
	int n;
	for (int i=0;i<votes;i++){
		cin >> n;
		candidate[n-1]+=1;
	}

	int winner=0;
	for (int i=1;i<100;i++){
		if(candidate[winner]<candidate[i]){
			winner=i;
		}
	}
	winner+=1;
	cout << "Winner: " << winner <<" ,Votes: "<<candidate[winner-1]<< endl;
}

