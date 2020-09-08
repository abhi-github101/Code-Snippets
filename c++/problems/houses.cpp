#include <iostream>

using namespace std;

int main(){
    int n;
    int k;
    cin >> n >> k;
    int temp;
	cin >>temp;
    int max=temp,min=temp;
    for(int i = 0;i < n;i++){
       cin >> temp;
        if(temp>max){
            max=temp;
        }
        if(min>temp){
            min=temp;
        }
    }
	cout<<min<<"||"<<max;
    int trans=0;
	k=2*k+1;
    for(int i=min;i<=max;i+=k){
        trans++;
    }
    cout<< trans<<endl;
    
    return 0;
}

